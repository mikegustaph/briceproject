<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function UserListView()
    {
        return view('pages.users_list');
    }

    public function PermissionList()
    {
        return view('pages.permission_list');
    }

    public function UserRoleList()
    {
        return view('pages.role_list');
    }
    public function CreateUserRole()
    {
        return view('pages.create_user_role');
    }
    public function CreateUser()
    {
        return view('pages.create_user');
    }
    public function UserCreate()
    {
        return view('pages.create_user');
    }
}
