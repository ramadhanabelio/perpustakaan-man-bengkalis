@extends('layouts.app')

@section('title', 'Edit Member')

@section('content')
    <div class="page-inner">

        <div class="page-header">
            <h3 class="fw-bold">Edit Member</h3>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('dashboard') }}">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item">
                    <a href="{{ route('members.index') }}">Data Member</a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item">Edit Member</li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-8">

                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-title">Form Edit Member</div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('members.update', $member->id) }}">
                            @csrf
                            @method('PUT')

                            <h5 class="mb-3">Data Akun</h5>

                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="name" value="{{ $member->user->name }}" class="form-control"
                                    required>
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" value="{{ $member->user->email }}" class="form-control"
                                    required>
                            </div>

                            <div class="form-group">
                                <label>No HP</label>
                                <input type="text" name="phone" value="{{ $member->user->phone }}"
                                    class="form-control">
                            </div>

                            <hr>

                            <h5 class="mb-3">Data Member</h5>

                            <div class="form-group">
                                <label>NISN</label>
                                <input type="text" name="nisn" value="{{ $member->nisn }}" class="form-control"
                                    required>
                            </div>

                            <div class="form-group">
                                <label>Kelas</label>
                                <input type="text" name="class" value="{{ $member->class }}" class="form-control"
                                    required>
                            </div>

                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea name="address" class="form-control">{{ $member->address }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select name="gender" class="form-control">
                                    <option value="">Pilih</option>
                                    <option value="L" {{ $member->gender == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ $member->gender == 'P' ? 'selected' : '' }}>Perempuan
                                    </option>
                                </select>
                            </div>

                            <div class="card-action mt-3">
                                <button class="btn btn-success">Update</button>
                                <a href="{{ route('members.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
