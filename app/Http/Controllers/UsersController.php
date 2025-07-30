<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
//use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function UserListView()
    {
        $users = User::all();
        return view('pages.users_list', compact('users'));
    }
    public function UserProfileView($id)
    {
        $user = User::find($id);
        if (!$user) {
            abort(404, 'User not found.');
        }
        return view('pages.user_profile', compact('user'));
    }
    public function UserProfileUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);
        // Validation rules
        $validatedData = $request->validate([
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cv' => 'nullable|mimes:pdf|max:2048',
            'first_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'phone' => 'string|max:15',
            'gender' => 'nullable|in:male,female,other',
            'birthday' => 'nullable|date',
            'role' => 'nullable|string',
            'position' => 'nullable|string',
            'address' => 'nullable|string',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            //'password' => 'nullable|min:6|confirmed',
        ]);
        // File upload handling for profile image
        if ($request->hasFile('profile_image')) {
            $profileImageName = time() . '_' . uniqid() . '.' . $request->file('profile_image')->getClientOriginalExtension();
            $profileImagePath = $request->file('profile_image')->storeAs('profile_images', $profileImageName, 'public');
            $user->profile_image = $profileImageName;
        }
        // File upload handling for CV
        if ($request->hasFile('cv')) {
            $cvName = time() . '_' . uniqid() . '.' . $request->file('cv')->getClientOriginalExtension();
            $cvPath = $request->file('cv')->storeAs('cvs', $cvName, 'public');
            $user->cv = $cvName;
        }
        // Updating other fields
        $user->first_name = $validatedData['first_name'];
        $user->last_name = $validatedData['last_name'];
        $user->phone = $validatedData['phone'];
        $user->gender = $validatedData['gender'] ?? $user->gender;
        $user->birthday = $validatedData['birthday'] ?? $user->birthday;
        $user->role = $validatedData['role'] ?? $user->role;
        $user->position = $validatedData['position'] ?? $user->position;
        $user->address = $validatedData['address'] ?? $user->address;
        $user->username = $validatedData['username'];
        $user->email = $validatedData['email'];
        // Update password if provided
        if (!empty($validatedData['password'])) {
            $user->password = bcrypt($validatedData['password']);
        }
        $user->save();
        return redirect()->back()->with('success', 'User profile updated successfully!');
    }

    public function PermissionList()
    {
        return view('pages.permission_list');
    }
    public function DeleteUserRole()
    {
        //return view('');
    }

    public function CreateUserRole()
    {
        return view('pages.create_user_role');
    }

    public function CreateUser()
    {
        return view('pages.create_user');
    }
    //public function CreateUser() {}
    public function createUserStoreData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profile_image' => 'nullable|image|max:2048', // Optional image upload
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'phone'         => 'required|string|max:20|unique:users,phone',
            'gender'        => 'nullable|string|in:male,female,other',
            'birthday'      => 'nullable|date',
            'role'          => 'required|string|max:255',
            'position'      => 'nullable|string|max:255',
            'cv'            => 'nullable|file|mimes:pdf|max:2048', // Optional CV upload
            'address'       => 'nullable|string|max:255',
            'username'      => 'required|string|max:255|unique:users,username',
            'email'         => 'required|email|max:255|unique:users,email',
            //'password'      => 'required|string|min:8|confirmed', // Password confirmation
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with([
                'status'  => 'error',
                'message' => 'Validation failed',
                'errors'  => $validator->errors(),
            ]);
        }
        $profileImageName = $request->file('profile_image')
            ? uniqid() . '_' . time() . '.' . $request->file('profile_image')->getClientOriginalExtension()
            : null;

        $cvName = $request->file('cv')
            ? uniqid() . '_' . time() . '.' . $request->file('cv')->getClientOriginalExtension()
            : null;
        // Save the files using unique names
        if ($request->file('profile_image')) {
            $request->file('profile_image')->storeAs('profile_images', $profileImageName, 'public');
        }
        if ($request->file('cv')) {
            $request->file('cv')->storeAs('cvs', $cvName, 'public');
        }
        // Create the user
        $user = User::create([
            'profile_image' => $profileImageName,
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'phone'         => $request->phone,
            'gender'        => $request->gender,
            'birthday'      => $request->birthday,
            'role'          => $request->role,
            'position'      => $request->position,
            'cv'            => $cvName,
            'address'       => $request->address,
            'username'      => $request->username,
            'email'         => $request->email,
            'password'      => Hash::make($request->password), // Hash the password
        ]);
        return redirect()->back()->with([
            'status'  => 'success',
            'message' => 'User created successfully',
        ]);
    }
    public function ChangeTheRole($id)
    {
        $role = User::find($id);
        return view('pages.permission_list', compact('role'));
    }
}
