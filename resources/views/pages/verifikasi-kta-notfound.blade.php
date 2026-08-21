@extends('layouts.ismy')

@section('content')
<section class="min-h-[70vh] flex items-center justify-center py-16 px-4 sm:px-6 lg:px-8 bg-warm-cream/40">
    <div class="max-w-md w-full text-center bg-white rounded-3xl p-8 border border-neutral-100 shadow-sm">
        <div class="w-16 h-16 bg-amber-50 text-amber-500 rounded-2xl flex items-center justify-center mx-auto mb-5">
            <span class="material-symbols-outlined text-3xl">warning</span>
        </div>
        
        <h1 class="text-xl font-bold text-neutral-900 mb-2 font-serif">Nomor KTA Tidak Ditemukan</h1>
        <p class="text-xs text-neutral-600 mb-6 leading-relaxed">
            Nomor KTA <span class="font-mono font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded">{{ $nomor }}</span> belum terdaftar di basis data keanggotaan resmi ISMY D.I. Yogyakarta.
        </p>
        
        <div class="pt-4 border-t border-neutral-100 flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ route('keanggotaan') }}" class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold rounded-2xl transition shadow-sm">
                Daftar Anggota Baru
            </a>
            <a href="{{ route('beranda') }}" class="px-5 py-2.5 bg-neutral-100 hover:bg-neutral-200 text-neutral-700 text-xs font-semibold rounded-2xl transition">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</section>
@endsection
