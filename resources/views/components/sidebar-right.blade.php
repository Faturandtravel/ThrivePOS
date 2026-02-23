<aside class="w-[340px] h-full bg-[#1A1A1A] text-white flex flex-col flex-shrink-0 border-l border-[#2A2A2A]">
    
    <div class="p-6 flex justify-between items-center border-b border-[#2A2A2A]">
        <h2 class="text-lg font-semibold">Current Order</h2>
        <button class="p-2 bg-[#2A2A2A] rounded-full hover:bg-slate-700 transition">
            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
        </button>
    </div>

    <div class="px-6 py-4 flex justify-between items-center text-sm">
        <div class="flex gap-3 items-baseline">
            <span class="font-bold text-white text-base">Table 5</span>
            <span class="text-slate-400">James K.</span>
        </div>
        <span class="text-slate-500 text-xs">23.02.2026</span>
    </div>

    <div class="flex-1 overflow-y-auto px-6 py-2 space-y-4">
        
        <div class="bg-[#262626] rounded-2xl p-4 flex flex-col gap-3">
            <div class="flex justify-between items-start">
                <span class="font-medium text-sm w-3/4">Ukrainian borscht</span>
                <span class="font-semibold text-sm">$5.00</span>
            </div>
            <div class="flex items-center gap-4 bg-[#1A1A1A] w-max rounded-xl px-2 py-1.5">
                <button class="w-6 h-6 flex items-center justify-center text-slate-400 hover:text-white transition">−</button>
                <span class="text-sm font-semibold w-4 text-center">1</span>
                <button class="w-6 h-6 flex items-center justify-center text-slate-400 hover:text-white transition">+</button>
            </div>
        </div>

        <div class="bg-[#262626] rounded-2xl p-4 flex flex-col gap-3">
            <div class="flex justify-between items-start">
                <span class="font-medium text-sm w-3/4">Poke with salmon</span>
                <span class="font-semibold text-sm">$5.00</span>
            </div>
            <div class="flex items-center gap-4 bg-[#1A1A1A] w-max rounded-xl px-2 py-1.5">
                <button class="w-6 h-6 flex items-center justify-center text-slate-400 hover:text-white transition">−</button>
                <span class="text-sm font-semibold w-4 text-center">1</span>
                <button class="w-6 h-6 flex items-center justify-center text-slate-400 hover:text-white transition">+</button>
            </div>
        </div>

    </div>

    <div class="p-6 bg-[#1A1A1A] border-t border-[#2A2A2A]">
        <div class="space-y-3 mb-6 text-sm">
            <div class="flex justify-between text-slate-400">
                <span>Subtotal</span>
                <span class="text-white font-medium">$10.00</span>
            </div>
            <div class="flex justify-between text-slate-400">
                <span>Tax</span>
                <span class="text-white font-medium">$1.00</span>
            </div>
            <div class="flex justify-between text-white font-bold text-lg pt-2 border-t border-[#2A2A2A]">
                <span>Total</span>
                <span>$11.00</span>
            </div>
        </div>

        <div class="flex gap-2 mb-4">
            <button class="flex-1 bg-white text-black py-2 rounded-xl text-xs font-bold hover:bg-slate-200 transition">Cash</button>
            <button class="flex-1 bg-[#262626] text-white py-2 rounded-xl text-xs font-medium hover:bg-[#333] transition border border-[#333]">Xendit</button>
        </div>

        <button class="w-full bg-white text-black font-extrabold py-4 rounded-xl hover:bg-slate-200 transition shadow-lg flex justify-center items-center gap-2">
            Place order
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
        </button>
    </div>
</aside>