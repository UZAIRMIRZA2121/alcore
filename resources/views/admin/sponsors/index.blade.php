@extends('layouts.admin.master')

@section('title', 'Admin-Dashboard')

@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Sponsors</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">sponsors</li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->
        <section class="section dashboard">
            <div class="row">
                <!-- Left side columns -->
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
                                            $i=1;
                                            @endphp
                                            @foreach ($sponsors as $sponsor)
                                            <tr>
                                                <td>{{ $i++}}</td>
                                                <td>{{ $sponsor->username }}</td>
                                                <td>{{ $sponsor->email }}</td>
                                                <td>
                                                    <span class="badge {{ $sponsor->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                                        {{ $sponsor->status }}
                                                    </span>
                                                </td>
                                                
                                                <td>{{ $sponsor->event->name ?? 'No Event' }}</td>
                                                <td><img src="{{ asset('storage/' . $sponsor->image) }}" alt="Sponsor Image" width="50">
                                                </td>
                                                <td><img src="{{ asset('storage/' . $sponsor->company_image) }}" alt="Sponsor Image" width="50">
                                            
                                                <td>{{ \Illuminate\Support\Str::limit($sponsor->details, 10, '...') }}</td>
                                                <td>{{ \Illuminate\Support\Str::limit($sponsor->company_details, 10, '...') }}</td>

                                                <td>
                                                    <a href="{{ route('sponsors.show', $sponsor->id) }}"
                                                        class="btn btn-sm btn-warning">Details</a>
                                                    <a href="{{ route('sponsors.edit', $sponsor->id) }}" class="btn btn-warning">Edit</a>
                                                    <form id="delete-form-{{ $sponsor->id }}" action="{{ route('sponsors.destroy', $sponsor->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger delete-sponsor-btn" data-sponsor-id="{{ $sponsor->id }}">Delete</button>
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
    </main>
    <!-- End #main -->

 <!-- Include Sweet Alert library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-sponsor-btn').forEach(button => {
            button.addEventListener('click', function () {
                const sponsorId = this.getAttribute('data-sponsor-id');
                const form = document.getElementById(`delete-form-${sponsorId}`);
                if (confirm('Are you sure you want to delete this sponsor?')) {
                    form.submit();
                }
            });
        });
    });
</script>

@endsection
