@extends('belajar')

@section('content')

<style>
    .hamburger-lines span { display: block; width: 24px; height: 3px; margin-bottom: 5px; position: relative; background-color: #374151; border-radius: 3px; z-index: 1; transform-origin: 4px 0px; transition: transform 0.5s cubic-bezier(0.77,0.2,0.05,1.0), background 0.5s cubic-bezier(0.77,0.2,0.05,1.0), opacity 0.55s ease; }
    .hamburger-lines span:first-child { transform-origin: 0% 0%; }
    .hamburger-lines span:nth-last-child(2) { transform-origin: 0% 100%; }
    .toggle.active .hamburger-lines span { opacity: 1; transform: rotate(45deg) translate(2px, -3px); background-color: #ffc800; }
    .toggle.active .hamburger-lines span:nth-last-child(2) { opacity: 0; transform: rotate(0deg) scale(0.2, 0.2); }
    .toggle.active .hamburger-lines span:nth-last-child(1) { transform: rotate(-45deg) translate(2px, 3px); }
</style>

<div class="min-h-screen bg-gray-50 p-4 md:p-8">

    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <div class="flex items-center gap-4 w-full md:w-auto">
            <div id="dashboard-toggle" class="toggle lg:hidden cursor-pointer p-2 rounded-md hover:bg-gray-200 transition duration-300">
                <div class="hamburger-lines"><span></span><span></span><span></span></div>
            </div>
            <div>
                <h1 class="text-2xl font-bold font-heading text-gray-800">Detail Ujian</h1>
                <p class="text-xs text-gray-500">Kelola soal dan informasi ujian</p>
            </div>
        </div>
        
        <div class="flex items-center gap-6 w-full md:w-auto justify-end">
            <div class="flex items-center gap-3 pl-0 md:pl-6 md:border-l border-gray-200 shrink-0">
                <div class="text-right hidden sm:block">
                    <span class="block text-sm font-bold text-gray-700">{{ Auth::user()->name ?? 'Guru' }}</span>
                    <span class="block text-xs text-[#ffc800] font-semibold">Administrator</span>
                </div>
                <div class="relative">
                    <img src="{{ asset('assets/imgs/customer01.jpg') }}" alt="Profile" class="w-10 h-10 rounded-full object-cover border-2 border-white shadow-md">
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8 animate-[fadeIn_0.5s_ease-out]">
        
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-lg border-l-4 border-[#ffc800] p-6 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-yellow-50 rounded-full blur-2xl translate-x-10 -translate-y-10"></div>
                
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 relative z-10">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">{{ $ujian->nama_ujian }}</h2>
                        <span class="inline-block mt-1 px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-bold">
                            {{ $ujian->mapel }} &bull; Kelas {{ $ujian->kelas }}
                        </span>
                    </div>
                    <div class="mt-4 md:mt-0 text-right">
                        <p class="text-xs text-gray-500 uppercase tracking-wide font-bold">Total Soal</p>
                        <p class="text-3xl font-bold text-[#ffc800]">{{ $jumlahSoal }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 border-t border-gray-100 pt-4 relative z-10">
                    <div>
                        <p class="text-xs text-gray-400">Waktu Mulai</p>
                        <p class="text-sm font-semibold text-gray-700">
                            {{ $ujian->waktu_mulai ? $ujian->waktu_mulai->format('d M Y, H:i') : '-' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Waktu Selesai</p>
                        <p class="text-sm font-semibold text-gray-700">
                            {{ $ujian->waktu_selesai ? $ujian->waktu_selesai->format('d M Y, H:i') : '-' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-1 flex flex-col gap-4">
            <a href="{{ route('ujian.index') }}" class="flex items-center justify-center gap-2 w-full py-3 bg-white border border-gray-200 text-gray-600 rounded-xl font-bold hover:bg-gray-50 transition shadow-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            
            <a href="{{ route('soal.create', $ujian->id) }}" class="flex items-center justify-center gap-2 w-full py-3 bg-[#ffc800] text-white rounded-xl font-bold shadow-lg hover:bg-yellow-500 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300">
                <i class="fas fa-plus-circle"></i> Tambah Soal Manual
            </a>

            <form action="{{ route('soal.import.excel', $ujian->id) }}" method="POST" enctype="multipart/form-data" class="w-full">
                @csrf
                <input type="file" name="file" id="importExcel" accept=".csv,.xlsx,.xls" hidden onchange="this.form.submit()">
                <label for="importExcel" class="cursor-pointer flex items-center justify-center gap-2 w-full py-3 bg-green-600 text-white rounded-xl font-bold shadow-md hover:bg-green-700 transition hover:-translate-y-0.5">
                    <i class="fas fa-file-excel"></i> Import dari Excel
                </label>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-xl shadow-sm flex items-center animate-pulse">
            <i class="fas fa-check-circle mr-3 text-lg"></i>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <div class="space-y-6">
        <h3 class="text-lg font-bold text-gray-800 border-l-4 border-gray-800 pl-3">Daftar Pertanyaan</h3>

        @forelse($ujian->soals as $index => $soal)
            <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300 group">
                
                <div class="bg-gray-50 px-6 py-3 border-b border-gray-100 flex justify-between items-center">
                    <span class="bg-gray-800 text-white text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                        No. {{ $index + 1 }}
                    </span>
                    
                    <div class="flex items-center gap-2 opacity-100 md:opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        <a href="{{ route('soal.edit', [$ujian->id, $soal->id]) }}" class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition" title="Edit">
                            <i class="fas fa-edit text-xs"></i>
                        </a>
                        <form action="{{ route('soal.destroy', [$ujian->id, $soal->id]) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-8 h-8 rounded-lg bg-red-100 text-red-600 flex items-center justify-center hover:bg-red-600 hover:text-white transition" onclick="return confirm('Yakin hapus soal ini?')" title="Hapus">
                                <i class="fas fa-trash text-xs"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="p-6">
                    <div class="text-gray-800 text-lg font-medium mb-6 leading-relaxed">
                        {!! $soal->pertanyaan !!}
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-start gap-3 p-3 rounded-xl border transition {{ $soal->jawaban_benar == 'A' ? 'bg-green-50 border-green-200' : 'bg-gray-50 border-transparent' }}">
                            <div class="w-8 h-8 rounded-full {{ $soal->jawaban_benar == 'A' ? 'bg-green-500 text-white border-green-500' : 'bg-white text-gray-500 border-gray-200' }} border font-bold flex items-center justify-center shrink-0 shadow-sm transition">A</div>
                            <div class="text-gray-600 text-sm mt-1">{!! $soal->opsi_a !!}</div>
                        </div>

                        <div class="flex items-start gap-3 p-3 rounded-xl border transition {{ $soal->jawaban_benar == 'B' ? 'bg-green-50 border-green-200' : 'bg-gray-50 border-transparent' }}">
                            <div class="w-8 h-8 rounded-full {{ $soal->jawaban_benar == 'B' ? 'bg-green-500 text-white border-green-500' : 'bg-white text-gray-500 border-gray-200' }} border font-bold flex items-center justify-center shrink-0 shadow-sm transition">B</div>
                            <div class="text-gray-600 text-sm mt-1">{!! $soal->opsi_b !!}</div>
                        </div>

                        <div class="flex items-start gap-3 p-3 rounded-xl border transition {{ $soal->jawaban_benar == 'C' ? 'bg-green-50 border-green-200' : 'bg-gray-50 border-transparent' }}">
                            <div class="w-8 h-8 rounded-full {{ $soal->jawaban_benar == 'C' ? 'bg-green-500 text-white border-green-500' : 'bg-white text-gray-500 border-gray-200' }} border font-bold flex items-center justify-center shrink-0 shadow-sm transition">C</div>
                            <div class="text-gray-600 text-sm mt-1">{!! $soal->opsi_c !!}</div>
                        </div>

                        <div class="flex items-start gap-3 p-3 rounded-xl border transition {{ $soal->jawaban_benar == 'D' ? 'bg-green-50 border-green-200' : 'bg-gray-50 border-transparent' }}">
                            <div class="w-8 h-8 rounded-full {{ $soal->jawaban_benar == 'D' ? 'bg-green-500 text-white border-green-500' : 'bg-white text-gray-500 border-gray-200' }} border font-bold flex items-center justify-center shrink-0 shadow-sm transition">D</div>
                            <div class="text-gray-600 text-sm mt-1">{!! $soal->opsi_d !!}</div>
                        </div>
                    </div>

                    @if($soal->jawaban_benar)
                    <div class="mt-4 pt-4 border-t border-gray-100 text-right">
                        <span class="inline-flex items-center gap-1 text-xs font-bold text-green-600 bg-green-50 px-3 py-1 rounded-full">
                            <i class="fas fa-check"></i> Kunci: {{ $soal->jawaban_benar }}
                        </span>
                    </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center animate-[fadeIn_0.5s_ease-out]">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
                    <i class="fas fa-clipboard-list text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-700 mb-2">Belum Ada Soal</h3>
                <p class="text-gray-500 mb-6 max-w-md mx-auto">Ujian ini belum memiliki soal. Silakan tambah manual atau import.</p>
                <a href="{{ route('soal.create', $ujian->id) }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-[#ffc800] text-white rounded-xl font-bold shadow-lg hover:bg-yellow-500 transition">
                    <i class="fas fa-plus"></i> Tambah Soal
                </a>
            </div>
        @endforelse
    </div>

    @if(method_exists($ujian->soals, 'links'))
    <div class="mt-8">
        {{ $ujian->soals->links() }}
    </div>
    @endif

</div>

@endsection