<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Siswa | ONMAI Admin</title>
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,300,700" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-body text-gray-800 flex h-screen overflow-hidden relative">

    {{-- SIDEBAR OVERLAY --}}
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-20 hidden transition-opacity opacity-0 lg:hidden"></div>

    {{-- SIDEBAR --}}
    <aside id="sidebar" class="w-64 bg-darker text-white fixed inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 flex flex-col shadow-2xl z-30 transition-transform duration-300 ease-in-out">
        <div class="h-20 flex items-center justify-center border-b border-gray-800 shrink-0">
            <a href="#" class="flex items-center gap-2 text-xl font-bold font-heading text-brand tracking-widest">
                <i class="fas fa-crown"></i> ADMIN
            </a>
        </div>

        <nav class="flex-1 overflow-y-auto py-4">
            <ul class="space-y-1">
                <li><a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-6 py-3 text-gray-400 hover:bg-gray-800 hover:text-brand transition"><i class="fas fa-tachometer-alt w-5 text-center"></i> Dashboard</a></li>
                <li><a href="{{ route('guru.index') }}" class="flex items-center gap-3 px-6 py-3 text-gray-400 hover:bg-gray-800 hover:text-brand transition"><i class="fas fa-user-tie w-5 text-center"></i> Data Guru</a></li>
                <li><a href="{{ route('siswa.index') }}" class="flex items-center gap-3 px-6 py-3 text-gray-400 hover:bg-gray-800 hover:text-brand transition"><i class="fas fa-user-graduate w-5 text-center"></i> Data Siswa</a></li>
                <li><a href="{{ route('admin.ujian.index') }}" class="flex items-center gap-3 px-6 py-3 bg-gray-800 border-r-4 border-brand text-white transition"><i class="fas fa-file-alt w-5 text-center"></i> Bank Soal</a></li>
            </ul>
        </nav>
        
        <div class="p-4 border-t border-gray-800 shrink-0">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-red-600/20 text-red-500 hover:bg-red-600 hover:text-white rounded-lg transition duration-300 font-bold text-sm">
                    <i class="fas fa-sign-out-alt"></i> LOGOUT
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN CONTENT --}}
    <div class="flex-1 flex flex-col h-screen overflow-hidden w-full">
        <header class="h-20 bg-white shadow-sm flex items-center justify-between px-4 md:px-8 border-b-4 border-brand z-10 shrink-0">
            <button id="sidebar-toggle" class="md:hidden text-gray-600 text-2xl focus:outline-none hover:text-brand transition">
                <i class="fas fa-bars"></i>
            </button>
            <h2 class="text-xl font-bold font-heading text-gray-800">Monitoring Hasil</h2>
            <div class="flex items-center gap-4">
                <div class="text-right hidden sm:block">
                    <span class="block text-sm font-bold text-gray-800">{{ Auth::user()->name }}</span>
                    <span class="block text-xs text-brand font-bold uppercase tracking-wider">Super Admin</span>
                </div>
                <img src="{{ asset('assets/imgs/customer01.jpg') }}" alt="Profile" class="w-10 h-10 rounded-full border-2 border-gray-200 shadow-sm object-cover">
            </div>
        </header>

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-4 md:p-8">
            <div class="max-w-6xl mx-auto animate-[fadeIn_0.5s_ease-out]">
                
                {{-- Flash Message (Sukses Reset) --}}
                @if(session('success'))
                <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm flex items-center justify-between animate-[fadeIn_0.3s]">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900"><i class="fas fa-times"></i></button>
                </div>
                @endif

                {{-- Header & Statistik Singkat --}}
                <div class="flex flex-col md:flex-row justify-between items-end mb-6 gap-6 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <div>
                        <a href="{{ route('admin.ujian.show', $ujian->id) }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-brand font-bold transition mb-3 text-sm">
                            <i class="fas fa-arrow-left"></i> Kembali ke Detail Ujian
                        </a>
                        <h1 class="text-2xl font-bold font-heading text-gray-800">{{ $ujian->nama_ujian }}</h1>
                        <p class="text-gray-500 text-sm mt-1">{{ $ujian->mapel }} | Kelas {{ $ujian->kelas }}</p>
                    </div>

                    <div class="flex gap-6 divide-x divide-gray-100">
                        <div class="text-right px-4">
                            <span class="block text-[10px] text-gray-400 uppercase font-bold tracking-widest">Total Peserta</span>
                            <span class="text-3xl font-bold text-gray-800">{{ $hasils->count() }}</span>
                        </div>
                        <div class="text-right px-4">
                            <span class="block text-[10px] text-gray-400 uppercase font-bold tracking-widest">Rata-rata Skor</span>
                            <span class="text-3xl font-bold text-brand">{{ number_format($hasils->avg('skor'), 1) }}</span>
                        </div>
                    </div>
                </div>

                {{-- Tabel Nilai --}}
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                        <h3 class="font-bold text-gray-800 flex items-center gap-2">
                            <i class="fas fa-list-ol text-brand"></i> Daftar Hasil Siswa
                        </h3>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-500 font-bold tracking-wider">
                                    <th class="px-6 py-4 w-16 text-center">No</th>
                                    <th class="px-6 py-4">Nama Siswa</th>
                                    <th class="px-6 py-4">Waktu Selesai</th>
                                    <th class="px-6 py-4 text-center">Pelanggaran</th>
                                    <th class="px-6 py-4 text-center">Status</th>
                                    <th class="px-6 py-4 text-center">Skor Akhir</th>
                                    <th class="px-6 py-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($hasils as $index => $hasil)
                                <tr class="hover:bg-yellow-50/20 transition group">
                                    <td class="px-6 py-4 font-bold text-gray-400 text-center">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-gray-100 border border-gray-200 flex items-center justify-center text-brand font-bold text-xs">
                                                {{ substr($hasil->user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <span class="block font-bold text-gray-700">{{ $hasil->user->name }}</span>
                                                <span class="text-xs text-gray-400">{{ $hasil->user->email }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 font-medium">
                                        {{ $hasil->updated_at->format('d M H:i') }}
                                    </td>
                                    
                                    {{-- Kolom Pelanggaran (Anti-Cheat Monitor) --}}
                                    <td class="px-6 py-4 text-center">
                                        @if($hasil->peringatan > 0)
                                            <div class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-red-50 border border-red-100 text-red-600 text-xs font-bold" title="Siswa keluar dari tab ujian">
                                                <i class="fas fa-exclamation-triangle animate-pulse"></i> {{ $hasil->peringatan }}x
                                            </div>
                                        @else
                                            <span class="text-green-500 text-xs font-bold opacity-50"><i class="fas fa-check"></i> Bersih</span>
                                        @endif
                                    </td>

                                    {{-- Kolom Status --}}
                                    <td class="px-6 py-4 text-center">
                                        @if($hasil->selesai == 1)
                                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold border border-green-200">Selesai</span>
                                        @else
                                            <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-bold border border-yellow-200 animate-pulse">Mengerjakan</span>
                                        @endif
                                    </td>

                                    {{-- Kolom Skor --}}
                                    <td class="px-6 py-4 text-center">
                                        <span class="text-lg font-extrabold font-heading {{ $hasil->skor >= 70 ? 'text-green-600' : 'text-red-500' }}">
                                            {{ number_format($hasil->skor, 0) }}
                                        </span>
                                    </td>

                                    {{-- Kolom Aksi (Reset) --}}
                                    <td class="px-6 py-4 text-center">
                                        <form action="{{ route('admin.hasil.reset', $hasil->id) }}" method="POST" onsubmit="return confirm('PERINGATAN ADMIN:\n\nApakah Anda yakin ingin me-reset ujian siswa ini?\n\n1. Semua jawaban siswa akan DIHAPUS.\n2. Nilai akan hilang.\n3. Siswa harus mengerjakan ulang dari awal.\n\nLanjutkan?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:text-red-600 hover:bg-red-50 transition" title="Reset Ujian & Hapus Data">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-16 text-center">
                                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
                                            <i class="fas fa-clipboard-list text-3xl"></i>
                                        </div>
                                        <h4 class="text-gray-500 font-bold">Belum Ada Data</h4>
                                        <p class="text-gray-400 text-sm">Belum ada siswa yang mengerjakan ujian ini.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
    </div>

    {{-- SCRIPT SIDEBAR --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.getElementById('sidebar-toggle');
            const overlay = document.getElementById('sidebar-overlay');

            function toggleSidebar() {
                if (sidebar.classList.contains('-translate-x-full')) {
                    sidebar.classList.remove('-translate-x-full');
                    sidebar.classList.add('translate-x-0');
                    overlay.classList.remove('hidden');
                    setTimeout(() => { overlay.classList.remove('opacity-0'); overlay.classList.add('opacity-100'); }, 10);
                } else {
                    sidebar.classList.remove('translate-x-0');
                    sidebar.classList.add('-translate-x-full');
                    overlay.classList.remove('opacity-100');
                    overlay.classList.add('opacity-0');
                    setTimeout(() => { overlay.classList.add('hidden'); }, 300);
                }
            }
            if (toggleBtn) toggleBtn.addEventListener('click', (e) => { e.stopPropagation(); toggleSidebar(); });
            if (overlay) overlay.addEventListener('click', toggleSidebar);
        });
    </script>
</body>
</html>