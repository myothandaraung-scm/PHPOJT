<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Contracts\Services\Post\PostServiceInterface;
use App\Models\Post;
use App\Post as AppPost;
use Illuminate\Validation\Rule;
//use Illuminate\Support\Facades;
use function PHPSTORM_META\type;

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
    $posts = $this->postInterface->getPostList();
    return view('post.postlist', compact('posts'))
      ->with('i', (request()->input('page', 1) - 1) * 5);
  }
  public function searchPost(Request $request)
  {
    $request->session()->forget('post');
    $request->session()->forget('user');
    $request->session()->forget('editpost');
    $request->session()->forget('edituser');
    log::info("search");
    log::info($request);
    $search = $request->input('postserach');
    if ($search == NULL) {
      $posts = $this->postInterface->getPostList();
    } else {
      $posts = $this->postInterface->searchPostList($search);
    }
    return view('post.postlist', compact('posts'))
      ->with('i', (request()->input('page', 1) - 1) * 5);
  }
  public function create(Request $request, Post $post)
  {
    if ($request->session()->has('post')) {
      $post->title = $request->session()->get('post')['titlepost'];
      $post->description = $request->session()->get('post')['postdescription'];
      $request->session()->forget('post');
    }
    return view('post.createpost', ['posts' => $post]);
  }


  public function confirmPost(Request $request)
  {
    $request->validate([
      'title'    => 'required|unique:posts,title',
      'description' => 'required',
    ]);
    $request->session()->put('post', ['titlepost' => $request->title, 'postdescription' => $request->description]);
    return view('post.confirmPost', ['posts' => $request]);
  }


  public function createpost(Request $request)
  {
    $request->session()->forget('user');
    $request->session()->forget('editpost');
    $request->session()->forget('edituser');
    $request->session()->forget('post');
    $id = Auth::user()->id;
    $this->postInterface->createPost($request, $id);
    return redirect()->intended('post/postlist');
  }


  public function editpost(Request $request, Post $post)
  {

    if ($request->session()->has('editpost')) {
      $post->id = $request->session()->get('editpost')['postid'];
      $post->title = $request->session()->get('editpost')['titlepost'];
      $post->description = $request->session()->get('editpost')['postdescription'];
      log::info($request->session()->get('editpost')['poststatus']);
      $post->status = $request->session()->get('editpost')['poststatus'];
      $request->session()->forget('editpost');
    }
    return view('post.editpost', compact('post'));
  }


  public function confirmeditpost(Request $request, Post $post)
  {
    $status = 1;
    $request->validate([
      'title'    => 'required',
      'description' => 'required',
    ]);
    if ($request->status == 'on') {
      $status = 1;
      log::info($request->status);
    } else {
      $status = 0;
    }
    $request->session()->put('editpost', ['postid' => $request->id, 'titlepost' => $request->title, 'postdescription' => $request->description, 'poststatus' => $status]);
    return view('post.confirmeditpost', ['post' => $request]);
  }


  public function updatepost(Request $request, Post $post)
  {
    $request->session()->forget('post');
    $request->session()->forget('user');
    $request->session()->forget('edituser');
    $request->session()->forget('editpost');
    $id = Auth::user()->id;
    $this->postInterface->updatePost($request, $post, $id);
    return redirect()->intended('post/postlist');
  }


  public function deletepost(Post $post)
  {
    $id = Auth::user()->id;
    $this->postInterface->deletePost($post, $id);
    return redirect()->route('post.postlist')
      ->with('success', 'post deleted successfully');
  }
  public function export(Post $post)
  {
    $request->session()->forget('post');
    $request->session()->forget('user');
    $request->session()->forget('editpost');
    $request->session()->forget('edituser');
    log::info("export");
    log::info($post);
    $headers = array(
      "Content-type" => "text/csv",
      "Content-Disposition" => "attachment; filename=file.csv",
      "Pragma" => "no-cache",
      "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
      "Expires" => "0"
    );

    $posts = $this->postInterface->exportPost();
    $columns = array('title', 'description', 'Posted User', 'Created Time');

    $callback = function () use ($posts, $columns) {
      $file = fopen('php://output', 'w');
      fputcsv($file, $columns);

      foreach ($posts as $post) {
        fputcsv($file, array($post->title, $post->description, $post->description, $post->name, $post->created_at));
      }
      fclose($file);
    };
    return Response::stream($callback, 200, $headers);
  }

  public function importCSV()
  {
    return view('post.importCSV');
  }

  public function importfile()
  {
    $request->validate([
      'file' => 'required|mimes:csv,txt,xlx,xls,xlsx|max:2048'
      ]);
      $id = Auth::user()->id;
      $this->postInterface->importData($request,$id);
      $name = time().'_'.$request->file->getClientOriginalName();
      return redirect()->intended('post/postlist')
      ->with('success','File has uploaded to the database.')
      ->with('file', $name);
  }
}
