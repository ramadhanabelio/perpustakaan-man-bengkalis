@extends('layouts.auth')

@section('title', 'Masuk')

@section('content')
    <div class="w-100 p-3" style="max-width: 560px;">
        <div class="text-center mb-4">
            <img src="{{ asset('img/logo.png') }}" alt="Logo MAN 1 Bengkalis" width="130" />
        </div>

        <div class="card card-round shadow-sm">
            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="card-header text-center">
                    <h3 class="card-title mb-0">Selamat Datang</h3>
                    <h6 class="op-7">Perpustakaan MAN 1 Bengkalis</h6>
                </div>

                <div class="card-body">

                    @if (session('error'))
                        <div class="alert alert-warning">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->has('email'))
                        <div class="alert alert-danger">
                            {{ $errors->first('email') }}
                        </div>
                    @endif

                    @if ($errors->has('password'))
                        <div class="alert alert-danger">
                            {{ $errors->first('password') }}
                        </div>
                    @endif

                    <div class="form-group mb-1">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email"
                            placeholder="Masukkan Email" required />
                    </div>

                    <div class="form-group mb-1">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password"
                            placeholder="Masukkan Password" required />
                    </div>
                </div>

                <div class="card-action pb-4">
                    <button class="btn btn-secondary w-100 mb-2">MASUK</button>

                    <div class="text-center">
                        <a href="{{ route('register') }}">
                            Belum punya akun? Daftar di sini.
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
