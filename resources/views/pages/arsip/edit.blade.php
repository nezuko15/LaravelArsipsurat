@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Arsip Surat'])
    <form action="{{ route('arsip.update', ['id' => $arsip->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h2 class="m-0 font-weight-bold">Arsip Surat >> Edit</h2>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2 mt-3">
                            <div class="form-group" style="padding-right: 20px; padding-left: 20px;">
                                <label for="nomor_surat">Nomor Surat</label>
                                <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" value="{{ $arsip->nomor_surat }}" required>
                            </div>
                            <div class="form-group" style="padding-right: 20px; padding-left: 20px;">
                                <label for="kategori_id">Kategori</label>
                                <select class="form-control" id="kategori_id" name="kategori_id" required>
                                    @foreach ($kategoriList as $kategori)
                                        <option value="{{ $kategori->id }}" {{ $kategori->id == $arsip->kategori_id ? 'selected' : '' }}>
                                            {{ $kategori->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" style="padding-right: 20px; padding-left: 20px;">
                                <label for="judul">Judul</label>
                                <input type="text" class="form-control" id="judul" name="judul" value="{{ $arsip->judul }}" required>
                            </div>
                            <div class="form-group" style="padding-right: 20px; padding-left: 20px;">
                                <label for="file_surat">File Surat (PDF)</label>
                                <input type="file" class="form-control" id="file_surat" name="file_surat" accept=".pdf">
                                <small class="text-muted">*Maksimal ukuran file: 2MB</small>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('kategori') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @include('layouts.footers.auth.footer')
@endsection

