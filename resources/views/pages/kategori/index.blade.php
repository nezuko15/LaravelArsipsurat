@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Kategori Surat'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h2>Kategori Surat</h2>
                        <div class="d-flex align-items-center mt-4">
                            <span class="me-2">Cari Kategori:</span>
                            <div class="col-6">
                                <input type="text" class="form-control" id="searchCategory"
                                    placeholder="Masukkan Nama Kategori">
                            </div>
                            <button class="btn btn-primary ms-2 my-auto" id="btnSearchCategory">Cari</button>
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
                                        <th>ID Kategori</th>
                                        <th>Nama Kategori</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($no = 1)
                                    @foreach ($data as $row)
                                        <tr>
                                            <th>{{ $no++ }}</th>
                                            <td>{{ $row->nama_kategori }}</td>
                                            <td>{{ $row->keterangan }}</td>
                                            <td>
                                                <a href="{{ route('kategori.hapus', $row->id) }}" class="btn btn-danger"
                                                    onclick="return confirm('Anda yakin ingin menghapus data kategori surat ini?');"><i
                                                        class="fas fa-trash"></i> Hapus</a>
                                                <a href="{{ route('kategori.edit', ['id' => $row->id]) }}"
                                                    class="btn btn-info"><i class="fas fa-pencil-alt"></i>
                                                    Edit</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('kategori.tambah') }}" class="btn btn-success">[+] Tambahkan Kategori Baru</a>
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
        // event listener yang akan diaktifkan ketika tombol pencarian (btnSearchCategory) di-klik
        document.getElementById('btnSearchCategory').addEventListener('click', function() {
            // Mengambil nilai dari input pencarian dan mengonversi menjadi huruf kecil
            var searchValue = document.getElementById('searchCategory').value.toLowerCase();

            // Memilih semua baris dalam tabel kategori
            var rows = document.querySelectorAll('.table tbody tr');

            // Loop melalui setiap baris untuk memeriksa kesesuaian dengan nilai pencarian
            rows.forEach(function(row) {
                // Mengambil teks dari kolom kedua (index 1) setiap baris (nama kategori) dan mengonversi menjadi huruf kecil
                var name = row.children[1].textContent.toLowerCase();

                // Memeriksa apakah teks nama kategori mengandung nilai pencarian
                if (name.includes(searchValue)) {
                    // Jika iya, tampilkan baris
                    row.style.display = '';
                } else {
                    // Jika tidak, sembunyikan baris
                    row.style.display = 'none';
                }
            });
        });
    </script>

    @include('layouts.footers.auth.footer')
@endsection
