<?php
namespace App\Helper;

class AlertHelper
{
    public static function alertRedirect ($route, $icon, $type, $message) {
        return redirect()->route($route)->with([
            'alert-icon' => $icon,
            'alert-type' => $type,
            'alert-message' => $message,
        ]);
    }
}
