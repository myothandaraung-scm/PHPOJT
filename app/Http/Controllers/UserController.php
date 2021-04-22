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
    //
    return view('user.login');
  }

  public function testuser(Request $request)
  {
    $request->validate([
      'email'    => 'required|email|exists:users,email',
      'password' => 'required',
    ]);

    log::info($request);
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
      log::info('true');
      session(['username' => $request->name]);
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
    return view('user.index', ['users' => $users]);
  }
}
