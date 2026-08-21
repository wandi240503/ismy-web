<x-app-layout>
    <div class="min-h-[70vh] flex items-center justify-center py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full text-center bg-white rounded-3xl p-8 border border-neutral-100 shadow-xl shadow-neutral-100/50">
            <div class="w-16 h-16 bg-amber-50 text-amber-500 rounded-2xl flex items-center justify-center mx-auto mb-5">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            
            <h1 class="text-xl font-bold text-neutral-900 mb-2">Kartu Tanda Anggota Tidak Ditemukan</h1>
            <p class="text-sm text-neutral-600 mb-4">
                Nomor KTA <span class="font-mono font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded">{{ $nomor }}</span> belum terdaftar atau masih dalam proses verifikasi tim sekretariat ISMY Yogyakarta.
            </p>
            
            <div class="pt-4 border-t border-neutral-100 flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ route('keanggotaan') }}" class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold rounded-xl transition shadow-sm">
                    Daftar Anggota Baru
                </a>
                <a href="{{ route('beranda') }}" class="px-5 py-2.5 bg-neutral-100 hover:bg-neutral-200 text-neutral-700 text-xs font-semibold rounded-xl transition">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
