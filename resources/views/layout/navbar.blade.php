<nav class="navbar navbar-expand-md navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">Lumen Poin Test</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('nasabah') ? 'active' : '' }}" aria-current="page"
                        href="{{ url('nasabah') }}">Nasabah</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('transaksi') ? 'active' : '' }}"
                        href="{{ url('transaksi') }}">Transaksi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('poin') ? 'active' : '' }}"
                        href="{{ url('poin') }}">Poin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('laporan') ? 'active' : '' }}"
                        href="{{ url('laporan') }}">Laporan</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
