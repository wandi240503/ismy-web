@extends('layouts.ismy')

@section('content')
<article class="py-xl px-gutter bg-warm-cream">
    <div class="max-w-4xl mx-auto space-y-8">
        <!-- Breadcrumbs -->
        <nav class="flex text-xs text-gray-500 gap-2">
            <a href="{{ route('beranda') }}" class="hover:text-primary">Beranda</a>
            <span>/</span>
            <a href="{{ route('berita') }}" class="hover:text-primary">Berita</a>
            <span>/</span>
            <span class="text-primary font-semibold truncate max-w-xs">{{ $berita->judul }}</span>
        </nav>

        <!-- Article Header -->
        <header class="space-y-4">
            <span class="bg-secondary/20 text-gray-900 text-xs font-semibold px-3 py-1 rounded-full w-fit inline-block">
                {{ $berita->kategori->nama ?? 'Umum' }}
            </span>
            <h1 class="text-3xl md:text-4xl font-serif font-bold text-primary leading-tight">
                {{ $berita->judul }}
            </h1>
            <div class="flex items-center gap-6 text-xs text-gray-500 py-2 border-y border-emerald-light">
                <span class="flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">person</span> {{ $berita->penulis ?? 'Admin' }}
                </span>
                <span class="flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">calendar_today</span> {{ $berita->tanggal_terbit ? $berita->tanggal_terbit->format('d M Y') : '' }}
                </span>
                <span class="flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">visibility</span> {{ $berita->view_count }} Dilihat
                </span>
            </div>
        </header>

        <!-- Featured Image -->
        @if($berita->gambar)
            <div class="rounded-2xl overflow-hidden card-shadow border-emerald-light">
                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="w-full max-h-[450px] object-cover">
            </div>
        @endif

        <!-- Article Content Body -->
        <div class="bg-white rounded-2xl p-8 card-shadow border-emerald-light text-on-surface-variant leading-relaxed space-y-4 text-base">
            {!! nl2br(e($berita->konten)) !!}
        </div>

        <!-- Related Articles -->
        @if(isset($beritaTerkait) && $beritaTerkait->count() > 0)
            <div class="pt-8 border-t border-emerald-light">
                <h3 class="text-2xl font-serif font-bold text-primary mb-6">Berita Terkait</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-md">
                    @foreach($beritaTerkait as $bt)
                        <div class="bg-white rounded-xl p-4 card-shadow border-emerald-light flex flex-col justify-between">
                            <div>
                                <span class="text-xs text-gray-400 block mb-1">{{ $bt->tanggal_terbit ? $bt->tanggal_terbit->format('d M Y') : '' }}</span>
                                <h4 class="font-serif font-bold text-primary text-sm line-clamp-2 mb-2">
                                    <a href="{{ route('berita.detail', $bt->slug) }}" class="hover:text-secondary">
                                        {{ $bt->judul }}
                                    </a>
                                </h4>
                            </div>
                            <a href="{{ route('berita.detail', $bt->slug) }}" class="text-xs font-semibold text-primary hover:text-secondary mt-3">Baca →</a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</article>
@endsection
