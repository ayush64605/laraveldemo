<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('hasPermission')) {
    function hasPermission(string $permission): bool
    {
        return Auth::check() && Auth::user()->can($permission);
    }
}

if (!function_exists('hasRole')) {
    function hasRole(string $role): bool
    {
        return Auth::check() && Auth::user()->hasRole($role);
    }
}
