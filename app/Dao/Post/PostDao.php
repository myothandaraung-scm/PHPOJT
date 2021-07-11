<?php

namespace App\Dao\Post;

use Illuminate\Support\Facades\DB;
use App\Contracts\Dao\Post\PostDaoInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use DateTime;

class PostDao implements PostDaoInterface
{
  public function getPostList(string $type,int $id)
  {
    if($type == '0'){
      $posts = DB::table('posts')
      ->join('users as user1', 'posts.create_user_id', '=', 'user1.id')
      ->join('users as user2', 'posts.updated_user_id', '=', 'user2.id')
      ->orWhere('posts.status', '=', 1)
      ->select('posts.*', 'user1.name as createuser','user2.name as updateuser')
      ->paginate(5);
    return $posts;
    }
    else{
      $posts = DB::table('posts')
      ->join('users as user1', 'posts.create_user_id', '=', 'user1.id')
      ->join('users as user2', 'posts.updated_user_id', '=', 'user2.id')
      ->where('posts.create_user_id','=',$id)
      ->where('posts.status', '=', 1)
      ->select('posts.*', 'user1.name as createuser','user2.name as updateuser')
      ->paginate(5);
      log::info($posts);
    return $posts;
    }
     
  }
  public function searchPostList(string $text)
  {
    if(Auth::user()->type == '0'){
      $posts = DB::table('posts')
      ->join('users as user1', 'posts.create_user_id', '=', 'user1.id')
      ->join('users as user2', 'posts.updated_user_id', '=', 'user2.id')
        ->where('posts.status', '=', 1)
        ->where(function ($query) use ($text) {
          $query->where('posts.title', 'LIKE', '%' . $text . '%')
            ->orWhere('posts.description', 'LIKE', '%' . $text . '%');
        })
        ->select('posts.*', 'user1.name as createuser','user2.name as updateuser')
        ->paginate(5);
      return $posts;
    }
    else{
      $posts = DB::table('posts')
      ->join('users as user1', 'posts.create_user_id', '=', 'user1.id')
      ->join('users as user2', 'posts.updated_user_id', '=', 'user2.id')
        ->where('posts.create_user_id','=',Auth::user()->id)
        ->where('posts.status', '=', 1)
        ->where(function ($query) use ($text) {
          $query->where('posts.title', 'LIKE', '%' . $text . '%')
            ->orWhere('posts.description', 'LIKE', '%' . $text . '%');
        })
        ->select('posts.*', 'user1.name as createuser','user2.name as updateuser')
        ->paginate(5);
      return $posts;
    }
  }


  public function createPost(Request $request, int $userId)
  {
    $existing_title = DB::table('posts')->where('title',$request->title)->first();
    if(!$existing_title){
      Post::create(['title' => $request->title, 'description' => $request->description, 'status' => 1, 'create_user_id' => $userId, 'updated_user_id' => $userId]);
    }
  }
  public function updatePost(Request $request,int $userId)
  {
    $existing_title = DB::table('posts')->where('title',$request->title)->first();
    if(!$existing_title){
      DB::table('posts')
      ->where('id', $request->id)
      ->update(array('title' => $request->title, 'description' => $request->description, 'status' => $request->status, 'updated_user_id' => $userId));
    }
   
  }
  public function deletePost(Post $post, int $userId)
  {
    $deleteddate = new DateTime('now');
    DB::table('posts')
      ->where('id', $post->id)
      ->update(array('status' => 0, 'deleted_user_id' => $userId, 'deleted_at' => $deleteddate));
  }
  public function exportPost(string $type,int $id)
  {
    if($type == '0'){
      $posts = DB::table('posts')
      ->join('users as user1', 'posts.create_user_id', '=', 'user1.id')
      ->join('users as user2', 'posts.updated_user_id', '=', 'user2.id')
      ->orWhere('posts.status', '=', 1)
      ->select('posts.*', 'user1.name as createuser','user2.name as updateuser')
      ->get();
      log::info($posts);
    return $posts;
    }
    else{
      log::info("test type");
      $posts = DB::table('posts')
      ->join('users as user1', 'posts.create_user_id', '=', 'user1.id')
      ->join('users as user2', 'posts.updated_user_id', '=', 'user2.id')
      ->where('posts.create_user_id','=',$id)
      ->where('posts.status', '=', 1)
      ->select('posts.*', 'user1.name as createuser','user2.name as updateuser')
      ->get();
      log::info($posts);
    return $posts;
    }
     
  }
  public function importData(array $row, int $userId)
  {
    $existing_title = DB::table('posts')->where('title', $row[0])->first();
    if(!$existing_title){
      Post::create(['title' =>$row[0], 'description' => $row[1], 'status' => (int)$row[2], 'create_user_id' => $userId, 'updated_user_id' => $userId]);
    }
  }
}
