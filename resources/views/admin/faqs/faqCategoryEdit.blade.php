@extends('layouts.account')

@section('content')
    <div class="container">
        <h1 class="text-center">Edit FAQ Category</h1>

        <br>
        <br>
        <br>

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

        <form action="{{ route('faqs-categories.update', $faqCategory->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label" class="font-weight-bold">Category Name</label>
                <input type="text" class="form-control" name="name" id="name"
                    value="{{ old('name', $faqCategory->name) }}" required>
            </div>
            <br>
            {{-- <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" name="status" id="status">
                    <option value="1" {{ old('status', $faqCategory->status) == '1' ? 'selected' : '' }}>Active
                    </option>
                    <option value="0" {{ old('status', $faqCategory->status) == '0' ? 'selected' : '' }}>Inactive
                    </option>
                </select>
            </div> --}}
            <div class="mb-3">
                <label for="status" class="form-label" class="font-weight-bold">Status</label>
                <select class="form-select custom-select" name="status" id="status">
                    <option value="1" {{ old('status', $faqCategory->status) == '1' ? 'selected' : '' }}>Active
                    </option>
                    <option value="0" {{ old('status', $faqCategory->status) == '0' ? 'selected' : '' }}>Inactive
                    </option>
                </select>
                <div id="statusHelp" class="form-text">Select the current status of the FAQ category.</div>
            </div>
            <br>

            <button type="submit" class="btn btn-primary">Update Category</button>
            <a href="{{ route('faqs-categories.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

    </div>
@endsection

@push('css')
    <style>
        .custom-select {
            background-color: #f8f9fa;
            /* Light gray background */
            color: #343a40;
            /* Dark text color */
        }

        .custom-select:focus {
            background-color: #ffffff;
            /* White background on focus */
            color: #343a40;
            /* Maintain text color on focus */
            border-color: #80bdff;
            /* Border color on focus */
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
            /* Bootstrap focus shadow */
        }
    </style>
@endpush
