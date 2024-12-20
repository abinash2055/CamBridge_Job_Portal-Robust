@extends('layouts.auth')

@section('content')
    <br>
    <div class="container">
        <h2>Edit Profile</h2>
        <br>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf

            <!-- Name -->
            <div class="form-group mb-3">
                <label for="name" class="font-weight-bold">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}"
                    required>
            </div>

            {{-- 
            <!-- Email -->
            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div> --}}

            {{-- Gender --}}
            <div class="form-group mb-3">
                <label for="gender" class="font-weight-bold">Gender</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="" disabled {{ old('gender', $user->gender) == null ? 'selected' : '' }}>Select your
                        gender</option>
                    <option value="Male" {{ old('gender', $user->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('gender', $user->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                    <option value="Other" {{ old('gender', $user->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>


            <!-- Date of Birth -->
            <div class="form-group mb-3">
                <label for="date_of_birth" class="font-weight-bold">Date of Birth</label>
                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                    value="{{ old('date_of_birth', $user->date_of_birth) }}" required>
            </div>


            <!-- Location -->
            <div class="form-group mb-3">
                <label for="location" class="font-weight-bold">Current Address</label>
                <input type="text" class="form-control" id="location" name="location"
                    value="{{ old('location', $user->location) }}" required>
            </div>


            <!-- Education -->
            <div class="form-group mb-3">
                <label for="education" class="font-weight-bold">Education</label>
                <select class="form-control" id="education" name="education" required>
                    <option value="" disabled {{ old('education', $user->education) == null ? 'selected' : '' }}>
                        Select your education</option>
                    <option value="High School"
                        {{ old('education', $user->education) == 'High School' ? 'selected' : '' }}>
                        High School</option>
                    <option value="Bachelor's Degree"
                        {{ old('education', $user->education) == "Bachelor's Degree" ? 'selected' : '' }}>Bachelor's Degree
                    </option>
                    <option value="Master's Degree"
                        {{ old('education', $user->education) == "Master's Degree" ? 'selected' : '' }}>Master's Degree
                    </option>
                    <option value="PhD" {{ old('education', $user->education) == 'PhD' ? 'selected' : '' }}>SEE Mid
                        School</option>
                    <option value="Other" {{ old('education', $user->education) == 'Other' ? 'selected' : '' }}>Other
                    </option>
                </select>
            </div>

            {{-- Experience Level --}}
            <div class="form-group mb-3">
                <label for="experience_level" class="font-weight-bold">Experience Level</label>
                <select class="form-control" id="experience_level" name="experience_level" required>
                    <option value="" disabled
                        {{ old('experience_level', $user->experience_level) == null ? 'selected' : '' }}>Select your
                        experience level</option>
                    <option value="Fresher"
                        {{ old('experience_level', $user->experience_level) == 'Fresher' ? 'selected' : '' }}>Fresher
                    </option>
                    <option value="1-2 Years"
                        {{ old('experience_level', $user->experience_level) == '1-2 Years' ? 'selected' : '' }}>1-3 Years
                    </option>
                    <option value="3-5 Years"
                        {{ old('experience_level', $user->experience_level) == '3-5 Years' ? 'selected' : '' }}>3-5 Years
                    </option>
                    <option value="6-10 Years"
                        {{ old('experience_level', $user->experience_level) == '6-10 Years' ? 'selected' : '' }}>6-10 Years
                    </option>
                    <option value="10+ Years"
                        {{ old('experience_level', $user->experience_level) == '10+ Years' ? 'selected' : '' }}>10+ Years
                    </option>
                </select>
            </div>


            <!-- Current Job -->
            <div class="form-group mb-3">
                <label for="current_job" class="font-weight-bold">Current Job</label>
                <input type="text" class="form-control" id="current_job" name="current_job"
                    value="{{ old('current_job', $user->current_job) }}" required>
            </div>

            <!-- Phone -->
            <div class="form-group mb-3">
                <label for="phone" class="font-weight-bold">Mobile/Phone Number</label>
                <input type="text" class="form-control" id="phone" name="phone"
                    value="{{ old('phone', $user->phone) }}" required>
            </div>

            <!-- Password -->
            {{-- <div class="form-group mb-3">
                <label for="password" class="font-weight-bold">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div> --}}

            <!-- Confirm Password -->
            {{-- <div class="form-group mb-3">
                <label for="password_confirmation" class="font-weight-bold">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                    required>
            </div> --}}

            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
    <br>
@endsection
