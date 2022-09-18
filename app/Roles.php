<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\SoftDeletes;


class Roles extends Model
{
    public static function getRoles(){
        $roles = DB::table('roles')
            ->whereIn('id',[2,3,4,5,6])
            ->orderBy('id')
            ->get();
        return $roles;
    }

    public static function getRolesEnte($ente){
        $roles = DB::table('roles')
            ->where('name','like','%'.strtoupper($ente).'%')
            ->orderBy('id')
            ->get();
        return $roles;
    }

    public static function getRolesId($id){
        $roles = DB::table('roles')
            ->where('id','=',$id)
            ->first();
        return $roles;
    }
}
