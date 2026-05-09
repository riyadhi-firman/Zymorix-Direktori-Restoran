@extends('layout')

@section('content')
<div class="mb-8">
    <a href="/menu" class="inline-flex items-center text-sm font-medium text-slate-500 dark:text-slate-400 hover:text-primary dark:hover:text-indigo-400 transition-colors">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Daftar Menu
    </a>
</div>

<div class="max-w-4xl mx-auto">
    @php
        $namaLower = strtolower($data['nama']);
        $icon = '🍽️';
        if (str_contains($namaLower, 'nasi')) $icon = '🍚';
        elseif (str_contains($namaLower, 'mie')) $icon = '🍜';
        elseif (str_contains($namaLower, 'salmon') || str_contains($namaLower, 'sushi')) $icon = '🍣';
        elseif (str_contains($namaLower, 'soup') || str_contains($namaLower, 'bakso')) $icon = '🍲';
        elseif (str_contains($namaLower, 'steak')) $icon = '🥩';
        elseif (str_contains($namaLower, 'rendang')) $icon = '🍛';
        elseif (str_contains($namaLower, 'teh') || str_contains($namaLower, 'tea') || str_contains($namaLower, 'tarik')) $icon = '🧋';
        elseif (str_contains($namaLower, 'es') || str_contains($namaLower, 'lemonade') || str_contains($namaLower, 'jeruk')) $icon = '🍹';
        elseif ($data['kategori'] === 'Makanan') $icon = '🥘';
        else $icon = '🥤';
    @endphp
    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden flex flex-col md:flex-row transition-colors duration-300">
        <!-- Banner/Icon -->
        <div class="md:w-1/3 bg-indigo-50 dark:bg-indigo-900/50 flex items-center justify-center p-12 min-h-[250px]">
            <div class="text-8xl drop-shadow-md transform hover:scale-110 transition-transform duration-300">
                {{ $icon }}
            </div>
        </div>
        
        <!-- Details -->
        <div class="md:w-2/3 p-8 md:p-12 flex flex-col">
            <div class="flex items-start justify-between gap-4 mb-4">
                <div>
                    <span class="inline-block px-3 py-1 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 rounded-full text-xs font-semibold tracking-wide uppercase mb-3">
                        {{ $data['kategori'] }}
                    </span>
                    <h1 class="text-3xl md:text-4xl font-bold text-slate-900 dark:text-white mb-2">{{ $data['nama'] }}</h1>
                </div>
                <div class="flex items-center text-xl font-bold {{ $data['rating'] >= 4.5 ? 'text-emerald-500 dark:text-emerald-400 animate-pulse' : 'text-primary dark:text-indigo-400' }} bg-slate-50 dark:bg-slate-700/50 px-3 py-2 rounded-xl">
                    {{ $data['rating'] }}
                    <svg class="w-5 h-5 ml-1" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                </div>
            </div>
            
            <div class="text-4xl font-extrabold text-primary dark:text-indigo-400 mb-8">
                Rp{{ number_format($data['harga'], 0, ',', '.') }}
            </div>
            
            <div class="mt-auto border-t border-slate-100 dark:border-slate-700 pt-6">
                <h3 class="text-sm font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-3">Tersedia di</h3>
                <a href="/restoran/{{ $resto['id'] }}" class="flex items-center p-4 bg-slate-50 dark:bg-slate-700/50 rounded-xl hover:bg-indigo-50 dark:hover:bg-slate-700 border border-slate-100 dark:border-slate-600 transition-colors group">
                    <div class="w-12 h-12 bg-white dark:bg-slate-800 rounded-lg shadow-sm border border-slate-200 dark:border-slate-600 flex items-center justify-center text-primary dark:text-indigo-400 text-xl font-bold mr-4">
                        {{ substr($resto['nama'], 0, 1) }}
                    </div>
                    <div>
                        <div class="font-bold text-slate-800 dark:text-white group-hover:text-primary dark:group-hover:text-indigo-400 transition-colors">{{ $resto['nama'] }}</div>
                        <div class="text-sm text-slate-500 dark:text-slate-400">{{ $resto['kota'] }} • {{ $resto['tipe_masakan'] }}</div>
                    </div>
                    <svg class="w-5 h-5 ml-auto text-slate-400 dark:text-slate-500 group-hover:text-primary dark:group-hover:text-indigo-400 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection