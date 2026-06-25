@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')
    <div class="page-inner">

        <div class="page-header">
            <h3 class="fw-bold">Daftar Buku</h3>
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
                    <a href="{{ route('books.index') }}">Daftar Buku</a>
                </li>
            </ul>
            <div class="ms-md-auto py-2 py-md-0">
                <a href="{{ route('books.create') }}" class="btn btn-primary btn-round">
                    <i class="fas fa-plus me-2"></i> Tambah Buku
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="card card-round">
                    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-3">

                        <div class="card-title mb-0">
                            Kelola Buku
                        </div>

                        <form class="d-flex align-items-center gap-2 flex-wrap">

                            <select name="year" class="form-select form-select-sm" style="width: 120px;">
                                <option value="">Semua Tahun</option>

                                @for ($y = date('Y'); $y >= 2020; $y--)
                                    <option value="{{ $y }}">
                                        {{ $y }}
                                    </option>
                                @endfor
                            </select>

                            <button type="submit" formaction="{{ route('books.export.pdf') }}"
                                class="btn btn-danger btn-sm">

                                <i class="fas fa-file-pdf me-1"></i>
                                PDF
                            </button>

                            <button type="submit" formaction="{{ route('books.export.excel') }}"
                                class="btn btn-success btn-sm">

                                <i class="fas fa-file-excel me-1"></i>
                                Excel
                            </button>

                        </form>

                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode</th>
                                        <th>Judul</th>
                                        <th>Penulis</th>
                                        <th>Tahun</th>
                                        <th>Stok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($books as $index => $book)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}.</td>
                                            <td>{{ $book->code }}</td>
                                            <td>{{ $book->title }}</td>
                                            <td>{{ $book->author }}</td>
                                            <td>{{ $book->published_year }}</td>
                                            <td>{{ $book->stock }}</td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="{{ route('books.edit', $book->id) }}"
                                                        class="btn btn-warning btn-sm me-2">Edit</a>

                                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST"
                                                        style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Hapus buku?')">Hapus</button>
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
