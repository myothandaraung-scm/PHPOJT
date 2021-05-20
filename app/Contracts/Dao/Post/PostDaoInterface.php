<?php

namespace App\Contracts\Dao\Post;
use Illuminate\Http\Request;

use App\Models\Post;

interface PostDaoInterface
{
    public function getPostList();
    public function searchPostList(string $text);
    public function createPost(Request $request,int $userId);
    public function updatePost(Request $request,Post $post,int $userId);
    public function deletePost(Post $post,int $userId);
    public function exportPost();
    public function importData(Request $request,int $userId);
}
