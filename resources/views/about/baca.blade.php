@extends('about')

@section('content')

<section class="pb-20 bg-gray-50 relative overflow-hidden" id="portfolio" style="padding-top: 180px;">
        
        <div class="absolute top-0 left-0 w-full h-full pointer-events-none opacity-10">
    
            <i class="fas fa-book absolute text-8xl md:text-9xl text-gray-400" 
               style="top: 40px; left: 20px; transform: rotate(-15deg);"></i>
        
            <i class="fas fa-graduation-cap absolute text-8xl md:text-9xl text-gray-400" 
               style="bottom: 40px; right: 20px; transform: rotate(15deg);"></i>
        
        </div>
    <div class="container mx-auto px-4 md:px-8">
        <div class="flex flex-col lg:flex-row items-center gap-16">

            <!-- KOLOM KIRI (TEKS) -->
            <div class="w-full lg:w-1/2" data-aos="fade-right">
                <div class="space-y-6 mb-10">
                    <!-- Item 1 -->
                    <div class="flex items-start gap-4">
                        <div class="min-w-[40px] h-10 flex items-center justify-center 
                                    rounded-full bg-blue-600 text-white font-semibold shadow-md">
                            1
                        </div>
                        <p class="text-gray-600 leading-relaxed">
                            Peringkat 1 UN SMP se-Provinsi Bengkulu berhasil dipertahankan selama
                            tiga tahun berturut-turut (2014, 2015, dan 2016).
                        </p>
                    </div>

                    <!-- Item 2 -->
                    <div class="flex items-start gap-4">
                        <div class="min-w-[40px] h-10 flex items-center justify-center 
                                    rounded-full bg-blue-600 text-white font-semibold shadow-md">
                            2
                        </div>
                        <p class="text-gray-600 leading-relaxed">
                            Peringkat 3 UNBK SMP se-Provinsi Bengkulu berhasil diraih pada tahun 2019.
                        </p>
                    </div>

                    <!-- Item 3 -->
                    <div class="flex items-start gap-4">
                        <div class="min-w-[40px] h-10 flex items-center justify-center 
                                    rounded-full bg-blue-600 text-white font-semibold shadow-md">
                            3
                        </div>
                        <p class="text-gray-600 leading-relaxed">
                            Sempurna Matematika: Pada UNBK 2019, siswa ONMAI meraih skor maksimal (100)
                            pada mata pelajaran Matematika.
                        </p>
                    </div>
                </div>
                <p class="text-gray-600 leading-relaxed mb-4">
                    Keberhasilan ONMAI tidak hanya di tingkat sekolah menengah.
                    Tahun ini, ONMAI juga sukses mengantarkan alumni menuju
                    Universitas Bengkulu (UNIB) pada program studi favorit:
                </p>

                <ul class="grid grid-cols-2 gap-2 text-gray-700 font-medium mb-6">
                    <li>✔ Fakultas Kedokteran</li>
                    <li>✔ Fakultas Hukum</li>
                    <li>✔ Manajemen</li>
                    <li>✔ Kehutanan</li>
                </ul>

                <p class="text-gray-600 leading-relaxed">
                    Pencapaian ini mempertegas posisi ONMAI sebagai lembaga
                    bimbingan belajar terpercaya dalam mengawal kesuksesan
                    siswa hingga ke Perguruan Tinggi Negeri impian.
                </p>
            </div>

            <!-- KOLOM KANAN (GAMBAR) -->
            <div class="w-full lg:w-1/2" data-aos="fade-left">

                <div class="text-center mb-6">
                    <h3 class="text-2xl md:text-3xl font-bold text-gray-800">
                        Spanduk Prestasi ONMAI
                    </h3>
                </div>

                <img 
                    src="{{ asset('landing-page/assets/img/img15.jpeg') }}"
                    alt="Spanduk Prestasi ONMAI"
                    class="w-full rounded-2xl shadow-xl hover:scale-105 transition duration-500"
                >

            </div>

        </div>
    </div>

</section>

@endsection