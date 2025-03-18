@extends('layouts.admin.master')

@section('title', 'Edit Delegate')

@section('main')
    <style>
        .d-flex {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 5px;
        }
    </style>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Edit Delegate</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('delegates.index') }}">Delegates</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>

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
                <div class="col-8">
                    @include('layouts.messages')

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Edit Delegate</h5>
                            <form class="row g-3" method="POST" action="{{ route('delegates.update', $delegate->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select name="event_id" id="event_id" class="form-control" required>
                                            @foreach ($events as $event)
                                                <option value="{{ $event->id }}"
                                                    {{ $delegate->event_id == $event->id ? 'selected' : '' }}>
                                                    {{ $event->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="event_id">Event </label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ $delegate->name }}" required>
                                        <label for="name">Name</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="email" name="email"
                                            value="{{ $delegate->email }}" required>
                                        <label for="email">Email</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="job_title" name="job_title"
                                            value="{{ $delegate->job_title }}" required>
                                        <label for="job_title">Job Title</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="contact" name="contact_number"
                                            value="{{ $delegate->contact_number }}" required>
                                        <label for="contact">Contact</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="file" class="form-control" id="personal_picture"
                                            name="personal_picture">
                                        <label for="personal_picture">Personal Image</label>
                                        @if ($delegate->personal_picture)
                                            <img src="{{ asset('storage/' . $delegate->personal_picture) }}" width="100"
                                                class="mt-2">
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <textarea name="personal_profile" class="form-control" id="personal_profile" required>{{ $delegate->personal_profile }}</textarea>
                                        <label for="personal_profile">Personal Profile</label>
                                    </div>
                                </div>

                                <h5 class="card-title">Company Details</h5>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="company_name" name="company_name"
                                            value="{{ $delegate->company_name }}" required>
                                        <label for="company_name">Company Name</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="file" class="form-control" id="company_logo" name="company_logo">
                                        <label for="company_logo">Company Logo</label>
                                        @if ($delegate->company_logo)
                                            <img src="{{ asset('storage/' . $delegate->company_logo) }}" width="100"
                                                class="mt-2">
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <textarea name="company_profile" class="form-control" id="company_profile" required>{{ $delegate->company_profile }}</textarea>
                                        <label for="company_profile">Company Profile</label>
                                    </div>
                                </div>

                                <h5 class="card-title">Questions</h5>
                                <div class="col-md-12">
                                    <div id="questions_container"></div>
                                </div>

                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('delegates.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            var savedAnswers = @json($savedAnswers); // Previously saved answers from backend
    
            function loadQuestions(eventId) {
                if (!eventId) {
                    $('#questions_container').html('');
                    return;
                }
    
                $.ajax({
                    url: "{{ route('get.question.answers') }}",
                    type: "GET",
                    data: { question_id: eventId },
                    success: function (response) {
                        renderQuestions(response);
                    },
                    error: function () {
                        $('#questions_container').html('<p class="text-danger">Error loading questions.</p>');
                    }
                });
            }
    
            function renderQuestions(response) {
                $('#questions_container').html('');
    
                if (!response.success || !response.questions.length) {
                    $('#questions_container').html('<p class="text-danger">No questions available for this event.</p>');
                    return;
                }
    
                let output = '';
                $.each(response.questions, function (index, question) {
                    let checkedAnswers = savedAnswers[question.question_id] ? savedAnswers[question.question_id].split(',') : [];
    
                    output += `<h5>${question.question} (ID: ${question.question_id})</h5>`;
                    output += `<input type="hidden" name="question_ids[]" value="${question.question_id}">`;
                    output += `<div class="d-flex flex-wrap gap-2">`;
    
                    $.each(question.answers, function (i, answer) {
                        let isChecked = checkedAnswers.includes(answer) ? 'checked' : '';
    
                        output += `
                            <div class="form-check d-flex align-items-center">
                                <input class="form-check-input me-2" type="checkbox" 
                                    name="question_${question.question_id}[]" 
                                    id="answer_${question.question_id}_${i}" 
                                    value="${answer}" ${isChecked}>
                                <label class="form-check-label" for="answer_${question.question_id}_${i}">
                                    ${answer}
                                </label>
                            </div>
                        `;
                    });
    
                    output += `</div><hr>`;
                });
    
                $('#questions_container').html(output);
            }
    
            // Load questions on page load if an event is already selected
            var selectedEventId = $('#event_id').val();
            if (selectedEventId) {
                loadQuestions(selectedEventId);
            }
    
            // Load questions when event selection changes
            $('#event_id').change(function () {
                loadQuestions($(this).val());
            });
        });
    </script>
    
@endsection
