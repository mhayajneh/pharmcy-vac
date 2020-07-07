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
            $file_extention = $data['image']->getClientOriginalExtension();
            $file_name = 'image_'. $data['number'] . "_profile." .$file_extention;
            $file_path = $data['image']->storeAs('image', $file_name);

            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'type' => $data['type'],
                'number' => $data['number'],
                'location' => $data['location'],
                'area' => $data['area'],
                'city' => $data['city'],
                'image' => $file_name,
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
                'letter' => $data['letter'],
                'university' => $data['university'],
                'university_number' => $data['university_number'],
                'password' => Hash::make($data['password']),
            ]);
        }


    }
}
