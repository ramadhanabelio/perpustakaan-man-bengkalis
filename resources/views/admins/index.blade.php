@extends('layouts.app')

@section('title', 'Daftar Admin')

@section('content')
    <div class="page-inner">

        <div class="page-header">
            <h3 class="fw-bold">Daftar Admin</h3>
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
                    <a href="{{ route('admins.index') }}">Daftar Admin</a>
                </li>
            </ul>
            <div class="ms-md-auto py-2 py-md-0">
                <a href="{{ route('admins.create') }}" class="btn btn-primary btn-round">
                    <i class="fas fa-plus me-2"></i> Tambah Admin
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-title">Kelola Admin</div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Foto</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>No HP</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($admins as $index => $admin)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}.</td>

                                            <td>
                                                <img src="{{ $admin->profile_picture ? asset('storage/' . $admin->profile_picture) : asset('img/profile.jpg') }}"
                                                    width="60" class="rounded-circle">
                                            </td>

                                            <td>{{ $admin->name }}</td>
                                            <td>{{ $admin->email }}</td>
                                            <td>{{ $admin->phone }}</td>

                                            <td>

                                                <a href="{{ route('admins.edit', $admin->id) }}"
                                                    class="btn btn-warning btn-sm">
                                                    Edit
                                                </a>

                                                <form action="{{ route('admins.destroy', $admin->id) }}" method="POST"
                                                    style="display:inline-block">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="btn btn-danger btn-sm">
                                                        Hapus
                                                    </button>

                                                </form>

                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection
