@extends('layouts.pos')

@section('sidebar-right')
@endsection

@section('content')
<div class="p-8 pb-20">
    
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Product Management</h1>
            <p class="text-slate-500 text-sm mt-1">Kelola daftar menu, harga, dan ketersediaan stok.</p>
        </div>
        
        <div class="flex items-center gap-4 w-full md:w-auto">
            <div class="relative w-full md:w-72">
                <input type="text" placeholder="Search product..." class="w-full pl-11 pr-4 py-3 bg-white border border-slate-100 rounded-2xl shadow-sm focus:ring-2 focus:ring-slate-900 outline-none text-sm font-medium transition">
                <svg class="w-5 h-5 text-slate-400 absolute left-4 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>

            <button class="px-5 py-3 bg-black text-white font-bold rounded-2xl text-sm shadow-md hover:bg-slate-800 hover:shadow-lg hover:-translate-y-0.5 transition-all flex items-center gap-2 whitespace-nowrap">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                New Product
            </button>
        </div>
    </div>

    <div class="flex gap-3 overflow-x-auto pb-4 mb-4 hide-scroll">
        <button class="px-5 py-2 bg-slate-900 text-white font-semibold rounded-full text-sm shadow-sm whitespace-nowrap">All Items</button>
        <button class="px-5 py-2 bg-white text-slate-600 font-semibold rounded-full text-sm hover:bg-slate-50 transition whitespace-nowrap border border-slate-200">Soups</button>
        <button class="px-5 py-2 bg-white text-slate-600 font-semibold rounded-full text-sm hover:bg-slate-50 transition whitespace-nowrap border border-slate-200">Salads</button>
        <button class="px-5 py-2 bg-white text-slate-600 font-semibold rounded-full text-sm hover:bg-slate-50 transition whitespace-nowrap border border-slate-200">Beverages</button>
    </div>

    <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600 whitespace-nowrap">
                
                <thead class="bg-slate-50/80 text-slate-500 font-bold border-b border-slate-100 uppercase tracking-wider text-[11px]">
                    <tr>
                        <th class="px-6 py-5 rounded-tl-[2rem]">Product Info</th>
                        <th class="px-6 py-5">Category</th>
                        <th class="px-6 py-5">Price</th>
                        <th class="px-6 py-5">Stock Level</th>
                        <th class="px-6 py-5 text-center rounded-tr-[2rem]">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-50">
                    
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-6 py-4 flex items-center gap-4">
                            <img src="https://images.unsplash.com/photo-1547592166-23ac45744acd?q=80&w=150&auto=format&fit=crop" class="w-12 h-12 rounded-2xl object-cover shadow-sm" alt="Soup">
                            <div>
                                <h4 class="font-extrabold text-slate-900 text-base">Ukrainian Borscht</h4>
                                <p class="text-slate-400 text-xs font-medium mt-0.5">SKU: SOUP-001</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-orange-50 text-orange-600 font-bold rounded-lg text-xs">Soups</span>
                        </td>
                        <td class="px-6 py-4 font-extrabold text-slate-900 text-base">
                            $5.00
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                                <span class="font-semibold text-slate-700">45 Unit</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button class="p-2 text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-xl transition tooltip" title="Edit Product">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </button>
                                <button class="p-2 text-red-600 bg-red-50 hover:bg-red-100 rounded-xl transition tooltip" title="Delete Product">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-6 py-4 flex items-center gap-4">
                            <img src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd?q=80&w=150&auto=format&fit=crop" class="w-12 h-12 rounded-2xl object-cover shadow-sm" alt="Salad">
                            <div>
                                <h4 class="font-extrabold text-slate-900 text-base">Roman Caesar</h4>
                                <p class="text-slate-400 text-xs font-medium mt-0.5">SKU: SLD-022</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-green-50 text-green-600 font-bold rounded-lg text-xs">Salads</span>
                        </td>
                        <td class="px-6 py-4 font-extrabold text-slate-900 text-base">
                            $6.50
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-amber-500"></div>
                                <span class="font-semibold text-slate-700">12 Unit</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button class="p-2 text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-xl transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </button>
                                <button class="p-2 text-red-600 bg-red-50 hover:bg-red-100 rounded-xl transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-6 py-4 flex items-center gap-4">
                            <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=150&auto=format&fit=crop" class="w-12 h-12 rounded-2xl object-cover shadow-sm grayscale opacity-70" alt="Poke">
                            <div>
                                <h4 class="font-extrabold text-slate-500 text-base line-through">Poke with Salmon</h4>
                                <p class="text-slate-400 text-xs font-medium mt-0.5">SKU: SLD-025</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-green-50 text-green-600 font-bold rounded-lg text-xs opacity-70">Salads</span>
                        </td>
                        <td class="px-6 py-4 font-extrabold text-slate-500 text-base opacity-70">
                            $8.00
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-red-500"></div>
                                <span class="font-bold text-red-500">Out of Stock</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button class="p-2 text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-xl transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </button>
                                <button class="p-2 text-red-600 bg-red-50 hover:bg-red-100 rounded-xl transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        
        <div class="p-4 border-t border-slate-100 flex items-center justify-between text-sm text-slate-500 bg-slate-50/50">
            <span>Showing 1 to 3 of 24 products</span>
            <div class="flex gap-1">
                <button class="px-3 py-1.5 border border-slate-200 rounded-lg hover:bg-white transition disabled:opacity-50">Prev</button>
                <button class="px-3 py-1.5 bg-slate-900 text-white rounded-lg font-medium shadow-sm">1</button>
                <button class="px-3 py-1.5 border border-slate-200 rounded-lg hover:bg-white transition">2</button>
                <button class="px-3 py-1.5 border border-slate-200 rounded-lg hover:bg-white transition">Next</button>
            </div>
        </div>
    </div>

</div>
@endsection