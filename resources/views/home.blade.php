@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <div class="page-inner">

        <div class="page-header">
            <div>
                <h3 class="fw-bold">Beranda Member</h3>
                <h6 class="op-7">Selamat datang, {{ auth()->user()->name }}</h6>
            </div>
        </div>

        <div class="row">
            @foreach ($books as $book)
                <div class="col-md-3 mb-4">
                    <div class="card card-round shadow-sm h-100">

                        <img src="{{ $book->cover_image ? asset('storage/' . $book->cover_image) : asset('img/default.jpg') }}"
                            class="card-img-top" style="height: 220px; object-fit: cover;">

                        <div class="card-body d-flex flex-column">

                            <h5 class="fw-bold">{{ $book->title }}</h5>

                            <p class="mb-1 text-muted">
                                <i class="fas fa-user"></i> {{ $book->author }}
                            </p>

                            <p class="mb-3">
                                <span class="badge bg-{{ $book->stock > 0 ? 'success' : 'secondary' }}">
                                    Stok: {{ $book->stock }}
                                </span>
                            </p>

                            <div class="mt-auto">
                                @if ($book->stock > 0)
                                    <a href="{{ route('borrow.create', $book->id) }}" class="btn btn-primary w-100 btn-sm">
                                        <i class="fas fa-book-reader me-1"></i> Pinjam Buku
                                    </a>
                                @else
                                    <button class="btn btn-secondary w-100 btn-sm" disabled>
                                        Stok Habis
                                    </button>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection
