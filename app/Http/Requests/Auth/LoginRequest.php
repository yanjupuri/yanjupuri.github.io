<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate()
    {
        $this->ensureIsNotRateLimited();
    
        if (!Auth::attempt($this->only('email', 'password'), $this->filled('remember'))) {
            RateLimiter::hit($this->throttleKey());
    
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }
    
        if (!auth()->user()->hasVerifiedEmail()) {
            Auth::logout();
            throw ValidationException::withMessages([
                'email' => __('Please verify your email before logging in.'),
            ]);
        }
    
        RateLimiter::clear($this->throttleKey());
    }
    

    /**
     * Ensure the login request is not rate limited.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited()
    {
        $throttleKey = $this->throttleKey();
    
        // Check if there are too many attempts
        if (!RateLimiter::tooManyAttempts($throttleKey, 5)) {
            return;
        }
    
        $seconds = RateLimiter::availableIn($throttleKey);
        $lockoutDuration = max(5 * 60, $seconds);
        event(new Lockout($this));
    
        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $lockoutDuration,
                'minutes' => ceil($lockoutDuration / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey()
    {
        return Str::lower($this->input('email')).'|'.$this->ip();
    }
}
