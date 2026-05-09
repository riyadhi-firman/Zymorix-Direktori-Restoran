@extends('layout')

@section('content')
<div x-data="{ search: '' }" class="mb-10">

    <!-- Header & Search -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-primary to-indigo-800 dark:from-indigo-400 dark:to-indigo-200">Eksplorasi Restoran</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-1">Temukan tempat makan terbaik di berbagai kota</p>
        </div>
        
        <div class="relative w-full md:w-80">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <input x-model="search" type="text" placeholder="Cari nama atau kota..."
                class="w-full pl-10 pr-4 py-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-20 shadow-sm transition-all outline-none dark:text-white dark:placeholder-slate-500">
        </div>
    </div>

    <!-- Grid Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($restoran as $r)
        @php
            $text = strtolower($r['nama'].' '.$r['kota'].' '.$r['tipe_masakan']);
            
            // Modern Rating Color badges
            if ($r['rating'] >= 4.7) {
                $ratingBg = 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400';
                $ratingIcon = 'text-emerald-500';
            } elseif ($r['rating'] >= 4.4) {
                $ratingBg = 'bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400';
                $ratingIcon = 'text-blue-500';
            } elseif ($r['rating'] >= 4.0) {
                $ratingBg = 'bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400';
                $ratingIcon = 'text-amber-500';
            } else {
                $ratingBg = 'bg-rose-100 dark:bg-rose-900/30 text-rose-700 dark:text-rose-400';
                $ratingIcon = 'text-rose-500';
            }
        @endphp

        <div x-show="('{{ $text }}').includes(search.toLowerCase())" x-transition.opacity.duration.300ms
            class="bg-white dark:bg-slate-800 rounded-2xl p-6 shadow-sm border border-slate-100 dark:border-slate-700 hover:shadow-xl hover:-translate-y-1 dark:hover:border-slate-600 transition-all duration-300 flex flex-col h-full cursor-pointer group animate-fadeUp"
            onclick="window.location='/restoran/{{ $r['id'] }}'"
            style="animation-delay: {{ $loop->index * 75 }}ms;">
            
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-indigo-50 dark:bg-indigo-900/30 rounded-xl text-primary dark:text-indigo-400 group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1v1H9V7zm5 0h1v1h-1V7zm-5 4h1v1H9v-1zm5 0h1v1h-1v-1zm-5 4h1v1H9v-1zm5 0h1v1h-1v-1z"></path></svg>
                </div>
                
                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-sm font-medium {{ $ratingBg }}">
                    <svg class="w-4 h-4 {{ $ratingIcon }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    {{ $r['rating'] }}
                </span>
            </div>

            <h3 class="text-xl font-bold text-slate-800 dark:text-slate-100 mb-2 group-hover:text-primary dark:group-hover:text-indigo-400 transition-colors">{{ $r['nama'] }}</h3>
            
            <div class="flex items-center text-slate-500 dark:text-slate-400 mb-4 text-sm">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                {{ $r['kota'] }}
            </div>
            
            <div class="mt-auto pt-4 border-t border-slate-100 dark:border-slate-700 flex items-center justify-between">
                <span class="text-sm font-medium px-2.5 py-1 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 rounded">
                    {{ $r['tipe_masakan'] ?? 'Umum' }}
                </span>
                <span class="text-primary dark:text-indigo-400 text-sm font-medium flex items-center group-hover:translate-x-1 transition-transform">
                    Lihat Detail
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </span>
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- Empty State -->
    <div x-show="!Array.from(document.querySelectorAll('.grid > div')).some(el => el.style.display !== 'none')" style="display: none;" 
         class="text-center py-12 px-4 bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 mt-6">
        <svg class="mx-auto h-12 w-12 text-slate-300 dark:text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <h3 class="mt-4 text-lg font-medium text-slate-900 dark:text-slate-100">Restoran tidak ditemukan</h3>
        <p class="mt-1 text-slate-500 dark:text-slate-400">Coba ubah kata kunci pencarian Anda menjadi kata lain.</p>
    </div>

</div>
@endsection