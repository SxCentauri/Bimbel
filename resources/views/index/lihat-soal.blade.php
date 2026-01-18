@extends('index')

@section('content')

<style>
    .prose img { max-width: 100%; height: auto; border-radius: 8px; margin-top: 0.5rem; margin-bottom: 0.5rem; }
    .prose p { margin-bottom: 0.5rem; }
</style>

<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6">
    <div class="max-w-4xl mx-auto animate-[fadeIn_0.5s_ease-out]">

        <div class="bg-white rounded-2xl shadow-lg border-l-4 border-[#ffc800] p-6 mb-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h6 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Mata Pelajaran</h6>
                <h1 class="text-2xl font-bold font-heading text-gray-800">{{ $mandiri->nama_mapel }}</h1>
            </div>
            
            <a href="{{ url()->previous() }}" class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg text-sm font-bold hover:bg-gray-200 transition flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="space-y-6">
            @forelse ($mapel as $index => $soal)
                <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    
                    <div class="bg-gray-50/50 px-6 py-5 border-b border-gray-100 flex items-start gap-4">
                        <span class="shrink-0 w-8 h-8 flex items-center justify-center bg-gray-800 text-[#ffc800] font-bold rounded-lg text-sm shadow-sm">
                            {{ $index + 1 }}
                        </span>

                        <div class="prose text-gray-800 font-medium text-base leading-relaxed w-full">
                            {!! $soal->pertanyaan !!}
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            
                            <div class="flex items-start gap-3 p-3 rounded-xl border border-gray-100 bg-white hover:border-[#ffc800]/50 hover:bg-yellow-50/30 transition group">
                                <span class="shrink-0 w-6 h-6 flex items-center justify-center rounded-full bg-gray-100 text-gray-500 text-xs font-bold group-hover:bg-[#ffc800] group-hover:text-white transition">A</span>
                                <div class="text-sm text-gray-600 group-hover:text-gray-900">{!! $soal->a !!}</div>
                            </div>

                            <div class="flex items-start gap-3 p-3 rounded-xl border border-gray-100 bg-white hover:border-[#ffc800]/50 hover:bg-yellow-50/30 transition group">
                                <span class="shrink-0 w-6 h-6 flex items-center justify-center rounded-full bg-gray-100 text-gray-500 text-xs font-bold group-hover:bg-[#ffc800] group-hover:text-white transition">B</span>
                                <div class="text-sm text-gray-600 group-hover:text-gray-900">{!! $soal->b !!}</div>
                            </div>

                            <div class="flex items-start gap-3 p-3 rounded-xl border border-gray-100 bg-white hover:border-[#ffc800]/50 hover:bg-yellow-50/30 transition group">
                                <span class="shrink-0 w-6 h-6 flex items-center justify-center rounded-full bg-gray-100 text-gray-500 text-xs font-bold group-hover:bg-[#ffc800] group-hover:text-white transition">C</span>
                                <div class="text-sm text-gray-600 group-hover:text-gray-900">{!! $soal->c !!}</div>
                            </div>

                            <div class="flex items-start gap-3 p-3 rounded-xl border border-gray-100 bg-white hover:border-[#ffc800]/50 hover:bg-yellow-50/30 transition group">
                                <span class="shrink-0 w-6 h-6 flex items-center justify-center rounded-full bg-gray-100 text-gray-500 text-xs font-bold group-hover:bg-[#ffc800] group-hover:text-white transition">D</span>
                                <div class="text-sm text-gray-600 group-hover:text-gray-900">{!! $soal->d !!}</div>
                            </div>

                        </div>
                    </div>

                </div>
            @empty
                <div class="text-center py-20">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
                        <i class="fas fa-folder-open text-3xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-600">Belum Ada Soal</h3>
                    <p class="text-gray-400 text-sm">Soal untuk mata pelajaran ini belum ditambahkan.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

@endsection