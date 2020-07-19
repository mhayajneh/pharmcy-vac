<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
             'name' => 'required|string|max:255',
             'email' => 'required|string|email|max:255|unique:users',
             'number' => 'required|unique:users',
             'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        if ($data['type'] == '2') {
            $dest = 'assets/uploads/pharm';
            $image = request()->file('image')->getClientOriginalName();
            request()->file('image')->move($dest,$image);
            $file_path =  $image;

            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'type' => $data['type'],
                'number' => $data['number'],
                'location' => $data['location'],
                'city' => $data['city'],
                'image' => $file_path,
                'manager' => $data['manager'],
                'students' => $data['students'],
                'password' => Hash::make($data['password']),
            ]);
        } elseif ($data['type'] == '3') {

            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'type' => $data['type'],
                'number' => $data['number'],
                'university' => $data['university'],
                'university_number' => $data['university_number'],
                'password' => Hash::make($data['password']),
            ]);
        }


    }
}
