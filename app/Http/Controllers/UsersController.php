<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Users;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Js;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('pages.systemuser', compact('users'));
    }
    public function newuser()
    {
        return view('pages.adduser');
    }
    public function systemUserProfile($id)
    {
        // dd(User::findOrFail($id));
        $profile = User::where('id', '=', $id)->first();
        $pass    = User::where('id', '=', $id)->first();
        return  view('pages.system_user_profile', compact('profile', 'pass'));
    }
    public function systemUserProfilePass($id)
    {
        $pass = User::where('id', '=', $id)->first;
        return  view('pages.system_user_profile', compact('pass'));
    }
    public function  systemUserProfileView(Request $request, $id)
    {
        $updateProfile = User::find($id);

        $updateProfile->first_name = $request->first_name;
        $updateProfile->last_name  = $request->last_name;
        $updateProfile->phone      = $request->mobile;
        $updateProfile->email      = $request->email;
        $updateProfile->update();
        return redirect()->back()->with('success', 'Update Successfully!');
    }
    public function  systemUserProfilePassword(Request $request, $id)
    {
        $updatePass = User::find($id); //Auth::user()->password
        if (!Hash::check($request->oldpassword)) {
            return redirect()->back()->with('error', 'The old password is incorrect.');
        }
        if ($request->newpassword !== $request->confirmpassword) {
            return redirect()->back()->with('error', 'The new password and confirmation do not match.');
        }
        $updatePass->password = Hash::make($request->newpassword);
        $updatePass->save();

        return redirect()->back()->with('success', 'Password updated successfully!');
    }
    public function newuserCreate(Request $request)
    {
        $request->validate([
            'email'       => 'required|string|email|unique:users',
            'mobile'      => 'required|string',
            'password'    => 'required|string|min:6|confirmed',
        ]);

        $profileImg = null;
        if ($request->hasFile('profile_img')) {
            $imgFile = $request->file('profile_img');
            $profileImg = uniqid() . '.' . $imgFile->getClientOriginalExtension();
            $imgFile->storeAs('public/SystemUser', $profileImg);
        }

        $userCv = null; // Corrected variable name
        if ($request->hasFile('cv')) {
            $cvFile = $request->file('cv');
            $userCv = uniqid() . '.' . $cvFile->getClientOriginalExtension();
            $cvFile->storeAs('public/SystemUser', $userCv);
        }

        $newUser = new User();
        $newUser->first_name     = $request->first_name;
        $newUser->last_name      = $request->last_name;
        $newUser->sex            = $request->sex;
        $newUser->birthday       = date("Y-m-d", strtotime($request->birthdate));
        $newUser->email          = $request->email;
        $newUser->phone          = $request->mobile;
        $newUser->address        = $request->address;
        $newUser->role_id        = $request->role_id;
        $newUser->status         = "Active";
        $newUser->password       = Hash::make($request->password);
        $newUser->profile_image  = $profileImg;
        $newUser->cv             = $userCv;
        $newUser->save();
        //return response()->json($newUser);
        return redirect()->back()->with('success', 'You have successfully registered a new user!');
    }
}
