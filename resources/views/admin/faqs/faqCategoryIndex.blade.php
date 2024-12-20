@extends('layouts.account')

@section('content')
    <div class="container">
        <div class="account-layout border">
            <div class="account-hdr bg-primary text-white border">
                FAQ Categories
            </div>

            <div class="account-bdy p-3">
                <div class="row mb-3">
                    <!-- Your existing dashboard cards go here -->
                </div>

                <!-- Flexbox container for FAQ Category List title and Add button -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="mb-0">FAQ Category List</h1>
                    <a href="{{ route('faqs-categories.create') }}" class="btn btn-primary">Add New Category</a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Manage FAQ</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->status ? 'Active' : 'Inactive' }}</td>
                                <td>
                                    <a href="{{ route('faqs.index', $category->id) }}" class="btn btn-info">Manage FAQ
                                        Details</a>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('faqs-categories.edit', $category->id) }}"
                                            class="btn btn-warning me-2">Edit</a>
                                        <form action="{{ route('faqs-categories.destroy', $category->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this category?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
