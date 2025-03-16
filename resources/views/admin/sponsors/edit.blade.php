@extends('layouts.admin.master')

@section('title', 'Admin-Dashboard')

@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Sponsor</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('sponsors.index') }}">Sponsor</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->
    

        <section class="section dashboard">
            <div class="row d-flex justify-content-center">
                <!-- Left side columns -->

                <div class="col-8 ">
                 @include('layouts.messages')

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Edit Sponsor</h5>
                            <!-- Floating Labels Form -->
                          
                            <form class="row g-3" action="{{ route('sponsors.update', $sponsor->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $sponsor->username) }}" placeholder="Username" required>
                                        <label for="username">Username</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $sponsor->email) }}" placeholder="Email" required>
                                        <label for="email">Email</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                        <label for="password">Password (Leave blank to keep current password)</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="active" {{ old('status', $sponsor->status) == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ old('status', $sponsor->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        <label for="status">Status</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $sponsor->phone) }}" placeholder="Phone" required>
                                        <label for="phone">Phone</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-control" id="event_id" name="event_id" required>
                                            @foreach($events as $event)
                                                <option value="{{ $event->id }}" {{ old('event_id', $sponsor->event_id) == $event->id ? 'selected' : '' }}>{{ $event->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="event_id">Event</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="file" class="form-control" id="image" name="image">
                                        <label for="image">Image</label>
                                        @if($sponsor->image)
                                            <small>Current Image: <a href="{{ asset('storage/' . $sponsor->image) }}" target="_blank">View</a></small>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="file" class="form-control" id="company_image" name="company_image">
                                        <label for="company_image">Company Image</label>
                                        @if($sponsor->company_image)
                                            <small>Current Company Image: <a href="{{ asset('storage/' . $sponsor->company_image) }}" target="_blank">View</a></small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="job" placeholder="job" name="job" value="{{ old('job', $sponsor->job) }}" required>
                                        <label for="job">Job</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="company_name" placeholder="company_name" name="company_name" value="{{ old('company_name', $sponsor->company_name) }}" required>
                                        <label for="company_name">Company Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <textarea class="form-control" id="details" name="details" placeholder="Details" style="height: 100px;" required>{{ old('details', $sponsor->details) }}</textarea>
                                        <label for="details">Details</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <textarea class="form-control" id="company_details" name="company_details" placeholder="Company Details" style="height: 100px;" required>{{ old('company_details', $sponsor->company_details) }}</textarea>
                                        <label for="company_details">Company Details</label>
                                    </div>
                                </div>
                                
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
