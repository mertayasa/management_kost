<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware{

    public function handle($request, Closure $next, $first_role, $second_role = null, $third_role = null){

        if(userRole() == $first_role || userRole() == $second_role || userRole() == $third_role){
            return $next($request);
        }

        abort(403);
    }

}
