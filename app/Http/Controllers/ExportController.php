<?php

namespace App\Http\Controllers;
use App\Contracts\Services\Post\PostServiceInterface;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Post;


class ExportController extends Controller implements FromCollection{
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

    public function collection()
    {
        $posts = $this->postInterface->exportPost();
        $post_array[] = array('title', 'description', 'Posted User', 'Created Time');
        foreach($posts as $post)
        {
        $post_array[] = array(
        'title'  => $post->title,
        'description'   => $post->description,
        'Post User'    => $post->name,
        'Created Time'  => $post->created_at,
        );
        }
        return collect($post_array);
    }
}