<?php

namespace App\Services\Post;

use App\Contracts\Services\Post\PostServiceInterface;
use App\Contracts\Dao\Post\PostDaoInterface;
use Illuminate\Http\Request;
use App\Models\Post;

class PostService implements PostServiceInterface
{
    private $postDao;
    /**
     * Class Constructor
     * @param OperatorPostDaoInterface
     * @return
     */
    public function __construct(PostDaoInterface $postDao)
    {
        $this->postDao = $postDao;
    }
    public function getPostList()
    {
        return $this->postDao->getPostList();
    }
    public function searchPostList(string $text)
    {
        return $this->postDao->searchPostList($text);
    }
    public function createPost(Request $request, int $userId)
    {
        $this->postDao->createPost($request,$userId);
    }
    public function updatePost(Request $request,Post $post,int $userId)
    {
        $this->postDao->updatePost($request,$post,$userId);
    }
    public function deletePost(Post $post,int $userId)
    {
        $this->postDao->deletePost($post,$userId);
    }
    public function exportPost()
    {
        return $this->postDao->exportPost();
    }
    public function importData(Request $request, int $userId)
    {
        return $this->postDao->importData($request,$userId);
    }
}
