  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
          <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8"> -->
          IPB
          <span class="brand-text font-weight-light ml-2">Dashboard</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <li class="nav-header ml-1">Asisten Kebun</li>
                  <li class="nav-item">
                      <a href="{{ route('assistant.dashboard') }}" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>Dashboard</p>
                      </a>
                  </li>

                  <!-- <li class="nav-item">
            <a href="{{ route('assistant.farm') }}" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>Kebun</p>
            </a>
          </li> -->
                  <li class="nav-item">
                      <a href="{{ route('assistant.afdelling.blocks') }}" class="nav-link">
                          <i class="nav-icon fas fa-tractor active"></i>
                          <p>Manajemen Afdelling</p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a href="{{ route('assistant.activities.index') }}" class="nav-link">
                          <i class="nav-icon fas fa-tractor active"></i>
                          <p>Aktivitas Area</p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a href="{{ route('assistant.harvesting.index') }}" class="nav-link">
                          <i class="nav-icon fa fa-user" aria-hidden="true"></i>
                          <p>Manajemen Panen</p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a href="{{ route('assistant.hancak.index') }}" class="nav-link">
                          <i class="nav-icon fas fa-tractor active"></i>
                          <p>Manajemen hancak</p>
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
