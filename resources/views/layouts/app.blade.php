<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ThrivePOS - Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex flex-col md:flex-row h-screen w-full bg-[#F3F4F6] font-sans antialiased overflow-hidden">

    <!-- Mobile Overlay for Sidebar Left -->
    <div id="mobile-overlay-left" class="fixed inset-0 bg-black/50 z-[90] hidden md:hidden transition-opacity opacity-0" onclick="toggleSidebarLeft()"></div>

    @include('components.sidebar-left')

    <main class="flex-1 w-full h-full flex flex-col overflow-y-auto relative">
        @include('components.navbar')

        <div class="flex-1 w-full flex flex-col">
            @yield('content')
        </div>
    </main>

    @yield('sidebar-right')

    <script>
        function toggleSidebarLeft() {
            const sidebar = document.getElementById('sidebar-left');
            const overlay = document.getElementById('mobile-overlay-left');
            
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                setTimeout(() => overlay.classList.remove('opacity-0'), 10);
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('opacity-0');
                setTimeout(() => overlay.classList.add('hidden'), 300);
            }
        }
        
        function toggleSidebarRight() {
            const sidebar = document.getElementById('sidebar-right');
            const overlay = document.getElementById('mobile-overlay-right');
            
            if (sidebar && sidebar.classList.contains('translate-x-full')) {
                sidebar.classList.remove('translate-x-full');
                if (overlay) {
                    overlay.classList.remove('hidden');
                    setTimeout(() => overlay.classList.remove('opacity-0'), 10);
                }
            } else if (sidebar) {
                sidebar.classList.add('translate-x-full');
                if (overlay) {
                    overlay.classList.add('opacity-0');
                    setTimeout(() => overlay.classList.add('hidden'), 300);
                }
            }
        }
    </script>
</body>
</html>