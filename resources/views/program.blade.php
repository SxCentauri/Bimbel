<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Pusat Bimbingan Belajar ONMAI" />
    <meta name="author" content="ONMAI" />
    <title>@yield('title', 'ONMAI - Pusat Bimbingan Belajar')</title>
    
    <link rel="icon" type="image/png" href="{{ asset('landing-page/assets/img/img1.png') }}" />
    
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    
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
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <a class="flex items-center gap-3 text-xl font-bold font-heading tracking-wider text-white group" href="#page-top">
                    <img src="{{ asset('landing-page/assets/img/img1.png') }}" class="h-10 w-auto transition transform group-hover:rotate-12" alt="Logo" />
                    <span>ON<span class="text-brand">MAI</span></span>
                </a>
    
                <div class="hidden lg:flex items-center space-x-8 text-sm font-semibold tracking-wide text-gray-300 font-heading">
                    <a class="hover:text-[#ffc800] transition duration-300 relative group" href="{{ route('home') }}">
                        Beranda <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#ffc800] transition-all group-hover:w-full"></span>
                    </a>
                    <!--a class="hover:text-[#ffc800] transition duration-300 relative group" href="#services">
                        Fasilitas <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#ffc800] transition-all group-hover:w-full"></span>
                    </a-->
                    <a class="hover:text-[#ffc800] transition duration-300 relative group" href="{{ route('program') }}">
                        Program <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#ffc800] transition-all group-hover:w-full"></span>
                    </a>
                    <!--a class="hover:text-[#ffc800] transition duration-300 relative group" href="">
                        Tentang <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#ffc800] transition-all group-hover:w-full"></span>
                    </a-->
                    
                    <div class="relative group h-full flex items-center">
                        <button class="flex items-center hover:text-[#ffc800] transition focus:outline-none py-6">
                            Lainnya <i class="fas fa-caret-down ml-1 text-xs transition-transform group-hover:rotate-180"></i>
                        </button>
                        <div class="dropdown-menu absolute right-0 top-16 w-56 bg-white rounded-lg shadow-2xl py-2 border-t-4 border-brand text-gray-800 z-50">
                            <a href="#team" class="block px-4 py-3 hover:bg-gray-50 hover:text-brand transition border-b border-gray-100">Testimoni</a>
                            <a href="#contact" class="block px-4 py-3 hover:bg-gray-50 hover:text-brand transition">Kontak</a>
                        </div>
                    </div>
    
                    @auth
                        <a href="{{ route('dashboard') }}" class="px-6 py-2.5 bg-[#ffc800] text-gray-900 font-bold rounded-full hover:bg-white hover:text-[#ffc800] transition shadow-lg transform hover:-translate-y-1 hover:shadow-brand/50">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-6 py-2.5 bg-[#ffc800] text-gray-900 font-bold rounded-full hover:bg-white hover:text-[#ffc800] transition shadow-lg transform hover:-translate-y-1 hover:shadow-brand/50">
                            Login
                        </a>
                    @endauth
                </div>
    
                <div class="lg:hidden flex items-center">
                    <button id="mobile-menu-btn" class="hamburger focus:outline-none p-2">
                        <span></span><span></span><span></span>
                    </button>
                </div>
            </div>
        </div>
    
        <div id="mobile-menu" class="lg:hidden bg-gray-900 border-t border-gray-800">
            <ul class="px-6 py-6 space-y-4 font-bold text-white uppercase text-sm font-heading">
                <li><a href="{{ route('home') }}" class="block hover:text-brand">Beranda</a></li>
                <li><a href="{{ route('detail.fasilitas') }}" class="block hover:text-brand">Fasilitas</a></li>
                <li><a href="{{ route('program') }}" class="block hover:text-brand">Program</a></li>
                <!--li><a href="" class="block hover:text-brand">Tentang</a></li-->
                <li><a href="https://wa.me/6283142064406" target="_blank" class="block hover:text-brand">Kontak</a></li>
            </ul>
        </div>
    </nav>

    <section class="py-24 bg-gray-50 relative" id="portfolio">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none opacity-5">
             <i class="fas fa-book absolute -top-10 -left-10 text-9xl"></i>
             <i class="fas fa-graduation-cap absolute bottom-10 right-10 text-9xl"></i>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16" data-aos="fade-down">
                <h2 class="text-4xl font-extrabold uppercase mb-4 text-gray-800 font-heading">Program Belajar</h2>
                <h3 class="text-lg text-gray-500 font-serif italic">Pilihan paket bimbingan berkualitas sesuai jenjang pendidikan</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden flex flex-col group border-t-4 border-brand" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative h-56 bg-gray-200 overflow-hidden h-full">
                        <img class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700" src="{{ asset ('landing-page/assets/img/portfolio/1.png') }}" alt="SD" />
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/0 transition-colors"></div>
                        <div class="absolute top-0 right-0 bg-brand text-white text-sm font-bold px-4 py-2 rounded-bl-xl shadow-md z-10">
                            KELAS 1-6
                        </div>
                    </div>
                    <div class="p-6 flex-grow flex flex-col">
                        <h4 class="text-2xl font-bold mb-4 font-heading text-center text-gray-800 group-hover:text-brand transition">Sekolah Dasar (SD)</h4>
                        <div class="space-y-3 text-sm text-gray-600 flex-grow">
                            <div class="flex items-center"><i class="fas fa-check-circle text-brand mr-3"></i> Matematika & IPA</div>
                            <div class="flex items-center"><i class="fas fa-check-circle text-brand mr-3"></i> B. Inggris & B. Indonesia</div>
                            <div class="flex items-center"><i class="fas fa-check-circle text-brand mr-3"></i> PR Tuntas</div>
                            <div class="flex items-center font-bold text-gray-800 bg-brand/10 p-2 rounded mt-2"><i class="fas fa-gift text-brand mr-3"></i> Tambahan Belajar Gratis</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden flex flex-col group border-t-4 border-brand" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative h-56 bg-gray-200 overflow-hidden h-full">
                        <img class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700" src="{{ asset ('landing-page/assets/img/portfolio/7.png') }}" alt="SMP" />
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/0 transition-colors"></div>
                        <div class="absolute top-0 right-0 bg-brand text-white text-sm font-bold px-4 py-2 rounded-bl-xl shadow-md z-10">
                            KELAS 7-9
                        </div>
                    </div>
                    <div class="p-6 flex-grow flex flex-col">
                        <h4 class="text-2xl font-bold mb-4 font-heading text-center text-gray-800 group-hover:text-brand transition">Sekolah Menengah (SMP)</h4>
                        <div class="space-y-3 text-sm text-gray-600 flex-grow">
                            <div class="flex items-center"><i class="fas fa-check-circle text-brand mr-3"></i> MTK, Fisika, Biologi</div>
                            <div class="flex items-center"><i class="fas fa-check-circle text-brand mr-3"></i> B. Inggris, B. Indo, IPS</div>
                            <div class="flex items-center"><i class="fas fa-check-circle text-brand mr-3"></i> PR Tuntas & Tambahan Gratis</div>
                            <div class="flex items-center font-bold text-gray-800 bg-brand/10 p-2 rounded mt-2"><i class="fas fa-star text-brand mr-3"></i> Kelas 9: Persiapan TKA</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden flex flex-col group border-t-4 border-brand" data-aos="fade-up" data-aos-delay="300">
                    <div class="relative h-56 bg-gray-200 overflow-hidden h-full">
                        <img class="w-full h-full object-cover object-top transform group-hover:scale-105 transition duration-700 ease-in-out" src="{{ asset ('landing-page/assets/img/portfolio/6.png') }}" alt="SMA" />
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/0 transition-colors"></div>
                        <div class="absolute top-0 right-0 bg-brand text-white text-sm font-bold px-4 py-2 rounded-bl-xl shadow-md z-10">
                            KELAS 10-11
                        </div>
                    </div>
                    <div class="p-6 flex-grow flex flex-col">
                        <h4 class="text-2xl font-bold mb-4 font-heading text-center text-gray-800 group-hover:text-brand transition">SMA Reguler</h4>
                        <div class="space-y-3 text-sm text-gray-600 flex-grow">
                            <div class="flex items-center"><i class="fas fa-check-circle text-brand mr-3"></i> MTK, Fisika, Bio, Ekonomi</div>
                            <div class="flex items-center"><i class="fas fa-check-circle text-brand mr-3"></i> B. Inggris, B. Indo, IPS</div>
                            <div class="flex items-center"><i class="fas fa-check-circle text-brand mr-3"></i> PR Tuntas & Tambahan Gratis</div>
                            <div class="flex items-center font-bold text-gray-800 bg-brand/10 p-2 rounded mt-2"><i class="fas fa-comments text-brand mr-3"></i> Konsultasi Orang Tua</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden flex flex-col group border-t-4 border-brand lg:col-span-3 lg:w-2/3 lg:mx-auto" data-aos="zoom-in-up" data-aos-delay="400">
                    <div class="flex flex-col md:flex-row h-full relative">
                        <div class="md:w-1/2 relative h-64 md:h-auto bg-gray-200 overflow-hidden">
                             <img class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700" src="{{ asset ('landing-page/assets/img/portfolio/3.png') }}" alt="SMA 12" />
                             <div class="absolute inset-0 bg-gradient-to-r from-black/0 to-black/10"></div>
                        </div>
                        <div class="p-8 md:w-1/2 flex flex-col justify-center relative"> 
                            <div class="absolute top-0 left-0 bg-brand text-white text-sm font-bold px-4 py-2 rounded-br-xl shadow-md">
                                KELAS 12 PEJUANG PTN
                            </div>
                        
                            <h4 class="text-2xl font-bold mb-2 font-heading text-gray-800 mt-6 md:mt-0 group-hover:text-brand transition">Program Akhir SMA & Alumni</h4>
                            <p class="text-gray-500 mb-6 text-sm">Fokus total menembus PTN impian.</p>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-gray-600 mb-6">
                                <div>
                                    <h6 class="font-bold text-brand mb-1">Mata Pelajaran:</h6>
                                    <ul class="space-y-1">
                                        <li><i class="fas fa-check text-xs mr-1 text-gray-400"></i> MTK, Fisika, Biologi, Kimia</li>
                                        <li><i class="fas fa-check text-xs mr-1 text-gray-400"></i> Ekonomi, B.Inggris, B.Indo</li>
                                    </ul>
                                </div>
                                <div>
                                    <h6 class="font-bold text-brand mb-1">Persiapan UTBK:</h6>
                                    <ul class="space-y-1">
                                        <li><i class="fas fa-check text-xs mr-1 text-gray-400"></i> TPS & Literasi</li>
                                        <li><i class="fas fa-check text-xs mr-1 text-gray-400"></i> Penalaran Matematika</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 border-l-4 border-l-brand">
                                <span class="font-bold text-gray-800 text-sm block mb-2">Program Khusus Tersedia:</span>
                                <div class="flex flex-wrap gap-2">
                                    <span class="px-3 py-1 bg-white rounded-full text-xs font-bold border shadow-sm text-gray-600">KEDINASAN</span>
                                    <span class="px-3 py-1 bg-white rounded-full text-xs font-bold border shadow-sm text-gray-600">KEDOKTERAN (Intensif)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    
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