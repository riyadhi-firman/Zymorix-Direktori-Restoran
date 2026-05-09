@extends('layout')

@section('content')

<!-- Hero Section -->
<div class="relative rounded-2xl overflow-hidden bg-gradient-to-r from-primary to-indigo-800 dark:from-indigo-900 dark:to-slate-800 text-white shadow-lg mb-8 transition-colors duration-300">
    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
    <div class="relative p-8 md:p-12 lg:px-16 flex flex-col md:flex-row items-center justify-between gap-8">
        <div class="max-w-2xl">
            <h1 class="text-3xl md:text-5xl font-bold mb-4 leading-tight">Temukan Rasa Sempurna di Setiap Sudut Kota</h1>
            <p class="text-indigo-100 text-lg mb-6 leading-relaxed">Zymorix menghubungkan Anda dengan restoran-restoran terbaik dan menu paling lezat. Jelajahi, bandingkan, dan rasakan nikmatnya.</p>
            <div class="flex flex-wrap gap-4">
                <a href="/restoran" class="px-6 py-3 bg-white text-primary font-semibold rounded-lg shadow-md hover:bg-slate-50 transition-colors duration-200">Lihat Restoran</a>
                <a href="/menu" class="px-6 py-3 bg-indigo-700/50 dark:bg-slate-700/50 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 dark:hover:bg-slate-600 transition-colors duration-200 backdrop-blur-sm">Eksplorasi Menu</a>
            </div>
        </div>
        <div class="hidden lg:block animate-float">
            <div class="w-48 h-48 bg-white/10 backdrop-blur-md rounded-full shadow-2xl border border-white/20 flex items-center justify-center">
                <svg class="w-24 h-24 text-white opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
        </div>
    </div>
</div>

<div class="mb-4">
    <h2 class="text-2xl font-bold text-slate-800 dark:text-slate-100 transition-colors duration-300">Statistik Platform</h2>
    <p class="text-slate-500 dark:text-slate-400 transition-colors duration-300">Melihat performa restoran berdasarkan data real-time kami.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

    <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700 flex flex-col h-full transition-all duration-300 hover:shadow-md">
        <div class="flex items-center justify-between mb-6">
            <h3 class="font-semibold text-lg text-slate-700 dark:text-slate-200">Persebaran Jumlah Menu</h3>
            <div class="p-2 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg text-primary dark:text-indigo-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
        </div>
        <div class="flex-grow flex items-center justify-center min-h-[300px]">
            <canvas id="chartMenu" class="w-full"></canvas>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700 flex flex-col h-full transition-all duration-300 hover:shadow-md">
        <div class="flex items-center justify-between mb-6">
            <h3 class="font-semibold text-lg text-slate-700 dark:text-slate-200">Tren Rating Restoran</h3>
            <div class="p-2 bg-emerald-50 dark:bg-emerald-900/30 rounded-lg text-secondary dark:text-emerald-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
            </div>
        </div>
        <div class="flex-grow flex items-center justify-center min-h-[300px]">
            <canvas id="chartRating" class="w-full"></canvas>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const restoran = @json($restoran);

    // Styling configuration for Chart.js
    Chart.defaults.font.family = "'Inter', sans-serif";
    Chart.defaults.color = '#64748b'; // slate-500

    new Chart(document.getElementById('chartMenu'), {
        type: 'bar',
        data: {
            labels: restoran.map(r => r.nama),
            datasets: [{
                label: 'Jumlah Menu Tersedia',
                data: restoran.map(r => r.menu_ids.length),
                backgroundColor: 'rgba(79, 70, 229, 0.8)', // primary color
                borderColor: 'rgb(79, 70, 229)',
                borderWidth: 1,
                borderRadius: 6,
                barPercentage: 0.6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(15, 23, 42, 0.9)',
                    padding: 12,
                    cornerRadius: 8,
                    titleFont: { size: 14, weight: 'bold' },
                    bodyFont: { size: 13 }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#f1f5f9', drawBorder: false },
                    ticks: { stepSize: 1 }
                },
                x: {
                    grid: { display: false, drawBorder: false }
                }
            }
        }
    });

    new Chart(document.getElementById('chartRating'), {
        type: 'line',
        data: {
            labels: restoran.map(r => r.nama),
            datasets: [{
                label: 'Rating (Skala 5)',
                data: restoran.map(r => r.rating),
                borderColor: '#10B981', // secondary color
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                borderWidth: 3,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#10B981',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7,
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(15, 23, 42, 0.9)',
                    padding: 12,
                    cornerRadius: 8,
                    titleFont: { size: 14, weight: 'bold' },
                    bodyFont: { size: 13 }
                }
            },
            scales: {
                y: {
                    beginAtZero: false,
                    min: 4.0,
                    max: 5.0,
                    grid: { color: '#f1f5f9', drawBorder: false }
                },
                x: {
                    grid: { display: false, drawBorder: false }
                }
            }
        }
    });
});
</script>
@endsection