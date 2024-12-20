@extends('layouts.account')

@section('content')
    <div class="account-layout border">
        <div class="account-hdr bg-danger text-white border">
            Rejected Applications
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

            @if ($rejectedApplications && $rejectedApplications->count())
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Applicant Name</th>
                            <th>Email</th>
                            <th>Job Title</th>
                            <th>Applied on</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rejectedApplications as $application)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $application->user->name }}</td>
                                <td>{{ $application->user->email }}</td>
                                <td>{{ $application->post->job_title }}</td>
                                <td>{{ $application->created_at }}</td>
                                <td>{{ ucfirst($application->status) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="alert alert-info">No rejected applications found.</p>
            @endif
        </div>
    </div>
@endsection
