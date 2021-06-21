<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Query\Expression;
use App\Contracts\Services\User\UserServiceInterface;
use Illuminate\Validation\Rule;
use App\Models\User;

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
    $request->session()->forget('user');
    $request->session()->forget('editpost');
    $request->validate([
      'email'    => 'required|email|exists:users,email',
      'password' => 'required',
    ]);
    $request->session()->put('userid', 'value');
    log::info($request);
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
      log::info('true');
      $request->session()->regenerate();
      return redirect()->intended('post/postlist');
    }
    else{
      $errors['password']=  'password is incorrect';
      return redirect()->back()->withErrors($errors);
    }
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

  public function register(Request $request, User $user){
    log::info("data");
    log::info("get info");
    log::info($request);
    if ($request->session()->has('user')) {
      $user->name = $request->session()->get('user')['name'];
      $user->email = $request->session()->get('user')['email'];
      $user->password = $request->session()->get('user')['password'];
      $user->confirm_password = $request->session()->get('user')['confirm_password'];
      $user->address = $request->session()->get('user')['address'];
      $user->type = $request->session()->get('user')['type'];
      $user->phone = $request->session()->get('user')['phone'];
      $user->profile = $request->session()->get('user')['profile'];
      $user->dob = $request->session()->get('user')['dob'];
      $request->session()->forget('user');
    }
    return view('user.register',['user' => $user]);
  }
  public function confirmuser (Request $request){
    $request->validate([
      'name' => 'min:3|max:50',
      'email' => 'email',
      'password' => 'min:8|regex:/^(?=.*[A-Z])(?=.*\d).+$/|same:confirm_password',
      'confirm_password' => 'min:8',
      'profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      ]);
      $type = '';
      log::info($request);
      if($request->type == '0'){
        $request->type  = 'Admin';
      }
      else{
        log::info("false admin");
        $request->type  = 'User';
      }
      $id = Auth::user()->id;
      $path = 'images/Upload/' . $id . '/profile';
      $name = time() . '_' . $request->profile->getClientOriginalName();
      $request->profile->move(public_path($path), $name);
      $imagePath = '/' .$path . '/' . $name ;
      $request->profile = $imagePath;
      $request->session()->put('user', ['name' => $request->name, 'email' => $request->email,'password' => $request->password,'confirm_password' => $request->confirm_password,'type' => $request->type,'profile' => $request->profile,'address' => $request->address,'profile' => $request->profile,'dob' => $request->dob,'phone' => $request->phone]);
      return view('user.confirmuser', ['user' => $request]);
  }
  public function createuser(Request $request)
  {
    //$id = Auth::
    $request->session()->forget('user');
    $id = Auth::user()->id;
    $this->userInterface->createUser($request,$id);
    return redirect()->intended('users/');
  }
  
  public function edituser(Request $request,User $user){
    log::info("data");
    log::info("get info");
    log::info($request);
    if ($request->session()->has('edituser')) {
      $user->name = $request->session()->get('user')['name'];
      $user->email = $request->session()->get('user')['email'];
      $user->password = $request->session()->get('user')['password'];
      $user->confirm_password = $request->session()->get('user')['confirm_password'];
      $user->address = $request->session()->get('user')['address'];
      $user->type = $request->session()->get('user')['type'];
      $user->phone = $request->session()->get('user')['phone'];
      $user->profile = $request->session()->get('user')['profile'];
      $user->dob = $request->session()->get('user')['dob'];
      $request->session()->forget('edituser');
    }

    return view('user.edituser', compact('user'));
  }
  public function confirmedituser(Request $request, User $user)
  {
    $request->validate([
      'name' => 'min:3|max:50',
      'email' => 'email',
      'password' => 'min:8|regex:/^(?=.*[A-Z])(?=.*\d).+$/|same:confirm_password',
      'confirm_password' => 'min:8',
      'profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      ]);
      $type = '';
      log::info($request);
      if($request->type == '0'){
        $request->type  = 'Admin';
      }
      else{
        log::info("false admin");
        $request->type  = 'User';
      }
      $id = Auth::user()->id;
      $path = 'images/Upload/' . $id . '/profile';
      $name = time() . '_' . $request->profile->getClientOriginalName();
      $request->profile->move(public_path($path), $name);
      $imagePath = '/' .$path . '/' . $name ;
      $request->profile = $imagePath;
      $request->session()->put('edituser', ['name' => $request->name, 'email' => $request->email,'password' => $request->password,'confirm_password' => $request->confirm_password,'type' => $request->type,'profile' => $request->profile,'address' => $request->address,'profile' => $request->profile,'dob' => $request->dob,'phone' => $request->phone]);
    return view('user.confirmedituser', ['user' => $request]);
  }

  public function updateuser(Request $request)
  {
    //$id = Auth::
    log::info("update data");
    log::info($request);
    $request->session()->forget('edituser');
    $id = Auth::user()->id;
    //$this->userInterface->createUser($request,$id);
    return redirect()->intended('users/');
  }

}
