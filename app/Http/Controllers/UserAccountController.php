<?php

namespace App\Http\Controllers;

use App\Models\Assistant;
use App\Models\FarmManager;
use App\Models\SuperAdmin;
use Illuminate\Http\Request;

class UserAccountController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:assistant,farmmanager,superadmin');
    }

    public function pageUpdateAccount($role)
    {
        switch ($role) {
            case 'superadmin':
                return view('superadmin.accounts.account-setting')->with(['account' => $this->userInstance(($role)), 'role' => $role]);
                break;
            case 'farmmanager':
                return view('manager.accounts.account-setting')->with(['account' => $this->userInstance(($role)), 'role' => $role]);
                break;
            case 'assistant':
                return view('assistant.accounts.account-setting')->with(['account' => $this->userInstance(($role)), 'role' => $role]);
                break;
        }
    }

    public function updateAccount(Request $request)
    {
        $user = $this->userModel($request->role)::find($request->id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password
        ]);
        return back()->withSuccess('Data account updated successfully');
    }

    public function userInstance($user_role)
    {
        switch ($user_role) {
            case 'superadmin':
                return auth()->guard('superadmin')->user();
            case 'farmmanager':
                return auth()->guard('farmmanager')->user();
            case 'assistant':
                return auth()->guard('assistant')->user();
        }
    }

    public function userModel($user_role)
    {
        switch ($user_role) {
            case 'superadmin':
                return SuperAdmin::class;
            case 'farmmanager':
                return FarmManager::class;
            case 'assistant':
                return Assistant::class;
        }
    }
}
