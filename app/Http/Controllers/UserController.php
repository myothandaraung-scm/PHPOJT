<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Query\Expression;
use App\Contracts\Services\User\UserServiceInterface;


class UserController extends Controller
{
  private $userInterface;
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(UserServiceInterface $userInterface)
  {
    $this->userInterface = $userInterface;
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  public function login()
  {
    return view('user.login');
  }

  public function testuser(Request $request)
  {
    $request->session()->forget('post');
    $request->session()->forget('editpost');
    $request->validate([
      'email'    => 'required|email|exists:users,email',
      'password' => 'required',
    ]);
    $request->session()->put('userid', 'value');
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();
      return redirect()->intended('post/postlist ');
    }

    return back()->withErrors([
      'errors' => 'email or password is wrong!!',
    ]);
   //
    // return view('students.create');
  }
  public function commonHeader()
  {
    //
    return view('common.layout');
  }

  public function index()
  {
    $users = $this->userInterface->getUserList();
    return view('user.index', compact('users'))
      ->with('i', (request()->input('page', 1) - 1) * 5);
  }

  public function searchUser(Request $request)
  {
    $namesearch = $request->input('namesearch');
    $emailsearch = $request->input('emailsearch');
    $createdformsearch = $request->input('createdfromsearch');
    $createdtosearch = $request->input('createdtosearch');
    if ($namesearch == NULL && $emailsearch == NULL && $createdformsearch == NULL && $createdtosearch == NULL) {
      $users = $this->userInterface->getUserList();
    } else {
      $namesearch = !is_null($namesearch) ? $namesearch : '';
      $emailsearch = !is_null($emailsearch) ? $emailsearch : '';
      $createdformsearch = !is_null($createdformsearch) ? $createdformsearch : '';
      $createdtosearch = !is_null($createdtosearch) ? $createdtosearch : '';
      $users = $this->userInterface->searchUserList($namesearch,$emailsearch,$createdformsearch,$createdtosearch);
    }
    return view('user.index', compact('users'))
      ->with('i', (request()->input('page', 1) - 1) * 5);
  }
  public function register(){
    return view('user.register');
  }

}
