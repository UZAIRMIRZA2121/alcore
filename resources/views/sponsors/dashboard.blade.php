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

                                            <i class="bi bi-people "></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ Auth::guard('sponsor')->user()->event->name }}</h6>
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
                                            <h6>{{ \Carbon\Carbon::parse(Auth::guard('sponsor')->user()->event->start)->format('d M Y') }}</h6>

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
                                            <h6>{{ \Carbon\Carbon::parse(Auth::guard('sponsor')->user()->event->lock_date)->format('d M Y') }}</h6>

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
                                            <h6>{{ \Carbon\Carbon::parse(Auth::guard('sponsor')->user()->event->end)->format('d M Y') }}</h6>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div><!-- End Customers Card -->


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
                                    <h5 class="card-title">Total Delagates <span>|</span></h5>

                                    <form action="{{ route('delegates.updatePriorities') }}" method="POST">
                                        @csrf
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
                                                    <th >Priority</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i = 0; @endphp
                                                @foreach ($delegates as $delegate)
                                                    <tr>
                                                        <td>{{ ++$i }}</td>
                                                        <td>{{ $delegate->event->name }}</td>
                                                        <td>{{ $delegate->name }}</td>
                                                        <td>{{ $delegate->email }}</td>
                                                        <td>{{ $delegate->contact_number }}</td>
                                                        <td>{{ $delegate->personal_profile }}</td>
                                                        <td>
                                                            <img src="{{ asset('storage/images/delegates/' . $delegate->personal_picture) }}" width="100" class="clickable-image" 
                                                                data-toggle="modal" data-target="#imageModal"
                                                                data-image="{{ asset('storage/images/delegates/' . $delegate->personal_picture) }}">
                                                        </td>
                                                        <td>{{ $delegate->company_name }}</td>
                                                        <td>{{ $delegate->company_profile }}</td>
                                                        <td>
                                                            <img src="{{ asset('storage/images/companies/' . $delegate->company_logo) }}" width="100" class="clickable-image" 
                                                                data-toggle="modal" data-target="#imageModal"
                                                                data-image="{{ asset('storage/images/companies/' . $delegate->company_logo) }}">
                                                        </td>
                                                        <td >
                                                            {{-- {{$delegate->priority->priority}}2121 --}}
                                                            <input type="hidden" name="delegates[{{ $delegate->id }}][id]" value="{{ $delegate->id }}">
                                                            <select name="delegates[{{ $delegate->id }}][priority]" class="form-select" style="width: 100%">
                                                                <option value="0" {{ optional($delegate->priority)->priority == 0 ? 'selected' : '' }}>Select Priority</option>
                                                                <option value="1" {{ optional($delegate->priority)->priority == 1 ? 'selected' : '' }}>1 Priority </option>
                                                                <option value="2" {{ optional($delegate->priority)->priority == 2 ? 'selected' : '' }}>2 Priority </option>
                                                                <option value="3" {{ optional($delegate->priority)->priority == 3 ? 'selected' : '' }}>3 Priority </option>
                                                            </select>
                                                        </td>
                                                        
                                                        <td>
                                                            @if (Auth::guard('sponsor')->check() && Auth::guard('sponsor')->user()->event)
                                                                @php
                                                                    $lockDate = Auth::guard('sponsor')->user()->event->lock_date;
                                                                @endphp
                                    
                                                                @if (Carbon\Carbon::parse($lockDate)->lessThanOrEqualTo(Carbon\Carbon::now()))
                                                                <a href="{{ route('delegate.details', $delegate->id) }}" class="btn btn-primary">Details</a>

                                                                @else
                                                                    <span class="badge bg-danger">Time Out</span>
                                                                @endif
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-success">Submit Priorities</button>
                                        </div>
                                        
                                    </form>
                                    
                                </div>

                            </div>
                        </div><!-- End Recent Sales -->

                    </div>
                </div><!-- End Left side columns -->



            </div>
        </section>

    </main><!-- End #main -->
    <!-- Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" alt="Image Preview" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modalImage = document.getElementById('modalImage');
            const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));

            document.querySelectorAll('.clickable-image').forEach(image => {
                image.addEventListener('click', function() {
                    modalImage.src = this.dataset.image;
                    imageModal.show();
                });
            });
        });
    </script>
@endsection
