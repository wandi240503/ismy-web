@extends('layouts.ismy')

@section('content')
<section class="py-12 px-gutter bg-warm-cream min-h-[80vh] flex items-center justify-center">
    <div class="max-w-2xl w-full mx-auto space-y-6">
        
        <!-- Verification Banner Card -->
        <div class="bg-white rounded-3xl p-6 md:p-8 card-shadow border border-[#D4AF37]/30 relative overflow-hidden space-y-6">
            <!-- Background Accent -->
            <div class="absolute top-0 right-0 w-40 h-40 bg-emerald-50 rounded-bl-full pointer-events-none -z-0"></div>

            <!-- Top Header & Badge Status -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-gray-100 pb-5 relative z-10">
                <div class="flex items-center gap-3">
                    <x-application-logo class="h-12 w-auto" />
                    <div>
                        <span class="text-xs font-bold text-secondary uppercase tracking-widest block">Verifikasi Identitas Resmi</span>
                        <h1 class="text-xl font-serif font-black text-primary">Ikatan Sarjana Melayu Yogyakarta</h1>
                    </div>
                </div>
                <div>
                    <span class="inline-flex items-center gap-1.5 bg-emerald-100 text-emerald-800 text-xs font-bold px-3.5 py-1.5 rounded-full border border-emerald-300 shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-emerald-600 animate-pulse"></span> KTA SAH & AKTIF
                    </span>
                </div>
            </div>

            <!-- Member Identity Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-12 gap-6 items-center relative z-10">
                <div class="sm:col-span-4 flex justify-center">
                    <div class="w-28 h-28 sm:w-32 sm:h-32 rounded-2xl overflow-hidden border-4 border-[#D4AF37] bg-warm-cream shadow-lg">
                        <img src="{{ $anggota->foto ? asset('storage/' . $anggota->foto) : asset('images/img_07.jpg') }}" alt="{{ $anggota->nama_lengkap }}" class="w-full h-full object-cover">
                    </div>
                </div>

                <div class="sm:col-span-8 space-y-2 text-center sm:text-left">
                    <span class="text-xs font-mono font-bold text-[#D4AF37] bg-primary px-2.5 py-0.5 rounded-md inline-block">
                        NO: {{ $anggota->nomor_anggota }}
                    </span>
                    <h2 class="text-2xl font-serif font-bold text-primary">{{ $anggota->nama_lengkap }}</h2>
                    <p class="text-sm font-semibold text-gray-700">{{ $anggota->bidang_keahlian ?? 'Sarjana Melayu' }}</p>
                    <p class="text-xs text-gray-500">Cabang: <span class="font-bold text-[#0F4C3A]">{{ $anggota->wilayah->nama ?? 'D.I. Yogyakarta' }}</span></p>
                </div>
            </div>

            <!-- Details Table -->
            <div class="bg-warm-cream/70 rounded-2xl p-5 border border-emerald-900/5 grid grid-cols-2 gap-4 text-xs relative z-10">
                <div>
                    <span class="text-gray-400 block mb-0.5">Pendidikan Terakhir</span>
                    <span class="font-bold text-gray-800">{{ $anggota->pendidikan_terakhir ?? 'Sarjana (S1)' }}</span>
                </div>
                <div>
                    <span class="text-gray-400 block mb-0.5">Status Keanggotaan</span>
                    <span class="font-bold text-emerald-700 uppercase">{{ $anggota->status_keanggotaan ?? 'AKTIF' }}</span>
                </div>
                <div>
                    <span class="text-gray-400 block mb-0.5">Total Kegiatan Diikuti</span>
                    <span class="font-bold text-[#0F4C3A]">{{ $anggota->kegiatan->count() }} Agenda Resmi</span>
                </div>
                <div>
                    <span class="text-gray-400 block mb-0.5">Tgl Bergabung</span>
                    <span class="font-bold text-gray-800">{{ $anggota->created_at ? $anggota->created_at->format('d M Y') : '-' }}</span>
                </div>
            </div>

            <!-- Event Attendance Quick Check-in for Organizers -->
            @if(isset($kegiatanTerkini) && $kegiatanTerkini->count() > 0)
                <div class="border-t border-gray-100 pt-5 space-y-3 relative z-10">
                    <h3 class="text-xs font-bold text-primary uppercase tracking-wider flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-sm text-[#C9A227]">event_available</span>
                        Presensi Cepat Panitia Acara
                    </h3>

                    @if(session('success'))
                        <div class="p-3 bg-emerald-50 text-emerald-800 rounded-xl text-xs font-bold border border-emerald-200 flex items-center gap-2">
                            <span class="material-symbols-outlined text-base">check_circle</span>
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('verifikasi.kta.presensi', $anggota->nomor_anggota) }}" method="POST" class="flex flex-col sm:flex-row gap-2">
                        @csrf
                        <select name="kegiatan_id" required class="flex-grow text-xs rounded-xl border border-gray-300 px-3 py-2 bg-white focus:ring-2 focus:ring-secondary focus:outline-none">
                            <option value="">-- Pilih Acara Hari Ini --</option>
                            @foreach($kegiatanTerkini as $keg)
                                <option value="{{ $keg->id }}">{{ $keg->judul }} ({{ $keg->tanggal ? $keg->tanggal->format('d M Y') : '' }})</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn-primary px-5 py-2 text-xs font-bold whitespace-nowrap shadow-sm flex items-center justify-center gap-1">
                            <span class="material-symbols-outlined text-sm">how_to_reg</span> Catat Hadir
                        </button>
                    </form>
                </div>
            @endif

            <!-- Footer Action -->
            <div class="pt-2 text-center relative z-10">
                <a href="{{ route('beranda') }}" class="text-xs font-bold text-[#0F4C3A] hover:text-[#C9A227] inline-flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">arrow_back</span> Kembali ke Beranda ISMY
                </a>
            </div>
        </div>

    </div>
</section>
@endsection
