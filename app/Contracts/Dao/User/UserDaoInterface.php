<?php

namespace App\Contracts\Dao\User;

interface UserDaoInterface
{
  public function getUserList();
  public function searchUserList(string $name,string $email,string $datefrom,string $dateto);
}
