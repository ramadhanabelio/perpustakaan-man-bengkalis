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
                        <label>Pilih Member (Opsional)</label>

                        <select name="member_id" class="form-select">
                            <option value="">Pilih Member</option>

                            @foreach ($members as $m)
                                <option value="{{ $m->id }}">
                                    {{ $m->user->name }}
                                </option>
                            @endforeach
                        </select>

                        <small class="text-muted">
                            Jika tidak memiliki akun, isi data manual di bawah.
                        </small>
                    </div>

                    <hr>

                    <h5 class="fw-bold">Data Peminjam Non Akun</h5>

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="guest_name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>No HP</label>
                        <input type="text" name="guest_phone" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>NISN</label>
                        <input type="text" name="guest_nisn" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Buku</label>
                        <select name="book_id" class="form-select">
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
