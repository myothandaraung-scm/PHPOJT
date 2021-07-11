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
  public function searchUserList(Request $request)
  {
    $namesearch = $request->input('namesearch');
    $emailsearch = $request->input('emailsearch');
    $createdformsearch = $request->input('createdfromsearch');
    $createdtosearch = $request->input('createdtosearch');
    if ($namesearch == NULL && $emailsearch == NULL && $createdformsearch == NULL && $createdtosearch == NULL) {
      $users = $this->userDao->getUserList();
    } else {
      $namesearch = !is_null($namesearch) ? $namesearch : '';
      $emailsearch = !is_null($emailsearch) ? $emailsearch : '';
      $createdformsearch = !is_null($createdformsearch) ? $createdformsearch : '';
      $createdtosearch = !is_null($createdtosearch) ? $createdtosearch : '';
      $users =$this->userDao->searchUserList($namesearch,$emailsearch,$createdformsearch,$createdtosearch);
    }
    return $users;
  }
  public function createUser(Request $request,int $userid){
    $type = '0';
    if ($request->type == 'Admin') {
      $request->type = '0';
    } else {
      $request->type = '1';
    }
    return $this->userDao->createUser($request,$userid);
  }
  public function updateUser(Request $request,int $userId)
  {
    if ($request->type == 'Admin') {
      $request->type = 0;
    } else {
      $request->type = 1;
    }

      $this->userDao->updateUser($request,$userId);
  }
  public function deleteUser(User $user,int $userId)
  {
      $this->userDao->deleteUser($user,$userId);
  }

}
