@extends('layouts.admin.master')

@section('title', 'Admin-Dashboard')

@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Department</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Departments</li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->
        <section class="section dashboard">
            <div class="row">
                <!-- Left side columns -->
                <div class="col-12">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-1"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-octagon me-1"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Department <span>|</span></h5>

                            <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                                <div class="datatable-top">
                                    <div class="datatable-search">
                                        <input class="datatable-input" placeholder="Search..." type="search" name="search"
                                            title="Search within table">
                                    </div>
                                </div>
                                <div class="datatable-container">
                                    <table class="table table-borderless datatable datatable-table">
                                        <thead>
                                            <tr>
                                                <th scope="col" data-sortable="true" style="width: 10.711909514304724%;">
                                                    <button class="datatable-sorter">#</button>
                                                </th>
                                                <th scope="col" data-sortable="true" style="width: 23.486360612109113%;">
                                                    <button class="datatable-sorter">Name</button>
                                                </th>
                                                <th scope="col" data-sortable="true" class="red"
                                                    style="width: 14.770459081836327%;"><button
                                                        class="datatable-sorter">Action</button></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($departments as $department)
                                                <tr data-index="0">
                                                    <td scope="row"><a href="#">#{{ $department->id }}</a></td>
                                                    <td>{{ $department->name }}</td>
                                                    <td>
                                                        <a href="{{ route('departments.edit', $department->id) }}"
                                                            class="btn btn-primary btn-sm">Edit</a>
                                                            <form action="{{ route('departments.destroy', $department->id) }}" method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $department->id }}">Delete</button>
                                                            </form>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                <div class="datatable-bottom">
                                    <div class="datatable-info">Showing 1 to 5 of 5 entries</div>
                                    <nav class="datatable-pagination">
                                        <ul class="datatable-pagination-list"></ul>
                                    </nav>
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
  
    <script>
        // Add a click event listener to the delete button
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.delete-btn');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function (event) {
                    event.preventDefault(); // Prevent the default form submission
                    const departmentId = this.getAttribute('data-id');
    
                     // Show SweetAlert confirmation dialog
                     Swal.fire({
                        title: 'Are you sure?',
                        text: 'Once deleted, you will not be able to recover this!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Delete',
                        cancelButtonText: 'Cancel',
                        confirmButtonColor: '#dc3545', // Customize the color here
                        customClass: {
                            confirmButton: 'btn btn-danger', // Add a custom class to the confirm button
                            cancelButton: 'btn btn-secondary' // Add a custom class to the cancel button
                        },
                        dangerMode: true,
                    })
                    .then((result) => {
                        if (result.isConfirmed) {
                            // If user confirms deletion, submit the form
                            const form = document.createElement('form');
                            form.setAttribute('method', 'POST');
                            form.setAttribute('action', `{{ route('departments.destroy', '') }}/${departmentId}`);
                            form.innerHTML = `
                                @csrf
                                @method('DELETE')
                            `;
                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
