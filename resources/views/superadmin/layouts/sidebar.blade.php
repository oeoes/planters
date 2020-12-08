  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
            IPB
      <span class="brand-text font-weight-light ml-2">PLANTERS Dashboard</span>
    </a>

    <div class="sidebar">
    
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('superadmin.dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-header ml-1">Rencana Kerja Harian</li>
          <li class="nav-item has-threeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i>
              <p>RKH Rawat <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('superadmin.spraying.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Spraying</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('superadmin.fertilizer.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fertilizer</p>
                </a>
              </li><li class="nav-item">
                <a href="{{ route('superadmin.circle.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manual Circle</p>
                </a>
              </li><li class="nav-item">
                <a href="{{ route('superadmin.pruning.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manual Pruning</p>
                </a>
              </li><li class="nav-item">
                <a href="{{ route('superadmin.gawangan.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manual Gawangan</p>
                </a>
              </li><li class="nav-item">
                <a href="{{ route('superadmin.pestcontrol.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pest Control</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ route('superadmin.harvesting.index') }}" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i>
              <p>RKH Panen</p>
            </a>
          </li>

          <li class="nav-header ml-1">Area</li>
          
          <li class="nav-item">
            <a href="{{ route('superadmin.farm') }}" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>Kebun</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('superadmin.afdelling') }}" class="nav-link">
              <i class="nav-icon fas fa-tractor"></i>
              <p>Afdelling</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('superadmin.block') }}" class="nav-link">
              <i class="nav-icon fas fa-th-large"></i>
              <p>Block</p>
            </a>
          </li>

          <li class="nav-header ml-1">User</li>

          <li class="nav-item">
            <a href="{{ route('superadmin.user.manager.index') }}" class="nav-link">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>Manager</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('superadmin.user.assistant.index') }}" class="nav-link">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>Assistant</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('superadmin.foreman.index') }}" class="nav-link">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>Mandor</p>
            </a>
          </li>

            <li class="nav-item">
            <a href="{{ route('superadmin.subforeman.index') }}" class="nav-link">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>Mandor Bidang</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('superadmin.job_type') }}" class="nav-link">
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