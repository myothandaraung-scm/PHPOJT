<?php

namespace App\Services\Post;

use App\Contracts\Services\Post\PostServiceInterface;
use App\Contracts\Dao\Post\PostDaoInterface;

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
}
