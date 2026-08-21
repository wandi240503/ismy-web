<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MemberDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $anggota = Anggota::where('user_id', $user->id)->first();

        // If user doesn't have an Anggota profile yet, create a dummy/draft one
        if (!$anggota) {
            $anggota = Anggota::create([
                'user_id' => $user->id,
                'nama_lengkap' => $user->name,
                'nomor_anggota' => 'ISMY-' . str_pad($user->id, 5, '0', STR_PAD_LEFT),
                'status_keanggotaan' => 'aktif',
                'bidang_keahlian' => 'Sarjana Melayu',
            ]);
        }

        // Generate QR code yang mengarah langsung ke URL Verifikasi Profil Anggota
        $verifyUrl = route('verifikasi.kta', ['nomor' => $anggota->nomor_anggota]);
        $qrCode = QrCode::size(120)->color(15, 76, 58)->generate($verifyUrl);

        return view('dashboard', compact('anggota', 'qrCode'));
    }

    public function downloadCard(Request $request)
    {
        $user = $request->user();
        $anggota = Anggota::where('user_id', $user->id)->firstOrFail();

        $verifyUrl = route('verifikasi.kta', ['nomor' => $anggota->nomor_anggota]);
        $qrCodeBase64 = base64_encode(QrCode::format('svg')->size(150)->color(15, 76, 58)->generate($verifyUrl));

        $pdf = Pdf::loadView('pdf.kartu-anggota', compact('anggota', 'qrCodeBase64'))
                 ->setPaper('a6', 'landscape');

        return $pdf->download('Kartu-Anggota-' . $anggota->nomor_anggota . '.pdf');
    }
}
