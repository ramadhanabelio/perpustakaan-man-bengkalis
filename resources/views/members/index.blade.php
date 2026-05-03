@extends('layouts.app')

@section('title', 'Daftar Member')

@section('content')
    <div class="page-inner">

        <div class="page-header">
            <h3 class="fw-bold">Daftar Member</h3>

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
                    <a href="{{ route('members.index') }}">Daftar Member</a>
                </li>
            </ul>

            <div class="ms-md-auto py-2 py-md-0">
                <a href="{{ route('members.create') }}" class="btn btn-primary btn-round">
                    <i class="fas fa-plus me-2"></i> Tambah Member
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
                        <div class="card-title">Kelola Member</div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>No HP</th>
                                        <th>NISN</th>
                                        <th>Kelas</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($members as $index => $m)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}.</td>
                                            <td>{{ $m->user->name }}</td>
                                            <td>{{ $m->user->email }}</td>
                                            <td>{{ $m->user->phone }}</td>
                                            <td>{{ $m->nisn }}</td>
                                            <td>{{ $m->class }}</td>
                                            <td>
                                                <div class="form-button-action">

                                                    <a href="{{ route('members.edit', $m->id) }}"
                                                        class="btn btn-warning btn-sm">
                                                        Edit
                                                    </a>

                                                    <form action="{{ route('members.destroy', $m->id) }}" method="POST"
                                                        style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Hapus member ini?')">
                                                            Hapus
                                                        </button>
                                                    </form>

                                                </div>
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
