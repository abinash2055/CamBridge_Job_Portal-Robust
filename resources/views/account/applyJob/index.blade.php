@extends('layouts.account')

@section('content')
    <div class="account-layout border">
        <div class="account-hdr bg-primary text-white border">
            My Applied Jobs
        </div>
        <div class="account-bdy p-3">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Job Position</th>
                            <th>Company</th>
                            <th>Applied On</th>
                            <th>Action of Post</th>
                            <th>Status</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($applications->isEmpty())
                            <tr>
                                <td colspan="5">No applications found.</td>
                            </tr>
                        @else
                            @foreach ($applications as $application)
                                <tr>
                                    <td>
                                        @if ($application->post)
                                            <a href="{{ route('post.show', ['job' => $application->post]) }}">
                                                {{ $application->post->job_title }}
                                            </a>
                                        @else
                                            <span class="text-muted">Job not found</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($application->post && $application->post->company)
                                            {{ $application->post->company->title }}
                                        @else
                                            <span class="text-muted">Company not found</span>
                                        @endif
                                    </td>
                                    <td>{{ $application->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <form action="{{ route('post.show', ['job' => $application->post->id]) }}"
                                                method="GET">
                                                @csrf
                                                @method('POST')
                                                <button type="submit" class="btn secondary-outline-btn">
                                                    View Job Details
                                                </button>
                                            </form>
                                        </div>
                                    </td>

                                    <!-- Add status with a default value and changes by Author-->
                                    <td>{{ $application->status ?? 'Pending' }}</td>

                                    <!-- Remove Button -->
                                    <td>
                                        @if ($application->created_at->diffInHours(now()) < 24)
                                            <form action="{{ route('application.remove', ['id' => $application->id]) }}"
                                                method="POST" class="ml-2">
                                                @csrf
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure you want to remove this application? This can only be done within 24 hours.');">
                                                    Remove
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-muted">Expired</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
@endsection
