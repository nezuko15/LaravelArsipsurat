@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'About'])

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h2>About</h2>
                </div>
                <div class="card-body d-flex align-items-center">
                    <img src="img/2131730042.jpeg" alt="Your Image" class="me-4" style="max-width: 200px; max-height: 200px;">
                    <div>
                        <p>Aplikasi ini dibuat oleh:</p>
                        <table>
                            <tr>
                                <td><strong>Nama</strong></td>
                                <td>:</td>
                                <td>Siemens Putra Ivanka</td>
                            </tr>
                            <tr>
                                <td><strong>NIM</strong></td>
                                <td>:</td>
                                <td>2131730042</td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal</strong></td>
                                <td>:</td>
                                <td>28 November 2023</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footers.auth.footer')
@endsection