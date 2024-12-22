@extends('layouts.account')

@section('content')
    <div class="container">
        <br>
        <h2>Upload Your CV</h2>
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
        <form action="{{ route('account.storeCv') }}" method="POST" enctype="multipart/form-data"
            class="p-4 border rounded shadow-sm bg-light">
            @csrf
            <div class="form-group">
                <label for="cv" class="font-weight-bold">Upload Your CV</label>
                <div class="custom-file mt-2">
                    <input type="file" name="cv" id="cv" class="custom-file-input" accept="application/pdf"
                        required>
                    <label class="custom-file-label" for="cv">Choose file...</label>
                </div>
                @error('cv')
                    <small class="text-danger d-block mt-2">{{ $message }}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-block mt-4">
                <i class="fas fa-upload"></i> Upload CV
            </button>
        </form>
    </div>
@endsection
