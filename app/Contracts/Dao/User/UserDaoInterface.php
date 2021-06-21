<?php

namespace App\Contracts\Dao\User;
use Illuminate\Http\Request;

interface UserDaoInterface
{
  public function getUserList();
  public function searchUserList(string $name,string $email,string $datefrom,string $dateto);
  public function createUser(Request $request,int $userid);
}
