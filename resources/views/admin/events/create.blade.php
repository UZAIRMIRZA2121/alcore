@extends('layouts.admin.master')

@section('title', 'Admin-Dashboard')

@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>events</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('events.index') }}">events</a></li>
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
                            <h5 class="card-title">Add events</h5>
                            <!-- Floating Labels Form -->
                            <form class="row g-3" action="{{ route('events.store') }}" method="POST">
                                @csrf
                            
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="floatingName" placeholder="Name"
                                            name="name" value="{{ old('name') }}">
                                        <label for="floatingName">Name</label>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" class="form-control @error('lock_date') is-invalid @enderror" id="floatingLockDate" placeholder="Lock Date"
                                            name="lock_date" value="{{ old('lock_date') }}">
                                        <label for="floatingLockDate">Lock Date</label>
                                        @error('lock_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" class="form-control @error('start') is-invalid @enderror" id="floatingStart" placeholder="Start Date"
                                            name="start" value="{{ old('start') }}">
                                        <label for="floatingStart">Start Date</label>
                                        @error('start')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" class="form-control @error('end') is-invalid @enderror" id="floatingEnd" placeholder="End Date"
                                            name="end" value="{{ old('end') }}">
                                        <label for="floatingEnd">End Date</label>
                                        @error('end')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            
                                {{-- Uncomment this section if you have a description field --}}
                                {{-- <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control @error('description') is-invalid @enderror" placeholder="Description" id="floatingTextarea" style="height: 100px;" name="description">{{ old('description') }}</textarea>
                                        <label for="floatingTextarea">Description</label>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div> --}}
                            
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </form><!-- End floating Labels Form -->
                            
                        </div>
                    </div>
                </div>
                <!-- End Left side columns -->
            </div>
        </section>
    </main>
    <!-- End #main -->
@endsection
