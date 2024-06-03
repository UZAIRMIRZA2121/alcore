@extends('layouts.admin.master')

@section('title', 'Admin-Dashboard')

@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Delegates</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">delegates</li>
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
                            <h5 class="card-title">Delegates <span>|</span></h5>

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
                                                <img src="{{ asset('storage/images/delegates/' . $delegate->personal_picture) }}" style="cursor: pointer"
                                                    alt="{{ $delegate->personal_picture }}" width="100"
                                                    class="clickable-image" data-toggle="modal" data-target="#imageModal"
                                                    data-image="{{ asset('storage/images/delegates/' . $delegate->personal_picture) }}">
                                            </td>
                                            <td>{{ $delegate->company_name }}</td>
                                            <td>{{ $delegate->company_profile }}</td>
                                            <td>
                                                <img src="{{ asset('storage/images/companies/' . $delegate->company_logo) }}" style="cursor: pointer"
                                                    alt="{{ $delegate->company_logo }}" width="100"
                                                    class="clickable-image" data-toggle="modal" data-target="#imageModal"
                                                    data-image="{{ asset('storage/images/companies/' . $delegate->company_logo) }}">
                                            </td>

                                            <td>
                                                <a href="{{ route('delegates.edit', $delegate->id) }}"
                                                    class="btn btn-primary">Edit</a>
                                                <form action="{{ route('delegates.destroy', $delegate->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
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
    <!-- Include Sweet Alert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-delegates-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const delegatesId = this.getAttribute('data-delegates-id');
                    const form = document.getElementById(`delete-form-${delegatesId}`);
                    if (confirm('Are you sure you want to delete this delegates?')) {
                        form.submit();
                    }
                });
            });
        });
    </script>
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
