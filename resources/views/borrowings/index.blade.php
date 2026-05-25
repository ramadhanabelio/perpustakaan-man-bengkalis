@extends('layouts.app')

@section('title', 'Monitoring Peminjaman')

@section('content')
    <div class="page-inner">

        <div class="page-header">
            <h3 class="fw-bold">Monitoring Peminjaman</h3>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('dashboard') }}">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item">Peminjaman</li>
            </ul>

            <div class="ms-md-auto py-2 py-md-0">
                <a href="{{ route('borrowings.create') }}" class="btn btn-primary btn-round">
                    <i class="fas fa-plus me-2"></i> Tambah Data
                </a>
            </div>
        </div>

        <div class="card card-round">
            <div class="card-header">
                <div class="card-title">Data Peminjaman</div>
            </div>

            <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive table-fixed">
                    <table id="basic-datatables" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Member</th>
                                <th>Buku</th>
                                <th>Tgl Pinjam</th>
                                <th>Jatuh Tempo</th>
                                <th>Status</th>
                                <th width="220">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($borrowings as $i => $b)
                                <tr>
                                    <td>{{ $i + 1 }}.</td>
                                    <td>
                                        @if ($b->member)
                                            {{ $b->member->user->name }}
                                        @else
                                            <div>
                                                <strong>{{ $b->guest_name }}</strong><br>
                                                <small>{{ $b->guest_nisn }}</small>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $b->book->title }}</td>
                                    <td>{{ $b->borrow_date }}</td>
                                    <td>{{ $b->due_date }}</td>
                                    <td>
                                        <span class="badge bg-{{ $b->status_color }}">
                                            {{ $b->status_label }}
                                        </span>
                                    </td>
                                    <td>

                                        <div class="d-flex flex-wrap gap-1">

                                            <a href="{{ route('borrowings.edit', $b->id) }}"
                                                class="btn btn-warning btn-sm">Edit</a>

                                            <form action="{{ route('borrowings.destroy', $b->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Hapus data?')">Hapus</button>
                                            </form>

                                            {{-- APPROVE --}}
                                            @if ($b->status == 'pending')
                                                <form action="{{ route('borrowings.approve', $b->id) }}" method="POST">
                                                    @csrf
                                                    <button class="btn btn-success btn-sm">Setujui</button>
                                                </form>

                                                <form action="{{ route('borrowings.reject', $b->id) }}" method="POST">
                                                    @csrf
                                                    <button class="btn btn-secondary btn-sm">Tolak</button>
                                                </form>
                                            @endif

                                            {{-- RETURN LANGSUNG --}}
                                            @if ($b->status == 'approved')
                                                <form action="{{ route('borrowings.return', $b->id) }}" method="POST">
                                                    @csrf
                                                    <button class="btn btn-primary btn-sm">Dikembalikan</button>
                                                </form>
                                            @endif

                                            {{-- APPROVAL RETURN --}}
                                            @if ($b->status == 'return_requested')
                                                <form action="{{ route('borrowings.return', $b->id) }}" method="POST">
                                                    @csrf
                                                    <button class="btn btn-success btn-sm">Approve Return</button>
                                                </form>

                                                <form action="{{ route('borrowings.rejectReturn', $b->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button class="btn btn-danger btn-sm">Tolak Return</button>
                                                </form>
                                            @endif

                                            @if ($b->status == 'extend_requested')
                                                <form action="{{ route('borrowings.approveExtend', $b->id) }}"
                                                    method="POST" style="display:inline;">

                                                    @csrf

                                                    <button class="btn btn-warning btn-sm">
                                                        Setujui Perpanjangan
                                                    </button>
                                                </form>
                                            @endif

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
@endsection
