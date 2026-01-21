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

    {{-- HEADER HALAMAN --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <div class="flex items-center gap-4 w-full md:w-auto">
            <div id="dashboard-toggle" class="toggle lg:hidden cursor-pointer p-2 rounded-md hover:bg-gray-200 transition duration-300">
                <div class="hamburger-lines"><span></span><span></span><span></span></div>
            </div>
            <div>
                <h1 class="text-2xl font-bold font-heading text-gray-800">Hasil Ujian Siswa</h1>
                <p class="text-xs text-gray-500">Monitoring nilai dan indikasi kecurangan</p>
            </div>
        </div>

        <div class="flex items-center gap-6 w-full md:w-auto justify-end">
            <div class="flex items-center gap-3 pl-0 md:pl-6 md:border-l border-gray-200 shrink-0">
                <div class="text-right hidden sm:block">
                    <span class="block text-sm font-bold text-gray-700">{{ Auth::user()->name ?? 'Guru' }}</span>
                    <span class="block text-xs text-[#ffc800] font-semibold">Guru Pengampu</span>
                </div>
                <div class="relative">
                    <img src="{{ asset('assets/imgs/customer01.jpg') }}" alt="Profile" 
                         class="w-10 h-10 rounded-full object-cover border-2 border-white shadow-md">
                </div>
            </div>
        </div>
    </div>

    <div class="animate-[fadeIn_0.5s_ease-out]">
        
        {{-- TOMBOL KEMBALI & INFO UJIAN --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6 flex flex-col md:flex-row justify-between items-center gap-6">
            
            <div class="flex flex-col gap-1 w-full md:w-auto">
                <a href="{{ route('ujian.index') }}" class="text-gray-400 hover:text-[#ffc800] font-bold text-xs flex items-center gap-2 mb-2 transition">
                    <i class="fas fa-arrow-left"></i> Kembali ke Bank Soal
                </a>
                <h2 class="text-xl font-bold text-gray-800">{{ $ujian->nama_ujian }}</h2>
                <div class="flex items-center gap-3 text-sm text-gray-500">
                    <span class="bg-blue-50 text-blue-600 px-2 py-0.5 rounded text-xs font-bold">{{ $ujian->mapel }}</span>
                    <span>Kelas {{ $ujian->kelas }}</span>
                </div>
            </div>

            <div class="flex gap-4 md:border-l md:pl-6 w-full md:w-auto justify-between md:justify-end">
                <div class="text-right">
                    <span class="block text-xs text-gray-400 font-bold uppercase tracking-wider">Total Peserta</span>
                    <span class="text-2xl font-bold text-gray-800">{{ $hasils->count() }}</span>
                </div>
                <div class="text-right">
                    <span class="block text-xs text-gray-400 font-bold uppercase tracking-wider">Rata-rata</span>
                    <span class="text-2xl font-bold text-[#ffc800]">{{ number_format($hasils->avg('skor'), 1) }}</span>
                </div>
            </div>
        </div>

        {{-- ALERT SUKSES RESET --}}
        @if(session('success'))
            <div class="mb-6 bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-xl shadow-sm flex items-center justify-between animate-pulse">
                <div class="flex items-center gap-3">
                    <i class="fas fa-check-circle text-lg"></i>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900"><i class="fas fa-times"></i></button>
            </div>
        @endif

        {{-- TABEL HASIL --}}
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            
            <div class="hidden md:grid grid-cols-12 gap-4 bg-gray-50 px-6 py-4 border-b border-gray-200 text-xs font-bold text-gray-500 uppercase tracking-wider">
                <div class="col-span-1 text-center">No</div>
                <div class="col-span-3">Nama Siswa</div>
                <div class="col-span-2">Waktu Selesai</div>
                <div class="col-span-2 text-center">Pelanggaran</div>
                <div class="col-span-2 text-center">Status & Skor</div>
                <div class="col-span-2 text-center">Aksi</div>
            </div>

            <div class="divide-y divide-gray-100">
                @forelse($hasils as $hasil)
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 px-6 py-4 items-center hover:bg-yellow-50/30 transition duration-200 group">
                        
                        {{-- NO --}}
                        <div class="col-span-1 text-center hidden md:block font-bold text-gray-400">
                            {{ $loop->iteration }}
                        </div>

                        {{-- NAMA SISWA --}}
                        <div class="col-span-12 md:col-span-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gray-100 border border-gray-200 flex items-center justify-center text-gray-500 font-bold shrink-0">
                                    {{ substr($hasil->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800 text-sm">{{ $hasil->user->name }}</h4>
                                    <span class="text-xs text-gray-400">{{ $hasil->user->email }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- WAKTU SELESAI --}}
                        <div class="col-span-6 md:col-span-2 mt-2 md:mt-0">
                            <div class="text-xs text-gray-500 md:hidden mb-1">Waktu Selesai</div>
                            <span class="text-sm font-medium text-gray-600">
                                <i class="far fa-clock text-xs mr-1"></i> {{ $hasil->updated_at->format('d M H:i') }}
                            </span>
                        </div>

                        {{-- PELANGGARAN --}}
                        <div class="col-span-6 md:col-span-2 text-left md:text-center mt-2 md:mt-0">
                            <div class="text-xs text-gray-500 md:hidden mb-1">Pelanggaran</div>
                            @if($hasil->peringatan > 0)
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-lg bg-red-50 border border-red-100 text-red-600 text-xs font-bold animate-pulse">
                                    <i class="fas fa-exclamation-triangle"></i> {{ $hasil->peringatan }}x
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-lg bg-green-50 text-green-600 text-xs font-bold opacity-70">
                                    <i class="fas fa-check-circle"></i> Bersih
                                </span>
                            @endif
                        </div>

                        {{-- STATUS & SKOR --}}
                        <div class="col-span-12 md:col-span-2 text-center mt-2 md:mt-0">
                            <div class="text-xs text-gray-500 md:hidden mb-1">Skor Akhir</div>
                            <div class="flex flex-col items-center">
                                <span class="text-xl font-extrabold {{ $hasil->skor >= 70 ? 'text-green-600' : 'text-red-500' }}">
                                    {{ number_format($hasil->skor, 0) }}
                                </span>
                                @if($hasil->selesai == 1)
                                    <span class="text-[10px] uppercase font-bold text-gray-400">Selesai</span>
                                @else
                                    <span class="text-[10px] uppercase font-bold text-yellow-600">Mengerjakan</span>
                                @endif
                            </div>
                        </div>

                        {{-- AKSI (RESET) --}}
                        <div class="col-span-12 md:col-span-2 flex justify-start md:justify-center gap-2 mt-3 md:mt-0 border-t md:border-t-0 border-gray-100 pt-3 md:pt-0">
                            <form action="{{ route('hasil.reset', $hasil->id) }}" method="POST" class="w-full md:w-auto">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                    class="w-full md:w-auto px-4 py-2 bg-white border border-gray-200 text-gray-500 rounded-lg hover:bg-red-50 hover:text-red-600 hover:border-red-200 transition shadow-sm flex items-center justify-center gap-2 text-xs font-bold"
                                    onclick="return confirm('PERINGATAN GURU:\n\nReset ujian siswa ini?\nSemua jawaban dan nilai akan dihapus permanen.\nSiswa harus mengerjakan ulang dari awal.')" 
                                    title="Reset Ujian Siswa">
                                    <i class="fas fa-redo-alt"></i> Reset Ujian
                                </button>
                            </form>
                        </div>

                    </div>
                @empty
                    <div class="p-10 text-center flex flex-col items-center justify-center">
                        <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4 text-gray-300">
                            <i class="fas fa-user-clock text-3xl"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-600">Belum Ada Hasil</h3>
                        <p class="text-gray-400 text-sm">Belum ada siswa yang mengerjakan ujian ini.</p>
                    </div>
                @endforelse
            </div>
            
        </div>
    </div>

</div>

@endsection