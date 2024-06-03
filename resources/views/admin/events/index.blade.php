@extends('layouts.admin.master')

@section('title', 'Admin-Dashboard')

@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Events</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Events</li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->
        <section class="section dashboard">
            <div class="row">
                <!-- Left side columns -->
                <div class="col-12">
                    @include('layouts.messages')
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Events <span>|</span></h5>

                            <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                                <div class="datatable-container">
                                    <table class="table table-borderless datatable datatable-table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Status</th>
                                                <th>Start</th>
                                                <th>End</th>
                                                <th>Lock Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $i=1;
                                            @endphp
                                            @foreach ($events as $event)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $event->name }}</td>
                                                <td>{{ $event->status }}</td>
                                                <td>{{ $event->start }}</td>
                                                <td>{{ $event->end }}</td>
                                                <td>{{ $event->lock_date }}</td>
                                                <td>
                                                    <a href="{{ route('events.show', $event->id) }}" class="btn btn-info">Details</a>
                                                    {{-- <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning">Edit</a> --}}
                                                    <form id="delete-form-{{ $event->id }}" action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger delete-event-btn" data-event-id="{{ $event->id }}">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <!-- End Left side columns -->
            </div>
        </section>
    </main>
    <!-- End #main -->

 <!-- Include Sweet Alert library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Function to show Sweet Alert confirmation dialog
    function confirmDelete(eventId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form
                document.getElementById('delete-form-' + eventId).submit();
            }
        });
    }

    // Attach click event listener to delete buttons
    document.querySelectorAll('.delete-event-btn').forEach(button => {
        button.addEventListener('click', () => {
            confirmDelete(button.getAttribute('data-event-id'));
        });
    });
</script>
@endsection
