<?php

namespace App\Contracts\Services\User;
use Illuminate\Http\Request;
use App\Models\User;
interface UserServiceInterface
{
  public function getUserList();
  public function searchUserList(string $name,string $email,string $datefrom,string $dateto);
  public function createUser(Request $request,int $userid);
  public function updateUser(Request $request,int $userid);
  public function deleteUser(User $user,int $userId);
}
