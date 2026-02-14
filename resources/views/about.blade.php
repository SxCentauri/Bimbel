<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Pusat Bimbingan Belajar ONMAI" />
    <meta name="author" content="ONMAI" />
    <title>@yield('title', 'ONMAI - Pusat Bimbingan Belajar')</title>
    
    <link rel="icon" type="image/png" href="{{ asset('landing-page/assets/img/img1.png') }}" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700,800,900" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400,700" rel="stylesheet" type="text/css" />

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Roboto Slab', serif; overflow-x: hidden; }
        h1, h2, h3, h4, h5, h6, .font-heading { font-family: 'Montserrat', sans-serif; }
        
        /* Warna Brand */
        :root {
            --brand-color: #ffc800;
            --brand-dark: #d9aa00;
        }
        
        .bg-brand { background-color: var(--brand-color); }
        .text-brand { color: var(--brand-color); }
        .border-brand { border-color: var(--brand-color); }
        .hover-bg-brand:hover { background-color: var(--brand-dark); }
        .hover-text-brand:hover { color: var(--brand-color); }
        
        /* Preloader Styles */
        #preloader {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background-color: #f4f5f8; /* Gray-900 */
            z-index: 9999;
            display: flex; justify-content: center; align-items: center;
            transition: opacity 0.5s ease-out, visibility 0.5s ease-out;
        }
        .loader-content { text-align: center; }
        .loader-logo { width: 80px; animation: pulse 1.5s infinite; }
        @keyframes pulse {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.1); opacity: 0.8; }
            100% { transform: scale(1); opacity: 1; }
        }

        /* Card Styles Enhanced */
        .card-ref {
            border: 1px solid #f3f4f6;
            border-radius: 16px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            background: white;
        }
        .card-ref:hover {
            border-color: var(--brand-color);
            transform: translateY(-10px);
            box-shadow: 0 20px 40px -10px rgba(255, 200, 0, 0.15);
        }

        /* Hamburger Menu */
        .hamburger span {
            display: block; width: 25px; height: 3px; background-color: white;
            margin-bottom: 5px; position: relative; border-radius: 3px;
            transition: transform 0.4s, opacity 0.4s;
        }
        .hamburger.active span:nth-child(1) { transform: translateY(8px) rotate(45deg); }
        .hamburger.active span:nth-child(2) { opacity: 0; }
        .hamburger.active span:nth-child(3) { transform: translateY(-8px) rotate(-45deg); }

        /* Navigation & Dropdown */
        .dropdown-menu { opacity: 0; visibility: hidden; transform: translateY(10px); transition: all 0.3s ease-in-out; }
        .group:hover .dropdown-menu { opacity: 1; visibility: visible; transform: translateY(0); }
        #mobile-menu { max-height: 0; opacity: 0; overflow: hidden; transition: max-height 0.4s ease, opacity 0.4s ease; }
        #mobile-menu.open { max-height: 500px; opacity: 1; }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 5px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body id="page-top" class="bg-white text-gray-700 antialiased selection:bg-[#ffc800] selection:text-black">

    <div id="preloader">
        <div class="loader-content">
            <img src="{{ asset('landing-page/assets/img/img1.png') }}" class="loader-logo mb-4" alt="Loading...">
            <h2 class="text-white font-heading font-bold text-xl tracking-widest">ON<span class="text-brand">MAI</span></h2>
        </div>
    </div>

    <nav class="fixed w-full z-50 top-0 bg-gray-900/95 backdrop-blur-md shadow-2xl border-b border-gray-800" id="mainNav">
        @include('incabout.nav')
    </nav>

    @yield('content')

    <footer class="bg-gray-50 border-t border-gray-200 pt-20 pb-10 text-sm text-gray-600">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                <div class="space-y-6">
                    <div class="flex items-center gap-2 text-3xl font-bold text-gray-900 font-heading">
                        <img src="{{ asset('landing-page/assets/img/img1.png') }}" class="h-10 w-auto" alt="Logo" />
                        <span>ON<span class="text-brand">MAI</span></span>
                    </div>
                    <p class="text-gray-500 leading-relaxed text-base">
                        Partner terbaikmu meraih prestasi akademik dan menembus PTN impian.
                    </p>
                    <div class="flex space-x-4 pt-2">
                        <a href="#" class="w-10 h-10 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-400 hover:text-white hover:bg-[#1877F2] hover:border-[#1877F2] transition duration-300"><i class="fab fa-facebook-f text-lg"></i></a>
                        <a href="https://instagram.com/bimbel_onmai" class="w-10 h-10 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-400 hover:text-white hover:bg-[#E4405F] hover:border-[#E4405F] transition duration-300"><i class="fab fa-instagram text-lg"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-400 hover:text-white hover:bg-[#1DA1F2] hover:border-[#1DA1F2] transition duration-300"><i class="fab fa-twitter text-lg"></i></a>
                    </div>
                </div>

                <div>
                    <h4 class="font-bold text-gray-900 mb-6 text-lg">Program Kami</h4>
                    <ul class="space-y-4 text-base">
                        <li><a  class="hover:text-[#ffc800] hover:translate-x-1 inline-block transition">Sekolah Dasar (SD)</a></li>
                        <li><a  class="hover:text-[#ffc800] hover:translate-x-1 inline-block transition">Sekolah Menengah (SMP)</a></li>
                        <li><a  class="hover:text-[#ffc800] hover:translate-x-1 inline-block transition">SMA Reguler</a></li>
                        <li><a  class="hover:text-[#ffc800] hover:translate-x-1 inline-block transition">Persiapan UTBK & PTN</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-gray-900 mb-6 text-lg">Jelajahi</h4>
                    <ul class="space-y-4 text-base">
                        <!--li><a href="" class="hover:text-[#ffc800] hover:translate-x-1 inline-block transition">Tentang Kami</a></li-->
                        <li><a href="{{ route('detail.fasilitas') }}" class="hover:text-[#ffc800] hover:translate-x-1 inline-block transition">Fasilitas</a></li>
                        <li><a  class="hover:text-[#ffc800] hover:translate-x-1 inline-block transition">Testimoni</a></li>
                        <li><a  class="hover:text-[#ffc800] hover:translate-x-1 inline-block transition">Karir Pengajar</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-gray-900 mb-6 text-lg">Hubungi Kami</h4>
                    <ul class="space-y-6">
                        <li class="flex items-start gap-3">
                            <i class="fas fa-map-marker-alt text-[#ffc800] mt-1"></i>
                            <span class="text-base">Jl. Mayjend Sutoyo No. 25 Tanah Patah, Kota Bengkulu, 55293</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-envelope text-[#ffc800]"></i>
                            <span class="text-base font-medium">onmaibimbel@gmail.com</span>
                        </li>
                        <li class="flex items-center gap-3">
                             <i class="fab fa-whatsapp text-[#ffc800] text-lg"></i>
                            <span class="text-base font-medium">083142064406</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-200 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-gray-400 text-sm">&copy; 2025 ONMAI Learning Center. All rights reserved.</p>
                <a href="https://wa.me/6283142064406" target="_blank" class="fixed bottom-6 right-6 z-50 bg-[#25D366] text-white w-14 h-14 rounded-full shadow-2xl hover:scale-110 transition duration-300 flex items-center justify-center group">
                    <i class="fab fa-whatsapp text-3xl group-hover:rotate-12 transition"></i>
                </a>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            AOS.init({
                duration: 800,
                easing: 'ease-out-cubic',
                once: true,
                offset: 50,
            });
    
            const preloader = document.getElementById('preloader');
            window.addEventListener('load', () => {
                setTimeout(() => {
                    preloader.style.opacity = '0';
                    preloader.style.visibility = 'hidden';
                }, 800);
            });
    
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');
    
            if (btn && menu) {
                btn.addEventListener('click', () => {
                    menu.classList.toggle('open');
                    btn.classList.toggle('active');
                });
    
                menu.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', () => {
                        menu.classList.remove('open');
                        btn.classList.remove('active');
                    });
                });
            }
    
            const counters = document.querySelectorAll('.counter');
            const speed = 200;
    
            const animate = (counter) => {
                const animateText = () => {
                    const target = +counter.getAttribute('data-target');
                    const count = +counter.innerText;
                    const inc = target / speed;
    
                    if (count < target) {
                        counter.innerText = Math.ceil(count + inc);
                        requestAnimationFrame(animateText);
                    } else {
                        counter.innerText = target;
                    }
                }
                animateText();
            }
    
            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const counter = entry.target;
                        animate(counter);
                        observer.unobserve(counter);
                    }
                });
            }, {
                threshold: 0.5
            });
    
            counters.forEach(counter => {
                observer.observe(counter);
            });
        });
    </script>
</body>
</html>