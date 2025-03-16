@extends('layouts.admin.master')

@section('title', 'Admin-Dashboard')

@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Sponsors Priority</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item ">sponsors</li>
                    <li class="breadcrumb-item active">Priority</li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->
        <section class="section dashboard">
            <div class="row">
                <!-- Left side columns -->
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Total Priorities <span>|</span></h5>

                            <form action="{{ route('priorities.update') }}" method="POST">
                                @csrf
                                @method('POST') {{-- Use POST or PUT based on your setup --}}
                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Event Name</th>
                                            <th>Sponsor Name</th>
                                            <th>Delegate Name</th>
                                            <th>Priority</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($priorities as $priority)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $priority->event->name }}</td>
                                            <td>{{ $priority->sponsor->username }}</td>
                                            <td>{{ $priority->delegate->name }}</td>
                                            <td>
                                                @if ($priority->priority == 1)
                                                    <span class="badge bg-danger">First</span>
                                                @elseif ($priority->priority == 2)
                                                    <span class="badge bg-warning">Second</span>
                                                @elseif ($priority->priority == 3)
                                                    <span class="badge bg-success">Third</span>
                                                @else
                                                    <span class="badge bg-secondary">Not Set</span>
                                                @endif
                                            </td>
                                            <td>
                                                <input type="datetime-local" name="start_time[{{ $priority->id }}]" class="form-control" value="{{ $priority->start_time }}">
                                            </td>
                                            <td>
                                                <input type="datetime-local" name="end_time[{{ $priority->id }}]" class="form-control" value="{{ $priority->end_time }}">
                                            </td>
                                            <td>
                                                <input type="hidden" name="priority_ids[]" value="{{ $priority->id }}">
                                                <button class="btn btn-warning btn-sm reset-btn" data-id="{{ $priority->id }}">Reset</button>
                                            </td>
                                          
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Update All</button>
                                </div>
                            </form>
                            
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
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".reset-btn").forEach(function (button) {
            button.addEventListener("click", function () {
                event.preventDefault(); // Prevent default behavior
                
                let row = this.closest("tr");
                row.querySelector('input[name^="start_time"]').value = "";
                row.querySelector('input[name^="end_time"]').value = "";
            });
        });
    });
</script>

@endsection
