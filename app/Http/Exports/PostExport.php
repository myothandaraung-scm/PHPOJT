<?php

namespace App\Http\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Contracts\Services\Post\PostServiceInterface;
//use App\Models\Post;
use App\Post;

class PostExport implements FromCollection
{
    private $posts;
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    public function __construct(Object $posts)
    {
      $this->posts = $posts;
    }
    // /**
    // * @return \Illuminate\Support\Collection
    
    public function collection()
    {
         $post_array[] = array('title', 'description', 'Posted User', 'Created Time');
        foreach($this->posts as $post)
        {
        $post_array[] = array(
        'title'  => $post->title,
        'description'   => $post->description,
        'Post User'    => $post->createuser,
        'Created Time'  => $post->created_at,
        );
        }
        return collect($post_array);
        //return Post::all();
    }
}