<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

use App\Http\Controllers\Controller;
use DateTime;
use Faker\Provider\en_IN\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Date;
use phpDocumentor\Reflection\Types\String_;

use function Symfony\Component\Clock\now;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store()
    {

        $attributes = request()->validate([
            'name'  => ['required', 'string', 'max:30'],
            'email'      => ['required', 'email', 'unique:users,email'],
            'password'   => [
                'required',
                Password::min(6),
                //      ->letters()
                //     ->mixedCase()
                //     ->numbers()
                //     ->symbols()
                // ],
            ],
            'phone_number' => ['required', 'digits between:10,11'],
            'address' => ['nullable'],
        ]);

        // dd($attributes);

        $user = User::create($attributes);

        Auth::login($user);

        return redirect('/');
    }
}
