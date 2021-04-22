<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;

use App\Contracts\Services\Post\PostServiceInterface;


class PostController extends Controller
{
  private $postInterface;
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(PostServiceInterface $postInterface)
  {
    $this->postInterface = $postInterface;
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function postlist()
  {
    //
    $posts = $this->postInterface->getPostList();
    Log:info($posts);
    return view('post.postlist',['posts'=> $posts]);
  }
}
