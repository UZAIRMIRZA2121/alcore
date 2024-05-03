 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{route('admin.dashboard')}}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <!-- End Dashboard Nav -->
      <li class="nav-item">
        <a class="nav-link " href="{{route('admin.dashboard')}}">
          <i class="bi bi-grid"></i>
          <span>Patient</span>
        </a>
      </li>
      <!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Components</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="components-alerts.html">
              <i class="bi bi-circle"></i><span>Alerts</span>
            </a>
          </li>
          <li>
            <a href="components-accordion.html">
              <i class="bi bi-circle"></i><span>Accordion</span>
            </a>
          </li>
        </ul>
      </li>
      <!-- End Components Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#doctors" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Doctor</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="doctors" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('doctors.create') }}">
              <i class="bi bi-circle"></i><span>Add Doctor</span>
            </a>
          </li>
          <li>
            <a href="{{ route('doctors.index') }}">
                <i class="bi bi-circle"></i><span>Manage Doctor</span>
            </a>
        </li>
        
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#department" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Department</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="department" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('departments.create') }}">
              <i class="bi bi-circle"></i><span>Add Department</span>
            </a>
          </li>
          <li>
            <a href="{{ route('departments.index') }}">
                <i class="bi bi-circle"></i><span>Manage Department</span>
            </a>
        </li>
        
        </ul>
      </li>
     
      <li class="nav-heading">Pages</li>

     
    </ul>

  </aside><!-- End Sidebar-->