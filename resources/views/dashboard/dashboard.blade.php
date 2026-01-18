@extends('belajar')

@section('content')
<style>
    /* Konfigurasi Garis Tiga */
    .hamburger-lines span {
        display: block; 
        width: 24px; 
        height: 3px; 
        margin-bottom: 5px;
        position: relative; 
        background-color: #1f2937; /* Gray-800 */
        border-radius: 3px;
        z-index: 1; 
        transform-origin: 4px 0px;
        transition: transform 0.5s cubic-bezier(0.77,0.2,0.05,1.0),
                    background 0.5s cubic-bezier(0.77,0.2,0.05,1.0),
                    opacity 0.55s ease;
    }
    
    .hamburger-lines span:first-child { transform-origin: 0% 0%; }
    .hamburger-lines span:nth-last-child(2) { transform-origin: 0% 100%; }
</style>

<div class="min-h-screen bg-gray-50 p-4 md:p-8">
    
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <div class="flex items-center gap-4 w-full md:w-auto">
            
            <div class="toggle lg:hidden cursor-pointer p-2 rounded-md hover:bg-gray-200 transition duration-300">
                <div class="hamburger-lines">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>

            <div>
                <h1 class="text-2xl font-bold font-heading text-gray-800">Dashboard</h1>
                <p class="text-xs text-gray-500">Overview aktivitas bimbingan belajar</p>
            </div>
        </div>

        <div class="flex items-center gap-4 w-full md:w-auto justify-between md:justify-end">
    
            <div class="relative w-full md:w-auto mr-2 md:mr-0">
                <input type="text" placeholder="Cari data..." 
                    class="pl-10 pr-4 py-2 rounded-full border border-gray-300 focus:border-[#ffc800] focus:ring-2 focus:ring-[#ffc800]/20 outline-none text-sm w-full md:w-64 transition">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400 text-xs"></i>
            </div>
        
            <div class="flex items-center gap-3 pl-0 md:pl-6 md:border-l border-gray-200 shrink-0">
                
                <div class="text-right hidden sm:block">
                    <span class="block text-sm font-bold text-gray-700">{{ Auth::user()->name ?? 'Ibu Guru' }}</span>
                    <span class="block text-xs text-[#ffc800] font-semibold">Administrator</span>
                </div>
                
                <div class="relative">
                    <img src="{{ asset('assets/imgs/customer01.jpg') }}" alt="Profile" 
                        class="w-10 h-10 rounded-full object-cover border-2 border-white shadow-md">
                    <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></div>
                </div>
            </div>
        
        </div>
    </div>

    <div class="relative bg-white rounded-3xl shadow-lg overflow-hidden mb-8 border border-gray-100 animate-[fadeIn_0.5s_ease-out]">
        <div class="absolute top-0 right-0 w-64 h-64 bg-[#ffc800]/10 rounded-full blur-3xl translate-x-10 -translate-y-10"></div>
        
        <div class="flex flex-col md:flex-row items-center relative z-10">
            <div class="p-8 md:p-12 md:w-2/3">
                <span class="inline-block px-3 py-1 bg-yellow-100 text-[#ffc800] rounded-full text-xs font-bold mb-4 tracking-wide uppercase">
                    Panel Guru
                </span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 font-heading mb-4">
                    Selamat Datang di <span class="text-[#ffc800]">ONMAI!</span>
                </h2>
                <p class="text-gray-500 mb-8 leading-relaxed max-w-lg">
                    Kelola materi, pantau perkembangan siswa, dan buat jadwal ujian dengan mudah dalam satu panel terintegrasi.
                </p>
                <div class="flex gap-3">
                    <button class="px-6 py-3 bg-[#ffc800] text-white rounded-xl font-bold shadow-lg shadow-yellow-500/30 hover:bg-yellow-500 transition transform hover:-translate-y-1">
                        <i class="fas fa-plus-circle mr-2"></i> Buat Ujian
                    </button>
                    <button class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition">
                        Lihat Laporan
                    </button>
                </div>
            </div>

            <div class="md:w-1/3 h-64 md:h-80 relative">
                <img src="{{ asset('landing-page/assets/img/img7.png') }}" 
                    class="w-full h-full object-contain object-bottom transform md:scale-110 origin-bottom" 
                    alt="Guru Illustration">
            </div>
        </div>
    </div>

</div>
@endsection