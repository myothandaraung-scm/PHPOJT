<?php

namespace App\Contracts\Services\Post;
use Illuminate\Http\Request;

use App\Models\Post;

interface PostServiceInterface
{
  public function getPostList(string $type,int $id);
  public function searchPostList(Request $request);
  public function createPost(Request $request,int $userId);
  public function updatePost(Request $request,int $userId);
  public function deletePost(Post $post,int $userId);
  public function exportPost(Request $request);
  public function importData(Request $request,int $userId);
}
