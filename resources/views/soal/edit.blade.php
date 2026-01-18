@extends('belajar')

@section('content')

<div class="main">
    <div class="toggle">
        <ion-icon name="menu-outline"></ion-icon>
    </div>

    <div class="ujian">

        <form action="{{ route('soal.update', [$ujian->id, $soal->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card-soal">
                <div class="card-header">
                    <span class="icon">✏️</span>
                    <span>Edit Soal Ujian</span>
                </div>

                <div class="card-body">
                    <table class="soal-table">
                        <tr>
                            <td class="label">Soal</td>
                            <td>
                                <textarea name="pertanyaan" class="editor">{{ old('pertanyaan', $soal->pertanyaan) }}</textarea>
                            </td>
                        </tr>

                        <tr>
                            <td class="label">Pilihan A</td>
                            <td>
                                <textarea name="opsi_a" class="editor">{{ old('opsi_a', $soal->opsi_a) }}</textarea>
                            </td>
                        </tr>

                        <tr>
                            <td class="label">Pilihan B</td>
                            <td>
                                <textarea name="opsi_b" class="editor">{{ old('opsi_b', $soal->opsi_b) }}</textarea>
                            </td>
                        </tr>

                        <tr>
                            <td class="label">Pilihan C</td>
                            <td>
                                <textarea name="opsi_c" class="editor">{{ old('opsi_c', $soal->opsi_c) }}</textarea>
                            </td>
                        </tr>

                        <tr>
                            <td class="label">Pilihan D</td>
                            <td>
                                <textarea name="opsi_d" class="editor">{{ old('opsi_d', $soal->opsi_d) }}</textarea>
                            </td>
                        </tr>

                        <tr>
                            <td class="label">Jawaban</td>
                            <td>
                                <select name="jawaban_benar" class="form-select">
                                    <option value="A" {{ $soal->jawaban_benar == 'A' ? 'selected' : '' }}>A</option>
                                    <option value="B" {{ $soal->jawaban_benar == 'B' ? 'selected' : '' }}>B</option>
                                    <option value="C" {{ $soal->jawaban_benar == 'C' ? 'selected' : '' }}>C</option>
                                    <option value="D" {{ $soal->jawaban_benar == 'D' ? 'selected' : '' }}>D</option>
                                </select>
                            </td>
                        </tr>
                    </table>

                    <div class="bttn" style="margin-top:20px">
                        <button type="submit" class="bttn btn-primary">
                            Update Soal
                        </button>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>

@endsection
