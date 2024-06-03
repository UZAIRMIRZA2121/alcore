@extends('layouts.admin.master')

@section('title', 'Admin-Dashboard')

@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Delegates</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('delegates.index') }}">Delegates</a></li>
                    <li class="breadcrumb-item active">Add</li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="section dashboard">
            <div class="row d-flex justify-content-center">
                <!-- Left side columns -->

                <div class="col-8 ">
                    @include('layouts.messages')

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add Delegates</h5>
                            <form class="row g-3" method="POST" action="{{ route('delegates.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select name="event_id" id="event_id" class="form-control" required>
                                            @foreach ($events as $event)
                                                <option value="{{ $event->id }}">{{ $event->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="event_id">Event </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" placeholder="Name"
                                            name="name" required>
                                        <label for="name">Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="email" placeholder="Email"
                                            name="email" required>
                                        <label for="email">Email</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="job_title" placeholder="Job Title"
                                            name="job_title" required>
                                        <label for="job_title">Job Title</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="contact" placeholder="Contact"
                                            name="contact_number" required>
                                        <label for="contact">Contact</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="file" class="form-control" id="personal_picture" placeholder="Personal Image"
                                            name="personal_picture" required>
                                        <label for="email">Personal Image</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating">
                                            <textarea name="personal_profile" class="form-control" placeholder="Personal Profile" id="personal_profile" cols="30" rows="15" required></textarea>
                                        <label for="personal_profile">Personal Profile</label>
                                    </div>
                                </div> 
                                <h5 class="card-title">Company Details</h5>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="company_name" placeholder="Company Name"
                                            name="company_name" required>
                                        <label for="company_name">Company Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="file" class="form-control" id="company_logo" 
                                            name="company_logo" required>
                                        <label for="company">Company Logo</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating">
                                      
                                            <textarea name="company_profile" class="form-control" placeholder="Company Profile" id="company_profile" cols="30" rows="10" required></textarea>
                                        <label for="company_profile">Company Profile</label>
                                    </div>
                                </div> 
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <!-- End Left side columns -->
            </div>
        </section>
    </main>
    <!-- End #main -->
@endsection
