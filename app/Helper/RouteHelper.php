<?php
namespace App\Helper;

use App\Helper\AlertHelper;
use App\Helper\RouteHelper;

class RouteHelper
{
    public static function getName () {
        $varText = request()->route()->getName();
        $newString = $varText;
        $newString = trim(strtolower($newString));
        $newString = preg_replace('/[\s.,-]+/', ' ', $newString);
        return $newString;
    }

    public static function checkPermission() {
        $routeName = RouteHelper::getName();
        if(!(auth()->user()->hasPermissionTo( $routeName))){
            AlertHelper::unAuthorized();
        }
    }
}
