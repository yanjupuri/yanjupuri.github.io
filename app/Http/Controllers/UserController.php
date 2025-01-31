<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use App\Models\User;
use App\Helpers\AuthHelper;
use Spatie\Permission\Models\Role;
use App\Http\Requests\UserRequest;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $dataTable)
    {
        $pageTitle = trans('global-message.list_form_title',['form' => trans('users.title')] );
        $auth_user = AuthHelper::authSession();
        $assets = ['data-table'];
        $headerAction = '<a href="'.route('users.create').'" class="btn btn-sm btn-primary" role="button">Add User</a>';
        return $dataTable->render('global.datatable', compact('pageTitle','auth_user','assets', 'headerAction'));
    }

    public function admin()
    {
        $users = User::select('id', 'first_name', 'last_name', 'phone_number', 'email', 'user_type', 'email_verified_at')->get();

        $status = [];

        foreach ($users as $user) {
            if (!empty($user->email_verified_at)) {
                $status[$user->id] = 'active';
            } else {
                $status[$user->id] = 'pending';
            }
        }
        
        return response()
            ->view('admin.users', compact('users', 'status'))
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('status',1)->get()->pluck('title', 'id');

        return view('users.form', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $request['password'] = bcrypt($request->password);

        $request['username'] = $request->username ?? stristr($request->email, "@", true) . rand(100,1000);

        $user = User::create($request->all());

        $user->update(['token' => Str::uuid()]);
        $user->assignRole('user');

        return redirect()->route('users.index')->withSuccess(__('User Created',['name' => __('users.store')]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::with('userProfile','roles')->findOrFail($id);

        $profileImage = getSingleMedia($data, 'profile_image');

        return response()
        ->view('users.profile', compact('data', 'profileImage'))
        ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
        ->header('Pragma', 'no-cache')
        ->header('Expires', '0');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::with('userProfile','roles')->findOrFail($id);

        $data['user_type'] = $data->roles->pluck('id')[0] ?? null;

        $roles = Role::where('status',1)->get()->pluck('title', 'id');

        $profileImage = getSingleMedia($data, 'profile_image');

        return view('users.form', compact('data','id', 'roles', 'profileImage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request)
    {
        $user = User::findOrFail(auth()->id());
        if (!empty($request->password) || !empty($request->new_password)) {
            $password = !empty($request->password) ? $request->password : $request->new_password;
            $user->password = Hash::make($password);
        }
        
        if ($request->hasFile('profile_picture') || $request->hasFile('picture')) {
            $fileInputName = $request->hasFile('profile_picture') ? 'profile_picture' : 'picture';
        
            $fileNameWithExtension = $request->file($fileInputName)->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $extension = $request->file($fileInputName)->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;

            // Store the cropped image temporarily
            $croppedImage = null;
            if(!empty($request->cropped_image_user)){
                $croppedImage = $request->cropped_image_user;
            }else{
                $croppedImage = $request->cropped_image;
            }
            $tempImagePath = 'temp/'.$fileNameToStore;
            Storage::put($tempImagePath, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $croppedImage)));


            // $path = $request->file($fileInputName)->storeAs('public/profile_pictures', $fileNameToStore);
        
            if (!empty($user->profile_picture)) {
                Storage::disk('public')->delete('profile_pictures/' . $user->profile_picture);
            }
    
            Storage::move($tempImagePath, 'public/profile_pictures/'.$fileNameToStore);
            $user->profile_picture = $fileNameToStore;

            Storage::delete($tempImagePath);
        }        

        if(!empty($request->phone_number)){
           $user->phone_number = $request->phone_number;
        }
        
        $user->save();
    
        UserProfile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'titles' => $request->titles,
                'description' => $request->description,
            ]
        );

        return redirect()->back()->withSuccess(__('Profile updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $status = 'errors';
        $message= __('global-message.delete_form', ['form' => __('users.title')]);

        if($user!='') {
            if (!empty($user->profile_picture)) {
                Storage::disk('public')->delete('profile_pictures/' . $user->profile_picture);
            }
            $user->delete();
            $status = 'success';
            $message= __('global-message.delete_form', ['form' => __('users.title')]);
        }

        if(request()->ajax()) {
            return response()->json(['status' => true, 'message' => $message, 'datatable_reload' => 'dataTable_wrapper']);
        }

        return redirect()->back()->with($status,$message);

    }

    public function showById(Request $request)
    {
        $userId = $request->input('user_id');
        $user = User::find($userId);

        if (!$user) {
            // Handle product not found
            return response()->json(['error' => 'User not found'], 404);
        }

        // Render the view with product details
        $view = view('navComponents.show_team_details', compact('user'))->render();

        return response()->json(['view' => $view]);
    }
}
