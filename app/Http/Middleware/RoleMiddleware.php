<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware{

    public function handle($request, Closure $next, $role_name, $second_role_name = null){
        // 3 Users
        $role = $role_name == 'owner' ? 0 : ($role_name == 'manager' ? 1 : 2);
        $second_role = $second_role_name == 'owner' ? 0 : ($second_role_name == 'manager' ? 1 : 2);
        
        // 2 Users
        // $role = $role_name == 'owner' ? 0 : 1;
        // $second_role = $second_role_name == 'owner' ? 0 : 1;

        if(Auth::user()->level == $role || Auth::user()->level == $second_role){
            return $next($request);
        }
        abort(403);
    }

}
