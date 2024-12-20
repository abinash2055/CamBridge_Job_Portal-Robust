@extends('layouts.account')
@section('content')
    <div class="account-layout border">
        <div class="account-hdr bg-primary text-white border">
            Job Lists
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

            {{-- <div class="row mb-3">
                <div class="col-xl-4 col-sm-6 py-2">
                    <div class="card dashboard-card text-white h-100 shadow">
                        <div class="card-body primary-bg">
                            <div class="rotate">
                                <i class="fas fa-users fa-4x"></i>
                            </div>
                            <h6 class="text-uppercase">Users</h6>
                            <h1 class="">{{ $dashCount['activeJobs'] }}</h1>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-sm-6 py-2">
                    <div class="card dashboard-card text-white h-100 shadow">
                        <div class="card-body bg-secondary">
                            <div class="rotate">
                                <i class="fas fa-building fa-4x"></i>
                            </div>
                            <h6 class="text-uppercase">Total Jobs</h6>
                            <h1 class="">{{ $dashCount['totalJobs'] }}</h1>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-sm-6 py-2">
                    <div class="card dashboard-card text-white h-100 shadow">
                        <div class="card-body bg-info">
                            <div class="rotate">
                                <i class="fas fa-user-tie fa-4x"></i>
                            </div>
                            <h6 class="text-uppercase">Authors</h6>
                            <h1 class="">N/A</h1>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-sm-6 py-2">
                    <div class="card dashboard-card text-white h-100 shadow">
                        <div class="card-body bg-danger">
                            <div class="rotate">
                                <i class="fas fa-star-of-life fa-4x"></i>
                            </div>
                            <h6 class="text-uppercase">Live Jobs</h6>
                            <h1 class="">{{ $dashCount['livePost'] }}</h1>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-sm-6 py-2">
                    <div class="card dashboard-card text-white h-100 shadow">
                        <div class="card-body bg-warning">
                            <div class="rotate">
                                <i class="fas fa-industry fa-4x"></i>
                            </div>
                            <h6 class="text-uppercase">Jobs Categories</h6>
                            <h1 class="">{{ count($jobCategories) }}</h1>
                        </div>
                    </div>
                </div>
            </div> --}}

            <section class="dashboard-authors my-5">
                <div class="row my-4">
                    <div class="col-sm-12">
                        <div class="row">
                            <!-- Title -->
                            <div class="col-md-8 col-12 d-flex align-items-center mb-2 mb-md-0">
                                <h4 class="card-title text-secondary">Manage Employer (Job Provider)</h4>
                            </div>
                            <!-- Button -->
                            <div class="col-md-4 col-12 d-flex justify-content-md-end justify-content-start mb-2">
                                <a href="{{ route('author.post.create') }}" class="btn btn-primary">Add More Job</a>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Level</th>
                                        <th>No. of Vacancy</th>
                                        <th>Deadline</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($activeJobs as $job)
                                        <tr>
                                            <td>{{ $job->id }}</td>
                                            <td>{{ $job->job_title }}</td>
                                            <td>{{ $job->job_level }}</td>
                                            <td>{{ $job->vacancy_count }}</td>
                                            <td>{{ \Carbon\Carbon::parse($job->deadline)->format('Y-m-d') }}</td>
                                            <td>
                                                <a href="{{ route('post.show', ['job' => $job->id]) }}"
                                                    class="btn btn-primary" target="_blank">View</a>

                                                <a href="{{ route('author.post.edit', $job->id) }}"
                                                    class="btn btn-warning">Edit</a>

                                                <button class="btn btn-danger delete-btn" data-id="{{ $job->id }}"
                                                    data-name="{{ $job->name }}"
                                                    data-url="{{ route('author.post.destroy', $job->id) }}">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <hr>
        </div>
    </div>
    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete Job</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete <strong id="job_title"></strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            var deleteUrl, jobTitle;

            // Trigger the modal on delete button click using event delegation
            $('.delete-btn').on('click', function() {
                deleteUrl = $(this).data('url'); // Get the route URL from data-url
                jobTitle = $(this).data('jo_title'); // Get the author name

                // Optionally, display the author's name in the modal
                $('#jobTitle').text(jobTitle);

                $('#deleteModal').modal('show');
            });

            // Handle the delete action when confirm is clicked
            $('#confirmDeleteBtn').on('click', function() {
                $.ajax({
                    url: deleteUrl, // Use the dynamic URL from the button
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content') // CSRF protection for Laravel
                    },
                    success: function(result) {
                        $('#deleteModal').modal('hide');
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
@endPush
