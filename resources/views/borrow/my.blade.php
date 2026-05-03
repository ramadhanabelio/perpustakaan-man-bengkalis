@extends('layouts.app')

@section('title', 'Peminjaman Saya')

@section('content')
    <div class="page-inner">

        {{-- HEADER --}}
        <div class="page-header">
            <div>
                <h3 class="fw-bold">Peminjaman Saya</h3>
                <h6 class="op-7">Riwayat peminjaman buku</h6>
            </div>
        </div>

        <div class="card card-round">
            <div class="card-header">
                <div class="card-title">Daftar Peminjaman</div>
            </div>

            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Buku</th>
                                <th>Tgl Pinjam</th>
                                <th>Jatuh Tempo</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($borrowings as $index => $b)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $b->book->title }}</td>
                                    <td>{{ $b->borrow_date }}</td>
                                    <td>{{ $b->due_date }}</td>
                                    <td>
                                        <span class="badge bg-{{ $b->status_color }}">
                                            {{ $b->status_label }}
                                        </span>
                                    </td>
                                    <td>

                                        {{-- AJUKAN RETURN --}}
                                        @if (in_array($b->status, ['approved', 'late']))
                                            <form action="{{ route('borrow.requestReturn', $b->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="fas fa-undo"></i>
                                                    Ajukan Pengembalian
                                                </button>
                                            </form>

                                            {{-- MENUNGGU --}}
                                        @elseif($b->status == 'return_requested')
                                            <span class="badge bg-info">
                                                Menunggu Persetujuan
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>
            </div>
        </div>

    </div>
@endsection
