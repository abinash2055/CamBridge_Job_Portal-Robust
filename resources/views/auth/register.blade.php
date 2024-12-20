@extends('layouts.auth')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-6 px-0">
            <div class="login-poster">
                <h2 class="my-3 slogan">
                    Register for a better opportunity
                </h2>
                <p class="text-white mb-3 lead"><i class="fas fa-angle-right"></i> Its free and always be</p>
                <p class="text-white mb-3 lead"><i class="fas fa-angle-right"></i>  Your Confidentiality is Assured</p>            
                <p class="text-white mb-3 lead"><i class="fas fa-angle-right"></i> We Provide Career Opportunities</p> 
                <p class="text-white mb-3 lead"><i class="fas fa-angle-right"></i> Most Trusted Job Portal in Nepal</p>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 px-0">
            <div class="login-container">
                <div class="login-header mb-3">
                    <h3><img src="{{ asset('images/logo/cambridge.png') }}" width="50px;" alt=""> Create your free job-seeker account</h3>
                    <p class="text-muted">Register with basic information, complete your profile and start applying for the job for free!</p>
                </div>
                <div class="login-form">
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        
                        {{-- Full Name --}}
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-id-badge"></i></span>
                                </div>
                                <input id="name" type="text" placeholder="Full name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Phone Number --}}
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-phone"></i></span>
                                </div>
                                <input id="phone" type="text" placeholder="Calling Number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input id="email" type="email" placeholder="E-mail address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        {{-- Password --}}
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                </div>
                                <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Password Confirmation --}}
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                </div>
                                <input id="password_confirmation" type="password" placeholder="Password (Repeat)" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required>
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Date of Birth --}}
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span>
                                </div>
                                <input id="date_of_birth" type="date" placeholder="Date of Birth" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                                @error('date_of_birth')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Location --}}
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-map-marker-alt"></i></span>
                                </div>
                                <input id="location" type="text" placeholder="Location" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ old('location') }}" required>
                                @error('location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Education --}}
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-graduation-cap"></i></span>
                                </div>
                                <input id="education" type="text" placeholder="Education" class="form-control @error('education') is-invalid @enderror" name="education" value="{{ old('education') }}" required>
                                @error('education')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Current Job/Company --}}
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-briefcase"></i></span>
                                </div>
                                <input id="current_job" type="text" placeholder="Current Job/Company" class="form-control @error('current_job') is-invalid @enderror" name="current_job" value="{{ old('current_job') }}" required>
                                @error('current_job')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <small class="text-muted d-block mb-3">By clicking on 'Create Job-seeker Account' below, you are agreeing to the terms and small privacy of Cambridge Job Portal!</small>
                        </div>
                        <button type="submit" class="btn primary-btn btn-block">Register</button>
                    </form>
                    <div class="my-3">
                        <p>Already have an account? <a href="/login">Login now</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
.login-poster {
    background-image: url('{{ asset("images/login-background.png") }}');
    background-image: linear-gradient(
            to bottom,
            rgba(0, 0, 0, 0.5),
            rgba(0, 0, 0, 0.35)
        ),
        url('{{ asset("images/login-background.png") }}');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
}
</style>
@endPush
