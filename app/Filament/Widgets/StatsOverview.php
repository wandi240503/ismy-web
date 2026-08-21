<?php

namespace App\Filament\Widgets;

use App\Models\Anggota;
use App\Models\PendaftaranAnggota;
use App\Models\Berita;
use App\Models\Kegiatan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        try {
            $totalAnggota = Anggota::count();
        } catch (\Throwable $e) {
            $totalAnggota = 0;
        }

        try {
            $pendingPendaftaran = PendaftaranAnggota::where('status_verifikasi', 'pending')->count();
        } catch (\Throwable $e) {
            $pendingPendaftaran = 0;
        }

        try {
            $totalBerita = Berita::count();
        } catch (\Throwable $e) {
            $totalBerita = 0;
        }

        try {
            $totalKegiatan = Kegiatan::count();
        } catch (\Throwable $e) {
            $totalKegiatan = 0;
        }

        return [
            Stat::make('Total Anggota Terdaftar', $totalAnggota)
                ->description('Anggota resmi ISMY aktif')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('success'),

            Stat::make('Pendaftaran Baru (Pending)', $pendingPendaftaran)
                ->description($pendingPendaftaran > 0 ? 'Perlu diverifikasi & disetujui' : 'Semua pendaftar telah diverifikasi')
                ->descriptionIcon('heroicon-m-clipboard-document-check')
                ->color($pendingPendaftaran > 0 ? 'warning' : 'gray'),

            Stat::make('Total Berita & Artikel', $totalBerita)
                ->description('Artikel publikasi ISMY')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('primary'),

            Stat::make('Agenda & Kegiatan', $totalKegiatan)
                ->description('Program kerja & sarasehan')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('info'),
        ];
    }
}
