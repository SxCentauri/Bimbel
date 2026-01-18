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

    /* Custom Style untuk CKEditor agar sesuai tema */
    .ck-editor__editable_inline {
        min-height: 150px;
        border-bottom-left-radius: 0.75rem !important;
        border-bottom-right-radius: 0.75rem !important;
    }
    .ck-toolbar {
        border-top-left-radius: 0.75rem !important;
        border-top-right-radius: 0.75rem !important;
    }
</style>

<div class="min-h-screen bg-gray-50 p-4 md:p-8">

    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <div class="flex items-center gap-4 w-full md:w-auto">
            <div id="dashboard-toggle" class="toggle lg:hidden cursor-pointer p-2 rounded-md hover:bg-gray-200 transition duration-300">
                <div class="hamburger-lines"><span></span><span></span><span></span></div>
            </div>
            <div>
                <h1 class="text-2xl font-bold font-heading text-gray-800">Edit Soal</h1>
                <p class="text-xs text-gray-500">Perbarui pertanyaan dan pilihan jawaban</p>
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

    <div class="max-w-5xl mx-auto animate-[fadeIn_0.5s_ease-out]">
        
        <div class="mb-6">
            <a href="{{ route('mandiri.mapel', $mandiri->id) }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-[#ffc800] font-bold transition">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar Soal
            </a>
        </div>

        <form action="{{ route('mapel.update', [$mandiri->id, $mapel->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-2xl shadow-lg border-t-4 border-[#ffc800] overflow-hidden">
                
                <div class="bg-gray-50 px-8 py-4 border-b border-gray-100 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-yellow-100 text-[#ffc800] flex items-center justify-center shadow-sm">
                        <i class="fas fa-pencil-alt"></i>
                    </div>
                    <h2 class="text-lg font-bold text-gray-800">Form Editor Soal</h2>
                </div>

                <div class="p-8 space-y-8">
                    
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Pertanyaan / Soal</label>
                        <textarea id="editor-pertanyaan" name="pertanyaan">{{ $mapel->pertanyaan }}</textarea>
                    </div>

                    <div class="border-t border-gray-100 my-6"></div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-4">Pilihan Jawaban</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            
                            <div class="relative">
                                <span class="absolute -top-3 -left-3 w-8 h-8 rounded-full bg-[#ffc800] text-white font-bold flex items-center justify-center shadow-md z-10 border-2 border-white">A</span>
                                <textarea id="editor-a" name="a">{{ $mapel->a }}</textarea>
                            </div>

                            <div class="relative">
                                <span class="absolute -top-3 -left-3 w-8 h-8 rounded-full bg-[#ffc800] text-white font-bold flex items-center justify-center shadow-md z-10 border-2 border-white">B</span>
                                <textarea id="editor-b" name="b">{{ $mapel->b }}</textarea>
                            </div>

                            <div class="relative">
                                <span class="absolute -top-3 -left-3 w-8 h-8 rounded-full bg-[#ffc800] text-white font-bold flex items-center justify-center shadow-md z-10 border-2 border-white">C</span>
                                <textarea id="editor-c" name="c">{{ $mapel->c }}</textarea>
                            </div>

                            <div class="relative">
                                <span class="absolute -top-3 -left-3 w-8 h-8 rounded-full bg-[#ffc800] text-white font-bold flex items-center justify-center shadow-md z-10 border-2 border-white">D</span>
                                <textarea id="editor-d" name="d">{{ $mapel->d }}</textarea>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="bg-gray-50 px-8 py-5 border-t border-gray-100 flex justify-end gap-3">
                    <a href="{{ route('mandiri.mapel', $mandiri->id) }}" class="px-6 py-3 rounded-xl font-bold text-gray-500 hover:bg-gray-200 transition text-sm">
                        Batal
                    </a>
                    <button type="submit" class="px-8 py-3 bg-[#ffc800] text-white rounded-xl font-bold shadow-lg hover:bg-yellow-500 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex items-center gap-2">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>

            </div>
        </form>
    </div>

</div>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    // Fungsi untuk inisialisasi editor
    function initEditor(id) {
        ClassicEditor
            .create(document.querySelector('#' + id), {
                toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable', '|', 'undo', 'redo' ],
                // Menghapus branding ckeditor jika mengganggu
                ui: {
                    viewportOffset: { top: 0 }
                }
            })
            .catch(error => {
                console.error(error);
            });
    }

    // Jalankan editor untuk setiap kolom
    document.addEventListener("DOMContentLoaded", function() {
        initEditor('editor-pertanyaan');
        initEditor('editor-a');
        initEditor('editor-b');
        initEditor('editor-c');
        initEditor('editor-d');
    });
</script>

@endsection