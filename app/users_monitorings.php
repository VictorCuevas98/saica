<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class users_monitorings extends Model
{
  protected $fillable = [
     'id_users',
     'token',
     'login',
     'result',
     'code_error'
 ];

 public static function getDatosToken($request)
 {
     $token = $request;
     $user = DB::table('users_monitorings')->where('token', '=', $token)->first();
     return $user;
 }
 public static function getDatosUserId($request)
 {
     $id = $request;
     $user = DB::table('users_monitorings')->where('id_users', '=', $id)->first();
     return $user;
 } 
}
