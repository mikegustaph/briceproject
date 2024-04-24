<?php

namespace App\Http\Controllers;

use App\Models\Role_Main;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SystemSettingController extends Controller
{
    public function index()
    {
        return view('pages.setting_general');
    }

    public function viewprofile()
    {
        return view('pages.setting_profile');
    }

    public function rolepermission()
    {
        $roledata = Role_Main::all();
        return view('pages.role_permissions', compact('roledata'));
    }
    public function roleCreate(Request $request)
    {
        return view('pages.role_create');
    }
    public function roleCreateStore(Request $request)
    {
        $newrole             = new Role_Main();
        $newrole->name       = $request->role_name;
        $newrole->guard_name = $request->guardname;
        $newrole->save();
        return redirect()->back()->with('success', 'New Role has been created!');
    }

    public function ChangePermission($id)
    {
        $role = Role::find($id);
        $perm = Role::findByName($role->name)->permissions();
        $all_permission = $perm->pluck('name')->toArray();

        if (!empty($all_permission)) {
            return view('pages.change_permission', compact('all_permission', 'role'));
        } else {
            return view('pages.change_permission', compact('all_permission', 'role'));
        }
    }
    public function ChangePermissionStore(Request $request)
    {
        $role = $request->role_id;
        $role = Role::firstOrCreate(['id' => $request['role_id']]);

        if ($request->has('dashboard-view')) {
            $permission = Permission::firstOrCreate(['name' => 'dashboard-view']);
            if (!$role->hasPermissionTo('dashboard-view')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('dashboard-view');
        }
        if ($request->has('dashboard-add')) {
            $permission = Permission::firstOrCreate(['name' => 'dashboard-add']);
            if (!$role->hasPermissionTo('dashboard-add')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('dashboard-add');
        }
        if ($request->has('dashboard-edit')) {
            $permission = Permission::firstOrCreate(['name' => 'dashboard-edit']);
            if (!$role->hasPermissionTo('dashboard-edit')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('dashboard-edit');
        }
        if ($request->has('dashboard-delete')) {
            $permission = Permission::firstOrCreate(['name' => 'dashboard-delete']);
            if (!$role->hasPermissionTo('dashboard-delete')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('dashboard-delete');
        }
        if ($request->has('customer-view')) {
            $permission = Permission::firstOrCreate(['name' => 'customer-view']);
            if (!$role->hasPermissionTo('customer-view')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('customer-view');
        }
        if ($request->has('customer-add')) {
            $permission = Permission::firstOrCreate(['name' => 'customer-add']);
            if (!$role->hasPermissionTo('customer-add')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('customer-add');
        }
        if ($request->has('customer-edit')) {
            $permission = Permission::firstOrCreate(['name' => 'customer-edit']);
            if (!$role->hasPermissionTo('customer-edit')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('customer-delete');
        }
        if ($request->has('customer-delete')) {
            $permission = Permission::firstOrCreate(['name' => 'customer-delete']);
            if (!$role->hasPermissionTo('customer-delete')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('customer-delete');
        }
        if ($request->has('NewLoan-view')) {
            $permission = Permission::firstOrCreate(['name' => 'NewLoan-view']);
            if (!$role->hasPermissionTo('NewLoan-view')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('NewLoan-view');
        }
        if ($request->has('NewLoan-add')) {
            $permission = Permission::firstOrCreate(['name' => 'NewLoan-add']);
            if (!$role->hasPermissionTo('NewLoan-add')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('NewLoan-add');
        }
        if ($request->has('NewLoan-edit')) {
            $permission = Permission::firstOrCreate(['name' => 'NewLoan-edit']);
            if (!$role->hasPermissionTo('NewLoan-edit')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('NewLoan-edit');
        }
        if ($request->has('NewLoan-edit')) {
            $permission = Permission::firstOrCreate(['name' => 'NewLoan-edit']);
            if (!$role->hasPermissionTo('NewLoan-edit')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('NewLoan-edit');
        }
        if ($request->has('NewLoan-delete')) {
            $permission = Permission::firstOrCreate(['name' => 'NewLoan-delete']);
            if (!$role->hasPermissionTo('NewLoan-delete')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('NewLoan-delete');
        }
        if ($request->has('CustomerDetail-view')) {
            $permission = Permission::firstOrCreate(['name' => 'CustomerDetail-view']);
            if (!$role->hasPermissionTo('CustomerDetail-view')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('CustomerDetail-view');
        }
        if ($request->has('CustomerDetail-add')) {
            $permission = Permission::firstOrCreate(['name' => 'CustomerDetail-add']);
            if (!$role->hasPermissionTo('CustomerDetail-add')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('CustomerDetail-add');
        }
        if ($request->has('CustomerDetail-edit')) {
            $permission = Permission::firstOrCreate(['name' => 'CustomerDetail-edit']);
            if (!$role->hasPermissionTo('CustomerDetail-edit')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('CustomerDetail-edit');
        }
        if ($request->has('CustomerDetail-delete')) {
            $permission = Permission::firstOrCreate(['name' => 'CustomerDetail-delete']);
            if (!$role->hasPermissionTo('CustomerDetail-delete')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('CustomerDetail-delete');
        }
        if ($request->has('Borrowing-view')) {
            $permission = Permission::firstOrCreate(['name' => 'Borrowing-view']);
            if (!$role->hasPermissionTo('Borrowing-view')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('Borrowing-view');
        }
        if ($request->has('Borrowing-add')) {
            $permission = Permission::firstOrCreate(['name' => 'Borrowing-add']);
            if (!$role->hasPermissionTo('Borrowing-add')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('Borrowing-add');
        }
        if ($request->has('Borrowing-edit')) {
            $permission = Permission::firstOrCreate(['name' => 'Borrowing-edit']);
            if (!$role->hasPermissionTo('Borrowing-edit')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('Borrowing-edit');
        }
        if ($request->has('Borrowing-delete')) {
            $permission = Permission::firstOrCreate(['name' => 'Borrowing-delete']);
            if (!$role->hasPermissionTo('Borrowing-delete')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('Borrowing-delete');
        }
        if ($request->has('Transaction-view')) {
            $permission = Permission::firstOrCreate(['name' => 'Transaction-view']);
            if (!$role->hasPermissionTo('Transaction-view')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('Transaction-view');
        }
        if ($request->has('Transaction-add')) {
            $permission = Permission::firstOrCreate(['name' => 'Transaction-add']);
            if (!$role->hasPermissionTo('Transaction-add')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('Transaction-add');
        }
        if ($request->has('Transaction-edit')) {
            $permission = Permission::firstOrCreate(['name' => 'Transaction-edit']);
            if (!$role->hasPermissionTo('Transaction-edit')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('Transaction-edit');
        }
        if ($request->has('Transaction-delete')) {
            $permission = Permission::firstOrCreate(['name' => 'Transaction-delete']);
            if (!$role->hasPermissionTo('Transaction-delete')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('Transaction-delete');
        }
        if ($request->has('AppSetting-view')) {
            $permission = Permission::firstOrCreate(['name' => 'AppSetting-view']);
            if (!$role->hasPermissionTo('AppSetting-view')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('AppSetting-view');
        }
        if ($request->has('AppSetting-add')) {
            $permission = Permission::firstOrCreate(['name' => 'AppSetting-add']);
            if (!$role->hasPermissionTo('AppSetting-add')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('AppSetting-add');
        }
        if ($request->has('AppSetting-edit')) {
            $permission = Permission::firstOrCreate(['name' => 'AppSetting-edit']);
            if (!$role->hasPermissionTo('AppSetting-edit')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('AppSetting-edit');
        }
        if ($request->has('AppSetting-delete')) {
            $permission = Permission::firstOrCreate(['name' => 'AppSetting-delete']);
            if (!$role->hasPermissionTo('AppSetting-delete')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('AppSetting-delete');
        }
        if ($request->has('AppSetting-view')) {
            $permission = Permission::firstOrCreate(['name' => 'AppSetting-view']);
            if (!$role->hasPermissionTo('AppSetting-view')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('AppSetting-view');
        }
        if ($request->has('SystemSetting-view')) {
            $permission = Permission::firstOrCreate(['name' => 'SystemSetting-view']);
            if (!$role->hasPermissionTo('SystemSetting-view')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('SystemSetting-view');
        }
        if ($request->has('SystemSetting-add')) {
            $permission = Permission::firstOrCreate(['name' => 'SystemSetting-add']);
            if (!$role->hasPermissionTo('SystemSetting-add')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('SystemSetting-add');
        }
        if ($request->has('SystemSetting-edit')) {
            $permission = Permission::firstOrCreate(['name' => 'SystemSetting-edit']);
            if (!$role->hasPermissionTo('SystemSetting-edit')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('SystemSetting-edit');
        }
        if ($request->has('SystemSetting-delete')) {
            $permission = Permission::firstOrCreate(['name' => 'SystemSetting-delete']);
            if (!$role->hasPermissionTo('SystemSetting-delete')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('SystemSetting-delete');
        }
        return redirect()->back()->with('message', 'Permission are set successfully!');
    }
}
