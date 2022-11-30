<?php
namespace App\Helper;

use App\Helper\AlertHelper;
use App\Helper\RouteHelper;

class RouteHelper
{
    public static function getName () {
        $routeName = request()->route()->getName();
        $routeName = trim(strtolower($routeName));
        $routeName = preg_replace('/[\s.,-]+/', ' ', $routeName);
        return $routeName;
    }

    public static function checkPermission() {
        $routeName = RouteHelper::getName();
        if(!(auth()->user()->hasPermissionTo( $routeName))){
            AlertHelper::unAuthorized();
        }
    }
}
