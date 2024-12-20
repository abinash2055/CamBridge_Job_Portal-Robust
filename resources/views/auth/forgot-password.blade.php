@extends('layouts.auth')

@section('title', 'Forgot Password')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mt-4 mb-3" style="font-weight: 600; color: #333;">
    Forgot Password
</h2>
<p class="text-center mb-4" style="font-size: 1.1rem; color: #555;">
    Enter your email address to receive a password reset link.
</p>


    <!-- Display success or error messages -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Forgot Password Form -->
    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <div class="form-group mb-4">
    <label for="email" class="font-weight-bold">Email Address</label>
    <input type="email" name="email" id="email" class="form-control" required placeholder="Enter your email">
</div>

        <br>
        <br>
        <button type="submit" class="btn btn-primary btn-block mt-3" style="background-color: #007bff; border-color: #007bff; font-weight: bold;">
    <i class="fas fa-paper-plane"></i> Send Password Reset Link
</button>
    </form>

<div class="text-center mt-3">
    <a href="{{ route('login') }}" style="color: #007bff; text-decoration: none; font-weight: bold;">
        <i class="fas fa-arrow-left"></i> Back to Login
    </a>
</div>

</div>
<br>
<br>
<br>
<br>
<br>
@endsection
