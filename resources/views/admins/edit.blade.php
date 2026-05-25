@extends('layouts.app')

@section('title', 'Edit Admin')

@section('content')
    <div class="page-inner">

        <div class="page-header">
            <h3 class="fw-bold">Edit Admin</h3>

            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('dashboard') }}">
                        <i class="icon-home"></i>
                    </a>
                </li>

                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admins.index') }}">Data Admin</a>
                </li>

                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>

                <li class="nav-item">
                    <a href="#">Edit Admin</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-8">

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
                            Form Edit Admin
                        </div>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('admins.update', $admin->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Nama Lengkap</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ old('name', $admin->name) }}" required>
                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ old('email', $admin->email) }}" required>
                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>No. Telepon</label>
                                        <input type="text" name="phone" class="form-control"
                                            value="{{ old('phone', $admin->phone) }}">
                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Password Baru</label>
                                        <input type="password" name="password" class="form-control">
                                        <small class="text-muted">
                                            Kosongkan jika tidak ingin mengubah password
                                        </small>
                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Konfirmasi Password</label>
                                        <input type="password" name="password_confirmation" class="form-control">
                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Foto Profile</label>

                                        <input type="file" name="profile_picture" class="form-control">

                                        @if ($admin->profile_picture)
                                            <div class="mt-3">
                                                <img src="{{ asset('storage/' . $admin->profile_picture) }}" width="120"
                                                    class="img-thumbnail">
                                            </div>
                                        @endif
                                    </div>

                                </div>

                            </div>

                            <div class="card-action mt-3">
                                <button class="btn btn-success">
                                    <i class="fas fa-save me-1"></i>
                                    Update
                                </button>

                                <a href="{{ route('admins.index') }}" class="btn btn-secondary">
                                    Kembali
                                </a>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
