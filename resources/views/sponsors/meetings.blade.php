@extends('layouts.admin.master')

@section('title', 'Sponsor-Dashboard')

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
                        <!-- Recent Sales -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">

                                <div class="card-body">
                                    <h5 class="card-title">Total Delagates <span>|</span></h5>

                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Delegate Name</th>
                                                <th>Email</th>
                                                {{-- <th>Contact</th> --}}
                                                <th>Pic</th>
                                                <th>Company Name</th>
                                                <th>Priority</th>
                                                <th>Start Meeting</th>
                                                <th>End Meeting</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $i = 0; @endphp
                                            @foreach ($priorities as $prioritie)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $prioritie->delegate->name }}</td>
                                                    <td>{{ $prioritie->delegate->email }}</td>
                                                    {{-- <td>{{ $prioritie->delegate->contact_number }}</td> --}}
                                                    <td>
                                                        <img src="{{ asset('storage/images/delegates/' . $prioritie->delegate->personal_picture) }}"
                                                            width="100" class="clickable-image" data-toggle="modal"
                                                            data-target="#imageModal"
                                                            data-image="{{ asset('storage/images/delegates/' . $prioritie->delegate->personal_picture) }}">
                                                    </td>
                                                    <td>{{ $prioritie->delegate->company_name }}</td>
                                                 
                                                    <td>
                                                        @if (optional($prioritie->delegate->priority)->priority == 1)
                                                        <span class="badge bg-danger">First</span>
                                                    @elseif (optional($prioritie->delegate->priority)->priority == 2)
                                                        <span class="badge bg-warning">Second</span>
                                                    @elseif (optional($prioritie->delegate->priority)->priority == 3)
                                                        <span class="badge bg-success">Third</span>
                                                    @else
                                                        <span class="badge bg-secondary">Not Set</span>
                                                    @endif
                                                    </td>
                                                    <td>
                                                        {{ $prioritie->start_time ? \Carbon\Carbon::parse($prioritie->start_time)->format('d M Y, h:i A') : 'N/A' }}
                                                    </td>
                                                    <td>
                                                        {{ $prioritie->end_time ? \Carbon\Carbon::parse($prioritie->end_time)->format('d M Y, h:i A') : 'N/A' }}
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
  
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


@endsection
