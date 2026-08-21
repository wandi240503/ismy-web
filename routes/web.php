<?php

use App\Http\Controllers\PublicController;
use App\Http\Controllers\KeanggotaanController;
use App\Http\Controllers\PencarianController;
use App\Http\Controllers\MemberDashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Redirect /admin/login ke halaman login Laravel standar
// (Menghindari Filament Livewire login yang bermasalah di serverless Vercel)
Route::get('/admin/login', function () {
    if (auth()->check()) {
        return redirect('/admin');
    }
    return redirect('/login');
})->name('filament.admin.auth.login');

Route::get('/', [PublicController::class, 'beranda'])->name('beranda');
Route::get('/tentang-kami', [PublicController::class, 'tentangKami'])->name('tentang-kami');
Route::get('/struktur-organisasi', [PublicController::class, 'strukturOrganisasi'])->name('struktur-organisasi');
Route::get('/keanggotaan', [PublicController::class, 'keanggotaan'])->name('keanggotaan');
Route::post('/keanggotaan', [KeanggotaanController::class, 'store'])->name('keanggotaan.store');
Route::get('/berita', [PublicController::class, 'berita'])->name('berita');
Route::get('/berita/{slug}', [PublicController::class, 'beritaDetail'])->name('berita.detail');
Route::get('/pencarian', [PencarianController::class, 'search'])->name('pencarian');
Route::get('/verifikasi-kta/{nomor}', [PublicController::class, 'verifikasiKta'])->name('verifikasi.kta');
Route::post('/verifikasi-kta/{nomor}/presensi', [PublicController::class, 'presensiDariScan'])->name('verifikasi.kta.presensi');
Route::get('/unduh-panduan', function () {
    $path = public_path('PANDUAN_PENGGUNAAN_ISMY.docx');
    if (!file_exists($path)) {
        abort(404);
    }
    return response()->download($path, 'PANDUAN_PENGGUNAAN_ISMY.docx');
})->name('unduh.panduan');

/*
|--------------------------------------------------------------------------
| Authenticated Member Portal Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [MemberDashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/kartu-pdf', [MemberDashboardController::class, 'downloadCard'])->name('dashboard.download-card');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
