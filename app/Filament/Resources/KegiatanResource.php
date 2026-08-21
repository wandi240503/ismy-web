<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KegiatanResource\Pages;
use App\Filament\Resources\KegiatanResource\RelationManagers\PesertaRelationManager;
use App\Models\Kegiatan;
use App\Models\Anggota;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class KegiatanResource extends Resource
{
    protected static ?string $model = Kegiatan::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationGroup = 'Publikasi & Konten';

    protected static ?string $navigationLabel = 'Agenda & Kegiatan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Kegiatan')
                    ->schema([
                        Forms\Components\TextInput::make('judul')
                            ->label('Nama Kegiatan / Agenda')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                        Forms\Components\TextInput::make('slug')
                            ->label('Slug URL')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('tanggal')
                            ->label('Tanggal Pelaksanaan')
                            ->required(),
                        Forms\Components\TimePicker::make('waktu')
                            ->label('Waktu / Jam'),
                        Forms\Components\TextInput::make('lokasi')
                            ->label('Lokasi / Tempat')
                            ->placeholder('Contoh: Ruang Sidang Utama UGM / Online Zoom')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('kuota')
                            ->label('Kuota Peserta (Opsional)')
                            ->numeric(),
                        Forms\Components\FileUpload::make('gambar')
                            ->label('Poster / Gambar Kegiatan')
                            ->image()
                            ->disk('public')
                            ->directory('kegiatans')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('deskripsi')
                            ->label('Deskripsi & Rincian Agenda')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('gambar')
                    ->label('Poster')
                    ->disk('public')
                    ->circular(),
                Tables\Columns\TextColumn::make('judul')
                    ->label('Nama Kegiatan')
                    ->searchable()
                    ->sortable()
                    ->limit(30),
                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('lokasi')
                    ->label('Lokasi')
                    ->searchable()
                    ->limit(25),
                Tables\Columns\TextColumn::make('anggota_count')
                    ->label('Peserta Hadir')
                    ->counts('anggota')
                    ->badge()
                    ->color('success')
                    ->sortable(),
            ])
            ->defaultSort('tanggal', 'desc')
            ->actions([
                Tables\Actions\Action::make('kelola_presensi')
                    ->label('Daftar Presensi')
                    ->icon('heroicon-o-clipboard-document-check')
                    ->color('primary')
                    ->url(fn (Kegiatan $record) => KegiatanResource::getUrl('edit', ['record' => $record]))
                    ->tooltip('Buka daftar presensi dan daftar kehadiran anggota pada acara ini'),
                Tables\Actions\Action::make('presensi')
                    ->label('Scan QR / Presensi')
                    ->icon('heroicon-o-qr-code')
                    ->color('success')
                    ->button()
                    ->size('xs')
                    ->modalHeading(fn (Kegiatan $record) => "Presensi: " . $record->judul)
                    ->modalDescription('Pilih anggota atau masukkan hasil scan QR / nomor anggota untuk mencatat kehadiran.')
                    ->form([
                        Forms\Components\Select::make('anggota_id')
                            ->label('Cari Anggota (Nama atau No. KTA)')
                            ->options(
                                 Anggota::with('wilayah')->get()->mapWithKeys(function ($a) {
                                     $wilayahNama = $a->wilayah->nama ?? 'DIY';
                                     return [$a->id => "[" . $a->nomor_anggota . "] " . $a->nama_lengkap . " (" . $wilayahNama . ")"];
                                 })
                            )
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->label('Status Kehadiran')
                            ->options([
                                'hadir' => 'Hadir di Lokasi',
                                'terdaftar' => 'Terdaftar / RSVP',
                            ])
                            ->default('hadir')
                            ->required(),
                    ])
                    ->action(function (Kegiatan $record, array $data) {
                        $record->anggota()->syncWithoutDetaching([
                            $data['anggota_id'] => ['status' => $data['status']],
                        ]);

                        $anggota = Anggota::find($data['anggota_id']);

                        Notification::make()
                            ->title('Presensi Berhasil Dicatat!')
                            ->body('Kehadiran ' . ($anggota->nama_lengkap ?? '') . ' pada acara "' . $record->judul . '" berhasil diverifikasi.')
                            ->success()
                            ->send();
                    }),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            PesertaRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKegiatans::route('/'),
            'create' => Pages\CreateKegiatan::route('/create'),
            'edit' => Pages\EditKegiatan::route('/{record}/edit'),
        ];
    }
}
