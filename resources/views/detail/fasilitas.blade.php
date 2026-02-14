@extends('about')
@section('content')

    <section class="py-24 bg-white" id="services">
        
        <div class="container mx-auto px-4">
            <div class="text-center mb-16 max-w-3xl mx-auto">
                <h2 class="text-4xl font-extrabold uppercase mb-4 text-gray-800 font-heading">Fasilitas <span class="text-brand">Premium</span></h2>
                <p class="text-lg text-gray-500 font-light leading-relaxed">
                    Di ONMAI, kami menciptakan suasana bimbel yang <span class="text-brand font-bold">cozy</span> dan nyaman, agar belajar tidak lagi membosankan.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="group relative bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-brand/30">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-brand/10 rounded-bl-full rounded-tr-2xl transition-all duration-300 group-hover:bg-brand/20"></div>
                    
                    <div class="relative z-10 flex justify-center mb-6">
                        <div class="w-56 h-56 rounded-xl bg-gray-50 flex items-center justify-center border-4 border-white shadow-md group-hover:scale-105 transition duration-300 overflow-hidden">
                             <img src="{{ asset('landing-page/assets/img/img3.png') }}" class="w-full h-full object-cover" alt="Ruang Belajar">
                        </div>
                    </div>
                    <div class="text-center relative z-10">
                        <h4 class="text-2xl font-bold mb-3 font-heading text-gray-800 group-hover:text-brand transition">Ruang Belajar</h4>
                        <p class="text-gray-600 leading-relaxed">Full AC, Free WiFi kecepatan tinggi, dan Full Furnished untuk kenyamanan maksimal.</p>
                    </div>
                </div>
    
                <div class="group relative bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-brand/30"> 
                    <div class="absolute top-0 right-0 w-24 h-24 bg-brand/10 rounded-bl-full rounded-tr-2xl transition-all duration-300 group-hover:bg-brand/20"></div>
                    
                    <div class="relative z-10 flex justify-center mb-6">
                        <div class="w-56 h-56 rounded-xl bg-gray-50 flex items-center justify-center border-4 border-white shadow-md group-hover:scale-105 transition duration-300 overflow-hidden">
                             <img src="{{ asset('landing-page/assets/img/img13.jpeg') }}" class="w-full h-full object-cover" alt="Persiapan Ujian">
                        </div>
                    </div>
                    <div class="text-center relative z-10">
                        <h4 class="text-2xl font-bold mb-3 font-heading text-gray-800 group-hover:text-brand transition">Persiapan Ujian</h4>
                        <p class="text-gray-600 leading-relaxed">Program intensif TKA, UTBK, UTS, UAS, hingga Ulangan Harian.</p>
                    </div>
                </div>
    
                <div class="group relative bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-brand/30">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-brand/10 rounded-bl-full rounded-tr-2xl transition-all duration-300 group-hover:bg-brand/20"></div>
                    
                    <div class="relative z-10 flex justify-center mb-6">
                        <div class="w-56 h-56 rounded-xl bg-gray-50 flex items-center justify-center border-4 border-white shadow-md group-hover:scale-105 transition duration-300 overflow-hidden">
                             <img src="{{ asset('landing-page/assets/img/img5.png') }}" class="w-full h-full object-cover" alt="Ruang Depan">
                        </div>
                    </div>
                    <div class="text-center relative z-10">
                        <h4 class="text-2xl font-bold mb-3 font-heading text-gray-800 group-hover:text-brand transition">Ruang Depan</h4>
                        <p class="text-gray-600 leading-relaxed">Lobby tunggu yang nyaman dengan sofa empuk dan area kantin mini.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection