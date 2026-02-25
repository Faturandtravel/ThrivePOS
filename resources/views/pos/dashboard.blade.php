@extends('layouts.app')

@section('sidebar-right')

@endsection

@section('content')
<div class="p-4 md:p-8 pb-20">
    
    <form action="{{ route('dashboard') }}" method="GET" class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Dashboard & Analytics</h1>
            <p class="text-slate-500 text-sm mt-1">Laporan penjualan dan performa outlet.</p>
        </div>
        
        <div class="flex flex-col md:flex-row items-stretch md:items-center gap-3 bg-white p-3 md:p-1.5 rounded-2xl border border-slate-200 shadow-sm w-full md:w-auto">
            <div class="flex justify-between md:justify-start items-center px-1 md:px-3 border-b md:border-b-0 md:border-r border-slate-100 pb-2 md:pb-0">
                <span class="text-xs font-semibold text-slate-500 mr-2">Dari</span>
                <input type="date" name="start_date" value="{{ request('start_date', $startDate ? $startDate->format('Y-m-d') : '') }}" class="w-full md:w-auto text-right md:text-left border-0 bg-transparent text-sm font-semibold text-slate-700 focus:ring-0 p-0 cursor-pointer">
            </div>
            <div class="flex justify-between md:justify-start items-center px-1 md:px-3 border-b md:border-b-0 md:border-r border-slate-100 pb-2 md:pb-0">
                <span class="text-xs font-semibold text-slate-500 mr-2">Sampai</span>
                <input type="date" name="end_date" value="{{ request('end_date', $endDate ? $endDate->format('Y-m-d') : '') }}" class="w-full md:w-auto text-right md:text-left border-0 bg-transparent text-sm font-semibold text-slate-700 focus:ring-0 p-0 cursor-pointer">
            </div>
            <div class="flex gap-2 w-full md:w-auto pt-1 md:pt-0">
                <button type="submit" class="flex-1 md:flex-none px-5 py-2 bg-slate-100 text-slate-700 font-bold rounded-xl text-sm shadow-sm hover:bg-slate-200 transition">
                    Filter
                </button>
                <a href="{{ route('dashboard.export', request()->query()) }}" class="flex-1 md:flex-none px-5 py-2 bg-black text-white font-bold rounded-xl text-sm shadow-md hover:bg-slate-800 transition flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    <span class="whitespace-nowrap">Export Excel</span>
                </a>
            </div>
        </div>
    </form>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        
        <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-md transition">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-slate-500 font-semibold text-sm mb-1">Penjualan Hari Ini</p>
                    <h2 class="text-3xl font-extrabold text-slate-900">Rp {{ number_format($salesToday, 0, ',', '.') }}</h2>
                </div>
                <div class="p-3 bg-emerald-50 rounded-2xl text-emerald-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <div class="flex items-center gap-2 text-sm">
                <span class="{{ $todayGrowth >= 0 ? 'text-emerald-500' : 'text-red-500' }} font-bold flex items-center gap-1">
                    @if($todayGrowth >= 0)
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 15l7-7 7 7"></path></svg>
                    @else
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                    @endif
                    {{ $todayGrowth > 0 ? '+' : '' }}{{ number_format($todayGrowth, 1) }}%
                </span>
                <span class="text-slate-400">dari kemarin</span>
            </div>
            <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-slate-50 rounded-full z-0 group-hover:scale-110 transition-transform"></div>
        </div>

        <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-md transition">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-slate-500 font-semibold text-sm mb-1">Penjualan Minggu Ini</p>
                    <h2 class="text-3xl font-extrabold text-slate-900">Rp {{ number_format($salesThisWeek, 0, ',', '.') }}</h2>
                </div>
                <div class="p-3 bg-blue-50 rounded-2xl text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </div>
            </div>
            <div class="flex items-center gap-2 text-sm">
                <span class="{{ $weekGrowth >= 0 ? 'text-emerald-500' : 'text-red-500' }} font-bold flex items-center gap-1">
                    @if($weekGrowth >= 0)
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 15l7-7 7 7"></path></svg>
                    @else
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                    @endif
                    {{ $weekGrowth > 0 ? '+' : '' }}{{ number_format($weekGrowth, 1) }}%
                </span>
                <span class="text-slate-400">dari minggu lalu</span>
            </div>
            <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-slate-50 rounded-full z-0 group-hover:scale-110 transition-transform"></div>
        </div>

        <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-md transition">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-slate-500 font-semibold text-sm mb-1">Penjualan Bulan Ini</p>
                    <h2 class="text-3xl font-extrabold text-slate-900">Rp {{ number_format($salesThisMonth, 0, ',', '.') }}</h2>
                </div>
                <div class="p-3 bg-purple-50 rounded-2xl text-purple-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path></svg>
                </div>
            </div>
            <div class="flex items-center gap-2 text-sm">
                <span class="{{ $monthGrowth >= 0 ? 'text-emerald-500' : 'text-red-500' }} font-bold flex items-center gap-1">
                    @if($monthGrowth >= 0)
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 15l7-7 7 7"></path></svg>
                    @else
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                    @endif
                    {{ $monthGrowth > 0 ? '+' : '' }}{{ number_format($monthGrowth, 1) }}%
                </span>
                <span class="text-slate-400">dari bulan lalu</span>
            </div>
            <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-slate-50 rounded-full z-0 group-hover:scale-110 transition-transform"></div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        
        <div class="bg-white p-7 rounded-[2rem] shadow-sm border border-slate-100 flex flex-col">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-slate-800">Penjualan Berdasarkan Kategori</h3>
                <button class="text-slate-400 hover:text-slate-800 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path></svg>
                </button>
            </div>
            <div class="relative w-full flex-1" style="min-height: 250px;">
                <canvas id="categoryChart"></canvas>
            </div>
        </div>

        <div class="bg-white p-7 rounded-[2rem] shadow-sm border border-slate-100 flex flex-col">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-slate-800">Metode Pembayaran</h3>
                <button class="text-slate-400 hover:text-slate-800 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path></svg>
                </button>
            </div>
            <div class="relative w-full flex-1 flex justify-center items-center" style="min-height: 250px;">
                <canvas id="paymentChart"></canvas>
            </div>
        </div>

    </div>

    <div class="bg-white rounded-3xl md:rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-4 md:p-6 border-b border-slate-100 flex justify-between items-center">
            <h3 class="text-lg font-bold text-slate-800">Transaksi Terakhir</h3>
            <a href="{{ route('transactions.index', request()->query()) }}" class="text-sm font-semibold text-slate-500 hover:text-slate-800 transition">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto hide-scroll">
            <table class="w-full text-left text-sm text-slate-600 whitespace-nowrap md:whitespace-normal">
                <thead class="bg-slate-50 text-slate-500 font-semibold border-b border-slate-100">
                    <tr>
                        <th class="px-4 md:px-6 py-3 md:py-4 rounded-tl-xl">ID Pesanan</th>
                        <th class="px-4 md:px-6 py-3 md:py-4">Tanggal & Waktu</th>
                        <th class="px-4 md:px-6 py-3 md:py-4">Pembayaran</th>
                        <th class="px-4 md:px-6 py-3 md:py-4">Total</th>
                        <th class="px-4 md:px-6 py-3 md:py-4 rounded-tr-xl">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($recentTransactions as $transaction)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-4 md:px-6 py-3 md:py-4 font-semibold text-slate-900">#{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-4 md:px-6 py-3 md:py-4">{{ $transaction->created_at->format('M d, H:i') }}</td>
                        <td class="px-4 md:px-6 py-3 md:py-4">
                            @if($transaction->payment_method === 'xendit')
                                <span class="px-2.5 py-1 bg-blue-50 text-blue-600 font-bold rounded-lg text-xs">Xendit</span>
                            @else
                                <span class="px-2.5 py-1 bg-slate-100 text-slate-600 font-bold rounded-lg text-xs">Tunai</span>
                            @endif
                        </td>
                        <td class="px-4 md:px-6 py-3 md:py-4 font-bold text-slate-900">Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                        <td class="px-4 md:px-6 py-3 md:py-4">
                            @if($transaction->payment_status === 'paid')
                                <span class="flex items-center gap-1.5 text-emerald-600 font-semibold"><div class="w-1.5 h-1.5 rounded-full bg-emerald-600"></div>Lunas</span>
                            @else
                                <span class="flex items-center gap-1.5 text-amber-600 font-semibold"><div class="w-1.5 h-1.5 rounded-full bg-amber-600"></div>Tertunda</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 md:px-6 py-6 md:py-8 text-center text-slate-500">Tidak ada transaksi terbaru.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        Chart.defaults.font.family = "'Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'";
        Chart.defaults.color = '#64748b'; 

        const ctxCategory = document.getElementById('categoryChart').getContext('2d');
        new Chart(ctxCategory, {
            type: 'bar',
            data: {
                labels: {!! json_encode($categoryLabels) !!},
                datasets: [{
                    label: 'Penjualan (Rp)',
                    data: {!! json_encode($categoryData) !!},
                    backgroundColor: [
                        '#0F172A', 
                        '#334155', 
                        '#64748B', 
                        '#94A3B8', 
                        '#CBD5E1'  
                    ],
                    borderRadius: 8, 
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#0F172A',
                        padding: 12,
                        cornerRadius: 8,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { borderDash: [4, 4], color: '#F1F5F9', drawBorder: false },
                    },
                    x: {
                        grid: { display: false, drawBorder: false }
                    }
                }
            }
        });

        const ctxPayment = document.getElementById('paymentChart').getContext('2d');
        new Chart(ctxPayment, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($paymentLabels) !!},
                datasets: [{
                    data: {!! json_encode($paymentData) !!}, 
                    backgroundColor: [
                        '#2563EB', 
                        '#1E293B', 
                    ],
                    borderWidth: 4,
                    borderColor: '#ffffff', 
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%', 
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { padding: 20, usePointStyle: true, pointStyle: 'circle' }
                    },
                    tooltip: {
                        backgroundColor: '#0F172A',
                        padding: 12,
                        cornerRadius: 8,
                        callbacks: {
                            label: function(context) {
                                return ' ' + context.label + ': ' + context.raw + '%';
                            }
                        }
                    }
                }
            }
        });

    });
</script>
@endsection