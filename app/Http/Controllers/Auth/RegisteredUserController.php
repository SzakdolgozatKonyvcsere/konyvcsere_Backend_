<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'full_name' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'tel' => ['nullable', 'string', 'max:20'],
            //'remember_token' => ['string', 'max:50'],
            'role' => ['integer'],
            'img_url' =>  ['nullable', 'image', 'mimes:jpg,png,gif,jpeg,svg', 'max:2048'],
        ]);

        // Fájlkezelés, ha van feltöltött kép
        $imagePath = null;
        if ($request->hasFile('img_url') && $request->file('img_url')->getSize() > 0) {
            $imagePath = $request->file('img_url')->store('profile_pictures', 'public');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->string('password')),
            'full_name' => $request->full_name,
            'city' => $request->city,
            'tel' => $request->tel,
            //'remember_token' => $request->remember_token,
            'role' => 1,
            //'img_url' => $imagePath,
        ]);

        // E-mail küldése
        $details = [
            'email' => $request->email,
            'subject' => 'Regisztráció sikeres',
            'message' => 'Kedves ' . $request->full_name . ', sikeresen regisztráltál.',
        ];
        Mail::to($request->email)->send(new ContactMail($details));


        event(new Registered($user));

        Auth::login($user);

        return response()->noContent();
    }
}
