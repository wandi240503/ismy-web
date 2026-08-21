<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PendaftaranAnggotaResource\Pages;
use App\Models\PendaftaranAnggota;
use App\Models\User;
use App\Models\Anggota;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PendaftaranAnggotaResource extends Resource
{
    protected static ?string $model = PendaftaranAnggota::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?string $navigationGroup = 'Keanggotaan';

    protected static ?string $navigationLabel = 'Pendaftaran Baru';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Calon Anggota')
                    ->schema([
                        Forms\Components\TextInput::make('nama_lengkap')
                            ->label('Nama Lengkap & Gelar')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('nik')
                            ->label('NIK')
                            ->required()
                            ->maxLength(20),
                        Forms\Components\TextInput::make('tempat_lahir')
                            ->label('Tempat Lahir')
                            ->required()
                            ->maxLength(100),
                        Forms\Components\DatePicker::make('tanggal_lahir')
                            ->label('Tanggal Lahir')
                            ->required(),
                        Forms\Components\TextInput::make('email')
                            ->label('Alamat Email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('telepon')
                            ->label('WhatsApp / Telepon')
                            ->tel()
                            ->required()
                            ->maxLength(25),
                        Forms\Components\Select::make('pendidikan_terakhir')
                            ->label('Pendidikan Terakhir')
                            ->options([
                                'S1' => 'Sarjana (S1)',
                                'S2' => 'Magister (S2)',
                                'S3' => 'Doktor (S3)',
                                'Profesi' => 'Profesi / Spesialis',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('bidang_keahlian')
                            ->label('Bidang Keahlian')
                            ->required()
                            ->maxLength(100),
                        Forms\Components\Textarea::make('alamat')
                            ->label('Alamat Lengkap')
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Dokumen Berkas')
                    ->schema([
                        Forms\Components\FileUpload::make('foto')
                            ->label('Pas Foto')
                            ->image()
                            ->disk('public')
                            ->directory('pendaftaran/foto'),
                        Forms\Components\FileUpload::make('ktp')
                            ->label('Identitas (KTP / Paspor)')
                            ->disk('public')
                            ->directory('pendaftaran/ktp'),
                    ])->columns(2),

                Forms\Components\Section::make('Status Verifikasi & Catatan Admin')
                    ->schema([
                        Forms\Components\Select::make('status_verifikasi')
                            ->label('Status Verifikasi')
                            ->options([
                                'pending' => 'Pending / Menunggu Review',
                                'disetujui' => 'Disetujui (Approved)',
                                'ditolak' => 'Ditolak (Rejected)',
                            ])
                            ->required()
                            ->default('pending'),
                        Forms\Components\Textarea::make('catatan')
                            ->label('Catatan Tim Verifikasi')
                            ->columnSpanFull(),
                    ]),
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
                Tables\Columns\TextColumn::make('nama_lengkap')
                    ->label('Nama Calon')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('telepon')
                    ->label('Telepon')
                    ->searchable(),
                Tables\Columns\TextColumn::make('pendidikan_terakhir')
                    ->label('Pendidikan')
                    ->badge(),
                Tables\Columns\TextColumn::make('bidang_keahlian')
                    ->label('Keahlian')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status_verifikasi')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'disetujui' => 'success',
                        'ditolak' => 'danger',
                        'pending' => 'warning',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tgl Daftar')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status_verifikasi')
                    ->label('Status Verifikasi')
                    ->options([
                        'pending' => 'Pending',
                        'disetujui' => 'Disetujui',
                        'ditolak' => 'Ditolak',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('approve')
                    ->label('Setujui & Terbitkan Akun')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Setujui Calon Anggota')
                    ->modalDescription('Tindakan ini akan menyetujui pendaftaran dan otomatis membuatkan Akun User serta Profil Anggota ISMY resmi.')
                    ->visible(fn (PendaftaranAnggota $record): bool => $record->status_verifikasi !== 'disetujui')
                    ->action(function (PendaftaranAnggota $record) {
                        // 1. Check or create User
                        $user = User::where('email', $record->email)->first();
                        if (!$user) {
                            $user = User::create([
                                'name' => $record->nama_lengkap,
                                'email' => $record->email,
                                'password' => Hash::make('password123'),
                            ]);
                        }

                        // 2. Check or create Anggota
                        $anggota = Anggota::where('user_id', $user->id)->first();
                        if (!$anggota) {
                            $anggota = Anggota::create([
                                'user_id' => $user->id,
                                'nomor_anggota' => 'ISMY-' . str_pad($user->id, 5, '0', STR_PAD_LEFT),
                                'nama_lengkap' => $record->nama_lengkap,
                                'nik' => $record->nik,
                                'tempat_lahir' => $record->tempat_lahir,
                                'tanggal_lahir' => $record->tanggal_lahir,
                                'alamat' => $record->alamat,
                                'telepon' => $record->telepon,
                                'pendidikan_terakhir' => $record->pendidikan_terakhir,
                                'bidang_keahlian' => $record->bidang_keahlian,
                                'foto' => $record->foto,
                                'status_keanggotaan' => 'aktif',
                            ]);
                        }

                        // 3. Mark registration as approved
                        $record->update([
                            'status_verifikasi' => 'disetujui',
                            'catatan' => 'Disetujui oleh admin. Akun dan Nomor Anggota ' . ($anggota->nomor_anggota ?? '') . ' telah diterbitkan.',
                        ]);

                        Notification::make()
                            ->title('Pendaftaran Disetujui!')
                            ->body('Akun anggota ISMY (' . $record->nama_lengkap . ') berhasil dibuat dengan nomor ' . ($anggota->nomor_anggota ?? ''))
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPendaftaranAnggotas::route('/'),
            'create' => Pages\CreatePendaftaranAnggota::route('/create'),
            'edit' => Pages\EditPendaftaranAnggota::route('/{record}/edit'),
        ];
    }
}
