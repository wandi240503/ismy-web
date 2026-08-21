@extends('layouts.ismy')

@section('content')
<section class="py-20 px-gutter bg-warm-cream min-h-[70vh] flex items-center justify-center">
    <div class="max-w-md w-full text-center bg-white p-8 md:p-10 rounded-3xl shadow-xl border border-emerald-900/10 space-y-6">
        <div class="w-20 h-20 mx-auto rounded-2xl bg-amber-50 border border-amber-200 flex items-center justify-center text-amber-600 shadow-inner">
            <span class="material-symbols-outlined text-4xl text-[#C9A227]">lock</span>
        </div>

        <div class="space-y-2">
            <span class="text-xs font-bold text-[#C9A227] uppercase tracking-widest block">Akses Terbatas (403)</span>
            <h1 class="text-2xl font-serif font-bold text-[#0F4C3A]">Halaman Khusus Administrator</h1>
            <p class="text-xs text-gray-600 leading-relaxed">
                Halaman Panel Admin hanya dapat diakses oleh jajaran Pengurus & Admin resmi ISMY. Sebagai anggota terdaftar, Anda dapat mengakses data profil dan KTA Anda melalui Dashboard Anggota.
            </p>
        </div>

        <div class="pt-2 flex flex-col gap-2.5">
            <a href="{{ route('dashboard') }}" class="btn-primary py-2.5 px-6 rounded-xl text-xs font-bold shadow-md flex items-center justify-center gap-1.5">
                <span class="material-symbols-outlined text-sm">badge</span> Buka Dashboard Anggota Saya
            </a>
            <a href="{{ route('beranda') }}" class="btn-secondary py-2 px-6 rounded-xl text-xs font-bold">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</section>
@endsection
