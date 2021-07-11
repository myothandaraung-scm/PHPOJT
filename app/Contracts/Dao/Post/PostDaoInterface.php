<?php

namespace App\Contracts\Dao\Post;
use Illuminate\Http\Request;

use App\Models\Post;

interface PostDaoInterface
{
    public function getPostList(string $type,int $id);
    public function searchPostList(string $text);
    public function createPost(Request $request,int $userId);
    public function updatePost(Request $request,int $userId);
    public function deletePost(Post $post,int $userId);
    public function exportPost(string $type,int $id);
    public function importData(array $request,int $userId);
}
