@extends('layouts.app')

@section('title', 'Pinjam Buku')

@section('content')
    <div class="page-inner">

        {{-- HEADER --}}
        <div class="page-header">
            <div>
                <h3 class="fw-bold">Form Peminjaman</h3>
                <h6 class="op-7">Ajukan peminjaman buku</h6>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">

                <div class="card card-round shadow-sm">
                    <div class="card-header">
                        <div class="card-title">Detail Buku</div>
                    </div>

                    <div class="card-body">

                        {{-- INFO BUKU --}}
                        <div class="mb-3">
                            <h5 class="fw-bold">{{ $book->title }}</h5>
                            <p class="text-muted mb-1">
                                <i class="fas fa-user"></i> {{ $book->author }}
                            </p>
                            <span class="badge bg-success">
                                Stok: {{ $book->stock }}
                            </span>
                        </div>

                        <hr>

                        {{-- FORM --}}
                        <form action="{{ route('borrow.store') }}" method="POST">
                            @csrf

                            <input type="hidden" name="book_id" value="{{ $book->id }}">

                            <div class="form-group mb-3">
                                <label>Tanggal Pinjam</label>
                                <input type="date" name="borrow_date" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label>Jatuh Tempo</label>
                                <input type="date" name="due_date" class="form-control" required>
                            </div>

                            <div class="card-action">
                                <button class="btn btn-success">
                                    <i class="fas fa-paper-plane me-1"></i>
                                    Ajukan Peminjaman
                                </button>

                                <a href="{{ route('home') }}" class="btn btn-secondary">
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
