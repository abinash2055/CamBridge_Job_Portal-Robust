{{-- Category search  --}}
@if (!is_null($posts))
    <form method="GET" action="{{ route('author.jobApplication.index') }}" id="companyChangeForm">
        <div class="form-group">
            <label for="job_title" class="font-weight-bold">Select a Job Title</label>
            <select id="job_title" name="job_id" class="form-control border-primary shadow" onchange="this.form.submit()">
                <option value="" disabled {{ !request('job_title') ? 'selected' : '' }}>
                    Choose a Job Title
                </option>
                @foreach ($posts as $post)
                    <option value="{{ $post->id }}" {{ request('job_id') == $post->id ? 'selected' : '' }}>
                        {{ $post->job_title }}
                    </option>
                @endforeach
            </select>
            <span><b>Select job title to view job applications.</b></span>
        </div>
    </form>
@endif


{{-- all Application, Shortlisted and Rejected part --}}
<div class="d-flex">
    @if (isset($_GET['job_id']) && !empty($_GET['job_id']))
        <a href="{{ route('author.job.applications.index', ['job_id' => $_GET['job_id']]) }}"
            class="btn btn-primary me-3" aria-label="View all applications">
            All Applications
        </a>
        <a href="{{ route('author.job.applications.pending', ['job_id' => $_GET['job_id']]) }}"
            class="btn btn-warning me-3" aria-label="View pending applications">
            Pending Applications
        </a>
        <a href="{{ route('author.job.applications.shortlisted', ['job_id' => $_GET['job_id']]) }}"
            class="btn btn-success me-3" aria-label="View shortlisted applications">
            Shortlisted Applications
        </a>
        <a href="{{ route('author.job.applications.rejected', ['job_id' => $_GET['job_id']]) }}" class="btn btn-danger"
            aria-label="View rejected applications">
            Rejected Applications
        </a>
    @else
        <a href="{{ route('author.job.applications.index') }}" class="btn btn-primary me-3"
            aria-label="View all applications">
            All Applications
        </a>
        <a href="{{ route('author.job.applications.pending') }}" class="btn btn-warning me-3"
            aria-label="View pending applications">
            Pending Applications
        </a>
        <a href="{{ route('author.job.applications.shortlisted') }}" class="btn btn-success me-3"
            aria-label="View shortlisted applications">
            Shortlisted Applications
        </a>
        <a href="{{ route('author.job.applications.rejected') }}" class="btn btn-danger"
            aria-label="View rejected applications">
            Rejected Applications
        </a>
    @endif
</div>
