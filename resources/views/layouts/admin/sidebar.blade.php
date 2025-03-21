 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

     <ul class="sidebar-nav" id="sidebar-nav">
        @if(Auth::user()->role == 'superadmin')
         <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
             <a class="nav-link  " href="{{ route('admin.dashboard') }}">
                 <i class="bi bi-grid"></i>
                 <span>Dashboard</span>
             </a>
         </li>
         <!-- End Dashboard Nav -->
         <!-- events link-->
         <li class="nav-item  ">
             <a class="nav-link collapsed " data-bs-target="#events" data-bs-toggle="collapse" href="#">
                 <i class="bi bi-menu-button-wide "></i><span>Events</span><i class="bi bi-chevron-down ms-auto"></i>
             </a>
             <ul id="events" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                 <li>
                     <a href="{{ route('events.create') }}">
                         <i class="bi bi-circle"></i><span>Add Events</span>
                     </a>
                 </li>
                 <li>
                     <a href="{{ route('events.index') }}">
                         <i class="bi bi-circle"></i><span>Events Management</span>
                     </a>
                 </li>
             </ul>
         </li>
         <!-- sponsors link-->
         <li class="nav-item  ">
             <a class="nav-link collapsed " data-bs-target="#sponsors" data-bs-toggle="collapse" href="#">
                 <i class="bi bi-menu-button-wide "></i><span>Sponsors</span><i class="bi bi-chevron-down ms-auto"></i>
             </a>
             <ul id="sponsors" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                 <li>
                     <a href="{{ route('sponsors.create') }}">
                         <i class="bi bi-circle"></i><span>Add Sponsors</span>
                     </a>
                 </li>
                 <li>
                     <a href="{{ route('sponsors.index') }}">
                         <i class="bi bi-circle"></i><span>Sponsors Management</span>
                     </a>
                 </li>
             </ul>
         </li>
         <!-- delegate link-->
         <li class="nav-item  ">
             <a class="nav-link collapsed " data-bs-target="#delegates" data-bs-toggle="collapse" href="#">
                 <i class="bi bi-menu-button-wide "></i><span>Delegates</span><i class="bi bi-chevron-down ms-auto"></i>
             </a>
             <ul id="delegates" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                 <li>
                     <a href="{{ route('delegates.create') }}">
                         <i class="bi bi-circle"></i><span>Add Delegates</span>
                     </a>
                 </li>
                 <li>
                     <a href="{{ route('delegates.index') }}">
                         <i class="bi bi-circle"></i><span>Delegates Management</span>
                     </a>
                 </li>
             </ul>
         </li>
            <!-- delegate link-->
            <li class="nav-item  ">
                <a class="nav-link collapsed " data-bs-target="#questions" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide "></i><span>Questions</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="questions" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('questions.create') }}">
                            <i class="bi bi-circle"></i><span>Add Questions</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('questions.index') }}">
                            <i class="bi bi-circle"></i><span>Questions Management</span>
                        </a>
                    </li>
                </ul>
            </li>
         <li class="nav-heading"></li>

@elseif(Auth::guard('sponsor')->check())
    <!-- Sponsor Dashboard -->
    <li class="nav-item {{ Request::is('sponsor/dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('sponsor.dashboard') }}">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item {{ Request::is('sponsor/my-meeting') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('sponsor.meeting') }}">
            <i class="bi bi-grid"></i>
            <span>My Meetings</span>
        </a>
    </li>
@endif
     </ul>

 </aside><!-- End Sidebar-->
