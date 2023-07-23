<?php
namespace App\Helper;
use Closure;
use Illuminate\Routing\Route;
use App\Providers\RouteServiceProvider;

use App\Helpers\AlertPermissionHelper;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoutePermissionHelper
{
    public static function getName () {
        if(isset(request()->route()->action['as'])){
            $routeName = str_replace('modulo.','',@request()->route()->action['as']);

        }else{
            $routeName ='home';
        }

        return $routeName;
    }

    public static function checkPermission($user) {

        return true;
    }
}
