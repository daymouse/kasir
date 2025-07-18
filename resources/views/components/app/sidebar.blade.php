<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 fixed-start" id="sidenav-main" style="background-color: #EDE6DA;">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand d-flex align-items-center m-0" href="#">
            <img src="{{ asset('assets/img/remen.svg') }}" class="navbar-brand-img h-100 me-2" alt="logo" style="width: 30px;">
            <span class="font-weight-bold fs-5" style="color: #4E342E;">Remen Coffee</span>
        </a>
    </div>

    <div class="collapse navbar-collapse px-4 w-auto h-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">

            <li class="nav-item mb-2">
                <a class="nav-link {{ is_current_route('dashboard') ? 'active' : '' }}"
                   href="{{ route('dashboard') }}"
                   style="{{ is_current_route('dashboard') ? 'background-color:#BB9587; color:white; border-radius:.5rem;' : 'color:#4E342E;' }}">
                    <i class="fas fa-home me-2" style="color: {{ is_current_route('dashboard') ? '#FFFFFF' : '#4E342E' }};"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item mb-2">
                <a class="nav-link {{ is_current_route('tables') ? 'active' : '' }}"
                   href="{{ route('tables') }}"
                   style="{{ is_current_route('tables') ? 'background-color:#BB9587; color:white; border-radius:.5rem;' : 'color:#4E342E;' }}">
                    <i class="fas fa-list-alt me-2" style="color: {{ is_current_route('tables') ? '#FFFFFF' : '#4E342E' }};"></i>
                    <span>Daftar Pesanan</span>
                </a>
            </li>

            <li class="nav-item mt-4 text-uppercase ps-2" style="font-size: 0.8rem; color: #8B7E74;">Manajemen</li>

            <li class="nav-item mt-2">
                <a class="nav-link {{ is_current_route('users-management') ? 'active' : '' }}"
                   href="{{ route('users-management') }}"
                   style="{{ is_current_route('users-management') ? 'background-color:#BB9587; color:white; border-radius:.5rem;' : 'color:#4E342E;' }}">
                    <i class="fas fa-users me-2" style="color: {{ is_current_route('users-management') ? '#FFFFFF' : '#4E342E' }};"></i>
                    <span>User Management</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ is_current_route('produk-management') ? 'active' : '' }}"
                   href="{{ route('produk-management') }}"
                   style="{{ is_current_route('produk-management') ? 'background-color:#BB9587; color:white; border-radius:.5rem;' : 'color:#4E342E;' }}">
                    <i class="fas fa-box-open me-2" style="color: {{ is_current_route('produk-management') ? '#FFFFFF' : '#4E342E' }};"></i>
                    <span>Produk Management</span>
                </a>
            </li>

        </ul>
    </div>
</aside>
