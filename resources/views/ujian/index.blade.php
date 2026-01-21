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
                <h1 class="text-2xl font-bold font-heading text-gray-800">Manajemen Ujian</h1>
                <p class="text-xs text-gray-500">Kelola jadwal dan daftar ujian sekolah</p>
            </div>
        </div>

        <div class="flex items-center gap-6 w-full md:w-auto justify-end">
            <div class="flex items-center gap-3 pl-0 md:pl-6 md:border-l border-gray-200 shrink-0">
                <div class="text-right hidden sm:block">
                    <span class="block text-sm font-bold text-gray-700">{{ Auth::user()->name ?? 'Guru' }}</span>
                    <span class="block text-xs text-[#ffc800] font-semibold">Administrator</span>
                </div>
                <div class="relative">
                    <img src="{{ asset('assets/imgs/customer01.jpg') }}" alt="Profile" 
                         class="w-10 h-10 rounded-full object-cover border-2 border-white shadow-md">
                </div>
            </div>
        </div>
    </div>

    <div class="animate-[fadeIn_0.5s_ease-out]">
        
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-6 flex flex-col md:flex-row justify-between items-center gap-4">
            
            <a href="{{ route('ujian.create') }}" class="w-full md:w-auto px-6 py-3 bg-[#ffc800] text-white rounded-xl font-bold shadow-lg hover:bg-yellow-500 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-2">
                <i class="fas fa-plus"></i> Tambah Ujian Baru
            </a>

            <div class="relative w-full md:w-64">
                <input type="text" placeholder="Cari nama ujian..." 
                    class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 focus:border-[#ffc800] focus:ring-2 focus:ring-[#ffc800]/20 outline-none text-sm transition">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400 text-xs"></i>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-xl shadow-sm flex items-center animate-pulse">
                <i class="fas fa-check-circle mr-3 text-lg"></i>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            
            <div class="hidden md:grid grid-cols-12 gap-4 bg-gray-50 px-6 py-4 border-b border-gray-200 text-xs font-bold text-gray-500 uppercase tracking-wider">
                <div class="col-span-1 text-center">No</div>
                <div class="col-span-3">Nama Ujian</div>
                <div class="col-span-2">Mapel & Kelas</div>
                <div class="col-span-1 text-center">Soal</div>
                <div class="col-span-3">Jadwal Pelaksanaan</div>
                <div class="col-span-2 text-center">Aksi</div>
            </div>

            <div class="divide-y divide-gray-100">
                @forelse($ujians as $ujian)
                    @php
                        $now = \Carbon\Carbon::now();
                        $isActive = $ujian->waktu_mulai && $ujian->waktu_selesai && $now->between($ujian->waktu_mulai, $ujian->waktu_selesai);
                        $isFinished = $ujian->waktu_selesai && $now->gt($ujian->waktu_selesai);
                    @endphp

                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 px-6 py-4 items-center hover:bg-yellow-50/30 transition duration-200 group">
                        
                        <div class="col-span-1 text-center hidden md:block font-bold text-gray-400">
                            {{ $loop->iteration }}
                        </div>

                        <div class="col-span-12 md:col-span-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg {{ $isActive ? 'bg-green-100 text-green-600' : ($isFinished ? 'bg-gray-100 text-gray-400' : 'bg-blue-100 text-blue-600') }} flex items-center justify-center shrink-0">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800 text-sm group-hover:text-[#ffc800] transition">{{ $ujian->nama_ujian }}</h4>
                                    
                                    <div class="md:hidden mt-1">
                                        @if($isActive)
                                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-green-100 text-green-700">Sedang Berlangsung</span>
                                        @elseif($isFinished)
                                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-gray-100 text-gray-500">Selesai</span>
                                        @else
                                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-blue-100 text-blue-700">Terjadwal</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-span-6 md:col-span-2 mt-2 md:mt-0">
                            <div class="text-xs text-gray-500 md:hidden mb-1">Pelajaran</div>
                            <p class="text-sm font-semibold text-gray-700">{{ $ujian->mapel }}</p>
                            <span class="text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded font-bold">{{ $ujian->kelas }}</span>
                        </div>

                        <div class="col-span-6 md:col-span-1 text-left md:text-center mt-2 md:mt-0">
                            <div class="text-xs text-gray-500 md:hidden mb-1">Jml Soal</div>
                            <span class="text-sm font-bold text-gray-800 bg-gray-50 px-3 py-1 rounded-lg border border-gray-200">
                                {{ $ujian->soals_count }}
                            </span>
                        </div>

                        <div class="col-span-12 md:col-span-3 mt-2 md:mt-0">
                            <div class="text-xs text-gray-500 md:hidden mb-1">Waktu Pelaksanaan</div>
                            @if($ujian->waktu_mulai && $ujian->waktu_selesai)
                                <div class="flex flex-col text-sm text-gray-600">
                                    <span class="flex items-center gap-1"><i class="far fa-calendar-alt text-xs w-4"></i> {{ $ujian->waktu_mulai->format('d M Y') }}</span>
                                    <span class="flex items-center gap-1 text-xs text-gray-500"><i class="far fa-clock text-xs w-4"></i> {{ $ujian->waktu_mulai->format('H:i') }} - {{ $ujian->waktu_selesai->format('H:i') }}</span>
                                </div>
                            @else
                                <span class="text-xs text-red-500 italic flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> Belum Dijadwalkan</span>
                            @endif
                        </div>

                        <div class="col-span-12 md:col-span-2 flex justify-start md:justify-center gap-2 mt-3 md:mt-0 border-t md:border-t-0 border-gray-100 pt-3 md:pt-0">
                            
                            {{-- Tombol Kelola Soal --}}
                            <a href="{{ route('ujian.show', $ujian) }}" class="w-8 h-8 rounded-lg bg-green-100 text-green-600 flex items-center justify-center hover:bg-green-600 hover:text-white transition shadow-sm" title="Kelola Soal">
                                <i class="fas fa-list-ol text-xs"></i>
                            </a>

                            {{-- TOMBOL BARU: LIHAT NILAI --}}
                            <a href="{{ route('ujian.hasil', $ujian->id) }}" class="w-8 h-8 rounded-lg bg-purple-100 text-purple-600 flex items-center justify-center hover:bg-purple-600 hover:text-white transition shadow-sm" title="Lihat Nilai Siswa">
                                <i class="fas fa-poll text-xs"></i>
                            </a>

                            {{-- Tombol Edit --}}
                            <a href="{{ route('ujian.edit', $ujian) }}" class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition shadow-sm" title="Edit Data Ujian">
                                <i class="fas fa-edit text-xs"></i>
                            </a>

                            {{-- Tombol Hapus --}}
                            <form action="{{ route('ujian.destroy', $ujian->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-8 h-8 rounded-lg bg-red-100 text-red-600 flex items-center justify-center hover:bg-red-600 hover:text-white transition shadow-sm" onclick="return confirm('Yakin hapus ujian ini beserta semua soalnya?')" title="Hapus Ujian">
                                    <i class="fas fa-trash text-xs"></i>
                                </button>
                            </form>

                        </div>

                    </div>
                @empty
                    <div class="p-10 text-center flex flex-col items-center justify-center">
                        <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4 text-gray-300">
                            <i class="fas fa-folder-open text-3xl"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-600">Belum Ada Ujian</h3>
                        <p class="text-gray-400 text-sm mb-4">Silakan buat ujian baru untuk memulai.</p>
                        <a href="{{ route('ujian.create') }}" class="px-4 py-2 bg-[#ffc800] text-white rounded-lg text-sm font-bold shadow hover:bg-yellow-500">
                            + Buat Ujian
                        </a>
                    </div>
                @endforelse
            </div>
            
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                @if(method_exists($ujians, 'links'))
                    {{ $ujians->links() }}
                @else
                    <div class="flex justify-between items-center text-xs text-gray-500">
                        <span>Menampilkan {{ count($ujians) }} Data</span>
                        <div class="flex gap-1">
                            <button class="px-3 py-1 rounded bg-white border border-gray-300 hover:bg-gray-100" disabled>&laquo; Prev</button>
                            <button class="px-3 py-1 rounded bg-[#ffc800] text-white font-bold">1</button>
                            <button class="px-3 py-1 rounded bg-white border border-gray-300 hover:bg-gray-100">Next &raquo;</button>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>

</div>

@endsection