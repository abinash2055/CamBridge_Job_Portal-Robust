@extends('layouts.account')

@section('content')
    <div class="account-layout border">
        <div class="account-hdr bg-primary text-white border">
            Create Job List
        </div>
        <div class="account-bdy p-3">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="alert alert-primary">Your company details will be attached automatically.</div>
            <p class="text-primary mb-4">Fill in all fields to create a job details</p>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-12">
                    <form action="{{ route('author.post.store') }}" id="postForm" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="job_title">Job title</label>
                            <input type="text" placeholder="Job title"
                                class="form-control @error('job_title') is-invalid @enderror" name="job_title"
                                value="" required autofocus>
                            @error('job_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="job_level">Job level</label>
                                    <select name="job_level" class="form-control" required>
                                        <option value="Top level">Top level</option>
                                        <option value="Senior level">Senior level</option>
                                        <option value="Mid level">Mid level</option>
                                        <option value="Entry level">Entry level</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="vacancy_count">No of vacancy</label>
                                    <input type="number" class="form-control @error('vacancy_count') is-invalid @enderror"
                                        name="vacancy_count" value="" min="1" required>
                                    @error('vacancy_count')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="employment_type">Employment Type</label>
                            <select name="employment_type" class="form-control">
                                <option value="Full Time">Full Time</option>
                                <option value="Part Time">Part Time</option>
                                <option value="Freelance">Freelance</option>
                                <option value="Internship">Internship</option>
                                <option value="Traineeship">Traineeship</option>
                                <option value="Volunteer">Volunteer</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="job_district">District</label>
                            <select name="job_district" id="job_district" class="form-control">
                                <option value="">Select District</option>
                                @foreach ($districts as $district)
                                    <option value="{{ $district->name }}">{{ $district->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="job_location">Job Location</label>
                            <input type="text" class="form-control @error('job_location') is-invalid @enderror"
                                name="job_location" value="" required>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="salary">Offered Salary (Monthly)</label>
                                    <input type="text" class="form-control @error('salary') is-invalid @enderror"
                                        name="salary" value="" required>
                                    @error('salary')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="deadline">Deadline</label>
                                    <input type="date" class="form-control @error('deadline') is-invalid @enderror"
                                        name="deadline" value="" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="education_level">Education level</label>
                                    <select name="education_level" class="form-control">
                                        <option value="Bachelors">Bachelors</option>
                                        <option value="High School">High School</option>
                                        <option value="Master">Master</option>
                                        <option value="SEE Mid School">SEE Mid School</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="experience">Experience</label>
                                    <select name="experience" class="form-control">
                                        <option value="Internship">Internship</option>
                                        <option value="Entry level">Entry level</option>
                                        <option value="More than 1 year">More than 1 year</option>
                                        <option value="More than 2 year">More than 2 year</option>
                                        <option value="More than 5+ year">More than 5+ year</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Professional skills</label>
                        </div>
                        <div id="skills-container">
                            @php
                                $skills = [];
                            @endphp

                            @foreach ($skills as $skill)
                                <div class="input-group mb-2 skill-input">
                                    <input type="text" class="form-control" name="skills[]"
                                        value="{{ trim($skill) }}" required>
                                    <button type="button" class="btn btn-danger remove-skill">Remove</button>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" id="add-skill" class="btn btn-primary">Add Skills</button>

                        <div class="form-group">
                            <label for="">Job Description (Specifications) <small>Optional Field</small></label>
                            <input type="hidden" id="specificationsInput" name="specifications" value="">
                            <div id="quillEditor" style="height:200px"></div>
                        </div>

                        {{-- <div class="form-group mb-3">
                            <label for="status" class="form-label text-success">Status</label>
                            <select name="status" id="status" class="form-control bg-info text-dark border-success"
                                required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div> --}}

                        <button type="button" id="postBtn" class="btn primary-btn">Create Job </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush

@push('js')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        $(document).ready(function() {
            var quill = new Quill('#quillEditor', {
                modules: {
                    toolbar: [
                        [{
                            'font': []
                        }, {
                            'size': []
                        }],
                        ['bold', 'italic'],
                        [{
                            'list': 'ordered'
                        }, {
                            'list': 'bullet'
                        }],
                        ['link', 'blockquote', 'code-block', 'image'],
                    ]
                },
                placeholder: 'Job Requirement, Job Specifications etc ...',
                theme: 'snow'
            });

            const postBtn = document.querySelector('#postBtn');
            const postForm = document.querySelector('#postForm');
            const specificationsInput = document.querySelector('#specificationsInput');

            if (specificationsInput.value) {
                quill.root.innerHTML = specificationsInput.value;
            }

            postBtn.addEventListener('click', function(e) {
                e.preventDefault();
                specificationsInput.value = quill.root.innerHTML;
                postForm.submit();
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const skillsContainer = document.getElementById('skills-container');
            const addSkillButton = document.getElementById('add-skill');

            function addSkillInput() {
                const skillInputDiv = document.createElement('div');
                skillInputDiv.className = 'input-group mb-2 skill-input';

                // Create input and button elements separately
                const skillInput = document.createElement('input');
                skillInput.type = 'text';
                skillInput.className = 'form-control';
                skillInput.name = 'skills[]'; // Name as an array to allow multiple skills
                // Do not set 'required' attribute

                const removeButton = document.createElement('button');
                removeButton.type = 'button';
                removeButton.className = 'btn btn-danger remove-skill';
                removeButton.textContent = 'Remove';

                // Append input and button to the skillInputDiv
                skillInputDiv.appendChild(skillInput);
                skillInputDiv.appendChild(removeButton);

                // Append skillInputDiv to the skillsContainer
                skillsContainer.appendChild(skillInputDiv);

                // Add event listener to the remove button
                removeButton.addEventListener('click', removeSkillInput);
            }

            function removeSkillInput(event) {
                const skillInputDiv = event.target.parentElement;
                skillsContainer.removeChild(skillInputDiv);
            }

            if (addSkillButton) {
                addSkillButton.addEventListener('click', addSkillInput);
            }

            // Add listeners to existing remove buttons (if any)
            const removeButtons = document.querySelectorAll('.remove-skill');
            removeButtons.forEach(button => {
                button.addEventListener('click', removeSkillInput);
            });
        });
    </script>

    <script>
        // For view-all-application
        postBtn.addEventListener('click', function(e) {
            e.preventDefault(); // Prevent default button action
            specificationsInput.value = quill.root.innerHTML; // Get the content from the quill editor
            postForm.submit(); // Submit the form
        });
    </script>
@endpush
