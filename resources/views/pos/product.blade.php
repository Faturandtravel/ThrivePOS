@extends('layouts.app')

@section('sidebar-right')
@endsection

@section('content')
<div class="fixed top-20 right-6 z-[9999] flex flex-col gap-3 w-full max-w-sm pointer-events-none">
    @if(session('success'))
    <div id="toast-success" class="pointer-events-auto flex items-center p-4 bg-white rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.1)] animate-toast-in overflow-hidden relative">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-10 h-10 text-emerald-500 bg-emerald-50 rounded-xl">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
        </div>
        <div class="ml-3 text-sm font-bold text-slate-800">{{ session('success') }}</div>
        <button onclick="closeToast('toast-success')" class="ml-auto text-slate-400 hover:text-slate-900 transition p-1">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <div class="toast-progress" style="animation-duration: 5000ms;"></div>
    </div>
    @endif

    @if($errors->any())
    <div id="toast-error" class="pointer-events-auto flex items-start p-4 bg-white rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.1)] border-l-4 border-red-500 animate-toast-in overflow-hidden relative">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-10 h-10 text-red-500 bg-red-50 rounded-xl">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <div class="ml-3 pr-4">
            <p class="text-sm font-bold text-slate-800">Ups! Ada Masalah</p>
            <ul class="text-[11px] text-slate-500 mt-1 list-disc list-inside leading-relaxed">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <button onclick="closeToast('toast-error')" class="ml-auto text-slate-400 hover:text-slate-900 transition p-1">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <div class="toast-progress" style="animation-duration: 8000ms;"></div>
    </div>
    @endif
</div>

<div class="p-4 md:p-8 pb-20">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 md:mb-8 gap-4 w-full">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Manajemen Produk</h1>
            <p class="text-slate-500 text-sm mt-1">Kelola daftar menu, harga, dan ketersediaan stok.</p>
        </div>
        
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full md:w-auto">
            <form method="GET" action="{{ route('product.index') }}" class="relative w-full md:w-72">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..." class="w-full pl-11 pr-4 py-3 bg-white border border-slate-100 rounded-2xl shadow-sm focus:ring-2 focus:ring-slate-900 outline-none text-sm font-medium transition">
                <button type="submit" class="absolute left-4 top-3.5 text-slate-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
            </form>

            <div class="flex gap-3">
                <button onclick="openCategoryModal()" class="flex-1 px-4 py-3 bg-white border border-slate-200 text-slate-700 font-bold rounded-2xl text-sm shadow-sm hover:bg-slate-50 transition-all flex items-center justify-center gap-2 whitespace-nowrap">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Kategori
                </button>

                <button onclick="openProductModal()" class="flex-1 px-5 py-3 bg-black text-white font-bold rounded-2xl text-sm shadow-md hover:bg-slate-800 transition-all flex items-center justify-center gap-2 whitespace-nowrap">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Produk
                </button>
            </div>
        </div>
    </div>

    <div class="flex gap-3 overflow-x-auto pb-4 mb-4 hide-scroll items-center">
        <a href="{{ route('product.index') }}" class="px-5 py-2 {{ !request('category') ? 'bg-slate-900 text-white' : 'bg-white text-slate-600 border border-slate-200' }} font-semibold rounded-full text-sm shadow-sm whitespace-nowrap hover:opacity-90 transition">Semua Item</a>
        @foreach($categories as $category)
        <div class="relative group flex items-center">
            <a href="{{ route('product.index', ['category' => $category->id]) }}" class="pl-5 pr-10 py-2 {{ request('category') == $category->id ? 'bg-slate-900 text-white' : 'bg-white text-slate-600 border border-slate-200' }} font-semibold rounded-full text-sm hover:opacity-90 transition whitespace-nowrap">{{ $category->name }}</a>
            <form action="{{ route('category.destroy', $category->id) }}" method="POST" class="absolute right-1 top-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 transition-opacity" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="p-1 {{ request('category') == $category->id ? 'text-white/70 hover:text-white hover:bg-white/20' : 'text-slate-400 hover:text-red-500 hover:bg-red-50' }} rounded-full transition" title="Hapus Kategori">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
            </form>
        </div>
        @endforeach
    </div>

    <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600 whitespace-nowrap">
                <thead class="bg-slate-50/80 text-slate-500 font-bold border-b border-slate-100 uppercase tracking-wider text-[11px]">
                    <tr>
                        <th class="px-6 py-5 rounded-tl-[2rem]">Info Produk</th>
                        <th class="px-6 py-5">Kategori</th>
                        <th class="px-6 py-5">Harga</th>
                        <th class="px-6 py-5">Stok</th>
                        <th class="px-6 py-5 text-center rounded-tr-[2rem]">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-50">
                    @forelse($products as $product)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-6 py-4 flex items-center gap-4">
                            <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/150x150?text=No+Image' }}" class="w-12 h-12 rounded-2xl object-cover shadow-sm {{ $product->stock <= 0 ? 'grayscale opacity-70' : '' }}" alt="{{ $product->name }}">
                            <div>
                                <h4 class="font-extrabold text-slate-900 text-base {{ $product->stock <= 0 ? 'text-slate-500 line-through' : '' }}">{{ $product->name }}</h4>
                                <p class="text-slate-400 text-xs font-medium mt-0.5">SKU: PRD-{{ str_pad($product->id, 3, '0', STR_PAD_LEFT) }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-orange-50 text-orange-600 font-bold rounded-lg text-xs {{ $product->stock <= 0 ? 'opacity-70' : '' }}">{{ $product->category->name }}</span>
                        </td>
                        <td class="px-6 py-4 font-extrabold text-slate-900 text-base {{ $product->stock <= 0 ? 'text-slate-500 opacity-70' : '' }}">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full {{ $product->stock > 10 ? 'bg-emerald-500' : ($product->stock > 0 ? 'bg-amber-500' : 'bg-red-500') }}"></div>
                                @if($product->stock > 0)
                                    <span class="font-semibold text-slate-700">{{ $product->stock }} Unit</span>
                                @else
                                    <span class="font-bold text-red-500">Stok Habis</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2 opacity-100">
                                <button onclick="editProduct({{ $product->toJson() }})" class="p-2 text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-xl transition tooltip" title="Edit Produk">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </button>
                                <form action="{{ route('product.destroy', $product->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-red-600 bg-red-50 hover:bg-red-100 rounded-xl transition tooltip" title="Hapus Produk">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-slate-500">Produk tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="p-4 border-t border-slate-100">
            {{ $products->links('pagination::tailwind') }}
        </div>
    </div>
</div>

<div id="productModal" class="hidden fixed inset-0 z-[100] flex items-center justify-center bg-slate-900/50 backdrop-blur-sm p-4">
    <div class="bg-white rounded-3xl w-full max-w-lg shadow-2xl overflow-hidden flex flex-col max-h-[90vh]">
        <div class="p-6 border-b border-slate-100 flex justify-between items-center">
            <h3 id="productModalTitle" class="text-xl font-bold text-slate-900">Produk Baru</h3>
            <button onclick="closeProductModal()" class="text-slate-400 hover:text-slate-600 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <form id="productForm" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" class="overflow-y-auto p-6 space-y-5">
            @csrf
            <input type="hidden" name="_method" id="productMethod" value="POST">
            
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Nama Produk</label>
                <input type="text" name="name" id="productName" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-slate-900 focus:bg-white outline-none transition text-sm">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="relative" id="categoryDropdownWrapper">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Kategori</label>
                    <input type="hidden" name="category_id" id="productCategory" required>
                    <button type="button" id="categoryDropdownBtn" onclick="toggleCategory()" class="w-full flex items-center justify-between px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-slate-900 focus:bg-white outline-none transition text-sm text-left">
                        <span id="categoryDropdownLabel" class="text-slate-500">Pilih Kategori</span>
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div id="categoryDropdownList" class="hidden absolute z-50 w-full mt-2 bg-white border border-slate-100 rounded-2xl shadow-xl overflow-hidden text-sm">
                        <div class="max-h-60 overflow-y-auto py-2">
                            <div onclick="selectCategory('', 'Pilih Kategori')" data-value="" data-name="Pilih Kategori" class="px-4 py-2.5 text-slate-500 hover:bg-slate-50 cursor-pointer transition">Pilih Kategori</div>
                            @foreach($categories as $category)
                            <div onclick="selectCategory('{{ $category->id }}', '{{ $category->name }}')" data-value="{{ $category->id }}" data-name="{{ $category->name }}" class="px-4 py-2.5 text-slate-700 hover:bg-slate-50 cursor-pointer transition">{{ $category->name }}</div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Stock</label>
                    <input type="number" name="stock" id="productStock" min="0" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900 focus:bg-white outline-none transition text-sm">
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Harga (IDR)</label>
                <div class="relative">
                    <span class="absolute left-4 top-3 text-slate-500 font-medium">Rp</span>
                    <input type="text" id="productPriceDisplay" required class="w-full pl-12 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-slate-900 focus:bg-white outline-none transition text-sm" oninput="formatRupiah(this)">
                    <input type="hidden" name="price" id="productPrice">
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Gambar Produk</label>
                <input type="file" name="image" id="productImage" accept="image/*" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-slate-900 focus:bg-white outline-none transition text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-slate-900 file:text-white hover:file:bg-slate-800">
                <p class="text-xs text-slate-400 mt-2">Biarkan kosong untuk mempertahankan gambar yang ada saat mengedit.</p>
            </div>

            <div class="pt-4 border-t border-slate-100 flex justify-end gap-3 mt-4">
                <button type="button" onclick="closeProductModal()" class="px-5 py-2.5 text-slate-600 font-bold hover:bg-slate-50 rounded-2xl transition text-sm">Batal</button>
                <button type="submit" class="px-5 py-2.5 bg-slate-900 text-white font-bold rounded-xl shadow-md hover:bg-slate-800 hover:shadow-lg transition text-sm">Simpan Produk</button>
            </div>
        </form>
    </div>
</div>

<div id="categoryModal" class="hidden fixed inset-0 z-[100] flex items-center justify-center bg-slate-900/50 backdrop-blur-sm p-4">
    <div class="bg-white rounded-3xl w-full max-w-sm shadow-2xl overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex justify-between items-center">
            <h3 class="text-xl font-bold text-slate-900">Kategori Baru</h3>
            <button onclick="closeCategoryModal()" class="text-slate-400 hover:text-slate-600 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <form action="{{ route('category.store') }}" method="POST" class="p-6 space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Nama Kategori</label>
                <input type="text" name="name" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-slate-900 focus:bg-white outline-none transition text-sm">
            </div>

            <div class="flex justify-end gap-3 pt-2">
                <button type="button" onclick="closeCategoryModal()" class="px-5 py-2.5 text-slate-600 font-bold hover:bg-slate-50 rounded-2xl transition text-sm">Batal</button>
                <button type="submit" class="px-5 py-2.5 bg-slate-900 text-white font-bold rounded-2xl shadow-md hover:bg-slate-800 transition text-sm">Tambah Kategori</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Toast logic
    function closeToast(id) {
        const toast = document.getElementById(id);
        if (toast) {
            toast.style.transform = 'translateX(20px)';
            toast.style.opacity = '0';
            toast.style.transition = 'all 0.3s ease-in';
            setTimeout(() => toast.remove(), 300);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        if (document.getElementById('toast-success')) setTimeout(() => closeToast('toast-success'), 5000);
        if (document.getElementById('toast-error')) setTimeout(() => closeToast('toast-error'), 8000);
    });

    // Custom Dropdown functions
    function toggleCategory() {
        document.getElementById('categoryDropdownList').classList.toggle('hidden');
    }

    function selectCategory(id, name) {
        document.getElementById('productCategory').value = id;
        document.getElementById('categoryDropdownLabel').innerText = name;
        if (id) {
            document.getElementById('categoryDropdownLabel').classList.remove('text-slate-500');
            document.getElementById('categoryDropdownLabel').classList.add('text-slate-900');
        } else {
            document.getElementById('categoryDropdownLabel').classList.add('text-slate-500');
            document.getElementById('categoryDropdownLabel').classList.remove('text-slate-900');
        }
        document.getElementById('categoryDropdownList').classList.add('hidden');
    }

    document.addEventListener('click', function(event) {
        const wrapper = document.getElementById('categoryDropdownWrapper');
        if (wrapper && !wrapper.contains(event.target)) {
            document.getElementById('categoryDropdownList').classList.add('hidden');
        }
    });

    // Existing functions
    function formatRupiah(obj) {
        let value = obj.value.replace(/[^0-9]/g, '');
        if (value) {
            value = parseInt(value, 10).toString();
            document.getElementById('productPrice').value = value;
            obj.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        } else {
            document.getElementById('productPrice').value = '';
            obj.value = '';
        }
    }

    function openProductModal() {
        document.getElementById('productModal').classList.remove('hidden');
        document.getElementById('productForm').reset();
        document.getElementById('productPrice').value = '';
        document.getElementById('productMethod').value = 'POST';
        document.getElementById('productForm').action = "{{ route('product.store') }}";
        document.getElementById('productModalTitle').innerText = 'Produk Baru';
        selectCategory('', 'Pilih Kategori');
    }

    function closeProductModal() {
        document.getElementById('productModal').classList.add('hidden');
    }

    function editProduct(product) {
        openProductModal();
        document.getElementById('productModalTitle').innerText = 'Edit Produk';
        document.getElementById('productMethod').value = 'PUT';
        document.getElementById('productForm').action = `/product/${product.id}`;
        
        document.getElementById('productName').value = product.name;
        
        let catName = 'Pilih Kategori';
        const opt = document.querySelector(`#categoryDropdownList div[data-value="${product.category_id}"]`);
        if (opt) catName = opt.getAttribute('data-name');
        selectCategory(product.category_id, catName);
        
        document.getElementById('productStock').value = product.stock;
        document.getElementById('productPrice').value = product.price;
        if (product.price) {
            document.getElementById('productPriceDisplay').value = product.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
    }

    function openCategoryModal() {
        document.getElementById('categoryModal').classList.remove('hidden');
    }

    function closeCategoryModal() {
        document.getElementById('categoryModal').classList.add('hidden');
    }
</script>
@endsection