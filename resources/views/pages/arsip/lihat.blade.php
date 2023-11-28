@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Arsip Surat'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h2>Arsip Surat >> Lihat</h2>
                    </div>
                    <div class="card-body">
                        <table>
                            <tr>
                                <td><strong>Nomor Surat</strong></td>
                                <td>:</td>
                                <td>{{ $surat->nomor_surat }}</td>
                            </tr>
                            <tr>
                                <td><strong>Kategori</strong></td>
                                <td>:</td>
                                <td>{{ optional($surat->kategori)->nama_kategori }}</td>
                            </tr>
                            <tr>
                                <td><strong>Judul</strong></td>
                                <td>:</td>
                                <td>{{ $surat->judul }}</td>
                            </tr>
                            <tr>
                                <td><strong>Waktu Pengarsipan</strong></td>
                                <td>:</td>
                                <td>{{ $surat->waktu_arsip }}</td>
                            </tr>
                        </table>

                        <br>
                        <!-- Penampil PDF -->
                        <iframe src="{{ asset('storage/file_surat/' . $surat->file_surat) }}" width="100%" height="500px"></iframe>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('arsip') }}" class="btn btn-secondary">Kembali</a>
                        <a href="{{ asset('storage/file_surat/' . $surat->file_surat) }}" download="{{ $surat->judul }}.pdf"
                            class="btn btn-kuning"><i class="fas fa-download"></i> Unduh</a>
                        <a href="{{ route('arsip.edit', ['id' => $surat->id]) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit/Ganti File</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth.footer')
@endsection
