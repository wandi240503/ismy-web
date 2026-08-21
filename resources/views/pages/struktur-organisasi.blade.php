@extends('layouts.ismy')

@section('content')
<!-- Header Banner -->
<section class="py-xl px-gutter bg-primary text-white text-center">
    <div class="max-w-container-max mx-auto">
        <span class="text-xs font-semibold text-secondary uppercase tracking-widest block mb-2">Kepengurusan ISMY</span>
        <h1 class="text-4xl md:text-5xl font-serif font-bold mb-4">Struktur Organisasi</h1>
        <p class="text-emerald-100 max-w-2xl mx-auto text-base">
            Mengenal lebih dekat jajaran kepengurusan Ikatan Sarjana Melayu Yogyakarta yang berdedikasi dalam menjaga marwah dan memajukan peradaban intelektual.
        </p>
    </div>
</section>

<!-- Organizational Hierarchy Chart -->
<section class="py-xl px-gutter bg-warm-cream">
    <div class="max-w-container-max mx-auto space-y-xl">
        <div class="text-center">
            <h2 class="text-2xl font-serif font-bold text-primary-container">Bagan Bagan Struktur Kepengurusan</h2>
            <p class="text-sm text-on-surface-variant">Periode 2024 - 2026</p>
        </div>

        <!-- Org Chart Flow Representation -->
        <div class="flex flex-col items-center gap-6 max-w-4xl mx-auto">
            <!-- Dewan Pembina -->
            <div class="bg-white rounded-xl p-4 px-8 border-2 border-primary/20 text-center card-shadow w-64">
                <span class="text-xs text-gray-500 font-semibold block">Dewan Pembina</span>
                <span class="font-serif font-bold text-primary text-base">Majelis Syura</span>
            </div>

            <div class="w-0.5 h-6 bg-primary/30"></div>

            <!-- Ketua Umum -->
            <div class="bg-primary text-white rounded-xl p-5 px-10 text-center shadow-lg w-80">
                <span class="text-xs text-secondary font-semibold block uppercase tracking-wider mb-1">Ketua Umum</span>
                <span class="font-serif font-bold text-lg">Prof. Dr. Ahmad Zulkifli</span>
            </div>

            <div class="w-0.5 h-6 bg-primary/30"></div>

            <!-- Sekretaris & Bendahara Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-full max-w-2xl">
                <div class="bg-white rounded-xl p-4 text-center border-emerald-light card-shadow">
                    <span class="text-xs text-gray-500 font-semibold block">Sekretaris Jenderal</span>
                    <span class="font-serif font-bold text-primary">Dr. Siti Aminah, M.Si</span>
                </div>
                <div class="bg-white rounded-xl p-4 text-center border-emerald-light card-shadow">
                    <span class="text-xs text-gray-500 font-semibold block">Bendahara Umum</span>
                    <span class="font-serif font-bold text-primary">Hj. Rina Melati, SE</span>
                </div>
            </div>

            <div class="w-0.5 h-6 bg-primary/30"></div>

            <!-- Departemen Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 w-full">
                <div class="bg-surface-container-low rounded-xl p-4 text-center border-emerald-light">
                    <span class="material-symbols-outlined text-primary mb-1">school</span>
                    <span class="text-xs font-bold text-primary block">Dept. Pendidikan</span>
                </div>
                <div class="bg-surface-container-low rounded-xl p-4 text-center border-emerald-light">
                    <span class="material-symbols-outlined text-primary mb-1">trending_up</span>
                    <span class="text-xs font-bold text-primary block">Dept. Ekonomi</span>
                </div>
                <div class="bg-surface-container-low rounded-xl p-4 text-center border-emerald-light">
                    <span class="material-symbols-outlined text-primary mb-1">theater_comedy</span>
                    <span class="text-xs font-bold text-primary block">Dept. Sosial Budaya</span>
                </div>
                <div class="bg-surface-container-low rounded-xl p-4 text-center border-emerald-light">
                    <span class="material-symbols-outlined text-primary mb-1">campaign</span>
                    <span class="text-xs font-bold text-primary block">Humas & Publikasi</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pengurus Inti Section -->
<section class="py-xl px-gutter bg-white border-y border-emerald-light">
    <div class="max-w-container-max mx-auto">
        <div class="text-center mb-lg">
            <h2 class="text-3xl font-serif font-bold text-primary-container">Pengurus Inti</h2>
            <p class="text-sm text-on-surface-variant mt-1">Tokoh-tokoh penggerak kepengurusan ISMY saat ini</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-md">
            @forelse($penguruses as $p)
                <div class="bg-warm-cream rounded-xl p-6 text-center card-shadow border-emerald-light flex flex-col items-center">
                    <div class="w-24 h-24 rounded-full overflow-hidden mb-4 border-2 border-secondary p-1 bg-white">
                        <img src="{{ $p->foto ? asset('storage/' . $p->foto) : asset('images/img_07.jpg') }}" alt="{{ $p->nama }}" class="w-full h-full object-cover rounded-full">
                    </div>
                    <h3 class="font-serif font-bold text-primary text-base mb-1">{{ $p->nama }}</h3>
                    <span class="bg-primary/10 text-primary text-xs font-semibold px-3 py-1 rounded-full mb-2">
                        {{ $p->jabatan->nama ?? 'Pengurus' }}
                    </span>
                </div>
            @empty
                <!-- Fallback to Stitch design cards -->
                <div class="bg-warm-cream rounded-xl p-6 text-center card-shadow border-emerald-light flex flex-col items-center">
                    <div class="w-24 h-24 rounded-full overflow-hidden mb-4 border-2 border-secondary p-1 bg-white">
                        <img src="{{ asset('images/img_07.jpg') }}" alt="Prof. Dr. Ahmad Zulkifli" class="w-full h-full object-cover rounded-full">
                    </div>
                    <h3 class="font-serif font-bold text-primary text-base mb-1">Prof. Dr. Ahmad Zulkifli</h3>
                    <span class="bg-secondary/20 text-gray-900 text-xs font-semibold px-3 py-1 rounded-full mb-2">Ketua Umum</span>
                    <p class="text-xs text-on-surface-variant">Guru Besar Sosiologi Budaya</p>
                </div>

                <div class="bg-warm-cream rounded-xl p-6 text-center card-shadow border-emerald-light flex flex-col items-center">
                    <div class="w-24 h-24 rounded-full overflow-hidden mb-4 border-2 border-primary/20 p-1 bg-white">
                        <img src="{{ asset('images/img_12.jpg') }}" alt="Dr. Siti Aminah" class="w-full h-full object-cover rounded-full">
                    </div>
                    <h3 class="font-serif font-bold text-primary text-base mb-1">Dr. Siti Aminah, M.Si</h3>
                    <span class="bg-primary/10 text-primary text-xs font-semibold px-3 py-1 rounded-full mb-2">Sekretaris Jenderal</span>
                    <p class="text-xs text-on-surface-variant">Pakar Kebijakan Publik</p>
                </div>

                <div class="bg-warm-cream rounded-xl p-6 text-center card-shadow border-emerald-light flex flex-col items-center">
                    <div class="w-24 h-24 rounded-full overflow-hidden mb-4 border-2 border-primary/20 p-1 bg-white">
                        <img src="{{ asset('images/img_15.jpg') }}" alt="Hj. Rina Melati" class="w-full h-full object-cover rounded-full">
                    </div>
                    <h3 class="font-serif font-bold text-primary text-base mb-1">Hj. Rina Melati, SE</h3>
                    <span class="bg-primary/10 text-primary text-xs font-semibold px-3 py-1 rounded-full mb-2">Bendahara Umum</span>
                    <p class="text-xs text-on-surface-variant">Praktisi Perbankan Syariah</p>
                </div>

                <div class="bg-warm-cream rounded-xl p-6 text-center card-shadow border-emerald-light flex flex-col items-center">
                    <div class="w-24 h-24 rounded-full overflow-hidden mb-4 border-2 border-primary/20 p-1 bg-white">
                        <img src="{{ asset('images/img_02.jpg') }}" alt="Dr. Budi Santoso" class="w-full h-full object-cover rounded-full">
                    </div>
                    <h3 class="font-serif font-bold text-primary text-base mb-1">Dr. Budi Santoso</h3>
                    <span class="bg-primary/10 text-primary text-xs font-semibold px-3 py-1 rounded-full mb-2">Ketua Dept. Pendidikan</span>
                    <p class="text-xs text-on-surface-variant">Dosen Pendidikan Sejarah</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Cabang Daerah (DIY) -->
<section class="py-xl px-gutter bg-warm-cream">
    <div class="max-w-container-max mx-auto">
        <div class="flex justify-between items-center mb-lg">
            <div>
                <h2 class="text-3xl font-serif font-bold text-primary-container">Cabang Daerah (DIY)</h2>
                <p class="text-sm text-on-surface-variant">Jaringan kepengurusan cabang ISMY di wilayah Daerah Istimewa Yogyakarta</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-md">
            @forelse($wilayahs as $w)
                <div class="bg-white rounded-xl p-6 card-shadow border-emerald-light">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="material-symbols-outlined text-primary text-2xl">location_city</span>
                        <h3 class="font-serif font-bold text-primary text-lg">Cabang {{ $w->nama }}</h3>
                    </div>
                    <p class="text-xs text-on-surface-variant mb-3">{{ $w->deskripsi ?? 'Koordinator wilayah kabupaten/kota.' }}</p>
                </div>
            @empty
                <div class="bg-white rounded-xl p-6 card-shadow border-emerald-light">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="material-symbols-outlined text-primary text-2xl">location_city</span>
                        <h3 class="font-serif font-bold text-primary text-lg">Cabang Sleman</h3>
                    </div>
                    <p class="text-xs text-on-surface-variant mb-2"><strong>Ketua:</strong> Faisal Rahman, M.Pd</p>
                    <p class="text-xs text-on-surface-variant"><strong>Sekretariat:</strong> Jl. Kaliurang Km 5.5, Sleman</p>
                </div>

                <div class="bg-white rounded-xl p-6 card-shadow border-emerald-light">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="material-symbols-outlined text-primary text-2xl">location_city</span>
                        <h3 class="font-serif font-bold text-primary text-lg">Cabang Bantul</h3>
                    </div>
                    <p class="text-xs text-on-surface-variant mb-2"><strong>Ketua:</strong> Hj. Dewi Lestari, S.Ag</p>
                    <p class="text-xs text-on-surface-variant"><strong>Sekretariat:</strong> Jl. Ringroad Selatan, Bantul</p>
                </div>

                <div class="bg-white rounded-xl p-6 card-shadow border-emerald-light">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="material-symbols-outlined text-primary text-2xl">location_city</span>
                        <h3 class="font-serif font-bold text-primary text-lg">Cabang Kota Yogyakarta</h3>
                    </div>
                    <p class="text-xs text-on-surface-variant mb-2"><strong>Ketua:</strong> Drs. Anwar Hidayat</p>
                    <p class="text-xs text-on-surface-variant"><strong>Sekretariat:</strong> Kawasan Kotagede, Yogyakarta</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
