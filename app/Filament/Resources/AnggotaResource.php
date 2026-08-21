<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnggotaResource\Pages;
use App\Models\Anggota;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AnggotaResource extends Resource
{
    protected static ?string $model = Anggota::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationGroup = 'Keanggotaan';

    protected static ?string $navigationLabel = 'Daftar Anggota';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Akun & Keanggotaan')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('Akun Pengguna (User)')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\Select::make('wilayah_id')
                            ->label('Cabang / Wilayah')
                            ->relationship('wilayah', 'nama')
                            ->searchable()
                            ->preload(),
                        Forms\Components\TextInput::make('nomor_anggota')
                            ->label('Nomor Anggota ISMY')
                            ->unique(ignoreRecord: true)
                            ->placeholder('ISMY-00001')
                            ->maxLength(255),
                        Forms\Components\Select::make('status_keanggotaan')
                            ->label('Status Keanggotaan')
                            ->options([
                                'aktif' => 'Aktif',
                                'nonaktif' => 'Nonaktif',
                                'kehormatan' => 'Anggota Kehormatan',
                            ])
                            ->default('aktif')
                            ->required(),
                    ])->columns(2),

                Forms\Components\Section::make('Biodata Diri')
                    ->schema([
                        Forms\Components\TextInput::make('nama_lengkap')
                            ->label('Nama Lengkap (beserta Gelar)')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('nik')
                            ->label('NIK')
                            ->maxLength(20),
                        Forms\Components\TextInput::make('tempat_lahir')
                            ->label('Tempat Lahir')
                            ->maxLength(100),
                        Forms\Components\DatePicker::make('tanggal_lahir')
                            ->label('Tanggal Lahir'),
                        Forms\Components\TextInput::make('telepon')
                            ->label('Nomor Telepon / WhatsApp')
                            ->tel()
                            ->maxLength(25),
                        Forms\Components\Select::make('pendidikan_terakhir')
                            ->label('Pendidikan Terakhir')
                            ->options([
                                'S1' => 'Sarjana (S1)',
                                'S2' => 'Magister (S2)',
                                'S3' => 'Doktor (S3)',
                                'Profesi' => 'Profesi / Spesialis',
                            ]),
                        Forms\Components\TextInput::make('bidang_keahlian')
                            ->label('Bidang Keahlian')
                            ->maxLength(100)
                            ->placeholder('Sosiologi Budaya, Hukum, dll.'),
                        Forms\Components\Textarea::make('alamat')
                            ->label('Alamat Domisili')
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('foto')
                            ->label('Pas Foto Anggota')
                            ->image()
                            ->disk('public')
                            ->directory('anggotas')
                            ->avatar()
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto')
                    ->label('Foto')
                    ->disk('public')
                    ->circular(),
                Tables\Columns\TextColumn::make('nomor_anggota')
                    ->label('No. KTA')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama_lengkap')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('wilayah.nama')
                    ->label('Cabang Wilayah')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bidang_keahlian')
                    ->label('Keahlian')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kegiatan_count')
                    ->label('Keaktifan Acara')
                    ->counts('kegiatan')
                    ->sortable()
                    ->badge()
                    ->color(fn (int $state): string => match (true) {
                        $state >= 3 => 'warning',
                        $state >= 1 => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (int $state): string => match (true) {
                        $state >= 3 => $state . ' Acara ⭐ (Sangat Aktif)',
                        $state >= 1 => $state . ' Acara (Aktif)',
                        default => '0 Acara',
                    }),
                Tables\Columns\TextColumn::make('status_keanggotaan')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'aktif' => 'success',
                        'nonaktif' => 'danger',
                        'kehormatan' => 'warning',
                        default => 'gray',
                    }),
            ])
            ->defaultSort('kegiatan_count', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('wilayah_id')
                    ->label('Wilayah')
                    ->relationship('wilayah', 'nama'),
                Tables\Filters\SelectFilter::make('status_keanggotaan')
                    ->label('Status')
                    ->options([
                        'aktif' => 'Aktif',
                        'nonaktif' => 'Nonaktif',
                        'kehormatan' => 'Kehormatan',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAnggotas::route('/'),
            'create' => Pages\CreateAnggota::route('/create'),
            'edit' => Pages\EditAnggota::route('/{record}/edit'),
        ];
    }
}
