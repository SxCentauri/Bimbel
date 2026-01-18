<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan Mandiri | ONMAI</title>

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,300,700" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: '#ffc800',
                        dark: '#1f2937',
                    },
                    fontFamily: {
                        heading: ['Montserrat', 'sans-serif'],
                        body: ['Roboto Slab', 'serif'],
                    }
                }
            }
        }
    </script>

    <style>
        /* CSS Khusus untuk Mode Cetak (Print) */
        @media print {
            body { background-color: white; }
            .no-print { display: none !important; }
            .page { 
                box-shadow: none; 
                margin: 0; 
                width: 100%; 
                padding: 0;
            }
            .page-break { page-break-inside: avoid; }
        }

        /* Style untuk Konten Soal (agar gambar tidak melebar) */
        .prose img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-top: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body class="bg-gray-100 font-body text-gray-800">

    <div class="no-print sticky top-0 z-50 bg-dark text-white shadow-lg border-b-4 border-brand">
        <div class="container mx-auto px-4 py-3 flex flex-col md:flex-row justify-between items-center gap-4">
            
            <div class="flex items-center gap-6 w-full md:w-auto justify-between md:justify-start">
                <h2 class="text-xl font-bold font-heading tracking-wide text-brand">Latihan Mandiri</h2>
                
                <a href="{{ route('home') }}" class="flex items-center gap-2 text-gray-300 hover:text-white transition group text-sm font-bold uppercase">
                    <ion-icon name="home-outline" class="text-lg group-hover:scale-110 transition-transform"></ion-icon>
                    <span>Home</span>
                </a>
            </div>

            <form action="/mandiri/latihan/import" method="POST" enctype="multipart/form-data" class="flex items-center gap-3 w-full md:w-auto bg-gray-800 p-1.5 rounded-lg border border-gray-700">
                @csrf
                
                <div class="relative group flex-grow">
                    <input type="file" name="file" id="file-upload" class="hidden" required onchange="document.getElementById('file-label').innerText = this.files[0].name">
                    <label for="file-upload" class="cursor-pointer block text-xs text-gray-400 truncate max-w-[150px] md:max-w-[200px] px-3 py-2 border border-dashed border-gray-600 rounded hover:border-brand hover:text-brand transition" id="file-label">
                        <i class="fas fa-file-excel mr-1"></i> Pilih File Excel...
                    </label>
                </div>

                <button type="submit" class="bg-brand text-dark font-bold text-xs px-4 py-2.5 rounded hover:bg-yellow-500 transition shadow-lg flex items-center gap-2 shrink-0">
                    <ion-icon name="cloud-upload-outline" class="text-lg"></ion-icon> Upload
                </button>
            </form>
        </div>
    </div>

    <div class="page max-w-[210mm] mx-auto bg-white min-h-screen my-8 p-8 md:p-12 shadow-2xl rounded-xl relative">
        
        <div class="border-b-2 border-black pb-4 mb-8 text-center">
            <h1 class="text-2xl font-bold font-heading uppercase text-black">Lembar Latihan Soal</h1>
            <p class="text-sm text-gray-600 mt-1">Mata Pelajaran: Pengetahuan Umum</p>
        </div>

        @isset($soals)
            <div class="space-y-8">
                @foreach($soals as $i => $soal)
                    <div class="page-break relative pl-8 md:pl-10">
                        
                        <span class="absolute left-0 top-0 w-6 h-6 md:w-8 md:h-8 bg-dark text-brand text-xs md:text-sm font-bold flex items-center justify-center rounded-full shadow-sm">
                            {{ $i+1 }}
                        </span>

                        <div class="prose max-w-none text-base md:text-lg mb-4 font-medium text-gray-900">
                            {!! $soal['pertanyaan'] !!}
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-2 ml-2">
                            <div class="flex items-start gap-2">
                                <span class="font-bold text-gray-500 min-w-[20px]">A.</span>
                                <div class="text-gray-700">{!! $soal['a'] !!}</div>
                            </div>
                            
                            <div class="flex items-start gap-2">
                                <span class="font-bold text-gray-500 min-w-[20px]">B.</span>
                                <div class="text-gray-700">{!! $soal['b'] !!}</div>
                            </div>

                            <div class="flex items-start gap-2">
                                <span class="font-bold text-gray-500 min-w-[20px]">C.</span>
                                <div class="text-gray-700">{!! $soal['c'] !!}</div>
                            </div>

                            <div class="flex items-start gap-2">
                                <span class="font-bold text-gray-500 min-w-[20px]">D.</span>
                                <div class="text-gray-700">{!! $soal['d'] !!}</div>
                            </div>

                            @if(!empty($soal['e']))
                                <div class="flex items-start gap-2 md:col-span-2">
                                    <span class="font-bold text-gray-500 min-w-[20px]">E.</span>
                                    <div class="text-gray-700">{!! $soal['e'] !!}</div>
                                </div>
                            @endif
                        </div>

                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20 text-gray-400">
                <ion-icon name="document-text-outline" class="text-6xl mb-4"></ion-icon>
                <p>Belum ada soal yang diimport.</p>
                <p class="text-sm">Silakan upload file soal melalui panel di atas.</p>
            </div>
        @endisset

        <div class="mt-16 pt-4 border-t border-gray-300 text-center text-xs text-gray-400 italic">
            Dicetak dari Sistem Bimbel ONMAI
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>