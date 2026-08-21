@extends('layouts.ismy')

@section('content')
<section class="py-12 px-4 sm:px-6 lg:px-8 bg-warm-cream/40 min-h-[80vh]">
    <div class="max-w-3xl mx-auto">
        <!-- Verification Header Badge -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-neutral-100 mb-6">
            <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6">
                <div class="w-24 h-24 rounded-2xl overflow-hidden bg-neutral-100 border border-neutral-200 shrink-0 flex items-center justify-center">
                    @if($anggota->foto)
                        <img src="{{ asset('storage/' . $anggota->foto) }}" alt="{{ $anggota->nama_lengkap }}" class="w-full h-full object-cover">
                    @else
                        <img src="{{ asset('images/logo.png') }}" alt="ISMY Logo" class="w-16 h-16 object-contain p-2">
                    @endif
                </div>

                <div class="flex-1 text-center sm:text-left">
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-semibold mb-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        Kartu Anggota Terverifikasi Resmi
                    </div>
                    <h1 class="text-2xl font-bold text-neutral-900 font-serif mb-1">{{ $anggota->nama_lengkap }}</h1>
                    <p class="text-sm font-mono text-emerald-700 font-semibold mb-2">No. KTA: {{ $anggota->nomor_anggota }}</p>
                    <p class="text-xs text-neutral-500">
                        Wilayah: <span class="text-neutral-700 font-medium">{{ $anggota->wilayah->nama ?? 'D.I. Yogyakarta' }}</span> | 
                        Bidang: <span class="text-neutral-700 font-medium">{{ $anggota->bidang_keahlian ?? 'Akademisi / Umum' }}</span>
                    </p>
                </div>
            </div>

            <!-- Profile Attributes Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mt-6 pt-6 border-t border-neutral-100 text-xs">
                <div class="bg-neutral-50/70 p-3 rounded-2xl">
                    <span class="text-neutral-400 block mb-0.5">Status Anggota</span>
                    <span class="font-semibold text-emerald-600 capitalize">{{ $anggota->status_keanggotaan ?? 'Aktif' }}</span>
                </div>
                <div class="bg-neutral-50/70 p-3 rounded-2xl">
                    <span class="text-neutral-400 block mb-0.5">Pendidikan</span>
                    <span class="font-semibold text-neutral-800">{{ $anggota->pendidikan_terakhir ?? '-' }}</span>
                </div>
                <div class="bg-neutral-50/70 p-3 rounded-2xl">
                    <span class="text-neutral-400 block mb-0.5">Total Kegiatan</span>
                    <span class="font-semibold text-neutral-800">{{ $anggota->kegiatan->count() }} Acara</span>
                </div>
                <div class="bg-neutral-50/70 p-3 rounded-2xl">
                    <span class="text-neutral-400 block mb-0.5">Bergabung Sejak</span>
                    <span class="font-semibold text-neutral-800">{{ $anggota->created_at ? $anggota->created_at->format('M Y') : '-' }}</span>
                </div>
            </div>
        </div>

        <!-- Presensi Cepat di Lokasi Acara -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-neutral-100">
            <h2 class="text-lg font-bold text-neutral-900 mb-1 flex items-center gap-2">
                <span class="material-symbols-outlined text-emerald-600 text-xl">how_to_reg</span>
                Presensi Kehadiran Acara / Kegiatan
            </h2>
            <p class="text-xs text-neutral-500 mb-5">
                Konfirmasi kehadiran anggota ini pada agenda yang sedang berlangsung.
            </p>

            @if(session('success'))
                <div class="p-4 mb-4 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs rounded-2xl flex items-center gap-2">
                    <span class="material-symbols-outlined text-base text-emerald-600">check_circle</span>
                    {{ session('success') }}
                </div>
            @endif

            @if($kegiatanTerkini->isNotEmpty())
                <form action="{{ route('verifikasi.kta.presensi', ['nomor' => $anggota->nomor_anggota]) }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="kegiatan_id" class="block text-xs font-semibold text-neutral-700 mb-1.5">Pilih Agenda Kegiatan Aktif:</label>
                        <select name="kegiatan_id" id="kegiatan_id" class="w-full rounded-2xl border-neutral-200 text-xs py-2.5 px-3 focus:ring-emerald-500 focus:border-emerald-500" required>
                            @foreach($kegiatanTerkini as $keg)
                                <option value="{{ $keg->id }}">{{ $keg->judul }} ({{ \Carbon\Carbon::parse($keg->tanggal)->translatedFormat('d F Y') }})</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="w-full py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs rounded-2xl transition shadow-sm flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-sm">fact_check</span>
                        Tandai Anggota Ini Hadir
                    </button>
                </form>
            @else
                <div class="text-center py-6 bg-neutral-50 rounded-2xl border border-dashed border-neutral-200">
                    <p class="text-xs text-neutral-500">Saat ini belum ada agenda kegiatan aktif yang dijadwalkan.</p>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
