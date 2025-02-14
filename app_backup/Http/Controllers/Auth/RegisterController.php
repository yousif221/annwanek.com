<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    use RegistersUsers;

    // Where to redirect users after registration
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    // Validator for user inputs
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255', 'regex:/^[\pL\s\-]+$/u'],
            'last_name' => ['required', 'string', 'max:255', 'regex:/^[\pL\s\-]+$/u'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'first_name.regex' => 'First Name can only contain alphabets.',
            'last_name.regex' => 'Last Name can only contain alphabets.',
        ]);
    }

    // Create the user and save to the database
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'is_active' => 0, // Set user as inactive by default
            'role' => 1, // Default role
        ]);
    }

    // Register a new user without logging them in
    public function register(Request $request)
    {
        try {
            // Validate the user data
            $this->validator($request->all())->validate();
    
            // Create the user
            event(new Registered($user = $this->create($request->all())));
    
            // Send registration email
            $this->sendRegistrationEmail($user);
    
            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Registration successful. Please check your email for further instructions.',
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            // Catch and log unexpected errors
            \Log::error('Registration error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);
    
            // Return a detailed error message in the response
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ], 500);
        }
    }

    // Send registration email to the user
    protected function sendRegistrationEmail($user)
    {
        $emailData = [
            'name' => $user->first_name . ' ' . $user->last_name,
            'email' => $user->email
        ];

        $email = $user->email; 

        Mail::send('front.registration', ['user' => $user], function ($m) use ($user, $email) {
            $m->from(env('MAIL_USERNAME'), 'Ideal Spot')
                ->to($email, 'User')
                ->subject('Welcome to  Ideal Spot');
        });

        if (Mail::failures()) {
            \Log::error('Failed to send registration email to ' . $user->email);
        }
    }
}
