@extends('layouts.admin.master')

@section('title', 'Admin-Dashboard')

@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
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
                                            <i class="bi bi-stopwatch"></i></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $events->count() }}</h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Sales Card -->

                        <!-- Revenue Card -->
                        <div class="col-xxl-3 col-md-6">
                            <div class="card info-card revenue-card">

                                <div class="card-body">
                                    <h5 class="card-title">Sponsers <span>|</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people "></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{$sponsor->count()}}</h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Revenue Card -->

                        <!-- Customers Card -->
                        <div class="col-xxl-3 col-md-6">

                            <div class="card info-card customers-card">
                                <div class="card-body">
                                    <h5 class="card-title">Delegates <span>| </span></h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>44</h6>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div><!-- End Customers Card -->
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


                        <!-- Recent Sales -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">

                                {{-- <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>

                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div> --}}

                                <div class="card-body">
                                    <h5 class="card-title">Total Events <span>|</span></h5>

                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Start Date</th>
                                                <th scope="col">End Date</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 0;

                                            @endphp
                                            @foreach ($events as $event)
                                                <tr>
                                                    <th scope="row"><a href="#">{{ ++$i }}</a></th>
                                                    <td>{{ $event->name }}</td>
                                                    <td>
                                                      <span class="badge {{ $event->status == 'ongoing' || $event->status == 'completed' ? 'bg-success' : 'bg-danger' }}">
                                                          {{ $event->status }}
                                                      </span>
                                                  </td>
                                                  
                                                    <td>{{ date('Y-m-d', strtotime($event->start)) }}</td>
                                                    <td>{{ date('Y-m-d', strtotime($event->end)) }}</td>

                                                    <td>
                                                        <a href="{{ route('events.edit', $event->id) }}"
                                                            class="btn btn-warning">Edit</a>
                                                        <form id="delete-form-{{ $event->id }}"
                                                            action="{{ route('events.destroy', $event->id) }}"
                                                            method="POST" style="display:inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger delete-event-btn"
                                                                data-event-id="{{ $event->id }}">Delete</button>
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
                </div><!-- End Left side columns -->



            </div>
        </section>

    </main><!-- End #main -->
@endsection
