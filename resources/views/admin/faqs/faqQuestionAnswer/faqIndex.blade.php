@extends('layouts.account')

@section('content')
    <div class="container">
        <div class="account-layout border">
            <div class="account-hdr bg-primary text-white border">
                FAQ Details
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
                    <div class="col-xl-4 col-sm-6 py-2">
                        <div class="card dashboard-card text-white h-100 shadow">
                            <div class="card-body primary-bg">
                                <div class="rotate">
                                    <i class="fas fa-users fa-4x"></i>
                                </div>
                                <h6 class="text-uppercase">Users</h6>
                                <h1 class="">{{ $userCount }}</h1>
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
                                <h1 class="">{{ $jobCount }}</h1>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-sm-6 py-2">
                        <div class="card dashboard-card text-white h-100 shadow">
                            <div class="card-body bg-warning">
                                <div class="rotate">
                                    <i class="fas fa-list-alt fa-4x"></i>
                                </div>
                                <h6 class="text-uppercase">Total Categories</h6>
                                <h1 class="">{{ $categories->count() }}</h1>
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

                    <div class="col-xl-4 col-sm-6 py-2">
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

                    <div class="col-xl-4 col-sm-6 py-2">
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
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="mb-0">Category Title: {{ $categories->name }}</h1>
                    <a href="{{ route('faqs.create', $categories->id) }}" class="btn btn-primary">Add New FAQ</a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Question</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($faqs as $faq)
                            <tr>
                                <td>{{ $faq->id }}</td>
                                <td>{{ $faq->question }}</td>
                                <td>{{ $faq->status ? 'Active' : 'Inactive' }}</td>
                                <td>
                                    <a href="{{ route('faqs.show', $faq->id) }}" class="btn btn-info">View</a>
                                    <a href="{{ route('faqs.edit', $faq->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('faqs.destroy', $faq->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this FAQ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>

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
                        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete FAQ</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete <strong></strong>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection
