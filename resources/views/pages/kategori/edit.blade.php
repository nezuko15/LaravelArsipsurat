@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Kategori Surat'])
    <form action="{{ route('kategori.update', ['id' => $kategori->id]) }}" method="post">
        @csrf
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4"> <!-- Tambahkan padding-bottom di sini -->
                        <div class="card-header pb-0">
                            <h2 class="m-0 font-weight-bold">Kategori Surat >> Edit</h2>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2 mt-3">
                            <div class="form-group" style="padding-right: 20px; padding-left: 20px;">
                                <label for="id">ID Kategori</label>
                                <input type="text" class="form-control" id="id" name="id" value="{{ $kategori->id }}" disabled>
                            </div>
                            <div class="form-group" style="padding-right: 20px; padding-left: 20px;">
                                <label for="nama_kategori">Nama Kategori</label>
                                <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="{{ $kategori->nama_kategori }}" required>
                            </div>
                            <div class="form-group" style="padding-right: 20px; padding-left: 20px;">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ $kategori->keterangan }}" required>
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
