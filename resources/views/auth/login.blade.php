<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - ThrivePOS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex flex-col md:flex-row h-screen w-full overflow-hidden font-sans bg-white">

    <div class="w-full md:w-1/2 flex flex-col justify-center bg-white px-6 py-10 lg:px-12 xl:px-20 overflow-y-auto">
        
        <div class="w-full max-w-md mx-auto flex flex-col min-h-full py-8">
            
            <div class="flex-grow"></div>

            <div class="mb-10 text-center">
                <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-3 tracking-tight">Selamat Datang!</h1>
                <p class="text-slate-500 text-sm leading-relaxed">Silakan masuk menggunakan akun Google resmi perusahaan untuk mengakses sistem kasir pintar ThrivePOS.</p>
            </div>

            <div class="space-y-4">
                <button id="btn-login-google" class="w-full flex items-center justify-center gap-4 px-6 py-4 bg-black border-2 border-transparent rounded-full hover:bg-slate-900 hover:border-slate-900 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 ease-in-out font-bold text-white text-base cursor-pointer shadow-sm">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                    </svg>
                    Masuk dengan Akun Google
                </button>
            </div>

            <p id="pesan-login" class="mt-6 text-sm font-semibold text-red-500 hidden text-center bg-red-50 p-3 rounded-lg border border-red-100"></p>

            <div class="flex-grow"></div>

            <div class="mt-12 text-center flex flex-col items-center">
                <p class="text-xs text-slate-400 mb-8 max-w-xs mx-auto">
                    Aplikasi ini hanya untuk staf internal yang berwenang. Semua aktivitas dalam sistem akan dicatat.
                </p>
                
                <div class="flex flex-col items-center justify-center space-y-2.5">
                    <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400">Powered by</span>
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('assets/images/digimax.png') }}" alt="Firebase Logo" class="h-10">
                        <span class="text-slate-300 font-light">|</span>
                        <h2 class="text-lg font-bold tracking-tighter italic">Thrive<span class="font-light">POS</h2>
                    </div>
                </div>
            </div>

        </div> 
    </div>

    <div class="hidden md:block md:w-1/2 h-full relative bg-slate-900">
        <img id="dynamic-bg" 
             src="https://picsum.photos/800/1200?random=1" 
             alt="POS Dashboard Background" 
             class="absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 ease-in-out opacity-100">
        
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
        
        <div class="absolute bottom-16 left-16 right-16 text-white">
            <h2 class="text-3xl lg:text-4xl font-bold mb-4 shadow-sm leading-tight text-white">Cepat, Akurat, & <br>Terintegrasi.</h2>
            <p class="text-white/80 font-light text-base lg:text-lg max-w-md">Sistem kasir pintar untuk mendukung efisiensi operasional dan pencatatan transaksi outlet harian kita.</p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const bgImage = document.getElementById('dynamic-bg');
            let counter = 2;

            setInterval(() => {
                bgImage.classList.remove('opacity-100');
                bgImage.classList.add('opacity-0');

                setTimeout(() => {
                    bgImage.src = `https://picsum.photos/800/1200?random=${counter}&timestamp=${new Date().getTime()}`;
                    counter++;
                    
                    bgImage.onload = () => {
                        bgImage.classList.remove('opacity-0');
                        bgImage.classList.add('opacity-100');
                    };
                }, 1000); 
                
            }, 6000); 
        });
    </script>
</body>
</html>