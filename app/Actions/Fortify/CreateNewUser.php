<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Str;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'min:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'date_of_birth' => ['required', 'string'],
            'location' => ['required', 'string'],
            'education' => ['required', 'string'],
            'current_job' => ['required', 'string'],
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'phone' => $input['phone'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'date_of_birth' => $input['date_of_birth'],
            'location' => $input['location'],
            'education' => $input['education'],
            'current_job' => $input['current_job'],
            'verification_code' => Str::random(40)
        ]);
        $user->assignRole('user');
        return $user;
    }
}
