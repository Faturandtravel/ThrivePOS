@extends('layouts.app')

@section('content')
<div class="p-4 md:p-8 pb-20">
    
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-6 md:mb-8 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Semua Transaksi</h1>
            <p class="text-slate-500 text-sm mt-1">Riwayat semua transaksi yang pernah dilakukan.</p>
        </div>
        
        <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
            <a href="{{ route('dashboard') }}" class="w-full sm:w-auto px-5 py-2.5 bg-white text-slate-700 font-semibold rounded-xl text-sm border border-slate-200 shadow-sm hover:bg-slate-50 transition flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
            <a href="{{ route('dashboard.export', request()->query()) }}" class="w-full sm:w-auto px-5 py-2.5 bg-emerald-600 text-white font-semibold rounded-xl text-sm shadow-md hover:bg-emerald-700 transition flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                Ekspor Excel
            </a>
        </div>
    </div>

    <!-- Filter Form -->
    <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 mb-8">
        <form action="{{ route('transactions.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
            <div class="w-full md:w-1/3">
                <label class="block text-sm font-semibold text-slate-700 mb-1">Tanggal Mulai</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}" class="w-full rounded-xl border-slate-200 shadow-sm focus:border-black focus:ring-black text-sm">
            </div>
            <div class="w-full md:w-1/3">
                <label class="block text-sm font-semibold text-slate-700 mb-1">Tanggal Selesai</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}" class="w-full rounded-xl border-slate-200 shadow-sm focus:border-black focus:ring-black text-sm">
            </div>
            <div class="flex gap-2">
                <button type="submit" class="px-5 py-2.5 bg-black text-white font-semibold rounded-xl text-sm shadow-md hover:bg-slate-800 transition">Filter</button>
                @if(request()->has('start_date') || request()->has('end_date'))
                <a href="{{ route('transactions.index') }}" class="px-5 py-2.5 bg-slate-100 text-slate-700 font-semibold rounded-xl text-sm shadow-sm hover:bg-slate-200 transition">Bersihkan</a>
                @endif
            </div>
        </form>
    </div>

    <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden mb-8">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-slate-500 font-semibold border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4 rounded-tl-xl">ID Pesanan</th>
                        <th class="px-6 py-4">Tanggal & Waktu</th>
                        <th class="px-6 py-4">Pelanggan</th>
                        <th class="px-6 py-4">Pembayaran</th>
                        <th class="px-6 py-4">Total</th>
                        <th class="px-6 py-4 rounded-tr-xl">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($orders as $transaction)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-4 font-semibold text-slate-900">
                            #{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}
                            <div class="text-xs text-slate-400 font-normal mt-1">{{ $transaction->items->count() }} item</div>
                        </td>
                        <td class="px-6 py-4">{{ $transaction->created_at->format('M d, Y - H:i') }}</td>
                        <td class="px-6 py-4">Pelanggan Langsung</td>
                        <td class="px-6 py-4">
                            @if($transaction->payment_method === 'xendit')
                                <span class="px-2.5 py-1 bg-blue-50 text-blue-600 font-bold rounded-lg text-xs">Xendit</span>
                            @else
                                <span class="px-2.5 py-1 bg-slate-100 text-slate-600 font-bold rounded-lg text-xs">Tunai</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-bold text-slate-900">Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            @if($transaction->payment_status === 'paid')
                                <span class="flex items-center gap-1.5 text-emerald-600 font-semibold"><div class="w-1.5 h-1.5 rounded-full bg-emerald-600"></div>Lunas</span>
                            @else
                                <span class="flex items-center gap-1.5 text-amber-600 font-semibold"><div class="w-1.5 h-1.5 rounded-full bg-amber-600"></div>Tertunda</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-slate-500">Tidak ada transaksi ditemukan untuk periode yang dipilih.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="flex justify-between items-center bg-white p-4 rounded-[1.5rem] shadow-sm border border-slate-100">
        {{ $orders->links() }}
    </div>

</div>
@endsection
