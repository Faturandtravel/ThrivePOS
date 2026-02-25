<header class="w-full flex justify-between items-center px-4 md:px-6 py-3 shrink-0 sticky top-0 bg-white border-b border-slate-200 z-50">
    <div class="flex items-center gap-2 md:gap-4">
        <button onclick="toggleSidebarLeft()" class="md:hidden p-2 -ml-2 text-slate-500 hover:text-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-200 rounded-xl transition flex items-center justify-center">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>
    </div>

    <div class="relative group">
        <button class="flex items-center gap-3 hover:bg-slate-50 p-1.5 pr-3 rounded-full transition-all focus:outline-none border border-transparent hover:border-slate-100">
            

            <div class="text-right hidden sm:block">
                <p class="text-sm font-bold text-slate-700 leading-none">{{ auth()->user()->name ?? 'Kasir' }}</p>
                <p class="text-[10px] font-medium text-slate-400 mt-1 uppercase tracking-wider">{{ auth()->user()->role === 'super_admin' ? 'Manager' : 'Kasir' }}</p>
            </div>

            <div class="relative">
                <img 
                    src="{{ auth()->user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name ?? 'User') . '&background=6366f1&color=fff' }}" 
                    alt="Profile" 
                    class="w-9 h-9 rounded-full object-cover border-2 border-white shadow-sm"
                >
                <span class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full bg-emerald-500 ring-2 ring-white"></span>
            </div>
            
            <svg class="w-4 h-4 text-slate-400 group-hover:text-slate-600 transition-colors ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>

        <div class="absolute right-0 mt-2 w-64 bg-white rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.15)] border border-slate-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform origin-top-right translate-y-2 group-hover:translate-y-0 overflow-hidden">
            <div class="p-4 bg-slate-50/50 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="overflow-hidden">
                        <p class="text-sm font-bold text-slate-800 truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-slate-500 truncate">{{ auth()->user()->email }}</p>
                    </div>
                </div>
            </div>

            <div class="p-2">
                <div class="px-3 py-2 flex items-center gap-2">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    <span class="text-[11px] font-bold text-emerald-600 uppercase tracking-tight">Sesi Aktif</span>
                </div>

                <div class="border-t border-slate-100 my-1"></div>

                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="w-full text-left px-3 py-3 text-sm font-bold text-red-500 hover:bg-red-50 hover:text-red-600 rounded-xl transition-colors flex items-center gap-3">
                        <div class="p-1.5 bg-red-100 rounded-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                        </div>
                        Keluar Aplikasi
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>