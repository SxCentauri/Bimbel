@extends('belajar')

@section('content')

<style>
    .hamburger-lines span {
        display: block; width: 24px; height: 3px; margin-bottom: 5px;
        position: relative; background-color: #374151; border-radius: 3px;
        z-index: 1; transform-origin: 4px 0px;
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
            <div id="dashboard-toggle" class="toggle lg:hidden cursor-pointer p-2 rounded-md hover:bg-gray-200 transition duration-300">
                <div class="hamburger-lines"><span></span><span></span><span></span></div>
            </div>
            <div>
                <h1 class="text-2xl font-bold font-heading text-gray-800">Bank Soal</h1>
                <p class="text-xs text-gray-500">Kelola pertanyaan untuk: <span class="font-bold text-[#ffc800]">{{ $mandiri->nama_mapel ?? 'Mata Pelajaran' }}</span></p>
            </div>
        </div>

        <div class="flex items-center gap-6 w-full md:w-auto justify-end">
            <div class="flex items-center gap-3 pl-0 md:pl-6 md:border-l border-gray-200 shrink-0">
                <div class="text-right hidden sm:block">
                    <span class="block text-sm font-bold text-gray-700">{{ Auth::user()->name ?? 'Admin' }}</span>
                    <span class="block text-xs text-[#ffc800] font-semibold">Administrator</span>
                </div>
                <div class="relative">
                    <img src="{{ asset('assets/imgs/customer01.jpg') }}" alt="Profile" 
                         class="w-10 h-10 rounded-full object-cover border-2 border-white shadow-md">
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4 animate-[fadeIn_0.5s_ease-out]">
        <a href="{{ route('mandiri.materi') }}" class="flex items-center gap-2 text-gray-500 hover:text-gray-800 transition font-bold text-sm bg-white px-4 py-2 rounded-xl shadow-sm border border-gray-200 hover:shadow-md">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

        @if(session('success'))
            <div class="flex-grow md:mx-4 w-full md:w-auto">
                <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-3 rounded-lg text-sm flex items-center shadow-sm">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <div class="flex items-center gap-3 w-full md:w-auto">
            <form action="{{ route('mapel.import', $mandiri->id) }}" method="POST" enctype="multipart/form-data" class="inline-block">
                @csrf
                <input type="file" name="file" id="importExcel" accept=".csv,.xlsx,.xls" hidden onchange="this.form.submit()">
                <label for="importExcel" class="cursor-pointer flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-xl font-bold text-sm shadow-md hover:bg-green-700 transition transform hover:-translate-y-0.5">
                    <i class="fas fa-file-excel"></i> Import Excel
                </label>
            </form>

            <a href="{{ route('mandiri.mapel', $mandiri->id) }}" class="flex items-center gap-2 px-4 py-2 bg-[#ffc800] text-white rounded-xl font-bold text-sm shadow-md hover:bg-yellow-500 transition transform hover:-translate-y-0.5">
                <i class="fas fa-plus"></i> Tambah Soal
            </a>
        </div>
    </div>

    <div class="space-y-6">
        @forelse($mandiri->mapels as $index => $mapel)
            <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300 relative group animate-[fadeIn_0.5s_ease-out]">
                
                <div class="bg-gray-50 px-6 py-3 border-b border-gray-100 flex justify-between items-center">
                    <span class="bg-[#ffc800] text-white text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                        No. {{ $index + 1 }}
                    </span>
                    
                    <div class="flex items-center gap-2 opacity-100 md:opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        <a href="{{ route('mapel.edit', [$mandiri->id, $mapel->id]) }}" class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition" title="Edit Soal">
                            <i class="fas fa-edit text-xs"></i>
                        </a>
                        <form action="{{ route('mapel.destroy', [$mandiri->id, $mapel->id]) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-8 h-8 rounded-lg bg-red-100 text-red-600 flex items-center justify-center hover:bg-red-600 hover:text-white transition" onclick="return confirm('Yakin hapus soal ini?')" title="Hapus Soal">
                                <i class="fas fa-trash text-xs"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="p-6">
                    <div class="text-gray-800 text-lg font-medium mb-6 leading-relaxed">
                        {!! $mapel->pertanyaan !!}
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-start gap-3 p-3 rounded-xl bg-gray-50 border border-transparent hover:border-[#ffc800]/50 transition">
                            <div class="w-8 h-8 rounded-full bg-white border border-gray-200 text-gray-500 font-bold flex items-center justify-center shrink-0 shadow-sm">A</div>
                            <div class="text-gray-600 text-sm mt-1">{!! $mapel->a !!}</div>
                        </div>

                        <div class="flex items-start gap-3 p-3 rounded-xl bg-gray-50 border border-transparent hover:border-[#ffc800]/50 transition">
                            <div class="w-8 h-8 rounded-full bg-white border border-gray-200 text-gray-500 font-bold flex items-center justify-center shrink-0 shadow-sm">B</div>
                            <div class="text-gray-600 text-sm mt-1">{!! $mapel->b !!}</div>
                        </div>

                        <div class="flex items-start gap-3 p-3 rounded-xl bg-gray-50 border border-transparent hover:border-[#ffc800]/50 transition">
                            <div class="w-8 h-8 rounded-full bg-white border border-gray-200 text-gray-500 font-bold flex items-center justify-center shrink-0 shadow-sm">C</div>
                            <div class="text-gray-600 text-sm mt-1">{!! $mapel->c !!}</div>
                        </div>

                        <div class="flex items-start gap-3 p-3 rounded-xl bg-gray-50 border border-transparent hover:border-[#ffc800]/50 transition">
                            <div class="w-8 h-8 rounded-full bg-white border border-gray-200 text-gray-500 font-bold flex items-center justify-center shrink-0 shadow-sm">D</div>
                            <div class="text-gray-600 text-sm mt-1">{!! $mapel->d !!}</div>
                        </div>
                    </div>
                    
                    <div class="mt-4 pt-4 border-t border-gray-100 text-xs text-gray-400 text-right">
                        Kunci Jawaban: <span class="font-bold text-green-600 uppercase">{{ $mapel->kunci_jawaban ?? '-' }}</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center animate-[fadeIn_0.5s_ease-out]">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
                    <i class="fas fa-clipboard-question text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-700 mb-2">Belum Ada Soal</h3>
                <p class="text-gray-500 mb-6 max-w-md mx-auto">Bank soal untuk mata pelajaran ini masih kosong. Silakan tambah manual atau import dari Excel.</p>
                <a href="{{ route('mandiri.mapel', $mandiri->id) }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-[#ffc800] text-white rounded-xl font-bold shadow-lg hover:bg-yellow-500 transition">
                    <i class="fas fa-plus"></i> Mulai Buat Soal
                </a>
            </div>
        @endforelse
    </div>

    @if(method_exists($mandiri->mapels, 'links'))
    <div class="mt-8">
        {{ $mandiri->mapels->links() }}
    </div>
    @endif

</div>

@endsection