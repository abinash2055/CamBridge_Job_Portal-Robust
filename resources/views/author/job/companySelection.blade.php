@extends('layouts.account')

@section('content')
    <div class="account-layout border">
        <div class="account-hdr bg-primary text-white border">
            Company Selection
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
            @if ($pendingApplications && $pendingApplications->count())
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
                        @foreach ($companySelections as $companySelection)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ optional($companySelection->user)->name }}</td>
                                <td>{{ optional($companySelection->user)->email }}</td>
                                <td>{{ optional($companySelection->post)->job_title }}</td>
                                <td>{{ $companySelection->created_at }}</td>
                                <td>{{ ucfirst($companySelection->status) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="alert alert-info">No Applications applied till now.</p>
            @endif
        </div>
    </div>
@endsection
