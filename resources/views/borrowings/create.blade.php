@extends('layouts.app')

@section('title', 'Tambah Peminjaman')

@section('content')
    <div class="page-inner">

        <div class="page-header">
            <h3 class="fw-bold">Tambah Peminjaman</h3>
        </div>

        <div class="card card-round">
            <div class="card-body">

                <form method="POST" action="{{ route('borrowings.store') }}">
                    @csrf

                    <div class="form-group">
                        <label>Member</label>
                        <select name="member_id" class="form-control">
                            @foreach ($members as $m)
                                <option value="{{ $m->id }}">{{ $m->user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Buku</label>
                        <select name="book_id" class="form-control">
                            @foreach ($books as $b)
                                <option value="{{ $b->id }}">{{ $b->title }} (Stok: {{ $b->stock }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Pinjam</label>
                        <input type="date" name="borrow_date" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Jatuh Tempo</label>
                        <input type="date" name="due_date" class="form-control" required>
                    </div>

                    {{-- hidden status --}}
                    <input type="hidden" name="status" value="pending">

                    <div class="mt-3">
                        <button class="btn btn-success">Simpan</button>
                        <a href="{{ route('borrowings.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection
