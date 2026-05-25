@extends('layouts.app')

@section('title', 'Tambah Admin')

@section('content')
    <div class="page-inner">

        <div class="page-header">
            <h3 class="fw-bold">Tambah Admin</h3>
        </div>

        <div class="row">
            <div class="col-md-6">

                <div class="card card-round">
                    <div class="card-body">

                        <form action="{{ route('admins.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="name" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>No HP</label>
                                <input type="text" name="phone" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Foto Profil</label>
                                <input type="file" name="profile_picture" class="form-control">
                            </div>

                            <div class="card-action mt-3">
                                <button class="btn btn-success">
                                    Simpan
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
