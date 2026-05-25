@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')
    <div class="page-inner">

        <div class="page-header">
            <h3 class="fw-bold">Tambah Buku</h3>
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
                    <a href="{{ route('books.create') }}">Tambah Buku</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-6 col-lg-6">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-title">Tambah Buku</div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label>Kode</label>
                                <input type="text" name="code" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Judul</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Author</label>
                                <input type="text" name="author" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Tahun</label>
                                <input type="number" name="published_year" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea name="description" class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Kategori</label>
                                <input type="text" name="category" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Cover Buku</label>
                                <input type="file" name="cover_image" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Stok</label>
                                <input type="number" name="stock" class="form-control" required>
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
