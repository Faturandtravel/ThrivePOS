@extends('layouts.pos')

@section('sidebar-right')
@endsection

@section('content')
<div class="p-8 pb-20 max-w-full mx-auto w-full">
    
    <div class="mb-8 flex justify-between items-end">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Settings</h1>
            <p class="text-slate-500 text-sm mt-1">Kelola profil toko, konfigurasi struk, dan hak akses staf.</p>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 mb-8 overflow-x-auto hide-scroll sticky top-0 z-10">
        <nav class="flex gap-2 px-2 py-2" id="settings-tabs">
            
            <button onclick="switchTab('store-profile')" id="tab-store-profile" class="tab-btn px-5 py-3 bg-slate-100 rounded-xl text-slate-900 font-bold text-sm flex items-center gap-2 whitespace-nowrap transition outline-none">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                Profil Toko & Struk
            </button>
            
            <button onclick="switchTab('user-access')" id="tab-user-access" class="tab-btn px-5 py-3 bg-transparent hover:bg-slate-50 rounded-xl text-slate-500 hover:text-slate-800 font-medium text-sm flex items-center gap-2 whitespace-nowrap transition outline-none">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Akses Sistem (User)
            </button>

        </nav>
    </div>

    <div class="w-full relative min-h-[500px]">

        <section id="store-profile" class="tab-content block bg-white rounded-[2rem] shadow-sm border border-slate-100 p-8 animate-fadeIn">
            <div class="mb-8 border-b border-slate-100 pb-5">
                <h2 class="text-xl font-extrabold text-slate-800">Manajemen Toko & Struk</h2>
                <p class="text-sm text-slate-500 mt-1">Informasi ini akan ditampilkan pada sistem dan cetakan struk pelanggan.</p>
            </div>

            <form action="#" method="POST" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Nama Toko (Outlet)</label>
                        <input type="text" value="ThrivePOS Jakarta Raya" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900 focus:bg-white outline-none text-sm font-semibold text-slate-800 transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Nomor Telepon</label>
                        <input type="text" value="+62 812-3456-7890" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900 focus:bg-white outline-none text-sm font-semibold text-slate-800 transition">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Alamat Toko (Tampil di Struk)</label>
                    <textarea rows="2" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900 focus:bg-white outline-none text-sm font-semibold text-slate-800 transition">Jl. Jend. Sudirman No. Kav 21, Kuningan, Jakarta Selatan 12920</textarea>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 pt-2">
                    <div class="lg:col-span-2">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Pesan Penutup Struk (Footer)</label>
                        <textarea rows="4" class="w-full h-32 px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900 focus:bg-white outline-none text-sm font-semibold text-slate-800 transition">Terima kasih atas kunjungannya!
Follow IG kami @thrivepos_jkt</textarea>
                        <p class="text-[11px] text-slate-400 mt-2">*Maksimal 3 baris teks agar struk tidak terlalu panjang.</p>
                    </div>
                    
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Logo Struk (Monokrom)</label>
                        <div class="w-full h-32 border-2 border-dashed border-slate-300 rounded-xl bg-slate-50 flex flex-col items-center justify-center cursor-pointer hover:bg-slate-100 hover:border-slate-400 transition group">
                            <svg class="w-8 h-8 text-slate-400 mb-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span class="text-xs font-bold text-slate-500">Upload Image</span>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end pt-6 mt-4 border-t border-slate-100">
                    <button type="button" class="px-8 py-3.5 bg-black text-white font-bold rounded-xl text-sm shadow-md hover:bg-slate-800 hover:shadow-lg hover:-translate-y-0.5 transition-all">
                        Simpan Profil Toko
                    </button>
                </div>
            </form>
        </section>

        <section id="user-access" class="tab-content hidden bg-white rounded-[2rem] shadow-sm border border-slate-100 p-8 animate-fadeIn">
            <div class="mb-8 border-b border-slate-100 pb-5">
                <h2 class="text-xl font-extrabold text-slate-800">Manajemen Akses Sistem</h2>
                <p class="text-sm text-slate-500 mt-1">Daftarkan email Google (Gmail/Workspace) staf yang diizinkan untuk login.</p>
            </div>

            <div class="bg-slate-50 p-6 rounded-[1.5rem] border border-slate-100 mb-8">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-4">Beri Akses ke Email Baru</label>
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-slate-400" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                        </div>
                        <input type="email" placeholder="contoh: kasir.satu@gmail.com" class="w-full pl-13 pr-5 py-4 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900 outline-none text-sm font-semibold text-slate-800 transition shadow-sm">
                    </div>
                    <select class="w-full md:w-48 px-5 py-4 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-slate-900 outline-none text-sm font-semibold text-slate-700 transition appearance-none shadow-sm">
                        <option value="kasir">Akses: Kasir</option>
                        <option value="admin">Akses: Manager</option>
                    </select>
                    <button type="button" class="w-full md:w-auto px-8 py-4 bg-slate-900 text-white font-bold rounded-xl text-sm shadow-md hover:bg-slate-800 hover:shadow-lg transition-all flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                        Tambahkan
                    </button>
                </div>
            </div>

            <div>
                <h3 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider">Daftar Akun Terdaftar</h3>
                <div class="border border-slate-100 rounded-[1.5rem] overflow-hidden shadow-sm">
                    <table class="w-full text-left text-sm text-slate-600">
                        <thead class="bg-slate-50/80 border-b border-slate-100">
                            <tr>
                                <th class="px-6 py-4 font-bold text-slate-500 uppercase tracking-wider text-[11px]">Email Pegawai</th>
                                <th class="px-6 py-4 font-bold text-slate-500 uppercase tracking-wider text-[11px]">Peran (Role)</th>
                                <th class="px-6 py-4 font-bold text-slate-500 text-right uppercase tracking-wider text-[11px]">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-full bg-slate-900 text-white flex items-center justify-center font-bold text-sm shadow-sm">F</div>
                                        <div>
                                            <p class="font-bold text-slate-900 text-base leading-tight mb-0.5">faturahman2806@gmail.com</p>
                                            <p class="text-xs text-slate-400 font-medium">Ditambahkan: 20 Feb 2026</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1.5 bg-purple-50 text-purple-600 font-bold rounded-lg text-xs uppercase tracking-wider">Manager</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="text-sm text-slate-400 italic font-medium px-4">Owner</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

    </div>
</div>

<script>
    function switchTab(tabId) {
        const contents = document.querySelectorAll('.tab-content');
        contents.forEach(content => {
            content.classList.add('hidden');
            content.classList.remove('block');
        });

        const targetContent = document.getElementById(tabId);
        targetContent.classList.remove('hidden');
        targetContent.classList.add('block');

        const tabs = document.querySelectorAll('.tab-btn');
        tabs.forEach(tab => {
            tab.classList.remove('bg-slate-100', 'text-slate-900', 'font-bold');
            tab.classList.add('bg-transparent', 'text-slate-500', 'font-medium');
        });

        const activeTab = document.getElementById('tab-' + tabId);
        activeTab.classList.remove('bg-transparent', 'text-slate-500', 'font-medium');
        activeTab.classList.add('bg-slate-100', 'text-slate-900', 'font-bold');
    }
</script>

<style>
    .animate-fadeIn {
        animation: fadeIn 0.3s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(5px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection