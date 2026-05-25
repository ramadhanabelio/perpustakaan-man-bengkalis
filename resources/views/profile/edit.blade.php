@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
    <div class="page-inner">

        <div class="page-header">
            <h3 class="fw-bold">Profil Saya</h3>

            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="#">
                        <i class="icon-home"></i>
                    </a>
                </li>

                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>

                <li class="nav-item">
                    <a href="#">Profil Saya</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-8">

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card card-round">

                    <div class="card-header">
                        <div class="card-title">
                            Update Profil
                        </div>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            @method('PUT')

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama</label>

                                        <input type="text" name="name" class="form-control"
                                            value="{{ old('name', $user->name) }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>

                                        <input type="email" name="email" class="form-control"
                                            value="{{ old('email', $user->email) }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>No HP</label>

                                        <input type="text" name="phone" class="form-control"
                                            value="{{ old('phone', $user->phone) }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Foto Profil</label>

                                        <input type="file" name="profile_picture" class="form-control">

                                        @if ($user->profile_picture)
                                            <div class="mt-3">
                                                <img src="{{ asset('storage/' . $user->profile_picture) }}" width="100"
                                                    class="img-thumbnail">
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Password Baru</label>

                                        <input type="password" name="password" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Konfirmasi Password</label>

                                        <input type="password" name="password_confirmation" class="form-control">
                                    </div>
                                </div>

                            </div>

                            {{-- KHUSUS MEMBER --}}
                            @if ($user->role == 'member' && $member)
                                <hr>

                                <h5 class="mb-3">Data Member</h5>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>NISN</label>

                                            <input type="text" name="nisn" class="form-control"
                                                value="{{ old('nisn', $member->nisn) }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kelas</label>

                                            <input type="text" name="class" class="form-control"
                                                value="{{ old('class', $member->class) }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>

                                            <select name="gender" class="form-select">
                                                <option value="L" {{ $member->gender == 'L' ? 'selected' : '' }}>
                                                    Laki-laki
                                                </option>

                                                <option value="P" {{ $member->gender == 'P' ? 'selected' : '' }}>
                                                    Perempuan
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Alamat</label>

                                            <textarea name="address" class="form-control" rows="4">{{ old('address', $member->address) }}</textarea>
                                        </div>
                                    </div>

                                </div>
                            @endif

                            <div class="card-action mt-3">
                                <button class="btn btn-success">
                                    <i class="fas fa-save me-1"></i>
                                    Update Profil
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
