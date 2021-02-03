<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Afdelling;
use App\Models\Company;
use App\Models\Farm;
use App\Models\Foreman;
use App\Models\Subforeman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request) {
        if ($token = Auth::guard('foreman')->attempt($request->all())) {
            return $this->respondWithToken($token, 'foreman');
        } elseif ($token = Auth::guard('subforeman')->attempt($request->all())) {
            return $this->respondWithToken($token, 'subforeman');
        }
        return res(false, 401, 'Unauthorized, invalid email or password');
    }

    public function logout() {
        // return 'p';
        if (Auth::guard('foreman')->check()) {
            Auth::guard('foreman')->logout();
        }
        if (Auth::guard('subforeman')->check()) {
            Auth::guard('subforeman')->logout();
        }
        return res(true, 200, 'Successfully logged out');
    }

    protected function respondWithToken($token, $guard)
    {   
        $profile = self::profileData($guard, Auth::guard($guard)->user());
        $data = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard($guard)->factory()->getTTL() * 60,
        ];
        array_push($data, $profile);
        
        return res(true, 200, 'Successfully log in', $data);
    }

    public static function profileData ($role, $user) {
        $entity = $role === 'foreman' ? Foreman::find($user->id) : Subforeman::find($user->id);
        $afdelling = Afdelling::find($entity->afdelling_id);
        $farm = Farm::find($afdelling->farm_id);
        $company = Company::find($farm->company_id);

        $account = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'afdelling_id' => $afdelling->afdelling_id,
            'role' => $user->role,
            'company' => $company->company_name,
            'farm' => $farm->name,
            'afdelling' => $afdelling->name
        ];

        return $account;
    }
}
