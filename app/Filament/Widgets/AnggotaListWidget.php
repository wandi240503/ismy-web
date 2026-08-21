<?php

namespace App\Filament\Widgets;

use App\Models\Anggota;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class AnggotaListWidget extends BaseWidget
{
    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = '📇 Data Anggota Resmi & Keaktifan Acara ISMY';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Anggota::query()->with(['user', 'wilayah'])->withCount('kegiatan')->orderBy('kegiatan_count', 'desc')
            )
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
                    ->placeholder('Pusat DIY'),
                Tables\Columns\TextColumn::make('kegiatan_count')
                    ->label('Keaktifan Partisipasi')
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
                Tables\Columns\TextColumn::make('bidang_keahlian')
                    ->label('Bidang Keahlian')
                    ->searchable(),
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
            ->paginated([5, 10, 25]);
    }
}
