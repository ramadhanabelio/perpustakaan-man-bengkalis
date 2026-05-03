@extends('layouts.auth')

@section('title', 'Daftar')

@section('content')
    <div class="w-100 p-3" style="max-width: 720px;">

        <div class="text-center mb-4">
            <img src="{{ asset('img/logo.png') }}" alt="Logo MAN 1 Bengkalis" width="130" />
        </div>

        <div class="card card-round shadow-sm">
            <form action="{{ route('register.post') }}" method="POST">
                @csrf

                <div class="card-header text-center">
                    <h3 class="card-title mb-0">Daftar Akun</h3>
                    <h6 class="op-7">Perpustakaan MAN 1 Bengkalis</h6>
                </div>

                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group mb-2">
                                <label>Nama</label>
                                <input type="text" name="name" class="form-control" placeholder="Masukkan Nama"
                                    required>
                            </div>

                            <div class="form-group mb-2">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Masukkan Email"
                                    required>
                            </div>

                            <div class="form-group mb-2">
                                <label>No HP</label>
                                <input type="text" name="phone" class="form-control" placeholder="08xxxx" required>
                            </div>

                            <div class="form-group mb-2">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Masukkan Password"
                                    required>
                            </div>

                            <div class="form-group mb-2">
                                <label>Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control"
                                    placeholder="Ulangi Password" required>
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group mb-2">
                                <label>NISN</label>
                                <input type="text" name="nisn" class="form-control" placeholder="Masukkan NISN"
                                    required>
                            </div>

                            <div class="form-group mb-2">
                                <label>Kelas</label>
                                <input type="text" name="class" class="form-control" placeholder="Contoh: XII RPL 1"
                                    required>
                            </div>

                            <div class="form-group mb-2">
                                <label>Alamat</label>
                                <textarea name="address" class="form-control" placeholder="Masukkan Alamat"></textarea>
                            </div>

                            <div class="form-group mb-2">
                                <label>Jenis Kelamin</label>
                                <select name="gender" class="form-select" required>
                                    <option value="">Pilih</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="card-action pb-4">
                    <button class="btn btn-secondary w-100 mb-2">DAFTAR</button>

                    <div class="text-center">
                        <a href="{{ route('login') }}">
                            Sudah punya akun? Masuk di sini.
                        </a>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
