  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8"> -->
            IPB
      <span class="brand-text font-weight-light ml-2">PLANTERS Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block">Welcome</a>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-header ml-1">Rencana Kerja Harian</li>
          <li class="nav-item">
            <a href="{{ route('maintain.index') }}" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i>
              <p>RKH Rawat</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i>
              <p>RKH Panen</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-line"></i>
              <p>Pemutuan Panen</p>
            </a>
          </li>

          <li class="nav-header ml-1">Area</li>
          {{-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Tambah kebun</p>
            </a>
          </li> --}}
          <li class="nav-item">
            <a href="{{ route('farm') }}" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>Kebun</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('afdelling') }}" class="nav-link">
              <i class="nav-icon fas fa-tractor"></i>
              <p>Afdelling</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('block') }}" class="nav-link">
              <i class="nav-icon fas fa-th-large"></i>
              <p>Block</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('block_reference') }}" class="nav-link">
              <i class="nav-icon fas fa-th-large"></i>
              <p>Block Reference</p>
            </a>
          </li>

          <li class="nav-header ml-1">User</li>
          <li class="nav-item">
            <a href="{{ route('foreman.index') }}" class="nav-link">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>Mandor 1</p>
            </a>
          </li>

            <li class="nav-item">
            <a href="{{ route('subforeman.index') }}" class="nav-link">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>Mandor 2</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('job_type') }}" class="nav-link">
              <i class="nav-icon fas fa-user-cog"></i>
              <p>Job Type</p>
            </a>
          </li>

          <li></li>
          <li></li>
          <li></li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>