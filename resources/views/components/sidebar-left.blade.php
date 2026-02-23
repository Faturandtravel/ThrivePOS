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
            <a href="{{ route('product') }}" class="px-4 py-3 {{ request()->routeIs('product') ? 'text-white bg-[#222222] shadow-sm font-semibold' : 'text-slate-400 hover:text-white hover:bg-[#1A1A1A] transition-colors font-medium' }} rounded-xl flex items-center">
                Product
            </a>            
            
            <div class="my-4 border-t border-slate-800 mx-4"></div>
            
            <a href="{{ route('setting') }}" class="px-4 py-3 {{ request()->routeIs('setting') ? 'text-white bg-[#222222] shadow-sm font-semibold' : 'text-slate-400 hover:text-white hover:bg-[#1A1A1A] transition-colors font-medium' }} rounded-xl flex items-center">
                Settings
            </a>        
        </nav>
    </div>

    <div class="p-5 flex flex-col gap-4">
        
        <div class="flex items-center justify-between bg-[#1A1A1A] border border-[#2A2A2A] p-2.5 rounded-xl shadow-sm hover:border-[#3A3A3A] transition-colors">
            
            <div class="flex items-center gap-3 overflow-hidden pl-1">
                <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center text-xs font-bold text-white shrink-0">
                    {{ strtoupper(substr(auth()->user()->name ?? 'K', 0, 1)) }}
                </div>
                <div class="flex flex-col truncate pr-2">
                    <span class="text-sm font-bold text-white truncate leading-tight">{{ auth()->user()->name ?? 'Kasir' }}</span>
                    <span class="text-[10px] text-emerald-500 font-medium flex items-center gap-1.5 mt-0.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        Online
                    </span>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="m-0 p-0 shrink-0">
                @csrf
                <button type="submit" class="p-2 text-slate-400 hover:text-white hover:bg-red-500 rounded-lg transition-all group" title="Logout">
                    <svg class="w-5 h-5 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                </button>
            </form>
        </div>

        <div class="px-1 text-center">
            <p class="text-[10px] text-slate-600 leading-relaxed font-medium">
                ThrivePOS is a registered <br>trademark of Thrive Inc. © 2026
            </p>
        </div>
    </div>
</aside>