@extends('belajar')

@section('content')

<div class="main">
    <div class="toggle">
        <ion-icon name="menu-outline"></ion-icon>
    </div>
    <div class="ujian">
        <div class="table-header">
            <a href="{{ route('ujian.show', $ujian->id) }}" class="btn-tambah">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        <form action="{{ route('soal.store', $ujian->id)}}" method="POST">
         @csrf
            <div class="card-soal">
                <div class="card-header">
                    <span class="icon">❓</span>
                    <span>Tambah Soal Ujian</span>
                </div>
                <div class="card-body">
                    <table class="soal-table">
                        <tr>
                            <td class="label">Soal</td>
                            <td class="editor-col" >
                                <textarea name="pertanyaan" id="pertanyaan" class="editor"></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td class="label">Pilihan A</td>
                            <td class="editor-col">
                                <textarea name="opsi_a" id="opsi_a" class="editor"></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td class="label">Pilihan B</td>
                            <td class="editor-col">
                                <textarea name="opsi_b" id="opsi_b" class="editor"></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td class="label">Pilihan C</td>
                            <td class="editor-col">
                                <textarea name="opsi_c" id="opsi_c" class="editor"></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td class="label">Pilihan D</td>
                            <td class="editor-col">
                                <textarea name="opsi_d" id="opsi_d" class="editor"></textarea>
                            </td>
                        </tr>

                        <!-- Jawaban Benar -->
                        <tr>
                            <td class="form-label">Jawaban</td>
                            <td class="form-field">
                                <select name="jawaban_benar" id="jawaban_benar" class="form-select">
                                    <option value="">-- Pilih --</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <div class="bttn" style="margin-top:20px">
                        <button type="submit" class="bttn btn-primary">
                            Simpan Soal
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div> 
</div>

@endsection