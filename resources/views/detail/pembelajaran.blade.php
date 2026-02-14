@extends('about')
@section('content')



<section class="py-24 bg-white" id="services">
    <!--div class="container mx-auto px-4">
        <form action="" method="POST" enctype="multipart/form-data">
            
            <input type="file" name="video">
            <button type="submit"></button>
        </form-->

            <div class="text-center mb-16 max-w-3xl mx-auto">
                <h2 class="text-4xl font-extrabold uppercase mb-4 text-gray-800 font-heading">
                    Pembelajaran<span class="text-brand">Seru</span>
                </h2>
                <p class="text-lg text-gray-500 font-light leading-relaxed">
                    Pembelajaran di ONMAI diselenggarakan dengan metode yang menyenangkan dan interaktif, sehingga siswa tidak merasa bosan dan semangat belajar.
                </p>
            </div>

            <!-- Galeri Foto -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">

            <!-- Video -->
            <div class="overflow-hidden rounded-2xl shadow-lg group">
                <video class="w-full h-72 object-cover transition duration-500 group-hover:scale-105" controls>
                    <source src="{{ asset('landing-page/assets/vid/vid1.mp4') }}" type="video/mp4">
                </video>
            </div>

            <!-- Video -->
            <div class="overflow-hidden rounded-2xl shadow-lg group">
                <video class="w-full h-72 object-cover transition duration-500 group-hover:scale-105" controls>
                    <source src="{{ asset('landing-page/assets/vid/vid6.mp4') }}" type="video/mp4">
                </video>
            </div>

             <!-- Video -->
            <div class="overflow-hidden rounded-2xl shadow-lg group">
                <video class="w-full h-72 object-cover transition duration-500 group-hover:scale-105" controls>
                    <source src="{{ asset('landing-page/assets/vid/vid3.mp4') }}" type="video/mp4">
                </video>
            </div>
             <!-- Video -->
            <div class="overflow-hidden rounded-2xl shadow-lg group">
                <video class="w-full h-72 object-cover transition duration-500 group-hover:scale-105" controls>
                    <source src="{{ asset('landing-page/assets/vid/vid5.mp4') }}" type="video/mp4">
                </video>
            </div>
             <!-- Video -->
            <div class="overflow-hidden rounded-2xl shadow-lg group">
                <video class="w-full h-72 object-cover transition duration-500 group-hover:scale-105" controls>
                    <source src="{{ asset('landing-page/assets/vid/vid4.mp4') }}" type="video/mp4">
                </video>
            </div>
             <!-- Video -->
            <div class="overflow-hidden rounded-2xl shadow-lg group">
                <video class="w-full h-72 object-cover transition duration-500 group-hover:scale-105" controls>
                    <source src="{{ asset('landing-page/assets/vid/vid8.mp4') }}" type="video/mp4">
                </video>
            </div>

            <!-- Gambar -->
            <!--div class="overflow-hidden rounded-2xl shadow-lg group">
                <img src=""
                    class="w-full h-72 object-cover group-hover:scale-110 transition duration-500">
            </di-->
        

    </div>
</section>

@endsection