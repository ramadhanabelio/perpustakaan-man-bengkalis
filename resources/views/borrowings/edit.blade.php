@extends('layouts.app')

@section('title', 'Edit Peminjaman')

@section('content')
    <div class="page-inner">

        <div class="page-header">
            <h3 class="fw-bold">Edit Peminjaman</h3>
        </div>

        <div class="card card-round">
            <div class="card-body">

                <form method="POST" action="{{ route('borrowings.update', $borrowing->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Member</label>
                        <select name="member_id" class="form-control">
                            @foreach ($members as $m)
                                <option value="{{ $m->id }}" {{ $borrowing->member_id == $m->id ? 'selected' : '' }}>
                                    {{ $m->user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Buku</label>
                        <select name="book_id" class="form-control">
                            @foreach ($books as $b)
                                <option value="{{ $b->id }}" {{ $borrowing->book_id == $b->id ? 'selected' : '' }}>
                                    {{ $b->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Pinjam</label>
                        <input type="date" name="borrow_date" value="{{ $borrowing->borrow_date }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Jatuh Tempo</label>
                        <input type="date" name="due_date" value="{{ $borrowing->due_date }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="pending" {{ $borrowing->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ $borrowing->status == 'approved' ? 'selected' : '' }}>Disetujui
                            </option>
                            <option value="return_requested"
                                {{ $borrowing->status == 'return_requested' ? 'selected' : '' }}>Menunggu Pengembalian
                            </option>
                            <option value="returned" {{ $borrowing->status == 'returned' ? 'selected' : '' }}>Dikembalikan
                            </option>
                            <option value="late" {{ $borrowing->status == 'late' ? 'selected' : '' }}>Terlambat</option>
                            <option value="rejected" {{ $borrowing->status == 'rejected' ? 'selected' : '' }}>Ditolak
                            </option>
                        </select>
                    </div>

                    <div class="mt-3">
                        <button class="btn btn-success">Update</button>
                        <a href="{{ route('borrowings.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection
