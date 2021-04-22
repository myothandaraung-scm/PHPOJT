<?php

namespace App\Dao\Post;
use Illuminate\Support\Facades\DB;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Models\Post;

class PostDao implements PostDaoInterface
{
  public function getPostList()
  {
    $posts= DB::table('posts')
    ->join('users', 'posts.create_user_id', '=', 'users.id')->get();
    //$posts = Post::all();
    return $posts; 
  }
}
