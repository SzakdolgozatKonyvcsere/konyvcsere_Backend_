<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): Response
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'full_name' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'tel' => ['nullable', 'string', 'max:20'],
            'remember_token' => ['string', 'max:50'],
            'role' => ['integer'],
            //'img_url' => ['nullable', 'url'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->string('password')),
            'full_name' => $request->full_name,
            'city' => $request->city,
            'tel' => $request->tel,
            'remember_token' => $request->remember_token,
            'role' => $request->role,
            //'img_url' => $request->img_url,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return response()->noContent();
    }
}
