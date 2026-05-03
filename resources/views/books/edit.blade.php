@extends('layouts.app')

@section('title', 'Edit Buku')

@section('content')
    <div class="page-inner">

        <div class="page-header">
            <h3 class="fw-bold">Edit Buku</h3>
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
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('books.edit', $book->id) }}">Edit Buku</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-6 col-lg-6">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-title">Edit Buku</div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('books.update', $book->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label>Kode</label>
                                <input type="text" name="code" value="{{ $book->code }}" class="form-control"
                                    required>
                            </div>

                            <div class="form-group">
                                <label>Judul</label>
                                <input type="text" name="title" value="{{ $book->title }}" class="form-control"
                                    required>
                            </div>

                            <div class="form-group">
                                <label>Author</label>
                                <input type="text" name="author" value="{{ $book->author }}" class="form-control"
                                    required>
                            </div>

                            <div class="form-group">
                                <label>Tahun</label>
                                <input type="number" name="published_year" value="{{ $book->published_year }}"
                                    class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea name="description" class="form-control">{{ $book->description }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Stok</label>
                                <input type="number" name="stock" value="{{ $book->stock }}" class="form-control"
                                    required>
                            </div>

                            <div class="card-action mt-3">
                                <button class="btn btn-success">Simpan</button>
                                <a href="{{ route('books.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
