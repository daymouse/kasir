<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 fixed-start" id="sidenav-main" style="background-color: #EDE6DA;">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand d-flex align-items-center m-0" href="#" target="_blank">
            <span class="font-weight-bold text-lg" style="color: #4E342E;">Remen Coffee</span>
        </a>
    </div>

    <div class="collapse navbar-collapse px-4 w-auto h-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ is_current_route('dashkasir') ? 'active' : '' }}"
                   href="{{ route('dashkasir') }}"
                   style="{{ is_current_route('dashkasir') ? 'background-color:#BB9587; color: white; border-radius: .5rem;' : 'color:#4E342E;' }}">
                    <div class="icon icon-shape icon-sm px-0 d-flex align-items-center justify-content-center me-2">
                        <i class="fas fa-home" style="color: {{ is_current_route('dashkasir') ? '#FFFFFF' : '#4E342E' }};"></i>
                    </div>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ is_current_route('cari_barang') ? 'active' : '' }}"
                   href="{{ route('cari_barang') }}"
                   style="{{ is_current_route('cari_barang') ? 'background-color:#BB9587; color: white; border-radius: .5rem;' : 'color:#4E342E;' }}">
                    <div class="icon icon-shape icon-sm px-0 d-flex align-items-center justify-content-center me-2">
                        <i class="fas fa-coffee" style="color: {{ is_current_route('cari_barang') ? '#FFFFFF' : '#4E342E' }};"></i>
                    </div>
                    <span class="nav-link-text">Kasir</span>
                </a>
            </li>

            <!-- Tambahkan item lain jika perlu -->
        </ul>
    </div>
</aside>
