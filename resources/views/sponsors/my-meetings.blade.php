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
                        <!-- Recent Sales -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">

                                <div class="card-body">
                                    <h5 class="card-title">Total Delagates <span>|</span></h5>

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
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach ($delegates as $delegate)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $delegate->event->name }}</td>
                                                    <td>{{ $delegate->name }}</td>
                                                    <td>{{ $delegate->email }}</td>
                                                    <td>{{ $delegate->contact_number }}</td>
                                                    <td>{{ $delegate->personal_profile }}</td>
                                                    <td>
                                                        <img src="{{ asset('storage/images/delegates/' . $delegate->personal_picture) }}"
                                                            style="cursor: pointer" alt="{{ $delegate->personal_picture }}"
                                                            width="100" class="clickable-image" data-toggle="modal"
                                                            data-target="#imageModal"
                                                            data-image="{{ asset('storage/images/delegates/' . $delegate->personal_picture) }}">
                                                    </td>
                                                    <td>{{ $delegate->company_name }}</td>
                                                    <td>{{ $delegate->company_profile }}</td>
                                                    <td>
                                                        <img src="{{ asset('storage/images/companies/' . $delegate->company_logo) }}"
                                                            style="cursor: pointer" alt="{{ $delegate->company_logo }}"
                                                            width="100" class="clickable-image" data-toggle="modal"
                                                            data-target="#imageModal"
                                                            data-image="{{ asset('storage/images/companies/' . $delegate->company_logo) }}">
                                                    </td>
                                                    <td>
                                                        <input type="datetime-local" name="start_time[{{ $delegate->id }}]" class="form-control start-time" value="{{ $delegate->start_time }}" data-delegate-id="{{ $delegate->id }}">
                                                    </td>
                                                    <td>
                                                        <input type="datetime-local" name="end_time[{{ $delegate->id }}]" class="form-control end-time" value="{{ $delegate->end_time }}" data-delegate-id="{{ $delegate->id }}">
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-warning btn-reset" data-id="{{ $delegate->id }}">Reset</button>
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
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".reset-btn").forEach(button => {
            button.addEventListener("click", function () {
                let delegateId = this.getAttribute("data-id");

                if (confirm("Are you sure you want to reset this delegate's datetime?")) {
                    fetch(`/delegates/reset/${delegateId}`, {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({ id: delegateId })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert("Datetime reset successfully!");
                        } else {
                            alert("Failed to reset datetime.");
                        }
                    })
                    .catch(error => console.error("Error:", error));
                }
            });
        });
    });
    </script>
@endsection
