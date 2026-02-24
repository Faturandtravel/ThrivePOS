<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ThrivePOS - Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex h-screen w-full bg-[#F3F4F6] font-sans antialiased overflow-hidden">

    @include('components.sidebar-left')

    <main class="flex-1 h-full flex flex-col overflow-y-auto relative">
        @include('components.navbar')

        <div class="flex-1 w-full flex flex-col">
            @yield('content')
        </div>
    </main>

    @yield('sidebar-right')
</body>
</html>