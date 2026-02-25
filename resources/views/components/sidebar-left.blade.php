<aside id="sidebar-left" class="fixed inset-y-0 left-0 z-[100] w-[240px] transform -translate-x-full md:relative md:translate-x-0 transition-transform duration-300 h-full bg-[#0D0D0D] text-white flex flex-col justify-between flex-shrink-0">
    
    <div>
        <div class="px-6 md:px-8 pt-6 md:pt-8 pb-8 flex justify-between items-center">
            <h1 class="text-3xl font-bold tracking-tighter italic">Thrive<span class="font-light">POS</span></h1>
            <button onclick="toggleSidebarLeft()" class="md:hidden text-slate-400 hover:text-white transition p-1 rounded-md hover:bg-slate-800">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <nav class="flex flex-col gap-1 px-4">
            @if(auth()->check() && auth()->user()->role === 'super_admin')
            <a href="{{ route('dashboard') }}" class="px-4 py-3 {{ request()->routeIs('dashboard') ? 'text-white bg-[#222222] shadow-sm font-semibold' : 'text-slate-400 hover:text-white hover:bg-[#1A1A1A] transition-colors font-medium' }} rounded-xl flex items-center">
                Dashboard
            </a>
            @endif
            <a href="{{ route('cashier') }}" class="px-4 py-3 {{ request()->routeIs('cashier') ? 'text-white bg-[#222222] shadow-sm font-semibold' : 'text-slate-400 hover:text-white hover:bg-[#1A1A1A] transition-colors font-medium' }} rounded-xl flex items-center">
                Kasir
            </a>
            <a href="{{ route('product.index') }}" class="px-4 py-3 {{ request()->routeIs('product.*') ? 'text-white bg-[#222222] shadow-sm font-semibold' : 'text-slate-400 hover:text-white hover:bg-[#1A1A1A] transition-colors font-medium' }} rounded-xl flex items-center">
                Produk
            </a>            
            
            @if(auth()->check() && auth()->user()->role === 'super_admin')
            <div class="my-4 border-t border-slate-800 mx-4"></div>
            
            <a href="{{ route('setting') }}" class="px-4 py-3 {{ request()->routeIs('setting') ? 'text-white bg-[#222222] shadow-sm font-semibold' : 'text-slate-400 hover:text-white hover:bg-[#1A1A1A] transition-colors font-medium' }} rounded-xl flex items-center">
                Pengaturan
            </a>
            @endif
        </nav>
    </div>

   <div class="p-4 mt-auto">
        <div class="bg-[#161616] rounded-2xl p-5 flex flex-col gap-4 border border-white/5">
            
            <div class="flex flex-col gap-2">
                <span class="text-[9px] uppercase tracking-[0.2em] text-slate-500 font-bold">Powered by</span>
                <div class="flex items-center gap-3">
                    <img src="{{ asset('assets/images/digimax 1.png') }}" alt="Digimax Logo" class="h-6">
                    <div class="w-[1px] h-4 bg-slate-700"></div>
                    <h2 class="text-lg font-bold tracking-tighter italic text-white">Thrive<span class="font-light">POS</span></h2>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-800/50">
                <p class="text-[10px] text-slate-600 leading-relaxed">
                    © 2026 Thrive POS System. <br>
                    Efficient Point of Sale Solutions.
                </p>
            </div>
        </div>
    </div>
</aside>