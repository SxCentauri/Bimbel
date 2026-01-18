@extends('tryout.index')

@section('content')

<style>
    /* Agar jawaban radio button terlihat custom */
    .custom-radio:checked + div {
        background-color: #fefce8; /* Yellow-50 */
        border-color: #ffc800;
    }
    .custom-radio:checked + div .radio-dot {
        background-color: #ffc800;
        border-color: #ffc800;
    }
</style>

<div class="min-h-screen pb-12">
    
    <div class="bg-gray-900 text-white p-4 rounded-xl shadow-lg mb-6 flex justify-between items-center sticky top-20 z-40 border-b-4 border-[#ffc800]">
        <div>
            <h2 class="text-lg font-bold font-heading">{{ $ujian->nama_ujian }}</h2>
            <p class="text-xs text-gray-400">{{ $ujian->mapel }} | Kelas {{ $ujian->kelas }}</p>
        </div>
        <div class="text-right">
            <span class="block text-xs text-gray-400 uppercase tracking-widest">Sisa Waktu</span>
            <span class="text-xl font-mono font-bold text-[#ffc800]">--:--:--</span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-2 animate-[fadeIn_0.5s_ease-out]">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden relative">
                
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <span class="bg-gray-800 text-white text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                        Soal No. {{ $index + 1 }}
                    </span>
                    <span class="text-xs text-gray-500 font-medium">
                        dari {{ count($soal_list) }} soal
                    </span>
                </div>

                <div class="p-6 md:p-8">
                    <div class="text-gray-800 text-lg font-medium leading-relaxed mb-8">
                        {!! $soal->pertanyaan !!}
                    </div>

                    <form method="POST" action="{{ route('tryout.jawab') }}" id="form-ujian">
                        @csrf
                        <input type="hidden" name="ujian_id" value="{{ $ujian->id }}">
                        <input type="hidden" name="soal_id" value="{{ $soal->id }}">
                        <input type="hidden" name="index" value="{{ $index }}">

                        <div class="space-y-4">
                            @php
                                $opsi = [
                                    'A' => $soal->opsi_a,
                                    'B' => $soal->opsi_b,
                                    'C' => $soal->opsi_c,
                                    'D' => $soal->opsi_d,
                                ];
                            @endphp

                            @foreach($opsi as $key => $value)
                                <label class="cursor-pointer block group">
                                    <input type="radio" name="jawaban" value="{{ $key }}" class="hidden custom-radio"
                                        {{ ($jawaban_user && $jawaban_user->jawaban === $key) ? 'checked' : '' }} 
                                        onchange="this.form.submit()"> <div class="flex items-start gap-4 p-4 rounded-xl border border-gray-200 hover:border-gray-400 hover:bg-gray-50 transition-all duration-200">
                                        <div class="radio-dot w-6 h-6 rounded-full border-2 border-gray-300 flex items-center justify-center shrink-0 mt-0.5 transition-colors group-hover:border-[#ffc800]">
                                            <span class="text-xs font-bold text-gray-500 group-hover:text-[#ffc800]">{{ $key }}</span>
                                        </div>
                                        
                                        <div class="text-gray-700 text-sm md:text-base">
                                            {!! $value !!}
                                        </div>
                                    </div>
                                </label>
                            @endforeach
                        </div>

                        <div class="flex justify-between items-center mt-8 pt-6 border-t border-gray-100">
                            @if($index > 0)
                                <button type="submit" name="prev" class="px-5 py-2.5 bg-gray-100 text-gray-600 rounded-lg font-bold hover:bg-gray-200 transition text-sm flex items-center gap-2">
                                    <i class="fas fa-chevron-left"></i> Sebelumnya
                                </button>
                            @else
                                <button disabled class="px-5 py-2.5 bg-gray-50 text-gray-300 rounded-lg font-bold text-sm cursor-not-allowed flex items-center gap-2">
                                    <i class="fas fa-chevron-left"></i> Sebelumnya
                                </button>
                            @endif

                            @if($index < count($soal_list) - 1)
                                <button type="submit" name="next" class="px-5 py-2.5 bg-[#ffc800] text-white rounded-lg font-bold shadow-md hover:bg-yellow-500 hover:shadow-lg transition text-sm flex items-center gap-2">
                                    Selanjutnya <i class="fas fa-chevron-right"></i>
                                </button>
                            @else
                                <button type="button" class="px-6 py-2.5 bg-green-600 text-white rounded-lg font-bold shadow-md hover:bg-green-700 transition text-sm flex items-center gap-2" onclick="confirmFinish()">
                                    Selesai <i class="fas fa-check"></i>
                                </button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="sticky top-40 space-y-6">
                
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                    <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wide mb-4 border-b border-gray-100 pb-2">Navigasi Soal</h3>
                    
                    <div class="grid grid-cols-5 gap-2">
                        @foreach($soal_list as $i => $s)
                            @php
                                $sudah_dijawab = isset($jawaban_all[$s->id]);
                                $is_active = $i == $index;
                                
                                // Kelas Warna
                                $bgClass = $is_active ? 'bg-[#ffc800] text-white border-[#ffc800] ring-2 ring-yellow-200' : ($sudah_dijawab ? 'bg-green-500 text-white border-green-500' : 'bg-white text-gray-600 border-gray-200 hover:border-gray-400');
                            @endphp

                            <a href="{{ route('tryout.kerjakan', ['ujian' => $ujian->id, 'index' => $i]) }}"
                               class="w-full aspect-square flex items-center justify-center rounded-lg border text-sm font-bold transition-all duration-200 {{ $bgClass }}">
                                {{ $i + 1 }}
                            </a>
                        @endforeach
                    </div>

                    <div class="mt-6 flex flex-col gap-2 text-xs text-gray-500">
                        <div class="flex items-center gap-2"><span class="w-3 h-3 bg-[#ffc800] rounded-sm"></span> Sedang Dikerjakan</div>
                        <div class="flex items-center gap-2"><span class="w-3 h-3 bg-green-500 rounded-sm"></span> Sudah Dijawab</div>
                        <div class="flex items-center gap-2"><span class="w-3 h-3 bg-white border border-gray-300 rounded-sm"></span> Belum Dijawab</div>
                    </div>
                </div>

                <form method="POST" action="{{ route('tryout.selesai', $ujian->id) }}" id="form-selesai">
                    @csrf
                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin mengakhiri ujian ini? Jawaban tidak dapat diubah setelah ini.')" 
                        class="w-full py-3 bg-red-50 text-red-600 border border-red-100 rounded-xl font-bold hover:bg-red-600 hover:text-white transition-all duration-300 shadow-sm flex items-center justify-center gap-2 group">
                        <i class="fas fa-flag-checkered group-hover:scale-110 transition-transform"></i> AKHIRI UJIAN SEKARANG
                    </button>
                </form>

            </div>
        </div>

    </div>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    // Fungsi Konfirmasi Selesai (Tombol di bawah soal)
    function confirmFinish() {
        if(confirm('Yakin ingin mengakhiri ujian? Pastikan semua jawaban sudah terisi.')) {
            document.getElementById('form-selesai').submit();
        }
    }

    // Logic Anti-Cheating (Visibility Change)
    let warningCount = 0;
    const maxWarnings = 3;
    let sudahDiproses = false;

    function pelanggaran() {
        if (sudahDiproses) return;
        
        warningCount++;
        
        // Kirim log pelanggaran ke server
        fetch("{{ route('ujian.pelanggaran') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ ujian_id: {{ $ujian->id }} })
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'selesai' || warningCount >= maxWarnings) {
                sudahDiproses = true;
                alert("PELANGGARAN BERAT!\nAnda telah meninggalkan halaman ujian lebih dari 3 kali.\nUjian Anda dihentikan paksa.");
                window.location.href = "/ujian/selesai"; // Redirect paksa
            } else {
                alert(`PERINGATAN KE-${data.peringatan}!\n\nDilarang membuka tab lain atau keluar dari halaman ujian.\nJika terjadi lagi, ujian akan otomatis dihentikan.`);
                // Opsional: Reload untuk memastikan status sinkron, tapi bisa mengganggu UX
                // window.location.reload(); 
            }
        });
    }

    document.addEventListener("visibilitychange", function () {
        if (document.hidden) {
            pelanggaran();
        }
    });

    // Disable Back Button
    history.pushState(null, null, location.href);
    window.onpopstate = function () {
        history.pushState(null, null, location.href);
        alert("Navigasi 'Back' dinonaktifkan selama ujian. Gunakan tombol navigasi soal.");
    };

    // Prevent Page Reload Issues (Optional)
    /*
    window.addEventListener("beforeunload", function (e) {
        var confirmationMessage = 'Yakin ingin keluar? Ujian belum selesai.';
        (e || window.event).returnValue = confirmationMessage; 
        return confirmationMessage;
    });
    */
</script>

@endsection