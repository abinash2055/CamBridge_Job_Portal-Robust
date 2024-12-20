@extends('layouts.account')

@section('content')
    <div class="account-layout  border">
        <div class="account-hdr bg-primary text-white border">
            Author Section
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

            <div class="row mb-3">
                <div class="col-xl-6 col-sm-6 py-2">
                    <div class="card dashboard-card text-white h-100 shadow">
                        <div class="card-body primary-bg">
                            <div class="rotate">
                                <i class="fas fa-users fa-4x"></i>
                            </div>
                            <h6 class="text-uppercase">My Jobs</h6>
                            <h1 class="">{{ $company ? $company->posts->count() : 0 }}</h1>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-sm-6 py-2">
                    <div class="card dashboard-card text-white h-100 shadow">
                        <div class="card-body primary-bg">
                            <div class="rotate">
                                <i class="fas fa-th fa-4x"></i>
                            </div>
                            <h6 class="text-uppercase">Live Jobs</h6>
                            <h1 class="">{{ $livePosts ?? 0 }}</h1>
                        </div>
                    </div>
                </div>

                {{-- <div class="col-xl-4 col-sm-6 py-2">
                    <a href="{{ route('author.jobApplication.index') }}">
                        <div class="card dashboard-card text-white h-100 shadow">
                            <div class="card-body bg-danger">
                                <div class="rotate">
                                    <i class="fas fa-envelope fa-4x"></i>
                                </div>
                                <h6 class="text-uppercase">Total Jobs</h6>
                                <h1 class="">{{ $applications ? $applications->count() : 0 }}</h1>
                            </div>
                        </div>
                    </a>
                </div> --}}
            </div>

            <section class="author-company-info">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Manage Company Details</h4>
                                <p class="mb-3 alert alert-info">For job listings you need to add Company details.</p>

                                <div class="mb-3 d-flex">
                                    @if (!$company)
                                        <a href="{{ route('author.company.create') }}" class="btn primary-btn mr-2">Create
                                            Company</a>
                                    @else
                                        <a href="{{ route('author.company.edit') }}" class="btn secondary-btn mr-2">Edit
                                            Company</a>
                                        <div class="ml-auto">
                                            {{-- <form action="{{route('author.company.destroy')}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn danger-btn">Delete Company</a>
                                </form> --}}
                                            <button class="btn btn-danger delete-company-btn" data-id="{{ $company->id }}"
                                                data-title="{{ $company->title }}"
                                                data-url="{{ route('author.company.destroy') }}">
                                                Delete Company
                                            </button>
                                        </div>
                                    @endif
                                </div>
                                @if ($company)
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <img src="{{ asset($company->logo) }}" width="100px"
                                                        class="img-fluid border p-2" alt="">
                                                    <h5>{{ $company->title }}</h5>
                                                    <small>{{ $company->getCategory->category_name }}</small>
                                                    <a class="d-block" href="{{ $company->website }}"><i
                                                            class="fas fa-globe"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="author-posts">
                <div class="row my-4">
                    <div class="col-lg-12 col-md-8 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Manage Jobs</h4>
                                <a href="{{ route('author.post.create') }}" class="btn primary-btn">Create new job
                                    listing</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Level</th>
                                        <th>No of vacancies</th>
                                        <th>Deadline</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($company)
                                        @foreach ($company->posts as $index => $post)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td> <a href="{{ route('post.show', ['job' => $post]) }}" target="_blank"
                                                        title="Go to this post">{{ $post->job_title }}</a></td>
                                                <td>{{ $post->job_level }}</td>
                                                <td>{{ $post->vacancy_count }}</td>
                                                <td>@php
                                                    $date = new DateTime($post->deadline);
                                                    $timestamp = $date->getTimestamp();
                                                    $dayMonthYear = date('d/m/Y', $timestamp);
                                                    $daysLeft = date('d', $timestamp - time()) . ' days remaining';
                                                    echo "$dayMonthYear <br> <span class='text-danger'> $daysLeft </span>";
                                                @endphp</td>
                                                <td>
                                                    <a href="{{ route('author.post.edit', ['post' => $post]) }}"
                                                        class="btn primary-btn">Edit</a>
                                                    {{-- <form action="{{route('author.post.destroy',['post'=>$post->id])}}" class="d-inline-block" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn danger-btn" >Delete</button>
                                </form> --}}
                                                    <button class="btn btn-danger delete-post-btn"
                                                        data-id="{{ $post->id }}" data-title="{{ $post->job_title }}"
                                                        data-url="{{ route('author.post.destroy', ['post' => $post->id]) }}">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>You haven't created a company yet.</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <!--/row-->
            </section>

        </div>
    </div>
    <!-- Delete Confirmation Modal for Company -->
    <div class="modal fade" id="deleteCompanyModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete Company</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete <strong id="companyTitle"></strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteCompanyBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal for Posts-->
    <div class="modal fade" id="deletePostModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete Jobs</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete <strong id="postTitle"></strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeletePostBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('js')
    {{-- JS script for Company --}}
    <script>
        $(document).ready(function() {
            var deleteUrl, companyTitle, postTitle;

            // Trigger the modal on delete button click using event delegation
            $('.delete-company-btn').on('click', function() {
                deleteUrl = $(this).data('url'); // Get the route URL from data-url
                companyTitle = $(this).data('title'); // Get the author name

                // Optionally, display the author's name in the modal
                $('#companyTitle').text(companyTitle);

                $('#deleteCompanyModal').modal('show');
            });

            // Handle the delete action when confirm is clicked
            $('#confirmDeleteCompanyBtn').on('click', function() {
                // console.log("Url: ", deleteUrl);
                $.ajax({
                    url: deleteUrl, // Use the dynamic URL from the button
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content') // CSRF protection for Laravel
                    },
                    success: function(result) {
                        $('#deleteCompanyModal').modal('hide');
                        location.reload(); // Reload page after deletion
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        alert('Something went wrong!');
                    }
                });
            });

            // Trigger the modal on delete button click using event delegation
            $('.delete-post-btn').on('click', function() {
                deleteUrl = $(this).data('url'); // Get the route URL from data-url
                postTitle = $(this).data('title'); // Get the author name

                // Optionally, display the author's name in the modal
                $('#postTitle').text(postTitle);

                $('#deletePostModal').modal('show');
            });

            // Handle the delete action when confirm is clicked
            $('#confirmDeletePostBtn').on('click', function() {
                // console.log("Url: ", deleteUrl);
                $.ajax({
                    url: deleteUrl, // Use the dynamic URL from the button
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content') // CSRF protection for Laravel
                    },
                    success: function(result) {
                        $('#deletePostModal').modal('hide');
                        location.reload(); // Reload page after deletion
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        alert('Something went wrong!');
                    }
                });
            });
        });
    </script>
@endpush
