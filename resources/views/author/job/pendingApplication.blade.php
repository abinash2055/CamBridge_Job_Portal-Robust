@extends('layouts.account')

@section('content')
    <div class="account-layout border">
        <div class="account-hdr bg-warning text-white border">
            Pending Applications
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

            @include('author.job.jobapplicationfilter')

            @if ($applications && $applications->count())
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
                        @foreach ($applications as $application)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ optional($application->user)->name }}</td>
                                <td>{{ optional($application->user)->email }}</td>
                                <td>{{ optional($application->post)->job_title }}</td>
                                <td>{{ $application->created_at }}</td>
                                <td>{{ ucfirst($application->status) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="alert alert-info">No pending applications found.</p>
            @endif
        </div>
    </div>
@endsection
