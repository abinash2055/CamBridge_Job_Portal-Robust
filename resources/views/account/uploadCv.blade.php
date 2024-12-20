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

        <form action="{{ route('account.storeCv') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="cv" class="font-weight-bold">Upload Your CV</label>
                <input type="file" name="cv" id="cv" class="form-control" accept="application/pdf" required>
                @error('cv')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Upload</button>
        </form>
    </div>
@endsection
