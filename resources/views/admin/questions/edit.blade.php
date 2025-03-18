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
                            <form action="{{ route('questions.update', $question->id) }}" method="POST" class="row g-3">
                                @csrf @method('PUT')

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select name="event_id" class="form-control">
                                            @foreach($events as $event)
                                            <option value="{{ $event->id }}" {{ $event->id == $question->event_id ? 'selected' : '' }}>
                                                {{ $event->name }}
                                            </option>
                                        @endforeach
                                        </select>
                                        <label for="event_id">Event </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="qus" placeholder="Quesiton"
                                            name="qus" required value="{{ $question->qus }}">
                                            
                                        <label for="qus">Quesiton</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" name="ans[]" class="form-control"
                                        value="{{ implode(',', explode(',', $question->ans)) }}">  
                                        <label for="qus">Answers (comma separated)</label>
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
