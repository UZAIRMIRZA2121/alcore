@extends('layouts.admin.master')

@section('title', 'Admin-Dashboard')

@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item ">Event</li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                            <!-- Sales Card -->
                            <div class="col-xxl-3 col-md-6">
                                <div class="card info-card sales-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Events <span>| </span></h5>
    
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
    
                                                <i class="bi bi-people "></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $event->name }}</h6>
                                            </div>
                                        </div>
                                    </div>
    
                                </div>
                            </div><!-- End Sales Card -->
    
                            <!-- Revenue Card -->
                            <div class="col-xxl-3 col-md-6">
                                <div class="card info-card revenue-card">
    
                                    <div class="card-body">
                                        <h5 class="card-title">Event Start <span>|</span></h5>
    
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
    
                                                <i class="bi bi-calendar"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ \Carbon\Carbon::parse($event->start)->format('d F Y') }}
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
    
                                </div>
                            </div><!-- End Revenue Card -->
    
                            <!-- Customers Card -->
                            <div class="col-xxl-3 col-md-6">
    
                                <div class="card info-card customers-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Event Lock <span>| </span></h5>
    
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-stopwatch"></i></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ \Carbon\Carbon::parse($event->lock_date)->format('d F Y') }}
                                                </h6>
                                            </div>
                                        </div>
    
                                    </div>
                                </div>
    
                            </div><!-- End Customers Card -->
                            <!-- Customers Card -->
                            <div class="col-xxl-3 col-md-6">
    
                                <div class="card info-card customers-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Event End <span>| </span></h5>
    
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center text-danger">
                                                <i class="bi bi-calendar"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ \Carbon\Carbon::parse($event->end)->format('d F Y') }}
                                                </h6>
                                            </div>
                                        </div>
    
                                    </div>
                                </div>
    
                            </div><!-- End Customers Card -->
    
                        <!-- End Customers Card -->
                        <!-- Customers Card -->
                        {{-- <div class="col-xxl-3 col-md-6">

            <div class="card info-card customers-card">
              <div class="card-body">
                <h5 class="card-title">Department <span>| </span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="ps-3">
                    <h6></h6>
                  </div>
                </div>

              </div>
            </div>

          </div><!-- End Customers Card --> --}}
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"></h5>

                                <!-- Bordered Tabs Justified -->
                                <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
                                    <li class="nav-item flex-fill" role="presentation">
                                        <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab"
                                            data-bs-target="#bordered-justified-home" type="button" role="tab"
                                            aria-controls="home" aria-selected="true">Sponsors   <span class="badge rounded-pill bg-info">{{$sponsors->count()}}</span></button>
                                    </li>
                                    <li class="nav-item flex-fill" role="presentation">
                                        <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab"
                                            data-bs-target="#bordered-justified-profile" type="button" role="tab"
                                            aria-controls="profile" aria-selected="false" tabindex="-1">Delegates <span class="badge rounded-pill bg-info">{{$delegates->count()}}</span></button>
                                    </li>
                                </ul>
                                <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                                    <div class="tab-pane fade active show" id="bordered-justified-home" role="tabpanel"
                                        aria-labelledby="home-tab">
                                        <!-- Recent Sales -->
                                        <div class="col-12">
                                            <div class="card recent-sales overflow-auto">
                                                <div class="card-body">
                                                    <h5 class="card-title">Sponsers<span>|</span></h5>

                                                    <table class="table table-borderless datatable">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>User Name</th>
                                                                <th>Email</th>
                                                                <th>Status</th>
                                                                <th>Event</th>
                                                                <th>Sponsor Image</th>
                                                                <th>Company Image</th>
                                                                <th>Sponsor Details</th>
                                                                <th>Company Details</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                $i = 1;
                                                            @endphp
                                                            @foreach ($sponsors as $sponsor)
                                                                <tr>
                                                                    <td>{{ $i++ }}</td>
                                                                    <td>{{ $sponsor->username }}</td>
                                                                    <td>{{ $sponsor->email }}</td>
                                                                    <td>
                                                                        <span
                                                                            class="badge {{ $sponsor->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                                                            {{ $sponsor->status }}
                                                                        </span>
                                                                    </td>
                                                                    <td>{{ $sponsor->event->name ?? 'No Event' }}</td>
                                                                    <td><img src="{{ asset('storage/' . $sponsor->image) }}"
                                                                            alt="Sponsor Image" width="50">
                                                                    </td>
                                                                    <td><img src="{{ asset('storage/' . $sponsor->company_image) }}"
                                                                            alt="Sponsor Image" width="50">
                                                                    <td>{{ $sponsor->details }}</td>
                                                                    <td>{{ $sponsor->company_details }}</td>
                                                                    <td>
                                                                     
                                                                        <a href="{{ route('sponsors.edit', $sponsor->id) }}"
                                                                            class="btn btn-sm btn-warning">Edit</a>
                                                                        <form id="delete-form-{{ $sponsor->id }}"
                                                                            action="{{ route('sponsors.destroy', $sponsor->id) }}"
                                                                            method="POST" style="display:inline-block;">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="button"
                                                                                class="btn btn-danger btn-sm delete-sponsor-btn"
                                                                                data-sponsor-id="{{ $sponsor->id }}">Delete</button>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>

                                                </div>

                                            </div>
                                        </div><!-- End Recent Sales -->

                                    </div>
                                    <div class="tab-pane fade" id="bordered-justified-profile" role="tabpanel"
                                        aria-labelledby="profile-tab">
                                        <!-- Recent Sales -->
                                        <div class="col-12">
                                            <div class="card recent-sales overflow-auto">
                                                <div class="card-body">
                                                    <h5 class="card-title">Delegates<span>|</span></h5>

                                                    <table class="table table-borderless datatable">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Event Name</th>
                                                                <th>Name</th>
                                                                <th>Email</th>
                                                                <th>Contact</th>
                                                                <th>Profile</th>
                                                                <th>Pic</th>
                                                                <th>Company Name</th>
                                                                <th>Company Profile</th>
                                                                <th>Company Logo</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                $i = 1;
                                                            @endphp
                                                            @foreach ($delegates as $delegate)
                                                                <tr>
                                                                    <td>{{ $i++ }}</td>
                                                                    <td>{{ $delegate->event->name }}</td>
                                                                    <td>{{ $delegate->name }}</td>
                                                                    <td>{{ $delegate->email }}</td>
                                                                    <td>{{ $delegate->contact_number }}</td>
                                                                    <td>{{ $delegate->personal_profile }}</td>
                                                                    <td>
                                                                        <img src="{{ asset('storage/images/delegates/' . $delegate->personal_picture) }}"
                                                                            style="cursor: pointer"
                                                                            alt="{{ $delegate->personal_picture }}"
                                                                            width="100" class="clickable-image"
                                                                            data-toggle="modal" data-target="#imageModal"
                                                                            data-image="{{ asset('storage/images/delegates/' . $delegate->personal_picture) }}">
                                                                    </td>
                                                                    <td>{{ $delegate->company_name }}</td>
                                                                    <td>{{ $delegate->company_profile }}</td>
                                                                    <td>
                                                                        <img src="{{ asset('storage/images/companies/' . $delegate->company_logo) }}"
                                                                            style="cursor: pointer"
                                                                            alt="{{ $delegate->company_logo }}"
                                                                            width="100" class="clickable-image"
                                                                            data-toggle="modal" data-target="#imageModal"
                                                                            data-image="{{ asset('storage/images/companies/' . $delegate->company_logo) }}">
                                                                    </td>

                                                                    <td>
                                                                        <a href="{{ route('delegates.edit', $delegate->id) }}"
                                                                            class="btn btn-primary btn-sm">Edit</a>
                                                                        <form
                                                                            action="{{ route('delegates.destroy', $delegate->id) }}"
                                                                            method="POST" style="display: inline;">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                class="btn btn-danger btn-sm">Delete</button>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>

                                                </div>

                                            </div>
                                        </div><!-- End Recent Sales -->

                                    </div>

                                </div><!-- End Bordered Tabs Justified -->

                            </div>
                        </div>
                    </div>
                </div><!-- End Left side columns -->
            </div>
        </section>
    </main><!-- End #main -->
@endsection
