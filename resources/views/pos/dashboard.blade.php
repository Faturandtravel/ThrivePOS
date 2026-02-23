@extends('layouts.pos')

@section('sidebar-right')

@endsection

@section('content')
<div class="p-8 pb-20">
    
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Dashboard & Analytics</h1>
            <p class="text-slate-500 text-sm mt-1">Laporan penjualan dan performa outlet.</p>
        </div>
        
        <div class="flex gap-3">
            <button class="px-5 py-2.5 bg-white text-slate-700 font-semibold rounded-xl text-sm border border-slate-200 shadow-sm hover:bg-slate-50 transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Filter Tanggal
            </button>
            <button class="px-5 py-2.5 bg-black text-white font-semibold rounded-xl text-sm shadow-md hover:bg-slate-800 transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                Export PDF
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        
        <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-md transition">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-slate-500 font-semibold text-sm mb-1">Penjualan Hari Ini</p>
                    <h2 class="text-3xl font-extrabold text-slate-900">$1,240.00</h2>
                </div>
                <div class="p-3 bg-emerald-50 rounded-2xl text-emerald-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <div class="flex items-center gap-2 text-sm">
                <span class="text-emerald-500 font-bold flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 15l7-7 7 7"></path></svg>
                    +12.5%
                </span>
                <span class="text-slate-400">dari kemarin</span>
            </div>
            <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-slate-50 rounded-full z-0 group-hover:scale-110 transition-transform"></div>
        </div>

        <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-md transition">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-slate-500 font-semibold text-sm mb-1">Penjualan Minggu Ini</p>
                    <h2 class="text-3xl font-extrabold text-slate-900">$8,450.00</h2>
                </div>
                <div class="p-3 bg-blue-50 rounded-2xl text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </div>
            </div>
            <div class="flex items-center gap-2 text-sm">
                <span class="text-emerald-500 font-bold flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 15l7-7 7 7"></path></svg>
                    +4.2%
                </span>
                <span class="text-slate-400">dari minggu lalu</span>
            </div>
            <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-slate-50 rounded-full z-0 group-hover:scale-110 transition-transform"></div>
        </div>

        <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-md transition">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-slate-500 font-semibold text-sm mb-1">Penjualan Bulan Ini</p>
                    <h2 class="text-3xl font-extrabold text-slate-900">$32,100.00</h2>
                </div>
                <div class="p-3 bg-purple-50 rounded-2xl text-purple-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path></svg>
                </div>
            </div>
            <div class="flex items-center gap-2 text-sm">
                <span class="text-red-500 font-bold flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                    -1.5%
                </span>
                <span class="text-slate-400">dari bulan lalu</span>
            </div>
            <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-slate-50 rounded-full z-0 group-hover:scale-110 transition-transform"></div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        
        <div class="bg-white p-7 rounded-[2rem] shadow-sm border border-slate-100 flex flex-col">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-slate-800">Sales by Category</h3>
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
                <h3 class="text-lg font-bold text-slate-800">Payment Methods</h3>
                <button class="text-slate-400 hover:text-slate-800 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path></svg>
                </button>
            </div>
            <div class="relative w-full flex-1 flex justify-center items-center" style="min-height: 250px;">
                <canvas id="paymentChart"></canvas>
            </div>
        </div>

    </div>

    <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex justify-between items-center">
            <h3 class="text-lg font-bold text-slate-800">Recent Transactions</h3>
            <a href="#" class="text-sm font-semibold text-slate-500 hover:text-slate-800 transition">View All</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-slate-500 font-semibold border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4 rounded-tl-xl">Order ID</th>
                        <th class="px-6 py-4">Date & Time</th>
                        <th class="px-6 py-4">Customer</th>
                        <th class="px-6 py-4">Payment</th>
                        <th class="px-6 py-4">Total</th>
                        <th class="px-6 py-4 rounded-tr-xl">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-4 font-semibold text-slate-900">#TRX-0091</td>
                        <td class="px-6 py-4">Today, 14:30</td>
                        <td class="px-6 py-4">Walk-in Customer</td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 bg-blue-50 text-blue-600 font-bold rounded-lg text-xs">Xendit</span>
                        </td>
                        <td class="px-6 py-4 font-bold text-slate-900">$24.00</td>
                        <td class="px-6 py-4"><span class="flex items-center gap-1.5 text-emerald-600 font-semibold"><div class="w-1.5 h-1.5 rounded-full bg-emerald-600"></div>Completed</span></td>
                    </tr>
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-4 font-semibold text-slate-900">#TRX-0090</td>
                        <td class="px-6 py-4">Today, 13:15</td>
                        <td class="px-6 py-4">James K.</td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 bg-slate-100 text-slate-600 font-bold rounded-lg text-xs">Cash</span>
                        </td>
                        <td class="px-6 py-4 font-bold text-slate-900">$11.00</td>
                        <td class="px-6 py-4"><span class="flex items-center gap-1.5 text-emerald-600 font-semibold"><div class="w-1.5 h-1.5 rounded-full bg-emerald-600"></div>Completed</span></td>
                    </tr>
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-4 font-semibold text-slate-900">#TRX-0089</td>
                        <td class="px-6 py-4">Today, 12:45</td>
                        <td class="px-6 py-4">Walk-in Customer</td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 bg-blue-50 text-blue-600 font-bold rounded-lg text-xs">Xendit</span>
                        </td>
                        <td class="px-6 py-4 font-bold text-slate-900">$45.50</td>
                        <td class="px-6 py-4"><span class="flex items-center gap-1.5 text-emerald-600 font-semibold"><div class="w-1.5 h-1.5 rounded-full bg-emerald-600"></div>Completed</span></td>
                    </tr>
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
                labels: ['Soups', 'Salads', 'Pasta', 'Bakery', 'Drinks'],
                datasets: [{
                    label: 'Sales ($)',
                    data: [1200, 1900, 3000, 1500, 2200],
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
                labels: ['Xendit (Digital)', 'Cash'],
                datasets: [{
                    data: [65, 35], 
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