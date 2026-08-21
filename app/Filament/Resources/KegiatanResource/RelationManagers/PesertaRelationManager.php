<?php

namespace App\Filament\Resources\KegiatanResource\RelationManagers;

use App\Models\Anggota;
use App\Models\Kegiatan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class PesertaRelationManager extends RelationManager
{
    protected static string $relationship = 'anggota';

    protected static ?string $title = '📋 Daftar Presensi & Kehadiran Anggota Pada Acara Ini';

    protected static ?string $recordTitleAttribute = 'nama_lengkap';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('anggota_id')
                    ->label('Pilih Anggota')
                    ->options(
                        Anggota::with('wilayah')->get()->mapWithKeys(function ($a) {
                            $wilayahNama = $a->wilayah->nama ?? 'DIY';
                            return [$a->id => "[{$a->nomor_anggota}] {$a->nama_lengkap} ({$wilayahNama})"];
                        })
                    )
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('status')
                    ->label('Status Kehadiran')
                    ->options([
                        'hadir' => 'Hadir di Lokasi',
                        'terdaftar' => 'Terdaftar / Undangan',
                        'batal' => 'Tidak Hadir / Batal',
                    ])
                    ->default('hadir')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
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
                    ->label('Nama Lengkap Anggota')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('wilayah.nama')
                    ->label('Cabang Wilayah')
                    ->badge(),
                Tables\Columns\TextColumn::make('telepon')
                    ->label('No. Telepon / WA')
                    ->searchable(),
                Tables\Columns\TextColumn::make('pivot.status')
                    ->label('Status Presensi')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'hadir' => 'success',
                        'terdaftar' => 'info',
                        'batal' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'hadir' => '✓ Hadir di Lokasi',
                        'terdaftar' => '• Terdaftar',
                        'batal' => '✗ Tidak Hadir',
                        default => ucfirst($state),
                    }),
                Tables\Columns\TextColumn::make('pivot.created_at')
                    ->label('Waktu Check-In')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Filter Kehadiran')
                    ->options([
                        'hadir' => 'Hadir di Lokasi',
                        'terdaftar' => 'Terdaftar',
                        'batal' => 'Tidak Hadir',
                    ])
                    ->query(fn ($query, array $data) => $query->when(
                        $data['value'],
                        fn ($q, $value) => $q->wherePivot('status', $value)
                    )),
            ])
            ->headerActions([
                Tables\Actions\Action::make('scan_presensi')
                    ->label('Presensi Cepat / Input No. KTA')
                    ->icon('heroicon-o-qr-code')
                    ->color('success')
                    ->button()
                    ->modalHeading('Catat Presensi Kehadiran Anggota')
                    ->modalDescription('Pilih nama anggota atau cari berdasarkan Nomor KTA hasil scan QR.')
                    ->form([
                        Forms\Components\Select::make('anggota_id')
                            ->label('Cari Anggota (Nama atau No. KTA)')
                            ->options(
                                Anggota::with('wilayah')->get()->mapWithKeys(function ($a) {
                                    $wilayahNama = $a->wilayah->nama ?? 'DIY';
                                    return [$a->id => "[{$a->nomor_anggota}] {$a->nama_lengkap} ({$wilayahNama})"];
                                })
                            )
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->label('Status Kehadiran')
                            ->options([
                                'hadir' => 'Hadir di Lokasi',
                                'terdaftar' => 'Terdaftar / Undangan',
                            ])
                            ->default('hadir')
                            ->required(),
                    ])
                    ->action(function (array $data) {
                        $kegiatan = $this->getOwnerRecord();
                        $kegiatan->anggota()->syncWithoutDetaching([
                            $data['anggota_id'] => ['status' => $data['status']],
                        ]);

                        $anggota = Anggota::find($data['anggota_id']);

                        Notification::make()
                            ->title('Presensi Berhasil!')
                            ->body('Kehadiran ' . ($anggota->nama_lengkap ?? '') . ' berhasil dicatat.')
                            ->success()
                            ->send();
                    }),
            ])
            ->actions([
                Tables\Actions\Action::make('set_hadir')
                    ->label('Tandai Hadir')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->button()
                    ->size('xs')
                    ->visible(fn (Anggota $record) => $record->pivot->status !== 'hadir')
                    ->action(function (Anggota $record) {
                        $kegiatan = $this->getOwnerRecord();
                        $kegiatan->anggota()->updateExistingPivot($record->id, ['status' => 'hadir']);

                        Notification::make()
                            ->title('Status Diperbarui')
                            ->body($record->nama_lengkap . ' ditandai Hadir.')
                            ->success()
                            ->send();
                    }),
                Tables\Actions\Action::make('set_tidak_hadir')
                    ->label('Batal / Tidak Hadir')
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->button()
                    ->size('xs')
                    ->visible(fn (Anggota $record) => $record->pivot->status === 'hadir')
                    ->action(function (Anggota $record) {
                        $kegiatan = $this->getOwnerRecord();
                        $kegiatan->anggota()->updateExistingPivot($record->id, ['status' => 'batal']);

                        Notification::make()
                            ->title('Status Diperbarui')
                            ->body($record->nama_lengkap . ' ditandai Tidak Hadir.')
                            ->warning()
                            ->send();
                    }),
                Tables\Actions\DetachAction::make()->label('Hapus Dari Acara'),
            ]);
    }
}
