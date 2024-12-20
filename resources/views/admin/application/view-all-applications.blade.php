@extends('layouts.account')

@section('content')
    <div class="account-layout  border">
        <div class="account-hdr bg-primary text-white border">
            VIewing all Application <span class="badge badge-primary">Any category</span>
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
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="table-responsive pt-3">
                        <table class="table table-hover table-striped small">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Author</th>
                                    <th>Email</th>
                                    <th>created on</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($users->count())
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                            <td>{{ $user->created_at }}</td>
                                            <td>
                                                <button class="btn btn-danger delete-btn" data-id="{{ $user->id }}"
                                                    data-name="{{ $user->name }}"
                                                    data-url="{{ route('admin.user.destroy', $user->id) }}">
                                                    Activate
                                                </button>
                                            </td>
                                            <td>
                                                <button class="btn btn-danger delete-btn" data-id="{{ $user->id }}"
                                                    data-name="{{ $user->name }}"
                                                    data-url="{{ route('admin.user.destroy', $user->id) }}">
                                                    Deactivate
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td>There isn't any users.</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-4 custom-pagination">
                        {{ $users->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete <strong id="userName"></strong>?
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
            var deleteUrl, userName;

            // Trigger the modal on delete button click using event delegation
            $('.delete-btn').on('click', function() {
                deleteUrl = $(this).data('url'); // Get the route URL from data-url
                userName = $(this).data('name'); // Get the author name

                // Optionally, display the author's name in the modal
                $('#userName').text(userName);

                $('#deleteModal').modal('show');
            });



            // Handle the delete action when confirm is clicked
            $('#confirmDeleteBtn').on('click', function() {
                // console.log("Url: ", deleteUrl);
                $.ajax({
                    url: deleteUrl, // Use the dynamic URL from the button
                    type: 'POST',
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
