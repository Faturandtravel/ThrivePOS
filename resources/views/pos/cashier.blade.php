@extends('layouts.app')

@section('sidebar-right')
    @include('components.sidebar-right')
@endsection

@section('content')
<div class="p-8">
    
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold text-slate-900">Food & Drinks</h1>
        
        <form action="{{ route('cashier') }}" method="GET" class="relative w-72">
            @if(request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search item..." class="w-full pl-12 pr-4 py-3 bg-white border border-slate-100 rounded-2xl shadow-sm focus:ring-2 focus:ring-slate-900 outline-none text-sm font-medium transition">
            <button type="submit" class="absolute left-4 top-3.5 text-slate-400 hover:text-slate-900 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </button>
        </form>
    </div>

    <div class="mb-8">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold text-slate-800">Categories</h2>
        </div>
        
        <div class="flex gap-3 overflow-x-auto pb-2 hide-scroll">
            <a href="{{ route('cashier', request()->except('category')) }}" class="px-6 py-2.5 {{ !request('category') ? 'bg-black text-white' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-100' }} font-semibold rounded-full text-sm shadow-sm transition whitespace-nowrap">All</a>
            @foreach($categories as $category)
            <a href="{{ route('cashier', array_merge(request()->query(), ['category' => $category->id])) }}" class="px-6 py-2.5 {{ request('category') == $category->id ? 'bg-black text-white' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-100' }} font-semibold rounded-full text-sm shadow-sm transition whitespace-nowrap flex items-center gap-2">{{ $category->name }}</a>
            @endforeach
        </div>
        <div class="border-b-2 border-slate-200 mt-2 rounded-full"></div>
    </div>

    @php
        $groupedProducts = $products->groupBy(function($product) {
            return $product->category ? $product->category->name : 'Uncategorized';
        });
    @endphp

    @forelse($groupedProducts as $categoryName => $categoryProducts)
    <div class="mb-8">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-slate-800">{{ $categoryName }}</h3>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-5">
            @foreach($categoryProducts as $product)
            <div onclick="if({{ $product->stock }} > 0) updateCart({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }}, 1)" class="bg-white p-3 rounded-[2rem] shadow-sm hover:shadow-md transition-shadow flex items-center gap-4 cursor-pointer {{ $product->stock <= 0 ? 'opacity-70 pointer-events-none' : '' }}">
                <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/200x200?text=' . urlencode($product->name) }}" class="w-24 h-24 rounded-full object-cover shadow-inner {{ $product->stock <= 0 ? 'grayscale opacity-70' : '' }}" alt="{{ $product->name }}">
                <div class="flex-1">
                    <h4 class="font-bold text-slate-900 text-sm mb-1 leading-tight {{ $product->stock <= 0 ? 'line-through text-slate-500' : '' }}">{{ $product->name }}</h4>
                    <p class="text-slate-500 font-semibold text-sm mb-3">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <div class="flex items-center gap-3 bg-slate-50 w-max rounded-full px-1.5 py-1 border border-slate-100 {{ $product->stock <= 0 ? 'opacity-50 pointer-events-none' : '' }}">
                        <button type="button" onclick="event.stopPropagation(); updateCart({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }}, -1)" class="w-6 h-6 flex items-center justify-center bg-white rounded-full text-slate-600 hover:text-black shadow-sm">−</button>
                        <span id="product-qty-{{ $product->id }}" class="text-sm font-bold w-4 text-center">0</span>
                        <button type="button" onclick="event.stopPropagation(); updateCart({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }}, 1)" class="w-6 h-6 flex items-center justify-center bg-white rounded-full text-slate-600 hover:text-black shadow-sm">+</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @if(!$loop->last)
        <div class="border-b-2 border-slate-200 mt-6 rounded-full w-2/3"></div>
        @endif
    </div>
    @empty
    <div class="text-center py-10">
        <div class="mb-4">
            <svg class="w-16 h-16 text-slate-300 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
        </div>
        <h3 class="text-lg font-bold text-slate-700">No products found</h3>
        <p class="text-slate-500 text-sm mt-1">Try adjusting your search or filter</p>
    </div>
    @endforelse

    <!-- Receipt Modal -->
    <div id="receipt-modal" class="fixed inset-0 bg-black/60 z-50 hidden items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-sm overflow-hidden flex flex-col max-h-[90vh] scale-95 opacity-0 transition-all duration-300 transform" id="receipt-modal-content">
            <div class="p-4 border-b border-slate-100 flex justify-between items-center bg-white">
                <h3 class="font-bold text-slate-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Payment Successful
                </h3>
                <button onclick="closeReceiptModal()" class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-50 text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <div class="flex-1 overflow-auto bg-slate-100/50 p-4 flex justify-center">
                <!-- Iframe for the receipt -->
                <iframe id="receipt-iframe" class="w-[80mm] h-[400px] bg-white border border-slate-200 shadow-sm rounded"></iframe>
            </div>
            <div class="p-4 border-t border-slate-100 bg-white flex gap-3">
                <button onclick="printIframe()" class="flex-1 bg-black text-white py-3 rounded-xl font-bold hover:bg-slate-800 transition shadow-md shadow-slate-200 flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    Print
                </button>
                <button onclick="closeReceiptModal()" class="flex-1 bg-white border-2 border-slate-100 text-slate-700 py-3 rounded-xl font-bold hover:bg-slate-50 hover:border-slate-200 transition">New Order</button>
            </div>
        </div>
    </div>

</div>
@endsection

<script>
    let cart = {};

    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number);
    }

    function formatCashInput(input) {
        let value = input.value.replace(/[^0-9]/g, '');
        if (value) {
            input.value = new Intl.NumberFormat('id-ID').format(value);
        } else {
            input.value = '';
        }
    }

    function updateCart(id, name, price, change) {
        if (!cart[id]) {
            cart[id] = { name: name, price: price, quantity: 0 };
        }
        
        cart[id].quantity += change;
        
        if (cart[id].quantity <= 0) {
            delete cart[id];
        }
        
        renderCart();
    }

    function renderCart() {
        const container = document.getElementById('cart-items-container');
        if(!container) return; // safety
        
        container.innerHTML = '';
        
        let subtotal = 0;
        
        Object.keys(cart).forEach(id => {
            const item = cart[id];
            subtotal += item.price * item.quantity;
            
            const html = `
            <div class="bg-[#262626] rounded-2xl p-4 flex flex-col gap-3">
                <div class="flex justify-between items-start">
                    <span class="font-medium text-sm w-3/4 text-white">${item.name}</span>
                    <span class="font-semibold text-sm text-white">${formatRupiah(item.price * item.quantity)}</span>
                </div>
                <div class="flex items-center gap-4 bg-[#1A1A1A] w-max rounded-xl px-2 py-1.5">
                    <button type="button" onclick="updateCart(${id}, '${item.name.replace(/'/g, "\\'")}', ${item.price}, -1)" class="w-6 h-6 flex items-center justify-center text-slate-400 hover:text-white transition">−</button>
                    <span class="text-sm font-semibold w-4 text-center text-white">${item.quantity}</span>
                    <button type="button" onclick="updateCart(${id}, '${item.name.replace(/'/g, "\\'")}', ${item.price}, 1)" class="w-6 h-6 flex items-center justify-center text-slate-400 hover:text-white transition">+</button>
                </div>
            </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
        });
        
        document.querySelectorAll('[id^=product-qty-]').forEach(badge => {
            const id = badge.id.split('-')[2];
            if(cart[id]) {
                badge.innerText = cart[id].quantity;
            } else {
                badge.innerText = '0';
            }
        });

        const total = subtotal;

        document.getElementById('cart-subtotal').innerText = formatRupiah(subtotal);
        document.getElementById('cart-total').innerText = formatRupiah(total);
        
        if (typeof calculateChange === 'function') {
            calculateChange();
        }
        
        if (Object.keys(cart).length === 0) {
            container.innerHTML = '<div class="text-slate-500 text-sm text-center py-24 flex flex-col items-center gap-2"><svg class="w-10 h-10 mx-auto text-slate-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>Cart is empty</div>';
        }
    }

    let selectedPayment = null;

    function selectPayment(method) {
        selectedPayment = method;
        const section = document.getElementById('cash-payment-section');
        const btnCash = document.getElementById('btn-cash');
        const btnXendit = document.getElementById('btn-xendit');
        
        if (!section || !btnCash || !btnXendit) return;

        if (method === 'cash') {
            btnCash.classList.remove('bg-[#262626]', 'text-white');
            btnCash.classList.add('bg-white', 'text-black');
            
            btnXendit.classList.remove('bg-white', 'text-black');
            btnXendit.classList.add('bg-[#262626]', 'text-white');
            
            section.classList.remove('hidden');
            document.getElementById('cash-input').focus();
            calculateChange();
        } else if (method === 'xendit') {
            btnXendit.classList.remove('bg-[#262626]', 'text-white');
            btnXendit.classList.add('bg-white', 'text-black');
            
            btnCash.classList.remove('bg-white', 'text-black');
            btnCash.classList.add('bg-[#262626]', 'text-white');
            
            section.classList.add('hidden');
            document.getElementById('cash-input').value = '';
            document.getElementById('change-amount').innerText = 'Rp 0';
            document.getElementById('change-amount').classList.remove('text-red-400', 'text-green-400');
            document.getElementById('change-amount').classList.add('text-white');
        }
    }

    function calculateChange() {
        const section = document.getElementById('cash-payment-section');
        if (!section || section.classList.contains('hidden')) return;

        let subtotal = 0;
        Object.keys(cart).forEach(id => {
            subtotal += cart[id].price * cart[id].quantity;
        });

        const total = subtotal;
        const cashInput = document.getElementById('cash-input').value;
        const cashAmount = parseFloat(cashInput.replace(/\./g, '')) || 0;
        
        const change = cashAmount - total;
        const changeElement = document.getElementById('change-amount');
        
        if (cashInput === '') {
            changeElement.innerText = 'Rp 0';
            changeElement.classList.remove('text-red-400', 'text-green-400');
            changeElement.classList.add('text-white');
            return;
        }

        if (change >= 0) {
            changeElement.innerText = formatRupiah(change);
            changeElement.classList.remove('text-red-400', 'text-white');
            changeElement.classList.add('text-green-400');
        } else {
            changeElement.innerText = 'Kurang ' + formatRupiah(Math.abs(change));
            changeElement.classList.remove('text-white', 'text-green-400');
            changeElement.classList.add('text-red-400');
        }
    }

    async function placeOrder() {
        if (Object.keys(cart).length === 0) {
            alert('Cart is empty.');
            return;
        }

        if (selectedPayment === null) {
            alert('Please select a payment method.');
            return;
        }

        let total = 0;
        let items = [];
        Object.keys(cart).forEach(id => {
            const item = cart[id];
            total += item.price * item.quantity;
            items.push({
                product_id: id,
                quantity: item.quantity,
                price: item.price
            });
        });

        let cashAmount = null;
        let changeAmount = null;

        if (selectedPayment === 'cash') {
            const cashInput = document.getElementById('cash-input').value;
            cashAmount = parseFloat(cashInput.replace(/\./g, '')) || 0;
            
            if (cashAmount < total) {
                alert('Insufficient cash amount.');
                return;
            }
            changeAmount = cashAmount - total;
        }

        const payload = {
            total: total,
            payment_method: selectedPayment,
            cash_amount: cashAmount,
            change_amount: changeAmount,
            items: items
        };

        const csrfToken = document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') : '{{ csrf_token() }}';

        try {
            const response = await fetch('{{ route("order.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            });

            const data = await response.json();

            if (data.success) {
                if (data.invoice_url) {
                    // Open Xendit payment in a popup
                    const paymentWindow = window.open(data.invoice_url, '_blank', 'width=600,height=800');
                    
                    // Show waiting state on button
                    const placeOrderBtn = document.querySelector('button[onclick="placeOrder()"]');
                    const originalBtnText = placeOrderBtn ? placeOrderBtn.innerHTML : '';
                    if (placeOrderBtn) {
                        placeOrderBtn.innerHTML = '<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Waiting for Payment...';
                        placeOrderBtn.disabled = true;
                        placeOrderBtn.classList.add('opacity-70', 'cursor-not-allowed');
                    }
                    
                    // Poll for status
                    const pollInterval = setInterval(async () => {
                        try {
                            const statusResponse = await fetch(`/order/${data.order_id}/status`);
                            const statusData = await statusResponse.json();

                            if (statusData.status === 'paid') {
                                clearInterval(pollInterval);
                                if (paymentWindow && !paymentWindow.closed) {
                                    paymentWindow.close();
                                }
                                
                                // Reset button
                                if (placeOrderBtn) {
                                    placeOrderBtn.innerHTML = originalBtnText;
                                    placeOrderBtn.disabled = false;
                                    placeOrderBtn.classList.remove('opacity-70', 'cursor-not-allowed');
                                }

                                // Show Modal instead of redirect
                                showReceiptModal(data.order_id);
                            } else if (statusData.status === 'expired') {
                                clearInterval(pollInterval);
                                if (placeOrderBtn) {
                                    placeOrderBtn.innerHTML = originalBtnText;
                                    placeOrderBtn.disabled = false;
                                    placeOrderBtn.classList.remove('opacity-70', 'cursor-not-allowed');
                                }
                                alert('Payment link expired. Please try again.');
                            }
                        } catch (e) {
                            console.error('Error polling status:', e);
                        }
                    }, 3000); // Poll every 3 seconds

                } else {
                    // Show Modal instead of redirect
                    showReceiptModal(data.order_id);
                }
            } else {
                alert('Failed to place order: ' + (data.message || 'Unknown error'));
            }
        } catch (error) {
            console.error('Error placing order:', error);
            alert('Error placing order.');
        }
    }

    function showReceiptModal(orderId) {
        const modal = document.getElementById('receipt-modal');
        const content = document.getElementById('receipt-modal-content');
        const iframe = document.getElementById('receipt-iframe');
        
        iframe.src = `/order/${orderId}/print`;
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        // Trigger reflow for animation
        void modal.offsetWidth;
        content.classList.remove('scale-95', 'opacity-0');
        content.classList.add('scale-100', 'opacity-100');
        
        // Reset Cart
        cart = {};
        renderCart();
        if (selectedPayment === 'cash') {
            document.getElementById('cash-input').value = '';
            document.getElementById('change-amount').innerText = 'Rp 0';
        }
    }

    function closeReceiptModal() {
        const modal = document.getElementById('receipt-modal');
        const content = document.getElementById('receipt-modal-content');
        
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.getElementById('receipt-iframe').src = '';
        }, 300);
    }

    function printIframe() {
        const iframe = document.getElementById('receipt-iframe');
        if (iframe.contentWindow) {
            iframe.contentWindow.print();
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        renderCart();
    });
</script>