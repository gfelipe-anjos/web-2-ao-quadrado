<?php

namespace App\Http\Controllers;

use App\Models\Permission;

class PermissionController extends Controller
{
    public static function loadPermissions($role) {

        $arr_permissions = Array();
        $perm = Permission::with(['resource'])->where('role_id', $role)->get();

        foreach($perm as $item) {
            $arr_permissions[$item->resource->name] = true;
        }
        // dd($arr_permissions);
        session(['user_permissions' => $arr_permissions]);
    }

    public static function isAuthorized($resource) {
        $permissions = session('user_permissions');

        if(array_key_exists($resource, $permissions)) {
            return true;
        }
        return false;
    }

}
