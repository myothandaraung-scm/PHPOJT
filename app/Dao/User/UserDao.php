<?php

namespace App\Dao\User;

use Illuminate\Support\Carbon;
use App\Contracts\Dao\User\UserDaoInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Hash;

class UserDao implements UserDaoInterface
{

  //user list action
  public function getUserList()
  {
    $user = DB::table('users as user1')
      ->join('users AS user2', 'user1.create_user_id', '=', 'user2.id')
      ->select('user1.*', 'user2.name as createduserName')
      ->paginate(5);
    return $user;
  }
  public function searchUserList(string $name, string $email, string $datefrom, string $dateto)
  {
    $user = null;
    $datef = Carbon::parse($datefrom);
    $test = '';
    if ($name != '' && $email == '' && $datefrom == '' && $dateto == '') {
      $user = DB::table('users as user1')
        ->where(function ($query) use ($name) {
          $query->where('user1.name', 'LIKE', '%' . $name . '%');
        })
        ->join('users AS user2', 'user1.create_user_id', '=', 'user2.id')
        ->select('user1.*', 'user2.name as createduserName')
        ->paginate(5);
    } else if ($name == '' && $email != '' && $datefrom == '' && $dateto == '') {
      $user = DB::table('users as user1')
        ->where('user1.email', 'LIKE', '%' . $email . '%')
        ->join('users AS user2', 'user1.create_user_id', '=', 'user2.id')
        ->select('user1.*', 'user2.name as createduserName')
        ->paginate(5);
    } else if ($name == '' && $email == '' && $datefrom != '' && $dateto != '') {
      $user = DB::table('users as user1')
        ->whereBetween(DB::raw('(DATE_FORMAT(user1.created_at,"%Y-%m-%d"))'), [$datefrom, $dateto])
        ->join('users AS user2', 'user1.create_user_id', '=', 'user2.id')
        ->select('user1.*', 'user2.name as createduserName')
        ->paginate(5);
    }
    else if ($name != '' && $email != '' && $datefrom == '' && $dateto == '') {
      $user = DB::table('users as user1')
        ->where('user1.email', 'LIKE', '%' . $email . '%')
        ->where('user1.name', 'LIKE', '%' . $name . '%')
        ->join('users AS user2', 'user1.create_user_id', '=', 'user2.id')
        ->select('user1.*', 'user2.name as createduserName')
        ->paginate(5);
    }
    else if ($name == '' && $email != '' && $datefrom != '' && $dateto != '') {
      $user = DB::table('users as user1')
        ->where('user1.email', 'LIKE', '%' . $email . '%')
        ->whereBetween(DB::raw('(DATE_FORMAT(user1.created_at,"%Y-%m-%d"))'), [$datefrom, $dateto])
        ->join('users AS user2', 'user1.create_user_id', '=', 'user2.id')
        ->select('user1.*', 'user2.name as createduserName')
        ->paginate(5);
    }
     else if ($name != '' && $email != '' && $datefrom != '' && $dateto != '') {
      $user = DB::table('users as user1')
        ->where(function ($query) use ($name, $email, $datefrom, $dateto) {
          $query->where('user1.name', 'LIKE', '%' . $name . '%')
            ->where('user1.email', 'LIKE', '%' . $email . '%')
            ->whereBetween(DB::raw('(DATE_FORMAT(user1.created_at,"%Y-%m-%d"))'), [$datefrom, $dateto]);
        })
        ->join('users AS user2', 'user1.create_user_id', '=', 'user2.id')
        ->select('user1.*', 'user2.name as createduserName')
        ->paginate(5);
    }
    return $user;
  }
  public function createUser(Request $request,int $userId)
  {
    log::info("create dao");
    $type = '0';
    log::info($request);
    log::info($userId);
    if ($request->type == 'Admin') {
      $type = '0';
      //log::info($request->status);
    } else {
      $type = '1';
    }
    User::create(['name' => $request->name, 'email' => $request->email, 'password' => Hash::make($request->password),'profile' => $request->profile, 'type'=>$type,'phone'=>$request->phone,'address'=>$request->address,'dob'=>$request->dob,'create_user_id'=>$userId,'updated_user_id'=> $userId]);
  }
}