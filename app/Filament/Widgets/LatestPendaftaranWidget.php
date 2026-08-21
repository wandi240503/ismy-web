<?php

namespace App\Filament\Widgets;

use App\Models\PendaftaranAnggota;
use App\Models\User;
use App\Models\Anggota;
use Filament\Notifications\Notification;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Hash;

class LatestPendaftaranWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = '📝 Antrean Pendaftaran Anggota Baru (Perlu Verifikasi)';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                PendaftaranAnggota::query()->latest()
            )
            ->columns([
                Tables\Columns\ImageColumn::make('foto')
                    ->label('Foto')
                    ->disk('public')
                    ->circular(),
                Tables\Columns\TextColumn::make('nama_lengkap')
                    ->label('Nama Calon Anggota')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('telepon')
                    ->label('WhatsApp / Telepon')
                    ->searchable(),
                Tables\Columns\TextColumn::make('pendidikan_terakhir')
                    ->label('Pendidikan')
                    ->badge(),
                Tables\Columns\TextColumn::make('bidang_keahlian')
                    ->label('Bidang Keahlian')
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
                    ->label('Waktu Daftar')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\Action::make('approve')
                    ->label('Setujui & Buat Akun')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->button()
                    ->size('xs')
                    ->requiresConfirmation()
                    ->modalHeading('Setujui Pendaftaran Anggota')
                    ->modalDescription('Sistem akan langsung membuat Akun Pengguna dan Profil Anggota resmi ISMY.')
                    ->visible(fn (PendaftaranAnggota $record): bool => $record->status_verifikasi !== 'disetujui')
                    ->action(function (PendaftaranAnggota $record) {
                        // 1. Create or get user
                        $user = User::where('email', $record->email)->first();
                        if (!$user) {
                            $user = User::create([
                                'name' => $record->nama_lengkap,
                                'email' => $record->email,
                                'password' => Hash::make('password123'),
                            ]);
                        }

                        // 2. Create or get anggota
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

                        // 3. Mark approved
                        $record->update([
                            'status_verifikasi' => 'disetujui',
                            'catatan' => 'Disetujui via Dashboard Admin.',
                        ]);

                        Notification::make()
                            ->title('Pendaftaran Disetujui!')
                            ->body('Akun ' . $record->nama_lengkap . ' aktif dengan nomor ' . ($anggota->nomor_anggota ?? ''))
                            ->success()
                            ->send();
                    }),
            ])
            ->paginated([5, 10, 25]);
    }
}
