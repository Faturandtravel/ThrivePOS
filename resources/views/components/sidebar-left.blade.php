<aside class="w-[240px] h-full bg-[#0D0D0D] text-white flex flex-col justify-between flex-shrink-0">
    
    <div>
        <div class="px-8 pt-8 pb-8">
            <h1 class="text-3xl font-bold tracking-tighter italic">Thrive<span class="font-light">POS</span></h1>
        </div>

        <nav class="flex flex-col gap-1 px-4">
            <a href="{{ route('dashboard') }}" class="px-4 py-3 {{ request()->routeIs('dashboard') ? 'text-white bg-[#222222] shadow-sm font-semibold' : 'text-slate-400 hover:text-white hover:bg-[#1A1A1A] transition-colors font-medium' }} rounded-xl flex items-center">
                Dashboard
            </a>
            <a href="{{ route('cashier') }}" class="px-4 py-3 {{ request()->routeIs('cashier') ? 'text-white bg-[#222222] shadow-sm font-semibold' : 'text-slate-400 hover:text-white hover:bg-[#1A1A1A] transition-colors font-medium' }} rounded-xl flex items-center">
                Cashier
            </a>
            <a href="{{ route('product.index') }}" class="px-4 py-3 {{ request()->routeIs('product.*') ? 'text-white bg-[#222222] shadow-sm font-semibold' : 'text-slate-400 hover:text-white hover:bg-[#1A1A1A] transition-colors font-medium' }} rounded-xl flex items-center">
                Product
            </a>            
            
            <div class="my-4 border-t border-slate-800 mx-4"></div>
            
            <a href="{{ route('setting') }}" class="px-4 py-3 {{ request()->routeIs('setting') ? 'text-white bg-[#222222] shadow-sm font-semibold' : 'text-slate-400 hover:text-white hover:bg-[#1A1A1A] transition-colors font-medium' }} rounded-xl flex items-center">
                Settings
            </a>        
        </nav>
    </div>

   <div class="p-4 mt-auto">
    <div class="bg-[#161616] rounded-2xl p-5 flex flex-col gap-4 border border-white/5">
        
        <div class="flex flex-col gap-2">
            <span class="text-[9px] uppercase tracking-[0.2em] text-slate-500 font-bold">Powered by</span>
            <div class="flex items-center gap-3">
                <h2 class="text-xl font-bold tracking-tighter italic leading-none">Thrive</h2>
                <div class="w-[1px] h-4 bg-slate-700"></div>
                <span class="text-sm font-medium tracking-widest text-slate-300 leading-none">POS</span>
            </div>
        </div>

        <div class="flex flex-wrap gap-x-4 gap-y-1">
            <a href="#" class="text-[11px] font-semibold text-slate-400 hover:text-white transition-colors">Help Center</a>
            <a href="#" class="text-[11px] font-semibold text-slate-400 hover:text-white transition-colors">Support</a>
            <a href="#" class="text-[11px] font-semibold text-slate-400 hover:text-white transition-colors">Legal</a>
        </div>

        <div class="pt-2 border-t border-slate-800/50">
            <p class="text-[10px] text-slate-600 leading-relaxed">
                © 2026 Thrive POS System. <br>
                Efficient Point of Sale Solutions.
            </p>
        </div>
    </div>
</div>
</aside>