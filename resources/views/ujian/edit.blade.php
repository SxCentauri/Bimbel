@extends('belajar')

@section('content')

<style>
    .hamburger-lines span { display: block; width: 24px; height: 3px; margin-bottom: 5px; position: relative; background-color: #374151; border-radius: 3px; z-index: 1; transform-origin: 4px 0px; transition: transform 0.5s cubic-bezier(0.77,0.2,0.05,1.0), background 0.5s cubic-bezier(0.77,0.2,0.05,1.0), opacity 0.55s ease; }
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
                <h1 class="text-2xl font-bold font-heading text-gray-800">Edit Ujian</h1>
                <p class="text-xs text-gray-500">Perbarui data ujian: <span class="font-bold text-[#ffc800]">{{ $ujian->nama_ujian }}</span></p>
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

    <div class="max-w-4xl mx-auto animate-[fadeIn_0.5s_ease-out]">
        
        <div class="mb-6">
            <a href="{{ route('ujian.index') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-[#ffc800] font-bold transition">
                <i class="fas fa-arrow-left"></i> Batal & Kembali
            </a>
        </div>

        <form action="{{ route('ujian.update', $ujian) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-2xl shadow-lg border-t-4 border-[#ffc800] overflow-hidden">
                
                <div class="bg-gray-50 px-8 py-5 border-b border-gray-100 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center shadow-sm">
                        <i class="fas fa-edit"></i>
                    </div>
                    <h2 class="text-lg font-bold text-gray-800">Form Perubahan Data</h2>
                </div>

                <div class="p-8 space-y-8">

                    <div>
                        <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4 border-b border-gray-100 pb-2">Informasi Dasar</h3>
                        
                        <div class="space-y-5">
                            <div>
                                <label for="nama_ujian" class="block text-sm font-bold text-gray-700 mb-2">Nama Ujian <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400"><i class="fas fa-heading"></i></span>
                                    <input type="text" name="nama_ujian" id="nama_ujian" required value="{{ old('nama_ujian', $ujian->nama_ujian) }}"
                                        class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-300 focus:border-[#ffc800] focus:ring-2 focus:ring-[#ffc800]/20 outline-none transition shadow-sm">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="mapel" class="block text-sm font-bold text-gray-700 mb-2">Mata Pelajaran <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400"><i class="fas fa-book"></i></span>
                                        <select name="mapel" id="mapel" class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-300 focus:border-[#ffc800] focus:ring-2 focus:ring-[#ffc800]/20 outline-none transition shadow-sm bg-white appearance-none">
                                            @foreach(['Matematika','Bahasa Indonesia','Kimia','Fisika','Biologi','Bahasa Inggris'] as $mapel)
                                                <option value="{{ $mapel }}" {{ $ujian->mapel == $mapel ? 'selected' : '' }}>{{ $mapel }}</option>
                                            @endforeach
                                        </select>
                                        <span class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-gray-400"><i class="fas fa-chevron-down text-xs"></i></span>
                                    </div>
                                </div>

                                <div>
                                    <label for="kelas" class="block text-sm font-bold text-gray-700 mb-2">Kelas <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400"><i class="fas fa-users"></i></span>
                                        <select name="kelas" id="kelas" class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-300 focus:border-[#ffc800] focus:ring-2 focus:ring-[#ffc800]/20 outline-none transition shadow-sm bg-white appearance-none">
                                            @foreach(['X','XI','XII'] as $kelas)
                                                <option value="{{ $kelas }}" {{ $ujian->kelas == $kelas ? 'selected' : '' }}>{{ $kelas }}</option>
                                            @endforeach
                                        </select>
                                        <span class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-gray-400"><i class="fas fa-chevron-down text-xs"></i></span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label for="deskripsi" class="block text-sm font-bold text-gray-700 mb-2">Deskripsi / Catatan</label>
                                <textarea name="deskripsi" id="deskripsi" rows="3"
                                    class="w-full p-4 rounded-xl border border-gray-300 focus:border-[#ffc800] focus:ring-2 focus:ring-[#ffc800]/20 outline-none transition shadow-sm">{{ old('deskripsi', $ujian->deskripsi) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4 border-b border-gray-100 pb-2">Jadwal Pelaksanaan</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="waktu_mulai" class="block text-sm font-bold text-gray-700 mb-2">Waktu Mulai</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400"><i class="far fa-calendar-alt"></i></span>
                                    <input type="datetime-local" name="waktu_mulai" id="waktu_mulai"
                                        value="{{ old('waktu_mulai', $ujian->waktu_mulai?->format('Y-m-d\TH:i')) }}"
                                        class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-300 focus:border-[#ffc800] focus:ring-2 focus:ring-[#ffc800]/20 outline-none transition shadow-sm text-gray-600">
                                </div>
                            </div>

                            <div>
                                <label for="waktu_selesai" class="block text-sm font-bold text-gray-700 mb-2">Waktu Selesai</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400"><i class="far fa-clock"></i></span>
                                    <input type="datetime-local" name="waktu_selesai" id="waktu_selesai"
                                        value="{{ old('waktu_selesai', $ujian->waktu_selesai?->format('Y-m-d\TH:i')) }}"
                                        class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-300 focus:border-[#ffc800] focus:ring-2 focus:ring-[#ffc800]/20 outline-none transition shadow-sm text-gray-600">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="bg-gray-50 px-8 py-5 border-t border-gray-100 flex justify-end gap-3">
                    <a href="{{ route('ujian.index') }}" class="px-6 py-3 rounded-xl font-bold text-gray-500 bg-white border border-gray-200 hover:bg-gray-100 transition shadow-sm text-center">
                        Batal
                    </a>
                    <button type="submit" class="px-8 py-3 bg-[#ffc800] text-white rounded-xl font-bold shadow-lg hover:bg-yellow-500 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-2">
                        <i class="fas fa-sync-alt"></i> Update Data
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>

@endsection