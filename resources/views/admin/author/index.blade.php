@extends('layouts.account')

@section('content')
    <div class="account-layout border">
        <div class="account-hdr bg-primary text-white border">
            Author List
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
                            <h6 class="text-uppercase">Employees</h6>
                            <h1 class="">{{ $userCount }}</h1>
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
                            <h1 class="">{{ $authorCount }}</h1>
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
                            <h1 class="">{{ $liveJobCount }}</h1>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-sm-6 py-2">
                    <div class="card dashboard-card text-white h-100 shadow">
                        <div class="card-body bg-warning">
                            <div class="rotate">
                                <i class="fas fa-industry fa-4x"></i>
                            </div>
                            <h6 class="text-uppercase">Company Categories</h6>
                            <h1 class="">{{ $jobCategoriesCount }}</h1>
                        </div>
                    </div>
                </div>
            </div> --}}

            <!-- Flexbox container for Author List title and Add button -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="mb-0">Author List</h1>
                <a href="{{ route('admin.author.create') }}" class="btn btn-primary">Add New Author</a>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($authors as $author)
                        <tr>
                            <td>{{ $author['name'] }}</td>
                            <td>{{ $author['email'] }}</td>
                            <td class="d-flex justify-content-start">
                                <a href="{{ route('admin.author.edit', $author->id) }}" class="btn btn-warning">Edit</a>
                                <a href="{{ route('admin.author.manageCompany', $author->id) }}" class="btn btn-info">Manage
                                    Company</a>
                                <button class="btn btn-danger delete-btn" data-id="{{ $author->id }}"
                                    data-name="{{ $author->name }}"
                                    data-url="{{ route('admin.author.delete', $author->id) }}">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete Author</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete <strong id="authorName"></strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            var deleteUrl, authorName;

            // Trigger the modal on delete button click using event delegation
            $('.delete-btn').on('click', function() {
                deleteUrl = $(this).data('url'); // Get the route URL from data-url
                authorName = $(this).data('name'); // Get the author name

                // Optionally, display the author's name in the modal
                $('#authorName').text(authorName);

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
@endpush
