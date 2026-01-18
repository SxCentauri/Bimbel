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
                <h1 class="text-2xl font-bold font-heading text-gray-800">Belajar Mandiri</h1>
                <p class="text-xs text-gray-500">Kelola bank soal dan materi pelajaran</p>
            </div>
        </div>

        <div class="flex items-center gap-6 w-full md:w-auto justify-end">
            <div class="flex items-center gap-3 pl-0 md:pl-6 md:border-l border-gray-200 shrink-0">
                <div class="text-right sm:block">
                    <span class="block text-sm font-bold text-gray-700">{{ Auth::user()->name ?? 'Pengguna' }}</span>
                    <span class="block text-xs text-[#ffc800] font-semibold">Administrator</span>
                </div>
                <div class="relative">
                    <img src="{{ asset('assets/imgs/customer01.jpg') }}" alt="Profile" 
                         class="w-10 h-10 rounded-full object-cover border-2 border-white shadow-md">
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-2 animate-[fadeIn_0.5s_ease-out]">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                
                <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                    <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-layer-group text-[#ffc800]"></i> Daftar Mata Pelajaran
                    </h2>

                    @if(session('success'))
                        <div class="mb-4 bg-green-50 border-l-4 border-green-500 text-green-700 p-3 rounded text-sm flex items-center shadow-sm animate-pulse">
                            <i class="fas fa-check-circle mr-2"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('mandiri.store') }}" method="POST" class="flex gap-2">
                        @csrf
                        <div class="relative flex-grow">
                            <input type="text" name="nama_mapel" placeholder="Masukkan Nama Mata Pelajaran Baru..." required
                                class="w-full pl-4 pr-4 py-3 rounded-xl border border-gray-300 focus:border-[#ffc800] focus:ring-2 focus:ring-[#ffc800]/20 outline-none text-sm transition shadow-sm">
                        </div>
                        <button type="submit" class="bg-[#ffc800] text-white px-6 py-3 rounded-xl font-bold text-sm shadow-md hover:bg-yellow-500 hover:shadow-lg transition transform hover:-translate-y-0.5 flex items-center gap-2">
                            <i class="fas fa-plus"></i> <span class="hidden sm:inline">Tambah</span>
                        </button>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100 text-gray-500 text-xs uppercase tracking-wider">
                                <th class="p-4 font-bold border-b border-gray-200">Nama Mata Pelajaran</th>
                                <th class="p-4 font-bold border-b border-gray-200 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($mandiris as $mandiri)
                                <tr class="hover:bg-yellow-50/30 transition duration-200 group">
                                    <td class="p-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-500 flex items-center justify-center shadow-sm">
                                                <i class="fas fa-book"></i>
                                            </div>
                                            <span class="font-semibold text-gray-700">{{ $mandiri->nama_mapel }}</span>
                                        </div>
                                    </td>
                                    <td class="p-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('mandiri.show', $mandiri->id) }}" 
                                               class="w-8 h-8 rounded-full bg-green-100 text-green-600 flex items-center justify-center hover:bg-green-600 hover:text-white transition shadow-sm" 
                                               title="Tambah Soal">
                                                <i class="fas fa-plus text-xs"></i>
                                            </a>

                                            <form action="{{ route('mandiri.destroy', $mandiri->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="w-8 h-8 rounded-full bg-red-100 text-red-600 flex items-center justify-center hover:bg-red-600 hover:text-white transition shadow-sm"
                                                        onclick="return confirm('Yakin hapus mapel ini beserta semua soalnya?')"
                                                        title="Hapus Mapel">
                                                    <i class="fas fa-trash text-xs"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="p-10 text-center">
                                        <div class="flex flex-col items-center justify-center text-gray-400">
                                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                                                <i class="fas fa-folder-open text-2xl"></i>
                                            </div>
                                            <p class="font-bold text-gray-600">Belum ada Mata Pelajaran</p>
                                            <p class="text-xs">Silakan tambahkan mata pelajaran baru di atas.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="lg:col-span-1 animate-[fadeIn_0.8s_ease-out]">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 sticky top-8">
                <h2 class="text-lg font-bold text-gray-800 mb-6 flex items-center justify-between">
                    <span>Pengajar Profesional</span>
                    <i class="fas fa-chalkboard-teacher text-gray-300"></i>
                </h2>

                <div class="space-y-4">
                    <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-gray-50 transition border border-transparent hover:border-gray-100 cursor-default group">
                        <div class="relative">
                            <div class="w-12 h-12 rounded-full bg-gray-200 overflow-hidden border-2 border-white shadow-md group-hover:scale-110 transition-transform duration-300">
                                <img src="{{ asset('assets/imgs/customer01.jpg') }}" alt="Guru 1" class="w-full h-full object-cover">
                            </div>
                            <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></div>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm group-hover:text-[#ffc800] transition">Budi Santoso, S.Pd</h4>
                            <p class="text-xs text-gray-500">Matematika & Fisika</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-gray-50 transition border border-transparent hover:border-gray-100 cursor-default group">
                        <div class="relative">
                            <div class="w-12 h-12 rounded-full bg-gray-200 overflow-hidden border-2 border-white shadow-md group-hover:scale-110 transition-transform duration-300">
                                <div class="w-full h-full bg-indigo-500 flex items-center justify-center text-white font-bold">S</div>
                            </div>
                            <div class="absolute bottom-0 right-0 w-3 h-3 bg-gray-400 rounded-full border-2 border-white"></div>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm group-hover:text-[#ffc800] transition">Siti Aminah, M.Kom</h4>
                            <p class="text-xs text-gray-500">Informatika</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-gray-50 transition border border-transparent hover:border-gray-100 cursor-default group">
                        <div class="relative">
                            <div class="w-12 h-12 rounded-full bg-gray-200 overflow-hidden border-2 border-white shadow-md group-hover:scale-110 transition-transform duration-300">
                                <div class="w-full h-full bg-pink-500 flex items-center justify-center text-white font-bold">R</div>
                            </div>
                            <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></div>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm group-hover:text-[#ffc800] transition">Rina Wati, S.Pd</h4>
                            <p class="text-xs text-gray-500">Bahasa Inggris</p>
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-gray-100 text-center">
                    <a href="#" class="text-xs font-bold text-[#ffc800] hover:text-yellow-600 transition uppercase tracking-wide">
                        Lihat Semua Pengajar
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection