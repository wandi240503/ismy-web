@extends('layouts.ismy')

@section('content')
<section class="py-20 px-gutter bg-warm-cream min-h-[70vh] flex items-center justify-center">
    <div class="max-w-md w-full text-center bg-white p-8 md:p-10 rounded-3xl shadow-xl border border-emerald-900/10 space-y-6">
        <div class="w-20 h-20 mx-auto rounded-2xl bg-emerald-50 border border-emerald-200 flex items-center justify-center text-[#0F4C3A] shadow-inner">
            <span class="material-symbols-outlined text-4xl text-[#0F4C3A]">explore_off</span>
        </div>

        <div class="space-y-2">
            <span class="text-xs font-bold text-[#C9A227] uppercase tracking-widest block">Halaman Tidak Ditemukan (404)</span>
            <h1 class="text-2xl font-serif font-bold text-[#0F4C3A]">Alamat Tidak Tersedia</h1>
            <p class="text-xs text-gray-600 leading-relaxed">
                Mohon maaf, halaman atau berkas yang Anda cari tidak ditemukan atau telah dipindahkan.
            </p>
        </div>

        <div class="pt-2 flex flex-col gap-2.5">
            <a href="{{ route('beranda') }}" class="btn-primary py-2.5 px-6 rounded-xl text-xs font-bold shadow-md flex items-center justify-center gap-1.5">
                <span class="material-symbols-outlined text-sm">home</span> Kembali ke Beranda Utama
            </a>
            <a href="{{ route('pencarian') }}" class="btn-secondary py-2 px-6 rounded-xl text-xs font-bold flex items-center justify-center gap-1.5">
                <span class="material-symbols-outlined text-sm">search</span> Cari di Pusat Data
            </a>
        </div>
    </div>
</section>
@endsection
