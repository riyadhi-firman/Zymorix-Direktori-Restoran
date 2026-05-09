@extends('layout')

@section('content')
<div class="mb-8">
    <a href="/restoran" class="inline-flex items-center text-sm font-medium text-slate-500 dark:text-slate-400 hover:text-primary dark:hover:text-indigo-400 transition-colors">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Daftar Restoran
    </a>
</div>

<div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden mb-10 transition-colors duration-300">
    <!-- Banner Area -->
    <div class="h-48 bg-gradient-to-r from-indigo-500 to-primary dark:from-indigo-900 dark:to-indigo-700 relative">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/food.png')] opacity-10"></div>
    </div>
    
    <!-- Restoran Info -->
    <div class="px-8 pb-8 relative">
        <!-- Logo/Avatar -->
        <div class="absolute -top-16 left-8">
            <div class="w-32 h-32 bg-white dark:bg-slate-800 rounded-2xl shadow-lg border-4 border-white dark:border-slate-800 flex items-center justify-center text-primary dark:text-indigo-400 text-4xl font-bold bg-indigo-50 dark:bg-indigo-900/50">
                {{ substr($data['nama'], 0, 1) }}
            </div>
        </div>
        
        <div class="pt-20 flex flex-col md:flex-row md:items-start justify-between gap-6">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <h1 class="text-3xl font-bold text-slate-900 dark:text-white">{{ $data['nama'] }}</h1>
                    <span class="px-2.5 py-1 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 rounded text-sm font-medium">{{ $data['tipe_masakan'] ?? 'Umum' }}</span>
                </div>
                <div class="flex items-center text-slate-500 dark:text-slate-400 mb-4 text-sm">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    {{ $data['kota'] }}
                </div>
            </div>
            
            <div class="flex flex-col items-center justify-center p-4 bg-slate-50 dark:bg-slate-700/50 rounded-xl border border-slate-100 dark:border-slate-700 min-w-[120px]">
                <div class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider font-semibold mb-1">Rating</div>
                <div class="flex items-center text-2xl font-bold {{ $data['rating'] >= 4.5 ? 'text-emerald-500 dark:text-emerald-400 animate-pulse' : 'text-primary dark:text-indigo-400' }}">
                    {{ $data['rating'] }}
                    <svg class="w-6 h-6 ml-1" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mb-6 flex items-center justify-between">
    <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Menu Tersedia</h2>
    <span class="bg-indigo-100 dark:bg-indigo-900/50 text-primary dark:text-indigo-400 py-1 px-3 rounded-full text-sm font-semibold">{{ count($menus) }} Item</span>
</div>

@if(count($menus) > 0)
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    @foreach($menus as $m)
    @php
        $namaLower = strtolower($m['nama']);
        $icon = '🍽️';
        if (str_contains($namaLower, 'nasi')) $icon = '🍚';
        elseif (str_contains($namaLower, 'mie')) $icon = '🍜';
        elseif (str_contains($namaLower, 'salmon') || str_contains($namaLower, 'sushi')) $icon = '🍣';
        elseif (str_contains($namaLower, 'soup') || str_contains($namaLower, 'bakso')) $icon = '🍲';
        elseif (str_contains($namaLower, 'steak')) $icon = '🥩';
        elseif (str_contains($namaLower, 'rendang')) $icon = '🍛';
        elseif (str_contains($namaLower, 'teh') || str_contains($namaLower, 'tea') || str_contains($namaLower, 'tarik')) $icon = '🧋';
        elseif (str_contains($namaLower, 'es') || str_contains($namaLower, 'lemonade') || str_contains($namaLower, 'jeruk')) $icon = '🍹';
        elseif ($m['kategori'] === 'Makanan') $icon = '🥘';
        else $icon = '🥤';
    @endphp
    <div class="bg-white dark:bg-slate-800 p-4 rounded-xl border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-md dark:hover:border-slate-600 transition-all flex items-center justify-between group cursor-pointer" onclick="window.location='/menu/{{ $m['id'] }}'">
        <div class="flex items-center gap-4">
            <div class="w-16 h-16 bg-slate-50 dark:bg-slate-700/50 rounded-lg flex items-center justify-center text-2xl group-hover:scale-105 transition-transform">
                {{ $icon }}
            </div>
            <div>
                <h3 class="font-bold text-slate-800 dark:text-slate-100 text-lg group-hover:text-primary dark:group-hover:text-indigo-400 transition-colors">{{ $m['nama'] }}</h3>
                <span class="text-sm text-slate-500 dark:text-slate-400">{{ $m['kategori'] }}</span>
            </div>
        </div>
        <div class="text-right">
            <div class="font-bold text-lg text-slate-900 dark:text-white">Rp{{ number_format($m['harga'], 0, ',', '.') }}</div>
            <div class="text-xs text-amber-500 font-medium flex items-center justify-end mt-1">
                ⭐ {{ $m['rating'] }}
            </div>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="text-center py-12 bg-white dark:bg-slate-800 rounded-xl border border-slate-100 dark:border-slate-700 transition-colors duration-300">
    <p class="text-slate-500 dark:text-slate-400">Restoran ini belum memiliki menu.</p>
</div>
@endif

@endsection