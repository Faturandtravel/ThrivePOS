@extends('layouts.pos')

@section('sidebar-right')
    @include('components.sidebar-right')
@endsection

@section('content')
<div class="p-8">
    
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold text-slate-900">Food & Drinks</h1>
        
        <div class="relative w-72">
            <input type="text" placeholder="Search item..." class="w-full pl-12 pr-4 py-3 bg-white border-none rounded-2xl shadow-sm focus:ring-2 focus:ring-slate-900 outline-none text-sm font-medium">
            <svg class="w-5 h-5 text-slate-400 absolute left-4 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </div>
    </div>

    <div class="mb-8">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold text-slate-800">Categories</h2>
        </div>
        
        <div class="flex gap-3 overflow-x-auto pb-2 hide-scroll">
            <button class="px-6 py-2.5 bg-black text-white font-semibold rounded-full text-sm shadow-md whitespace-nowrap">All</button>
            <button class="px-6 py-2.5 bg-white text-slate-600 font-semibold rounded-full text-sm hover:bg-slate-100 transition whitespace-nowrap border border-slate-100 flex items-center gap-2">🍜 Soups</button>
            <button class="px-6 py-2.5 bg-white text-slate-600 font-semibold rounded-full text-sm hover:bg-slate-100 transition whitespace-nowrap border border-slate-100 flex items-center gap-2">🥗 Salads</button>
            <button class="px-6 py-2.5 bg-white text-slate-600 font-semibold rounded-full text-sm hover:bg-slate-100 transition whitespace-nowrap border border-slate-100 flex items-center gap-2">🍝 Pasta</button>
            <button class="px-6 py-2.5 bg-white text-slate-600 font-semibold rounded-full text-sm hover:bg-slate-100 transition whitespace-nowrap border border-slate-100 flex items-center gap-2">🥐 Bakery</button>
        </div>
        <div class="border-b-2 border-slate-200 mt-2 rounded-full"></div>
    </div>

    <div class="mb-8">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-slate-800">Soups</h3>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-5">
            <div class="bg-white p-3 rounded-[2rem] shadow-sm hover:shadow-md transition-shadow flex items-center gap-4 cursor-pointer">
                <img src="https://images.unsplash.com/photo-1547592166-23ac45744acd?q=80&w=200&auto=format&fit=crop" class="w-24 h-24 rounded-full object-cover shadow-inner" alt="Soup">
                <div class="flex-1">
                    <h4 class="font-bold text-slate-900 text-sm mb-1 leading-tight">Ukrainian borscht</h4>
                    <p class="text-slate-500 font-semibold text-sm mb-3">$5.00</p>
                    <div class="flex items-center gap-3 bg-slate-50 w-max rounded-full px-1.5 py-1 border border-slate-100">
                        <button class="w-6 h-6 flex items-center justify-center bg-white rounded-full text-slate-600 hover:text-black shadow-sm">−</button>
                        <span class="text-sm font-bold w-4 text-center">1</span>
                        <button class="w-6 h-6 flex items-center justify-center bg-white rounded-full text-slate-600 hover:text-black shadow-sm">+</button>
                    </div>
                </div>
            </div>

            <div class="bg-white p-3 rounded-[2rem] shadow-sm hover:shadow-md transition-shadow flex items-center gap-4 cursor-pointer">
                <img src="https://images.unsplash.com/photo-1574484284002-952d92456975?q=80&w=200&auto=format&fit=crop" class="w-24 h-24 rounded-full object-cover shadow-inner" alt="Fish Soup">
                <div class="flex-1">
                    <h4 class="font-bold text-slate-900 text-sm mb-1 leading-tight">Finnish fish soup</h4>
                    <p class="text-slate-500 font-semibold text-sm mb-3">$5.00</p>
                    <div class="flex items-center gap-3 bg-slate-50 w-max rounded-full px-1.5 py-1 border border-slate-100">
                        <button class="w-6 h-6 flex items-center justify-center bg-white rounded-full text-slate-600 hover:text-black shadow-sm">−</button>
                        <span class="text-sm font-bold w-4 text-center">0</span>
                        <button class="w-6 h-6 flex items-center justify-center bg-white rounded-full text-slate-600 hover:text-black shadow-sm">+</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-b-2 border-slate-200 mt-6 rounded-full w-2/3"></div>
    </div>

    <div>
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-slate-800">Salads</h3>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-5">
            <div class="bg-white p-3 rounded-[2rem] shadow-sm hover:shadow-md transition-shadow flex items-center gap-4 cursor-pointer">
                <img src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd?q=80&w=200&auto=format&fit=crop" class="w-24 h-24 rounded-full object-cover shadow-inner" alt="Salad">
                <div class="flex-1">
                    <h4 class="font-bold text-slate-900 text-sm mb-1 leading-tight">Roman caesar</h4>
                    <p class="text-slate-500 font-semibold text-sm mb-3">$5.00</p>
                    <div class="flex items-center gap-3 bg-slate-50 w-max rounded-full px-1.5 py-1 border border-slate-100">
                        <button class="w-6 h-6 flex items-center justify-center bg-white rounded-full text-slate-600 hover:text-black shadow-sm">−</button>
                        <span class="text-sm font-bold w-4 text-center">0</span>
                        <button class="w-6 h-6 flex items-center justify-center bg-white rounded-full text-slate-600 hover:text-black shadow-sm">+</button>
                    </div>
                </div>
            </div>
            
            <div class="bg-white p-3 rounded-[2rem] shadow-sm hover:shadow-md transition-shadow flex items-center gap-4 cursor-pointer">
                <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=200&auto=format&fit=crop" class="w-24 h-24 rounded-full object-cover shadow-inner" alt="Poke">
                <div class="flex-1">
                    <h4 class="font-bold text-slate-900 text-sm mb-1 leading-tight">Poke with salmon</h4>
                    <p class="text-slate-500 font-semibold text-sm mb-3">$5.00</p>
                    <div class="flex items-center gap-3 bg-slate-50 w-max rounded-full px-1.5 py-1 border border-slate-100">
                        <button class="w-6 h-6 flex items-center justify-center bg-white rounded-full text-slate-600 hover:text-black shadow-sm">−</button>
                        <span class="text-sm font-bold w-4 text-center">1</span>
                        <button class="w-6 h-6 flex items-center justify-center bg-white rounded-full text-slate-600 hover:text-black shadow-sm">+</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection