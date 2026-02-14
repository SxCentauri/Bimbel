@extends('about')
@section('content')

<section class="py-24 bg-white" id="services">
    <div class="container mx-auto px-4">

        <div class="text-center mb-16 max-w-3xl mx-auto">
            <h2 class="text-4xl font-extrabold uppercase mb-4 text-gray-800 font-heading">
                Pengajar<span class="text-brand">Profesional</span>
            </h2>
            <p class="text-lg text-gray-500 font-light leading-relaxed">
                Semua pengajar kami adalah profesional dan berpengalaman dalam bidang pendidikan dan sudah tersertifikasi PPG.
            </p>
        </div>

        <!-- Galeri Foto -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            
            <div class="overflow-hidden rounded-2xl shadow-lg group">
                <img src="{{ asset('landing-page/assets/img/img11.jpeg') }}"
                     class="w-full h-72 object-cover transform group-hover:scale-110 transition duration-500"
                     alt="Fasilitas 1">
            </div>

            <div class="overflow-hidden rounded-2xl shadow-lg group">
                <img src="{{ asset('landing-page/assets/img/img16.jpeg') }}"
                     class="w-full h-72 object-cover transform group-hover:scale-110 transition duration-500"
                     alt="Fasilitas 2">
            </div>

            <div class="overflow-hidden rounded-2xl shadow-lg group">
                <img src="{{ asset('landing-page/assets/img/img12.jpeg') }}"
                     class="w-full h-72 object-cover transform group-hover:scale-110 transition duration-500"
                     alt="Fasilitas 3">
            </div>

        </div>
    </div>
</section>

@endsection