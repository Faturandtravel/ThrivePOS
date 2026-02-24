<aside class="w-[340px] h-full bg-[#1A1A1A] text-white flex flex-col flex-shrink-0 border-l border-[#2A2A2A]">
    
    <div class="p-6 flex justify-between items-center border-b border-[#2A2A2A]">
        <h2 class="text-lg font-semibold">Current Order</h2>
    </div>

    

    <div id="cart-items-container" class="flex-1 overflow-y-auto px-6 py-2 space-y-4">
    </div>

    <div class="p-6 bg-[#1A1A1A] border-t border-[#2A2A2A]">
        <div class="space-y-3 mb-6 text-sm">
            <div class="flex justify-between text-slate-400">
                <span>Subtotal</span>
                <span id="cart-subtotal" class="text-white font-medium">Rp 0</span>
            </div>
            <div class="flex justify-between text-white font-bold text-lg pt-2 border-t border-[#2A2A2A]">
                <span>Total</span>
                <span id="cart-total">Rp 0</span>
            </div>
        </div>

        <div class="flex gap-2 mb-4">
            <button type="button" id="btn-cash" onclick="selectPayment('cash')" class="flex-1 bg-[#262626] text-white py-2 rounded-xl text-xs font-medium hover:bg-white hover:text-black transition border border-[#333]">Cash</button>
            <button type="button" id="btn-xendit" onclick="selectPayment('xendit')" class="flex-1 bg-[#262626] text-white py-2 rounded-xl text-xs font-medium hover:bg-white hover:text-black transition border border-[#333]">Xendit</button>
        </div>

        <div id="cash-payment-section" class="hidden mb-4">
            <div class="flex flex-col gap-3">
                <div>
                    <label class="text-xs text-slate-400 mb-1 block">Cash Amount</label>
                    <div class="relative">
                        <span class="absolute left-3 top-2 text-slate-400 text-sm">Rp</span>
                        <input type="text" inputmode="numeric" id="cash-input" oninput="formatCashInput(this); calculateChange()" class="w-full bg-[#262626] border border-[#333] text-white text-sm rounded-xl pl-9 pr-3 py-2 outline-none focus:border-slate-500 transition" placeholder="0">
                    </div>
                </div>
                <div class="flex justify-between items-center text-sm border-t border-[#333] pt-2 mt-1">
                    <span class="text-slate-400">Change</span>
                    <span id="change-amount" class="text-white font-bold">Rp 0</span>
                </div>
            </div>
        </div>

        <button type="button" onclick="placeOrder()" class="w-full bg-[#262626] text-white font-bold py-4 rounded-2xl hover:bg-slate-200 hover:text-black transition shadow-lg flex justify-center items-center gap-2 border border-[#333]">
            Place order
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
        </button>
    </div>
</aside>