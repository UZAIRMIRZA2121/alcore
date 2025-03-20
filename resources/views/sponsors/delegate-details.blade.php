@extends('layouts.admin.master')

@section('title', 'Sponsor-Dashboard')

@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Users</li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4 col-md-12">

                    <div class="card">

                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center ">

                            <img src="{{ asset('storage/images/delegates/' . $delegate->personal_picture) }}" alt="Profile" class="rounded-circle">
                            <h2>{{ $delegate->name }}</h2>
                            <h3>{{ $delegate->job_title }}</h3>
                        </div>
                    </div>
                    <div class="card">

                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center ">

                            <img src="{{ asset('storage/images/companies/' . $delegate->company_logo) }}" alt="Profile"
                                class="rounded-circle">
                            <h2>{{ $delegate->company_name }}</h2>

                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">
                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview">Overview</button>
                                </li>
                            </ul>
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12">
                                            {{-- <h5 class="card-title">Profile Details</h5> --}}
                                            {{-- <div class="row">
                                                <div class="col-lg-3 col-md-4 label ">Name</div>
                                                <div class="col-lg-9 col-md-8">{{ $delegate->name }}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Email</div>
                                                <div class="col-lg-9 col-md-8">{{ $delegate->email }}</div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Event</div>
                                                <div class="col-lg-9 col-md-8">{{ $delegate->event->name }}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Job</div>
                                                <div class="col-lg-9 col-md-8">{{ $delegate->job_title }}</div>
                                            </div> --}}
                                            <h5 class="card-title">About Delegates</h5>
                                            <p class="small fst-italic">{{ $delegate->personal_profile }}.</p>

                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <h5 class="card-title">Company Details</h5>
                                            <div class="row">
                                                <div class="col-lg-5 col-md-4 label">Company</div>
                                                <div class="col-lg-7 col-md-8">{{ $delegate->company_name }}</div>
                                            </div>
                                            <h5 class="card-title">About Company</h5>
                                            <p class="small fst-italic">{{ $delegate->company_profile }}.</p>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12">
                                            <h5 class="card-title">Event Questionnaire</h5>
                                            @foreach ($delegate->answers as $answer)
                                            <div class="row">
                                                <label class="col-lg-12 col-md-4 label ">{{$answer->question->qus}}</label> 
                                                <ul class="col-lg-9 col-md-8 ms-3 mb-0">
                                                    @foreach(explode(',', $answer->answers) as $ans)
                                                        <li> <b> {{ trim($ans) }}</b></li>
                                                    @endforeach
                                                </ul>
                                                
                                            </div>
                                            @endforeach
                                         
                                         
                                        </div>
                                    </div>



                                </div>
                            </div><!-- End Bordered Tabs -->

                            
                        </div>

                    </div>
                </div>
            </div>
        </section>



    </main><!-- End #main -->
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const profileImage = document.getElementById('profileImage');
            const uploadBtn = document.getElementById('uploadBtn');
            const removeBtn = document.getElementById('removeBtn');
            const fileInput = document.getElementById('fileInput');

            // Upload new profile image
            uploadBtn.addEventListener('click', function(event) {
                event.preventDefault();
                fileInput.click();
            });

            fileInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        profileImage.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Remove profile image
            removeBtn.addEventListener('click', function(event) {
                event.preventDefault();
                profileImage.src = 'assets/img/profile-img.jpg'; // Set to a default or blank image
            });
        });
    </script>
@endsection
