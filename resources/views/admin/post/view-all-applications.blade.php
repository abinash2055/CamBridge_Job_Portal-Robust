@extends('layouts.account')

@section('content')
    <div class="account-layout border">
        <div class="account-hdr bg-primary text-white border">
            Viewing all posts <span class="badge badge-primary">All Posts</span>
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

                        {{-- Category search --}}
                        @if (!is_null($companies))
                            <form method="GET" action="{{ route('admin.post.viewAll') }}" id="companyChangeForm">
                                <div class="form-group">
                                    <label for="company" class="font-weight-bold">Select a Company</label>
                                    <select id="company" name="company_id" class="form-control border-primary shadow"
                                        onchange="changeCompany()">
                                        <option value="" disabled {{ !request('company_id') ? 'selected' : '' }}>
                                            Choose a company</option>
                                        @foreach ($companies as $company)
                                            <option value="{{ $company->id }}"
                                                {{ request('company_id') == $company->id ? 'selected' : '' }}>
                                                {{ $company->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        @endif

                        <table class="table table-hover table-striped small">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> Job Title </th>
                                    <th>Company Name</th>
                                    <th> Author Name </th>
                                    <th> Created On </th>
                                    <th> Action </th>
                                </tr>
                            </thead>

                            <tbody>
                                @if ($posts->count())
                                    @foreach ($posts as $post)
                                        <tr>
                                            <td>{{ $post->id }}</td>
                                            <td>{{ $post->job_title }}</td>

                                            {{-- Need relation from post to company->title --}}
                                            <td>{{ $post->company->title ?? 'N/A' }}</td>


                                            {{-- Need relation from post to company then company to user->name --}}
                                            <td> {{ $post->company->user->name ?? 'N/A' }}</td>

                                            <td>{{ $post->created_at }}</td>
                                            <td>
                                                <a href="{{ route('account.applyJob', ['post_id' => $post->id]) }}"
                                                    class="btn btn-info">
                                                    View
                                                </a>
                                            </td>
                                            <td>
                                                <button
                                                    class="btn toggle-status-btn {{ $post->status === 'active' ? 'btn-success' : 'btn-danger' }}"
                                                    data-id="{{ $post->id }}" data-title="{{ $post->title }}"
                                                    data-status="{{ $post->status }}">
                                                    {{ $post->status === 'active' ? 'Active' : 'deactivate' }}
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">No posts available.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <!-- Display Posts with Pagination -->
                        <div class="posts">
                            @foreach ($posts as $post)
                                <div class="post">
                                    <h5>{{ $post->title }}</h5>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination Links -->
                        <div class="pagination d-flex justify-content-center">
                            {{ $posts->appends(['company_id' => request('company_id')])->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            // Handle toggle status button click
            $('.toggle-status-btn').on('click', function() {
                var button = $(this);
                var postId = button.data('id');
                var currentStatus = button.data('status');

                $.ajax({
                    url: "{{ route('admin.post.toggleStatus') }}",
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id: postId,
                        status: currentStatus
                    },
                    success: function(response) {
                        if (response.success) {
                            var newStatus = response.status;

                            if (newStatus === 'active') {
                                // Change the button appearance and text for active status
                                button.removeClass('btn-danger').addClass('btn-success');
                                button.text('Active');
                                button.data('status', 'active');
                            } else {
                                // Change the button appearance and text for deactivated status
                                button.removeClass('btn-success').addClass('btn-danger');
                                button.text('Deactivate');
                                button.data('status', 'deactivate');
                            }
                        } else {
                            alert('Unable to update status. Please try again.');
                        }
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr.responseText);
                        alert('An error occurred while processing your request.');
                    }
                });
            });
        });
    </script>
    <script>
        function changeCompany() {
            document.getElementById('companyChangeForm').submit();
        }
    </script>
@endpush
