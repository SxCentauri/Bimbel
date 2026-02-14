<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru | ONMAI</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('landing-page/assets/img/img1.png') }}" />

    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700,800" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Roboto Slab', serif; }
        .font-heading { font-family: 'Montserrat', sans-serif; }
        
        /* Utility Warna Brand */
        .bg-brand { background-color: #ffc800; }
        .text-brand { color: #ffc800; }
        
        /* Scrollbar Custom (Opsional - agar lebih rapi) */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 antialiased overflow-hidden">

    <div class="flex h-screen relative">
        
        <div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden transition-opacity opacity-0"></div>

        <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-gray-900 text-white h-full transform -translate-x-full transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-auto shadow-2xl lg:shadow-none">
            @include('incbelajar.navigation')
        </aside>

        <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden w-full">
            @yield('content')
        </div>
        
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        const toggleBtns = document.querySelectorAll('.toggle'); // Class .toggle dari tombol di dashboard

        // Fungsi Buka/Tutup Sidebar
        function toggleSidebar() {
            // Toggle class translate untuk efek slide
            if (sidebar.classList.contains('-translate-x-full')) {
                // Buka Sidebar
                sidebar.classList.remove('-translate-x-full');
                
                // Tampilkan Overlay
                overlay.classList.remove('hidden');
                setTimeout(() => { overlay.classList.remove('opacity-0'); }, 10); // Efek fade in
            } else {
                // Tutup Sidebar
                sidebar.classList.add('-translate-x-full');
                
                // Sembunyikan Overlay
                overlay.classList.add('opacity-0');
                setTimeout(() => { overlay.classList.add('hidden'); }, 300); // Tunggu animasi selesai
            }
        }

        // Event Listener untuk semua tombol dengan class 'toggle'
        toggleBtns.forEach(btn => {
            btn.addEventListener('click', toggleSidebar);
        });
    </script>
</body>

</html>