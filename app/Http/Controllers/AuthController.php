<?php

namespace App\Http\Controllers;

use App\Models\PoolsUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
{
    $pssw = Hash::make($request->password);
    $user = User::where('name', $request->name)->where('password', $request->password)->first();

    // Comprueba si el usuario existe y si la contraseña coincide
    if ($user) {

        return $user;
    } else {

        return $pssw;
    }
}
public function get(Request $request)
{

    $user = User::where('id', $request->id)->first();
    $poolId =$user->pool;
    $result = DB::table('pools_users')->where('id_pool', $poolId)
    ->join('users', 'pools_users.id_user', '=', 'users.id')
    ->select('users.name as nombre','pools_users.id as id', 'pools_users.id_pool as id_pool', 'pools_users.date as date', 'pools_users.temp as temp')
    ->get();

    return $result;
}

}
