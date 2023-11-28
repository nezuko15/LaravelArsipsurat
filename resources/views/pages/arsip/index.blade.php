@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Arsip Surat'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h2>Arsip Surat</h2>
                        <div class="d-flex align-items-center mt-4">
                            <span class="me-2">Cari Surat:</span>
                            <div class="col-6">
                                <input type="text" class="form-control" id="searchJudul"
                                    placeholder="Masukkan Judul Surat">
                            </div>
                            <button class="btn btn-primary ms-2 my-auto" id="btnSearchJudul">Cari</button>
                        </div>
                    </div>
                    <div class="card-body ">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th>Nomor Surat</th>
                                        <th>Kategori</th>
                                        <th>Judul</th>
                                        <th>Waktu Pengarsipan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $row)
                                        <tr>
                                            <th>{{ $row->nomor_surat }}</th>
                                            <td>{{ optional($row->kategori)->nama_kategori }}</td>
                                            <td>{{ $row->judul }}</td>
                                            <td>{{ $row->waktu_arsip }}</td>
                                            <td>
                                                <a href="{{ route('arsip.hapus', ['id' => $row->id]) }}" class="btn btn-danger"
                                                    onclick="return confirm('Anda yakin ingin menghapus data kategori surat ini?');"><i
                                                        class="fas fa-trash"></i> Hapus</a>
                                                <a href="{{ asset('storage/file_surat/' . $row->file_surat) }}" download="{{ $row->judul }}.pdf"
                                                    class="btn btn-kuning"><i class="fas fa-download"></i> Unduh</a>
                                                <a href="{{ route('arsip.lihat', $row->id) }}" class="btn btn-info"><i class="fas fa-eye"></i> Lihat</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('arsip.tambah') }}" class="btn btn-success">Arsipkan Surat</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .table th,
        .table td {
            text-align: center;
        }

        .table thead th {
            vertical-align: middle;
        }
    </style>

    <script>
        document.getElementById('btnSearchJudul').addEventListener('click', function() {
            var searchValue = document.getElementById('searchJudul').value.toLowerCase();
            var rows = document.querySelectorAll('.table tbody tr');

            rows.forEach(function(row) {
                var name = row.children[2].textContent.toLowerCase();
                if (name.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>

    <!-- Tambahkan di bagian head atau sebelum penutup tag body -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var downloadButtons = document.querySelectorAll('.btn-download');

            downloadButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();

                    // Dapatkan URL file dari atribut data
                    var fileUrl = this.getAttribute('data-file-url');

                    // Minta pengguna untuk memilih direktori penyimpanan
                    var directoryPath = prompt(
                        'Masukkan direktori penyimpanan (cth: /path/to/directory)');

                    if (directoryPath) {
                        // Gunakan FileSaver.js untuk menyimpan file ke direktori yang dipilih
                        fetch(fileUrl)
                            .then(response => response.blob())
                            .then(blob => saveAs(blob, directoryPath + '/' + fileUrl.split('/')
                            .pop()));
                    }
                });
            });
        });
    </script>


    @include('layouts.footers.auth.footer')
@endsection
