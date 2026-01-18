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
            
            <div id="dashboard-toggle" class="toggle lg:hidden cursor-pointer p-2 rounded-md hover:bg-gray-200 transition duration-300" onclick="this.classList.toggle('active')">
                <div class="hamburger-lines">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
    
            <div>
                <h1 class="text-2xl font-bold font-heading text-gray-800">Manajemen Guru</h1>
                <p class="text-xs text-gray-500">Kelola data pengajar bimbel</p>
            </div>
        </div>
    
        <div class="flex items-center gap-6 w-full md:w-auto justify-end">
            
            <div class="flex items-center gap-3 pl-0 md:pl-6 md:border-l border-gray-200 shrink-0">
                
                <div class="text-right sm:block">
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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-1 animate-[fadeIn_0.5s_ease-out]">
            <div class="bg-white rounded-2xl shadow-lg border-t-4 border-[#ffc800] overflow-hidden sticky top-8">
                <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                    <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-user-plus text-[#ffc800]"></i> Tambah Pengajar
                    </h2>
                </div>
                
                <div class="p-6">
                    <form method="POST" action="{{ route('storeguru') }}" class="space-y-5">
                        @csrf

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1 ml-1">Nama Lengkap</label>
                            <div class="relative group">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400 group-focus-within:text-[#ffc800] transition"><i class="fas fa-user"></i></span>
                                <input type="text" name="name" required placeholder="Contoh: Budi Santoso"
                                    class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-300 focus:border-[#ffc800] focus:ring-2 focus:ring-[#ffc800]/20 outline-none text-sm transition bg-gray-50 focus:bg-white">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1 ml-1">Email Address</label>
                            <div class="relative group">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400 group-focus-within:text-[#ffc800] transition"><i class="fas fa-envelope"></i></span>
                                <input type="email" name="email" required placeholder="nama@email.com"
                                    class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-300 focus:border-[#ffc800] focus:ring-2 focus:ring-[#ffc800]/20 outline-none text-sm transition bg-gray-50 focus:bg-white">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1 ml-1">Password</label>
                            <div class="relative group">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400 group-focus-within:text-[#ffc800] transition"><i class="fas fa-lock"></i></span>
                                <input type="password" name="password" required placeholder="••••••••"
                                    class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-300 focus:border-[#ffc800] focus:ring-2 focus:ring-[#ffc800]/20 outline-none text-sm transition bg-gray-50 focus:bg-white">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1 ml-1">Konfirmasi Password</label>
                            <div class="relative group">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400 group-focus-within:text-[#ffc800] transition"><i class="fas fa-check-circle"></i></span>
                                <input type="password" name="password_confirmation" required placeholder="Ulangi password"
                                    class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-300 focus:border-[#ffc800] focus:ring-2 focus:ring-[#ffc800]/20 outline-none text-sm transition bg-gray-50 focus:bg-white">
                            </div>
                        </div>

                        <div class="pt-2 flex gap-3">
                            <button type="submit" class="flex-1 bg-[#ffc800] text-white py-2.5 rounded-xl font-bold text-sm shadow-md hover:bg-yellow-500 hover:shadow-lg transition transform hover:-translate-y-0.5">
                                <i class="fas fa-save mr-1"></i> Simpan
                            </button>
                            <a href="{{ route('dashboard') }}" class="flex-1 bg-gray-100 text-gray-600 py-2.5 rounded-xl font-bold text-sm text-center shadow-sm hover:bg-gray-200 transition">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 animate-[fadeIn_0.8s_ease-out]">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <h2 class="text-lg font-bold text-gray-800">Daftar Guru Terdaftar</h2>
                    <span class="bg-blue-100 text-blue-600 text-xs font-bold px-3 py-1 rounded-full">Total: {{ count($guru) }}</span>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100 text-gray-500 text-xs uppercase tracking-wider">
                                <th class="p-4 font-bold border-b border-gray-200 w-16 text-center">No</th>
                                <th class="p-4 font-bold border-b border-gray-200">Nama Lengkap</th>
                                <th class="p-4 font-bold border-b border-gray-200">Email Akun</th>
                                <th class="p-4 font-bold border-b border-gray-200 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($guru as $item)
                                <tr class="hover:bg-yellow-50/50 transition duration-200 group">
                                    <td class="p-4 text-center font-bold text-gray-400 group-hover:text-[#ffc800]">{{ $loop->iteration }}</td>
                                    <td class="p-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 font-bold text-xs">
                                                {{ substr($item->name, 0, 1) }}
                                            </div>
                                            <span class="font-semibold text-gray-700">{{ $item->name }}</span>
                                        </div>
                                    </td>
                                    <td class="p-4 text-gray-600 text-sm">{{ $item->email }}</td>
                                    <td class="p-4 text-center">
                                        <button class="text-gray-400 hover:text-[#ffc800] transition p-2" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-gray-400 hover:text-red-500 transition p-2" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-10 text-center">
                                        <div class="flex flex-col items-center justify-center text-gray-400">
                                            <i class="fas fa-users-slash text-4xl mb-3"></i>
                                            <p class="text-sm">Belum ada data guru yang ditambahkan.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="p-4 border-t border-gray-100 bg-gray-50 text-xs text-gray-500 flex justify-between items-center">
                    <span>Menampilkan semua data</span>
                    </div>
            </div>
        </div>

    </div>

</div>

@endsection