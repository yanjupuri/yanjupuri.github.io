<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use A6digital\Image\Facades\DefaultProfileImage as FacadesDefaultProfileImage;
use Illuminate\Support\Facades\Storage;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(UserRequest $request)
    {
        $user = User::create([
            'username' => strtolower(str_replace(' ', '', $request->first_name)) . strtolower(str_replace(' ', '', $request->last_name)),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => 'user',
            'token' => Str::uuid(),
        ]);

        $user->assignRole($request->role ?: 'user');

        $initials = strtoupper(substr($request->first_name, 0, 1) . substr($request->last_name, 0, 1));
        $img = FacadesDefaultProfileImage::create($initials);
        $imagePath = 'public/profile_pictures/' . $user->id . '_profile.png';
        Storage::put($imagePath, $img->encode());

        $user->profile_picture = $user->id . '_profile.png';
        $user->save();

        event(new Registered($user));

        if ($user->roles->first()->name === 'user'){
            // return redirect(RouteServiceProvider::HOME)->with('success', 'Successfully created. Please check your email for verification.');
            return redirect()->back()->with('success', 'Successfully created. Please check your email for verification.');
        }else{
            return redirect()->route('admin.users')->with('success', 'New admin added successfully!');
        }
        
    }
}
