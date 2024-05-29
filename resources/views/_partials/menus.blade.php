@php
    $routeActive = Route::currentRouteName();
@endphp

@if (Auth::check())
    <li class="nav-item">
        <a class="nav-link {{ $routeActive == 'home' ? 'active' : '' }}" href="{{ route('home') }}">
            <i class="ni ni-tv-2 text-primary"></i>
            <span class="nav-link-text">Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $routeActive == 'users.index' ? 'active' : '' }}" href="{{ route('users.index') }}">
            <i class="fas fa-users text-warning"></i>
            <span class="nav-link-text">Data Pengguna</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $routeActive == 'tracking-records.index' ? 'active' : '' }}"
            href="{{ route('tracking-records.index') }}">
            <i class="fas fa-users text-primary"></i>
            <span class="nav-link-text">Data Pengiriman</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $routeActive == 'profile' ? 'active' : '' }}" href="{{ route('profile') }}">
            <i class="fas fa-user-tie text-success"></i>
            <span class="nav-link-text">Profile</span>
        </a>
    </li>
@else
    <li class="nav-item">
        <a class="nav-link {{ $routeActive == 'scan.index' ? 'active' : '' }}" href="{{ route('scan.index') }}">
            <i class="ni ni-tv-2 text-primary"></i>
            <span class="nav-link-text">Scan Nomor Resi</span>
        </a>
    </li>
@endif
