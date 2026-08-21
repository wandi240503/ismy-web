@extends('layouts.ismy')

@section('content')
<section class="py-12 px-gutter bg-warm-cream">
    <div class="max-w-container-max mx-auto space-y-8">
        
        <!-- Welcome Header -->
        <div class="bg-white rounded-2xl p-6 md:p-8 card-shadow border border-emerald-900/10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <span class="text-xs font-bold text-secondary uppercase tracking-widest block mb-1">Portal Anggota Resmi</span>
                <h1 class="text-2xl md:text-3xl font-serif font-bold text-primary">
                    Profil Anggota — {{ $anggota->nama_lengkap }}
                </h1>
                <p class="text-sm text-on-surface-variant mt-1">Kelola data keanggotaan, kartu tanda anggota digital, dan riwayat aktivitas sarjana Melayu.</p>
            </div>
            <div class="flex flex-wrap gap-2.5">
                @if(Auth::user()->email === 'admin@ismy.or.id' || str_ends_with(Auth::user()->email, '@ismy.or.id'))
                    <a href="{{ url('/admin') }}" class="bg-emerald-900 text-[#D4AF37] hover:bg-emerald-950 font-bold px-4 py-2.5 rounded-xl text-xs flex items-center gap-1.5 border border-[#D4AF37]/40 shadow-sm transition-transform hover:scale-95">
                        <span class="material-symbols-outlined text-sm text-[#D4AF37]">admin_panel_settings</span> Panel Admin
                    </a>
                @endif
                <a href="{{ route('dashboard.download-card') }}" class="btn-primary px-4 py-2.5 text-xs font-bold flex items-center gap-2 shadow-sm">
                    <span class="material-symbols-outlined text-sm">picture_as_pdf</span> Unduh Kartu PDF
                </a>
                <a href="{{ route('profile.edit') }}" class="btn-secondary px-4 py-2.5 text-xs font-bold flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-sm">manage_accounts</span> Pengaturan Akun
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-50 text-red-700 hover:bg-red-100 px-3.5 py-2.5 rounded-xl text-xs font-semibold flex items-center gap-1 border border-red-200 transition-colors">
                        <span class="material-symbols-outlined text-sm">logout</span> Keluar
                    </button>
                </form>
            </div>
        </div>

        <!-- Dashboard Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Digital Member Card (Left Column) -->
            <div class="lg:col-span-5 bg-gradient-to-br from-[#0F4C3A] via-[#0b382b] to-[#00261c] text-white rounded-3xl p-6 md:p-8 shadow-2xl relative overflow-hidden space-y-6 border border-[#D4AF37]/30">
                <!-- Background Pattern Accent -->
                <div class="absolute -right-12 -bottom-12 w-48 h-48 border-8 border-[#D4AF37]/15 rounded-full pointer-events-none"></div>
                <div class="absolute -left-8 -top-8 w-32 h-32 border-4 border-white/5 rounded-full pointer-events-none"></div>

                <div class="flex justify-between items-center border-b border-white/15 pb-4 relative z-10">
                    <div class="flex items-center gap-3">
                        <x-application-logo class="h-11 w-auto drop-shadow-md" />
                        <div>
                            <span class="text-xl font-serif font-black text-[#D4AF37] block leading-none">ISMY</span>
                            <p class="text-[9px] uppercase font-bold text-emerald-200 tracking-widest mt-0.5">Ikatan Sarjana Melayu Yogyakarta</p>
                        </div>
                    </div>
                    <span class="bg-[#D4AF37] text-gray-900 text-[10px] font-black uppercase px-3 py-1 rounded-full shadow">
                        {{ strtoupper($anggota->status_keanggotaan ?? 'AKTIF') }}
                    </span>
                </div>

                <div class="flex gap-4 items-center relative z-10">
                    <div class="w-20 h-20 rounded-2xl overflow-hidden border-2 border-[#D4AF37] bg-white flex-shrink-0 shadow-md">
                        <img src="{{ $anggota->foto ? asset('storage/' . $anggota->foto) : asset('images/img_07.jpg') }}" alt="{{ $anggota->nama_lengkap }}" class="w-full h-full object-cover">
                    </div>
                    <div class="space-y-0.5">
                        <h3 class="font-serif font-bold text-xl leading-tight text-white">{{ $anggota->nama_lengkap }}</h3>
                        <p class="text-xs text-emerald-200 font-medium">{{ $anggota->bidang_keahlian ?? 'Sarjana Melayu' }}</p>
                        <div class="pt-1">
                            <span class="text-[11px] font-mono font-bold text-[#D4AF37] bg-black/30 px-2 py-0.5 rounded border border-[#D4AF37]/30 inline-block">
                                {{ $anggota->nomor_anggota }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- QR Code Display -->
                <div class="bg-white/95 backdrop-blur-sm p-4 rounded-2xl flex items-center justify-between text-gray-900 shadow-inner relative z-10">
                    <div class="space-y-1">
                        <span class="text-xs font-bold block text-primary flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm text-[#C9A227]">verified</span> QR Code Resmi
                        </span>
                        <p class="text-[10px] text-gray-600 leading-tight">Pindai kode untuk verifikasi keaslian status keanggotaan ISMY.</p>
                        <span class="text-[9px] text-emerald-800 font-semibold block">Cabang: {{ $anggota->wilayah->nama ?? 'D.I. Yogyakarta' }}</span>
                    </div>
                    <div class="bg-white p-1.5 rounded-xl border border-gray-200 shadow-sm flex-shrink-0">
                        {!! $qrCode !!}
                    </div>
                </div>
            </div>

            <!-- Profile Details & Activities Summary (Right Column) -->
            <div class="lg:col-span-7 space-y-6">
                <!-- Info Overview Card -->
                <div class="bg-white rounded-2xl p-6 md:p-8 card-shadow border border-emerald-900/10 space-y-6">
                    <div class="flex justify-between items-center border-b border-gray-100 pb-4">
                        <h3 class="text-lg font-serif font-bold text-primary flex items-center gap-2">
                            <span class="material-symbols-outlined text-secondary">badge</span> Biodata Lengkap Anggota
                        </h3>
                        <a href="{{ route('profile.edit') }}" class="text-xs text-primary font-bold hover:underline flex items-center gap-1">
                            <span class="material-symbols-outlined text-xs">edit</span> Edit Profil
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-6 text-sm">
                        <div class="bg-warm-cream/60 p-3.5 rounded-xl border border-emerald-900/5">
                            <span class="text-xs text-gray-500 block mb-0.5">Nama Lengkap</span>
                            <span class="font-bold text-primary">{{ $anggota->nama_lengkap }}</span>
                        </div>
                        <div class="bg-warm-cream/60 p-3.5 rounded-xl border border-emerald-900/5">
                            <span class="text-xs text-gray-500 block mb-0.5">Nomor Anggota (KTA)</span>
                            <span class="font-bold text-[#0F4C3A] font-mono">{{ $anggota->nomor_anggota }}</span>
                        </div>
                        <div class="bg-warm-cream/60 p-3.5 rounded-xl border border-emerald-900/5">
                            <span class="text-xs text-gray-500 block mb-0.5">Cabang / Wilayah</span>
                            <span class="font-semibold text-gray-800">{{ $anggota->wilayah->nama ?? 'Daerah Istimewa Yogyakarta' }}</span>
                        </div>
                        <div class="bg-warm-cream/60 p-3.5 rounded-xl border border-emerald-900/5">
                            <span class="text-xs text-gray-500 block mb-0.5">Pendidikan Terakhir</span>
                            <span class="font-semibold text-gray-800">{{ $anggota->pendidikan_terakhir ?? 'Sarjana' }}</span>
                        </div>
                        <div class="bg-warm-cream/60 p-3.5 rounded-xl border border-emerald-900/5">
                            <span class="text-xs text-gray-500 block mb-0.5">Bidang Keahlian</span>
                            <span class="font-semibold text-gray-800">{{ $anggota->bidang_keahlian ?? '-' }}</span>
                        </div>
                        <div class="bg-warm-cream/60 p-3.5 rounded-xl border border-emerald-900/5">
                            <span class="text-xs text-gray-500 block mb-0.5">Status Keanggotaan</span>
                            <span class="inline-flex items-center gap-1 text-xs font-bold text-emerald-700 bg-emerald-100 px-2 py-0.5 rounded-full">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span> Aktif & Terverifikasi
                            </span>
                        </div>
                        <div class="bg-warm-cream/60 p-3.5 rounded-xl border border-emerald-900/5">
                            <span class="text-xs text-gray-500 block mb-0.5">Alamat Email</span>
                            <span class="font-semibold text-gray-800">{{ Auth::user()->email }}</span>
                        </div>
                        <div class="bg-warm-cream/60 p-3.5 rounded-xl border border-emerald-900/5">
                            <span class="text-xs text-gray-500 block mb-0.5">WhatsApp / Telepon</span>
                            <span class="font-semibold text-gray-800">{{ $anggota->telepon ?? '-' }}</span>
                        </div>
                        <div class="md:col-span-2 bg-warm-cream/60 p-3.5 rounded-xl border border-emerald-900/5">
                            <span class="text-xs text-gray-500 block mb-0.5">Alamat Domisili Yogyakarta</span>
                            <span class="font-semibold text-gray-800">{{ $anggota->alamat ?? 'Yogyakarta, Indonesia' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Registered Events -->
                <div class="bg-white rounded-2xl p-6 md:p-8 card-shadow border border-emerald-900/10 space-y-4">
                    <h3 class="text-lg font-serif font-bold text-primary border-b border-gray-100 pb-3 flex items-center gap-2">
                        <span class="material-symbols-outlined text-secondary">event_available</span> Riwayat Kegiatan & Sarasehan Diikuti
                    </h3>

                    @if($anggota->kegiatan && $anggota->kegiatan->count() > 0)
                        <div class="space-y-3">
                            @foreach($anggota->kegiatan as $keg)
                                <div class="p-3.5 rounded-xl bg-warm-cream flex justify-between items-center text-sm border border-emerald-900/5">
                                    <div>
                                        <h4 class="font-bold text-primary">{{ $keg->judul }}</h4>
                                        <span class="text-xs text-gray-500">📅 {{ $keg->tanggal ? $keg->tanggal->format('d M Y') : '' }}</span>
                                    </div>
                                    <span class="bg-emerald-100 text-emerald-800 text-xs px-3 py-1 rounded-full font-bold">
                                        {{ ucfirst($keg->pivot->status ?? 'Terdaftar') }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="p-6 text-center text-gray-400 space-y-2 bg-warm-cream/40 rounded-xl">
                            <span class="material-symbols-outlined text-3xl text-gray-300">calendar_today</span>
                            <p class="text-xs text-gray-500">Belum ada riwayat kegiatan yang terdaftar.</p>
                            <a href="{{ route('berita') }}" class="text-xs text-primary font-bold hover:underline inline-block mt-1">Jelajahi Agenda & Sarasehan ISMY →</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
