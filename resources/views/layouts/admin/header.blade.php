 <!-- ======= Header ======= -->
 <header id="header" class="header fixed-top d-flex align-items-center">
     <div class="d-flex align-items-center justify-content-between">
         <a href="index.html" class="logo d-flex align-items-center">
             {{-- <img src="{{ asset('admin/assets/img/logo.png') }}" alt=""> --}}
             <span class="d-none d-lg-block">Alcore</span>
         </a>
         <i class="bi bi-list toggle-sidebar-btn"></i>
     </div><!-- End Logo -->

     <div class="search-bar">
         <form class="search-form d-flex align-items-center" method="POST" action="#">
             <input type="text" name="query" placeholder="Search" title="Enter search keyword">
             <button type="submit" title="Search"><i class="bi bi-search"></i></button>
         </form>
     </div><!-- End Search Bar -->

     <nav class="header-nav ms-auto">
         <ul class="d-flex align-items-center">

             <li class="nav-item d-block d-lg-none">
                 <a class="nav-link nav-icon search-bar-toggle " href="#">
                     <i class="bi bi-search"></i>
                 </a>
             </li><!-- End Search Icon-->
             @if(Auth::user()->role == 'superadmin')
             <li class="nav-item dropdown pe-3">

                 <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                     data-bs-toggle="dropdown">
                     <img src="{{ asset('storage/images/profile-images/' . Auth::user()->profile_photo_path) }}" alt="Profile" class="rounded-circle">
                     <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
                 </a><!-- End Profile Iamge Icon -->

                 <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                     <li class="dropdown-header">
                         <h6>{{ Auth::user()->name }}</h6>
                         <span>{{ ucfirst(Auth::user()->role) }}</span>
                     </li>
                     <li>
                         <hr class="dropdown-divider">
                     </li>

                     <li>
                         <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.profile') }}">
                             <i class="bi bi-person"></i>
                             <span>My Profile</span>
                         </a>
                     </li>
                     <li>
                         <hr class="dropdown-divider">
                     </li>
                     <form id="logout-form" action="{{ route('user.logout') }}" method="GET">
                      @csrf
                         <li>
                             <button class="dropdown-item d-flex align-items-center" type="submit"> <i class="bi bi-box-arrow-right"></i>
                              <span>Sign Out</span></button>
                         </li>
                     </form>
                    @endif
                    @if(Auth::guard('sponsor')->check())
                    <li class="nav-item dropdown pe-3">
       
                        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                            data-bs-toggle="dropdown">
                            <img src="{{ asset('storage/' . Auth::guard('sponsor')->user()->image) }}" alt="{{Auth::guard('sponsor')->user()->image}}" class="rounded-circle">
                            <span class="d-none d-md-block dropdown-toggle ps-2">{{Auth::guard('sponsor')->user()->username }}</span>
                        </a><!-- End Profile Iamge Icon -->
       
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                            <li class="dropdown-header">
                                <h6>{{ Auth::user()->name }}</h6>
                                <span>{{ ucfirst(Auth::user()->role) }}</span>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
       
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('sponsor.profile') }}">
                                    <i class="bi bi-person"></i>
                                    <span>My Profile</span>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <form id="logout-form" action="{{ route('user.logout') }}" method="GET">
                             @csrf
                                <li>
                                    <button class="dropdown-item d-flex align-items-center" type="submit"> <i class="bi bi-box-arrow-right"></i>
                                     <span>Sign Out</span></button>
                                </li>
                            </form>
                           @endif
                     <!-- Authentication -->
                 </ul><!-- End Profile Dropdown Items -->
             </li><!-- End Profile Nav -->

         </ul>
     </nav><!-- End Icons Navigation -->

 </header><!-- End Header -->
