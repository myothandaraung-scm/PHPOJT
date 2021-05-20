<?php

namespace App\Contracts\Services\User;

interface UserServiceInterface
{
  public function getUserList();
  public function searchUserList(string $name,string $email,string $datefrom,string $dateto);
}
