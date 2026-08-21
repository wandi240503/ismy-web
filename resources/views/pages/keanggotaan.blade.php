@extends('layouts.ismy')

@section('content')
<!-- Header Banner -->
<section class="py-xl px-gutter bg-primary text-white text-center">
    <div class="max-w-container-max mx-auto">
        <span class="text-xs font-semibold text-secondary uppercase tracking-widest block mb-2">Portal Keanggotaan</span>
        <h1 class="text-4xl md:text-5xl font-serif font-bold mb-4">Bergabung Menjadi Anggota ISMY</h1>
        <p class="text-emerald-100 max-w-2xl mx-auto text-base mb-6">
            Jadilah bagian dari komunitas cendekiawan Melayu terkemuka. Berkontribusi, berkembang, dan perluas jaringan Anda dalam tradisi intelektual yang kuat.
        </p>
        <a href="#form-pendaftaran" class="btn-primary px-8 py-3 text-sm inline-flex items-center gap-2 shadow-md">
            Daftar Sekarang <span class="material-symbols-outlined text-sm">arrow_downward</span>
        </a>
    </div>
</section>

<!-- Flash Success Message -->
@if(session('success'))
    <div class="max-w-container-max mx-auto mt-6 px-gutter">
        <div class="bg-emerald-100 border border-emerald-400 text-emerald-800 px-6 py-4 rounded-xl flex items-center gap-3">
            <span class="material-symbols-outlined text-2xl text-emerald-600">check_circle</span>
            <div>
                <p class="font-bold text-sm">{{ session('success') }}</p>
            </div>
        </div>
    </div>
@endif

<!-- Manfaat Keanggotaan -->
<section class="py-xl px-gutter bg-warm-cream">
    <div class="max-w-container-max mx-auto space-y-lg">
        <div class="text-center">
            <h2 class="text-3xl font-serif font-bold text-primary-container">Manfaat Keanggotaan</h2>
            <div class="w-16 h-1 bg-secondary mx-auto mt-2 rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-md">
            <div class="bg-white rounded-xl p-6 text-center card-shadow border-emerald-light">
                <div class="w-12 h-12 rounded-full bg-primary/10 text-primary flex items-center justify-center mx-auto mb-3">
                    <span class="material-symbols-outlined text-2xl">hub</span>
                </div>
                <h3 class="font-serif font-bold text-primary text-lg mb-2">Jaringan Luas</h3>
                <p class="text-xs text-on-surface-variant leading-relaxed">Terhubung dengan cendekiawan dan profesional terkemuka di berbagai bidang ilmu.</p>
            </div>

            <div class="bg-white rounded-xl p-6 text-center card-shadow border-emerald-light">
                <div class="w-12 h-12 rounded-full bg-primary/10 text-primary flex items-center justify-center mx-auto mb-3">
                    <span class="material-symbols-outlined text-2xl">psychology</span>
                </div>
                <h3 class="font-serif font-bold text-primary text-lg mb-2">Pelatihan</h3>
                <p class="text-xs text-on-surface-variant leading-relaxed">Akses eksklusif ke berbagai program pelatihan dan pengembangan kapasitas.</p>
            </div>

            <div class="bg-white rounded-xl p-6 text-center card-shadow border-emerald-light">
                <div class="w-12 h-12 rounded-full bg-primary/10 text-primary flex items-center justify-center mx-auto mb-3">
                    <span class="material-symbols-outlined text-2xl">local_activity</span>
                </div>
                <h3 class="font-serif font-bold text-primary text-lg mb-2">Kegiatan</h3>
                <p class="text-xs text-on-surface-variant leading-relaxed">Partisipasi aktif dalam seminar kebudayaan, riset, dan konferensi tahunan.</p>
            </div>

            <div class="bg-white rounded-xl p-6 text-center card-shadow border-emerald-light">
                <div class="w-12 h-12 rounded-full bg-primary/10 text-primary flex items-center justify-center mx-auto mb-3">
                    <span class="material-symbols-outlined text-2xl">workspace_premium</span>
                </div>
                <h3 class="font-serif font-bold text-primary text-lg mb-2">Penghargaan</h3>
                <p class="text-xs text-on-surface-variant leading-relaxed">Peluang kontribusi untuk penghargaan prestasi akademis dan sosial.</p>
            </div>
        </div>
    </div>
</section>

<!-- Persyaratan & Hero Image -->
<section class="py-xl px-gutter bg-white border-y border-emerald-light">
    <div class="max-w-container-max mx-auto grid md:grid-cols-2 gap-lg items-center">
        <div class="space-y-6">
            <h2 class="text-3xl font-serif font-bold text-primary-container">Persyaratan Keanggotaan</h2>
            <p class="text-sm text-on-surface-variant">
                Untuk menjaga integritas dan kualitas komunitas, kami menetapkan beberapa kriteria dasar bagi calon anggota:
            </p>
            <ul class="space-y-3 text-sm text-on-surface-variant">
                <li class="flex gap-3 items-start">
                    <span class="material-symbols-outlined text-secondary">verified</span>
                    <span>Warga Negara Indonesia berketurunan atau memiliki minat kuat pada kebudayaan Melayu.</span>
                </li>
                <li class="flex gap-3 items-start">
                    <span class="material-symbols-outlined text-secondary">verified</span>
                    <span>Memiliki gelar sarjana (S1) atau sedang/telah menempuh studi yang diakui.</span>
                </li>
                <li class="flex gap-3 items-start">
                    <span class="material-symbols-outlined text-secondary">verified</span>
                    <span>Berkomitmen pada visi dan misi ISMY.</span>
                </li>
                <li class="flex gap-3 items-start">
                    <span class="material-symbols-outlined text-secondary">verified</span>
                    <span>Melengkapi formulir pendaftaran dan dokumen pendukung.</span>
                </li>
            </ul>
        </div>
        <div class="rounded-2xl overflow-hidden card-shadow border-emerald-light">
            <img src="{{ asset('images/img_11.jpg') }}" alt="Diskusi Anggota ISMY" class="w-full h-80 object-cover">
        </div>
    </div>
</section>

<!-- Registration Form Section -->
<section id="form-pendaftaran" class="py-xl px-gutter bg-warm-cream">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-lg">
            <h2 class="text-3xl font-serif font-bold text-primary-container">Formulir Pendaftaran</h2>
            <p class="text-sm text-on-surface-variant mt-1">Silakan isi data diri Anda secara lengkap dan benar</p>
        </div>

        <form action="{{ route('keanggotaan.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl p-8 card-shadow border-emerald-light space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Lengkap -->
                <div>
                    <label class="block text-xs font-semibold text-primary uppercase mb-2">Nama Lengkap (beserta gelar)</label>
                    <input type="text" name="nama_lengkap" required placeholder="Dr. Fulan bin Fulan, M.A." class="w-full rounded-xl border-emerald-light px-4 py-3 text-sm focus:ring-2 focus:ring-secondary focus:outline-none bg-warm-cream/50">
                    @error('nama_lengkap') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- NIK -->
                <div>
                    <label class="block text-xs font-semibold text-primary uppercase mb-2">Nomor Induk Kependudukan (NIK)</label>
                    <input type="text" name="nik" required placeholder="3404012345670001" class="w-full rounded-xl border-emerald-light px-4 py-3 text-sm focus:ring-2 focus:ring-secondary focus:outline-none bg-warm-cream/50">
                    @error('nik') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Tempat Lahir -->
                <div>
                    <label class="block text-xs font-semibold text-primary uppercase mb-2">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" required placeholder="Yogyakarta" class="w-full rounded-xl border-emerald-light px-4 py-3 text-sm focus:ring-2 focus:ring-secondary focus:outline-none bg-warm-cream/50">
                </div>

                <!-- Tanggal Lahir -->
                <div>
                    <label class="block text-xs font-semibold text-primary uppercase mb-2">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" required class="w-full rounded-xl border-emerald-light px-4 py-3 text-sm focus:ring-2 focus:ring-secondary focus:outline-none bg-warm-cream/50">
                </div>
            </div>

            <!-- Alamat -->
            <div>
                <label class="block text-xs font-semibold text-primary uppercase mb-2">Alamat Lengkap (Domisili)</label>
                <textarea name="alamat" rows="3" required placeholder="Alamat domisili saat ini di Yogyakarta..." class="w-full rounded-xl border-emerald-light px-4 py-3 text-sm focus:ring-2 focus:ring-secondary focus:outline-none bg-warm-cream/50"></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Pendidikan Terakhir -->
                <div>
                    <label class="block text-xs font-semibold text-primary uppercase mb-2">Pendidikan Terakhir</label>
                    <select name="pendidikan_terakhir" required class="w-full rounded-xl border-emerald-light px-4 py-3 text-sm focus:ring-2 focus:ring-secondary focus:outline-none bg-warm-cream/50">
                        <option value="">Pilih Jenjang...</option>
                        <option value="S1">Sarjana (S1)</option>
                        <option value="S2">Magister (S2)</option>
                        <option value="S3">Doktor (S3)</option>
                        <option value="Profesi">Spesialis / Profesi</option>
                    </select>
                </div>

                <!-- Bidang Keahlian -->
                <div>
                    <label class="block text-xs font-semibold text-primary uppercase mb-2">Bidang Keahlian / Rumpun Ilmu</label>
                    <input type="text" name="bidang_keahlian" required placeholder="Contoh: Sosiologi, Hukum, Linguistik" class="w-full rounded-xl border-emerald-light px-4 py-3 text-sm focus:ring-2 focus:ring-secondary focus:outline-none bg-warm-cream/50">
                </div>

                <!-- WhatsApp -->
                <div>
                    <label class="block text-xs font-semibold text-primary uppercase mb-2">Nomor WhatsApp / HP</label>
                    <input type="tel" name="telepon" required placeholder="081234567890" class="w-full rounded-xl border-emerald-light px-4 py-3 text-sm focus:ring-2 focus:ring-secondary focus:outline-none bg-warm-cream/50">
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-xs font-semibold text-primary uppercase mb-2">Alamat Email</label>
                    <input type="email" name="email" required placeholder="email@contoh.com" class="w-full rounded-xl border-emerald-light px-4 py-3 text-sm focus:ring-2 focus:ring-secondary focus:outline-none bg-warm-cream/50">
                </div>
            </div>

            <!-- File Uploads -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                <!-- Pas Foto -->
                <div>
                    <label class="block text-xs font-semibold text-primary uppercase mb-2">Unggah Pas Foto (Latar Merah/Biru)</label>
                    <div class="border-2 border-dashed border-emerald-light rounded-xl p-4 text-center bg-warm-cream/30 hover:bg-warm-cream/60 transition-colors">
                        <input type="file" name="foto" accept="image/*" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                        <p class="text-[10px] text-gray-400 mt-2">PNG, JPG maksimal 2MB</p>
                    </div>
                </div>

                <!-- KTP -->
                <div>
                    <label class="block text-xs font-semibold text-primary uppercase mb-2">Unggah Identitas (KTP)</label>
                    <div class="border-2 border-dashed border-emerald-light rounded-xl p-4 text-center bg-warm-cream/30 hover:bg-warm-cream/60 transition-colors">
                        <input type="file" name="ktp" accept="image/*,.pdf" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                        <p class="text-[10px] text-gray-400 mt-2">PNG, JPG, PDF maksimal 2MB</p>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-4">
                <button type="submit" class="btn-primary w-full py-4 text-base font-bold shadow-md hover:scale-[0.99] transition-transform">
                    Kirim Pendaftaran
                </button>
            </div>
        </form>
    </div>
</section>
@endsection
