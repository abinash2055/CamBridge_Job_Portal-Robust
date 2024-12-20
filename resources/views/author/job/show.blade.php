@extends('layouts.account')

@section('content')
    <div class="account-layout border">
        <div class="account-hdr bg-primary text-white border">
            Job Application Details
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
            
            <p class="alert alert-primary">
                User named <span class="text-capitalize">{{ optional($applicant)->name }}</span> applied for your listing
                on {{ $application->created_at }}
            </p>

            <div class="row">
                <div class="col-sm-12 col-md-12 mb-5">
                    <div class="card">
                        <div class="card-header">
                            User Profile (Applicant)
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <img src="{{ asset('images/user-profile.png') }}" class="img-fluid rounded-circle"
                                        alt="">
                                </div>

                                <div class="col-9">
                                    <h6 class="text-info text-capitalize">{{ optional($applicant)->name }}</h6>
                                    <p class="my-2"><i class="fas fa-envelope"></i> Email:
                                        {{ optional($applicant)->email }}</p>

                                    <a href="mailto:{{ optional($applicant)->email }}" class="btn primary-btn"
                                        title="Click to send email">Send Email</a>

                                    {{-- For CV View  --}}

                                    <a href="{{ asset($applicant->cv_path) }}" class="btn btn-success"
                                        title="Click to view CV">View CV</a>


                                    <!-- Status Dropdown -->
                                    <form action="{{ route('author.jobApplication.saveStatus') }}" method="POST"
                                        id="statusForm">
                                        @csrf
                                        <div class="mt-3">
                                            <label for="status" class="form-label">Update Status:</label>
                                            <select name="status" id="status" class="form-select">
                                                <option value="pending"
                                                    {{ $application->status == 'pending' ? 'selected' : '' }}>
                                                    Pending
                                                </option>

                                                <option value="shortlisted"
                                                    {{ $application->status == 'shortlisted' ? 'selected' : '' }}>
                                                    Shortlisted
                                                </option>

                                                <option value="rejected"
                                                    {{ $application->status == 'rejected' ? 'selected' : '' }}>
                                                    Rejected
                                                </option>

                                            </select>

                                            <input type="hidden" name="application_id" value="{{ $application->id }}">
                                            <button type="submit" class="btn primary-outline-btn mt-2 px-2">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        Job Details
                    </div>

                    <div class="card-body">
                        <p class="h4 text-info text-capitalize">{{ optional($post)->job_title }}</p>
                        <h6 class="text-uppercase">
                            <a href="{{ route('employer.show', ['employer' => optional($company)->id]) }}">
                                {{ optional($company)->title }}
                            </a>
                        </h6>

                        <p class="my-2"><i class="fas fa-map-marker-alt"></i> Location:
                            {{ optional($post)->job_location }}</p>
                        @if ($post)
                            <p class="text-danger small">
                                Deadline: {{ date('l, jS \of F Y', $post->deadlineTimestamp()) }}
                                ({{ date('d', $post->remainingDays()) }} days from now)
                            </p>
                        @endif

                        <a href="{{ route('post.show', ['job' => optional($post)->id]) }}" class="btn secondary-link">
                            <i class="fas fa-briefcase"></i> View Job
                        </a>
                        <a href="{{ route('author.jobApplication.index') }}" class="btn primary-outline-btn mt-3">Go
                            Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


<script>
    document.getElementById('status-select').addEventListener('change', function() {
                const status = this.value;
                const applicationId = this.dataset.applicationId;
                fetch('{{ route('author.jobApplication.saveStatus') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            application_id: applicationId,
                            status
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update the status in the index page
                            const statusElement = document.getElementById('status-' + applicationId);
                            if (statusElement) {
                                statusElement.textContent = data.status.charAt(0).toUpperCase() + data.status.slice(
                                    1);
                            }
                            alert('Status updated to: ' + data.status);
                        } else {
                            alert('Error updating status: ' + data.message);
                        }
                    })
                    .catch(error => console.error('Error:', error));
</script>
