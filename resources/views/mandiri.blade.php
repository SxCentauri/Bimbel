<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>@yield('title', 'Dashboard Siswa - ONMAI')</title>
    
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700,800" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Roboto Slab', serif; }
        h1, h2, h3, h4, h5, h6, .font-heading { font-family: 'Montserrat', sans-serif; }
        
        /* Utility Warna Brand */
        .bg-brand { background-color: #ffc800; }
        .text-brand { color: #ffc800; }
        .border-brand { border-color: #ffc800; }
        .hover-bg-brand:hover { background-color: #d9aa00; }

        /* Animasi Hamburger Menu (Konsisten dengan Landing Page) */
        .hamburger span {
            display: block;
            width: 25px;
            height: 3px;
            background-color: white;
            margin-bottom: 5px;
            position: relative;
            border-radius: 3px;
            transition: transform 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55),
                        opacity 0.4s ease;
        }
        .hamburger.active span:nth-child(1) { transform: translateY(8px) rotate(45deg); }
        .hamburger.active span:nth-child(2) { opacity: 0; }
        .hamburger.active span:nth-child(3) { transform: translateY(-8px) rotate(-45deg); }

        /* Animasi Mobile Menu Slide */
        #mobile-menu {
            max-height: 0;
            opacity: 0;
            overflow: hidden;
            transition: max-height 0.4s ease-in-out, opacity 0.4s ease-in-out;
        }
        #mobile-menu.open {
            max-height: 600px;
            opacity: 1;
        }

        /* Animasi Kilatan (Shimmer) untuk Tombol Login */
        @keyframes shimmer {
            100% { transform: translateX(100%); }
        }
    </style>
</head>
<body id="page-top" class="bg-gray-50 text-gray-700 antialiased selection:bg-[#ffc800] selection:text-black flex flex-col min-h-screen">

    <nav class="fixed w-full z-50 top-0 transition-all duration-300 bg-gray-900 shadow-xl" id="mainNav">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                
                <a class="flex items-center gap-3 text-xl font-bold font-heading tracking-wider text-white group" href="{{ url('/') }}">
                    <img src="{{ asset('landing-page/assets/img/img1.png') }}" class="h-10 w-auto transition-transform duration-300 group-hover:scale-110" alt="Logo" />
                    <span class="text-brand">TRY OUT</span>
                </a>

                <div class="hidden lg:flex items-center space-x-8">
                    @guest
                    <a class="relative group py-2 text-gray-300 hover:text-[#ffc800] transition duration-300 font-bold uppercase text-sm tracking-wide" href="{{ url('/') }}">
                        <i class="fas fa-home mr-1"></i> Home
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#ffc800] transition-all duration-300 group-hover:w-full"></span>
                    </a>
                        <div class="h-6 w-px bg-gray-700 mx-2"></div> <a href="{{ route('login') }}" class="group relative inline-flex items-center gap-2 px-6 py-2 bg-[#ffc800] text-white font-bold rounded-full overflow-hidden shadow-lg transition-all duration-300 hover:scale-105 hover:shadow-[0_0_20px_rgba(255,200,0,0.5)] active:scale-95 text-sm">
                            <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/40 to-transparent -translate-x-[150%] skew-x-12 transition-transform duration-1000 group-hover:translate-x-[150%] ease-in-out"></div>
                            <i class="fas fa-sign-in-alt relative z-10 transition-transform duration-300 group-hover:translate-x-1"></i>
                            <span class="relative z-10 tracking-wide">LOGIN</span>
                        </a>
                    @else
                        <div class="h-6 w-px bg-gray-700 mx-2"></div>
                        
                        <div class="flex items-center gap-4">
                            <div class="text-right hidden xl:block">
                                <span class="block text-white text-sm font-bold leading-tight">Halo, {{ Auth::user()->name ?? 'Siswa' }}</span>
                                <span class="block text-xs text-gray-400">Selamat Belajar</span>
                            </div>
                            
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="group px-5 py-2 bg-red-600 text-white rounded-full font-bold text-sm hover:bg-red-700 transition shadow-lg flex items-center gap-2 hover:shadow-red-600/30">
                                    <span>Logout</span>
                                    <i class="fas fa-sign-out-alt transition-transform duration-300 group-hover:translate-x-1"></i>
                                </button>
                            </form>
                        </div>
                    @endguest
                </div>

                <div class="lg:hidden flex items-center">
                    <button id="mobile-menu-btn" class="hamburger focus:outline-none p-2">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </div>
        </div>

        <div id="mobile-menu" class="lg:hidden bg-gray-900 border-t border-gray-800 absolute w-full left-0 shadow-xl z-40">
            <ul class="px-6 py-6 space-y-4 font-bold text-white uppercase text-sm font-heading tracking-wide">
                @guest
                <li>
                    <a class="block hover:text-brand transition-colors hover:translate-x-2 duration-200" href="{{ url('/') }}">
                        <i class="fas fa-home mr-2 text-brand"></i> Home
                    </a>
                </li>
                
                <li class="border-t border-gray-700 pt-2"></li>
                    <li>
                        <a class="block w-full text-center py-3 bg-[#ffc800] text-white rounded-lg hover:bg-yellow-600 shadow-lg transition duration-200" href="{{ route('login') }}">
                            Login Sekarang <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </li>
                @else
                    <li class="flex items-center gap-3 bg-gray-800 p-3 rounded-lg">
                        <div class="w-8 h-8 rounded-full bg-brand flex items-center justify-center text-white font-bold">
                            {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                        </div>
                        <div class="flex-col">
                            <span class="block text-sm text-white">{{ Auth::user()->name ?? 'User' }}</span>
                            <span class="block text-xs text-brand">Status: Siswa</span>
                        </div>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="block w-full text-center py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 shadow-lg transition duration-200">
                                Logout
                            </button>
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>

    <main class="flex-grow pt-24 pb-12 px-4">
        @yield('content')
    </main>

    <footer class="py-6 bg-gray-900 text-white text-center text-sm border-t border-gray-800 mt-auto">
        <div class="container mx-auto text-gray-400">
            &copy; 2025 ONMAI. All rights reserved.
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');

            if(btn && menu){
                btn.addEventListener('click', () => {
                    // Toggle animasi menu slide
                    menu.classList.toggle('open');
                    // Toggle animasi icon hamburger
                    btn.classList.toggle('active');
                });
            }
        });
    </script>

</body>
</html>