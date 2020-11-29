<div class="nav-active-text-primary" data-nav>
    <ul class="nav bg">
        <li class="nav-header hidden-folded">
            <span class="text-muted">Main</span>
        </li>
        <li>
            <a href="dashboard.html">
                <span class="nav-icon "><i data-feather='home'></i></span>
                <span class="nav-text">Dashboard</span>
            </a>
        </li>
        <li class="nav-header hidden-folded">
            <span class="text-muted">Rawat</span>
        </li>
        <li>
            <a href="{{ route('maintain.index') }}">
                <span class="nav-icon"><i data-feather='grid'></i></span>
                <span class="nav-text">Rencana kerja harian</span>
                {{-- <span class="nav-badge"><b class="badge-circle xs text-danger"></b></span> --}}
            </a>
            <a href="app.calendar.html">
                <span class="nav-icon text-primary"><i data-feather='grid'></i></span>
                <span class="nav-text">Riwayat</span>
                <span class="nav-badge"><b class="badge-circle xs text-danger"></b></span>
            </a>
        </li>

        <li class="nav-header hidden-folded">
            <span class="text-muted">Area</span>
        </li>
        <li>
            <a href="app.calendar.html">
                <span class="nav-icon"><i data-feather='grid'></i></span>
                <span class="nav-text">Kebun</span>
            </a>
            <a href="app.calendar.html">
                <span class="nav-icon"><i data-feather='grid'></i></span>
                <span class="nav-text">Afdelling</span>
            </a>
            <a href="app.calendar.html">
                <span class="nav-icon"><i data-feather='grid'></i></span>
                <span class="nav-text">Blok</span>
            </a>
        </li>

        <li class="nav-header hidden-folded">
            <span class="text-muted">Users</span>
        </li>
        <li>
            <a href="app.calendar.html">
                <span class="nav-icon"><i data-feather='grid'></i></span>
                <span class="nav-text">Mandor utama</span>
            </a>
            <a href="app.calendar.html">
                <span class="nav-icon"><i data-feather='grid'></i></span>
                <span class="nav-text">Mandor bidang</span>
            </a>
            {{-- <a href="#" class="">
                <span class="nav-icon"><i data-feather='grid'></i></span>
                <span class="nav-text">Components</span>
                <span class="nav-caret"></span>
            </a>
            <ul class="nav-sub nav-mega">
                <li>
                    <a href="ui.alert.html" class="">
                        <span class="nav-text">Alert</span>
                    </a>
                </li>
            </ul> --}}
        </li>
    </ul>
</div>