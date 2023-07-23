<?php

namespace App\Http\Middleware;

use Closure;
use App\Providers\RouteServiceProvider;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Helper\RoutePermissionHelper;
use App\Helper\AlertHelper;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
class RoutePermissionMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()){
            $user_id = Auth::id();
            $user = \App\Models\User::find($user_id);
            $routeName = RoutePermissionHelper::getName();

            if(!($user->can($routeName))){
            AlertHelper::alertRedirect(RouteServiceProvider::HOME,'ERROR','error','La ruta a la que desea acceder no esta autorizada');
        }


        }

        return $next($request);
    }
}

