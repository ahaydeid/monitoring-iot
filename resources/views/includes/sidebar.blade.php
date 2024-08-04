<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" style="background:#0D99FF !important">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link fw-bold mt-4 {{ request()->is('monitoring') ? 'active-nav' : '' }}" href="/monitoring">
                    <div class="sb-nav-link-icon {{ request()->is('monitoring') ? 'text-primary' : '' }}"><i class="fas fa-tachometer-alt"></i></div>
                    Monitoring
                </a>
                <a class="nav-link fw-bold {{ request()->is('katalog') ? 'active-nav' : '' }}" href="/katalog">
                    <div class="sb-nav-link-icon {{ request()->is('katalog') ? 'text-primary' : '' }}"><i class="fas fa-tachometer-alt"></i></div>
                    Katalog
                </a>
                <a class="nav-link fw-bold {{ request()->is('master-jenis-sayur') ? 'active-nav' : '' }}" href="/master-jenis-sayur">
                    <div class="sb-nav-link-icon {{ request()->is('master-jenis-sayur') ? 'text-primary' : '' }}"><i class="fas fa-tachometer-alt"></i></div>
                    Master Jenis Sayur
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer"  style="background:#0494fb !important">
            <div class="small fw-bold">Logged in as:</div>
             {{ Auth::user()->name }}
        </div>
    </nav>
</div>