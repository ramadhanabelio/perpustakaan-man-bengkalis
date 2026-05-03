<!-- Sidebar -->
<div class="sidebar" data-background-color="light">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header justify-content-center" data-background-color="light">

            <a href="{{ route('dashboard') }}" class="logo">
                <img src="{{ asset('img/brand.png') }}" alt="navbar brand" class="navbar-brand" height="30">
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>

        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-info">
                {{-- ================= ADMIN MENU ================= --}}
                @auth
                    @if (auth()->user()->role === 'admin')
                        <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-item {{ request()->is('books*') ? 'active' : '' }}">
                            <a href="{{ route('books.index') }}">
                                <i class="fas fa-book"></i>
                                <p>Kelola Buku</p>
                            </a>
                        </li>

                        <li class="nav-item {{ request()->is('members*') ? 'active' : '' }}">
                            <a href="{{ route('members.index') }}">
                                <i class="fas fa-users"></i>
                                <p>Kelola Anggota</p>
                            </a>
                        </li>

                        <li class="nav-item {{ request()->is('borrowings*') ? 'active' : '' }}">
                            <a href="{{ route('borrowings.index') }}">
                                <i class="fas fa-handshake"></i>
                                <p>Kelola Peminjaman</p>
                            </a>
                        </li>
                    @endif
                @endauth

                {{-- ================= MEMBER MENU ================= --}}
                @auth
                    @if (auth()->user()->role === 'member')
                        <li class="nav-item {{ request()->is('home') ? 'active' : '' }}">
                            <a href="{{ route('home') }}">
                                <i class="fas fa-home"></i>
                                <p>Beranda</p>
                            </a>
                        </li>

                        <li class="nav-item {{ request()->is('my-borrowings') ? 'active' : '' }}">
                            <a href="{{ route('borrow.my') }}">
                                <i class="fas fa-book-reader"></i>
                                <p>Peminjaman Saya</p>
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
