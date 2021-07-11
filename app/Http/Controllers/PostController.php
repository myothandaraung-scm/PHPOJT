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
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Exports\PostExport;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Http\Controllers\ExportController;

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
  public function postlist(Request $request)
  {
    $posts = $this->postInterface->getPostList(Auth::user()->type,Auth::user()->id);
    $import_message = NULL;
    if($request->has('import')){
      $import_message = $request->import;
      $request->import = NULL;
    }
    return view('post.postlist', compact('posts'))
      ->with('i', (request()->input('page', 1) - 1) * 5)
      ->with('import_message',$import_message);
  }
  public function searchPost(Request $request)
  {
    $request->session()->forget('post');
    $request->session()->forget('user');
    $request->session()->forget('editpost');
    $request->session()->forget('edituser');
    $posts = $this->postInterface->searchPostList($request);
    $import_message = NULL;
    $search = $request->input('postserach');
    return view('post.postlist', compact('posts','import_message'))
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
      'title'    => 'required|max:255|unique:posts,title',
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
      $post->status = $request->session()->get('editpost')['poststatus'];
      $request->session()->forget('editpost');
    }
    return view('post.editpost', compact('post'));
  }


  public function confirmeditpost(Request $request, Post $post)
  {
    $status = 1;
    $request->validate([
      'title'    => 'required|max:255|unique:posts,title',
      'description' => 'required',
    ]);
    if ($request->status == 'on') {
      $status = 1;
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
    $this->postInterface->updatePost($request,$id);
    return redirect()->intended('post/postlist');
  }


  public function deletepost(Post $post)
  {
    $id = Auth::user()->id;
    $this->postInterface->deletePost($post, $id);
    return redirect()->route('post.postlist')
      ->with('success', 'post deleted successfully');
  }

  public function importCSV()
  {
    return view('post.importCSV');
  }

  public function importfile(Request $request)
  {
      $request->validate([
        'file' => 'required|mimes:csv,txt|max:2048'
        ]);
      $id = Auth::user()->id;
      $import =$this->postInterface->importData($request,$id);
      $name = time().'_'.$request->file->getClientOriginalName();
      return redirect()->intended(route('post.postlist',['import'=>$import]));

  }

  public function export(Request $request)
  {
    $posts = $this->postInterface->exportPost($request);
    return Excel::download(new PostExport($posts), 'posts.xlsx');
    
  }
}
