<div class="navbar-bg d-none d-lg-block"></div>
<nav class="navbar navbar-expand-lg main-navbar container-lg bg-primary">
    <a href="/" class="navbar-brand sidebar-gone-hide">{{ config('app.name') }}</a>
    <a href="#" class="nav-link d-flex justify-content-center align-items-center d-lg-none" data-toggle="sidebar"><i
            class="fas fa-bars"></i> <span
            class="ml-3 font-weight-bold text-uppercase">{{ config('app.name') }}</span></a>
    <div class="ml-auto">
        @if (Auth::user())
            <ul class="navbar-nav navbar-right">
                <li class="dropdown"><a href="#" data-toggle="dropdown"
                        class="nav-link dropdown-toggle nav-link-lg nav-link-user d-flex justify-content-center align-items-center">
                        <div style="background-image: url('{{ asset(Auth::user()->image != null ? '/storage/image/user/' . Auth::user()->image : '/img/avatar/avatar-1.png') }}');"
                            class="img-navbar d-block mr-3"></div>
                        <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->nama }}</div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="{{ route('profil') }}" class="dropdown-item has-icon">
                            <i class="far fa-user"></i> Profil
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>
        @else
            <a href="{{ route('login') }}" class="btn btn-sm bg-white"><i class="fas fa-sign-in-alt mr-1"></i> Login</a>
        @endif

    </div>
</nav>

<nav class="navbar navbar-secondary navbar-expand-lg">
    <div class="container">
        <ul class="navbar-nav">
            <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                <a href="/" class="nav-link"><i class="fas fa-home"></i><span>Beranda</span></a>
            </li>
            <li
                class="nav-item {{ Request::is('sewa-mobil') || Request::is('sewa-mobil/*') || Request::is('mobil') || Request::is('mobil/*') ? 'active' : '' }}">
                <a href="/sewa-mobil" class="nav-link active"><i class="fas fa-car"></i><span>Sewa Mobil</span></a>
            </li>
            @if (Auth::user())
                <li class="nav-item  {{ Request::is('peminjaman') ? 'active' : '' }}">
                    <a href="/peminjaman" class="nav-link"><i
                            class="fas fa-calendar-plus"></i><span>Peminjaman</span></a>
                </li>
                <li class="nav-item  {{ Request::is('pengembalian') ? 'active' : '' }}">
                    <a href="/pengembalian" class="nav-link"><i
                            class="fas fa-calendar-minus"></i><span>Pengembalian</span></a>
                </li>
            @endif
        </ul>
    </div>
</nav>
