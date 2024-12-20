@extends('layouts.account') 

@section('content')
<div class="container">
    <br>
    <h1 class="text-center">Create FAQ Category</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <br>
    <br>

    <form action="{{ route('faqs-categories.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" name="status" id="status">
                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
            </select>
            <small class="form-text text-muted">Select the status of the category.</small>
        </div>

        <button type="submit" class="btn btn-primary">Create Category</button>
        <a href="{{ route('faqs-categories.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
    <br>
</div>
@endsection
