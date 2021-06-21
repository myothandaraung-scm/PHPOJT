<?php

namespace App\Services\User;

use App\Contracts\Dao\User\UserDaoInterface;
use Illuminate\Http\Request;
use App\Contracts\Services\User\UserServiceInterface;
use App\Models\User;

class UserService implements UserServiceInterface
{
  private $userDao;

  /**
   * Class Constructor
   * @param OperatorUserDaoInterface
   * @return
   */
  public function __construct(UserDaoInterface $userDao)
  {
    $this->userDao = $userDao;
  }

  /**
   * Get User List
   * @param Object
   * @return $userList
   */

  public function getUserList()
  {
    return $this->userDao->getUserList();
  }
  public function searchUserList(string $name, string $email, string $datefrom, string $dateto)
  {
    return $this->userDao->searchUserList($name,$email,$datefrom,$dateto);
  }
  public function createUser(Request $request,int $userid){
    return $this->userDao->createUser($request,$userid);
  }

}
