@extends('mandiri')

@section('title', 'Daftar Ujian - ONMAI')

@section('content')
    <div class="min-h-screen bg-gray-50 py-28 px-4 sm:px-6 lg:px-8">
        
        <div class="container mx-auto max-w-7xl">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 font-heading mb-4">
                    Daftar Mata Pelajaran
                </h2>
                <div class="w-24 h-1.5 bg-[#ffc800] mx-auto rounded-full"></div>
                <p class="mt-4 text-lg text-gray-600">Pilih mata pelajaran untuk memulai ujian mandiri.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($mandiri as $item)
                    <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-[#ffc800] relative flex flex-col transform hover:-translate-y-2">
                        
                        <div class="absolute top-0 right-0 w-24 h-24 bg-yellow-50 rounded-bl-full -mr-6 -mt-6 transition-all group-hover:bg-[#ffc800]/20"></div>

                        <div class="p-8 flex-grow flex flex-col items-center text-center relative z-10">
                            <div class="w-20 h-20 bg-yellow-50 rounded-full flex items-center justify-center text-[#ffc800] mb-6 shadow-sm border border-yellow-100 group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-book-open text-3xl"></i>
                            </div>

                            <h3 class="text-xl font-bold text-gray-800 mb-3 font-heading group-hover:text-[#ffc800] transition-colors line-clamp-2">
                                {{ $item->nama_mapel }}
                            </h3>
                            
                            <div class="w-10 h-1 bg-gray-100 my-4 group-hover:bg-[#ffc800]/50 transition-colors"></div>

                            <div class="mt-auto w-full">
                                <a href="{{ route('index.lihat-soal', $item->id) }}" class="group/btn relative w-full inline-flex items-center justify-center gap-2 px-6 py-3 bg-[#ffc800] text-white font-bold rounded-xl overflow-hidden shadow-md transition-all duration-300 hover:scale-[1.02] hover:shadow-lg active:scale-95">
                                    <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/30 to-transparent -translate-x-[150%] skew-x-12 transition-transform duration-1000 group-hover/btn:translate-x-[150%] ease-in-out"></div>
                                    <span class="relative z-10">Lihat Soal</span>
                                    <i class="fas fa-arrow-right relative z-10 transition-transform duration-300 group-hover/btn:translate-x-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($mandiri->isEmpty())
                <div class="text-center py-20">
                    <div class="inline-block p-6 rounded-full bg-gray-100 mb-4">
                        <i class="fas fa-inbox text-4xl text-gray-400"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-600">Belum ada mata pelajaran tersedia.</h3>
                </div>
            @endif

        </div>
    </div>
@endsection