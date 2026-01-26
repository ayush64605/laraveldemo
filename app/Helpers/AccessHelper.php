<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('hasRole')) {
    function hasRole(string $role): bool
    {
        $user = Auth::user();
        if ($user->is_admin == 1) {
            return true;
        }
        return false;
    }
}

if (!function_exists('checkPermission')) {
    function checkPermission($permissions)
    {
        $user = Auth::user();
        if (!$user) {
            return false;
        }
        if ($user->is_admin == 1) {
            return true;
        }
        if (is_array($permissions)) {
            foreach ($permissions as $permission) {
                if ($user->can($permission)) {
                    return true;
                }
            }
            return false;
        }
        return $user->can($permissions);
    }
}