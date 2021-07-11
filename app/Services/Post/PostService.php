<?php

namespace App\Services\Post;

use App\Contracts\Services\Post\PostServiceInterface;
use App\Contracts\Dao\Post\PostDaoInterface;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Exports\PostExport;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Http\Controllers\ExportController;

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
    public function getPostList(string $type,int $id)
    {
        return $this->postDao->getPostList($type,$id);
    }
    public function searchPostList(Request $request)
    {
        $search = $request->input('postserach');
        if ($search == NULL) {
        $posts = $this->postDao->getPostList(Auth::user()->type,Auth::user()->id);
        //return $posts;
        } else {
        $posts = $this->postDao->searchPostList($search);
        //return $posts;
        }
      return $posts;
    }
    public function createPost(Request $request, int $userId)
    {
        $this->postDao->createPost($request,$userId);
    }
    public function updatePost(Request $request,int $userId)
    {
        //$status = 1;
        if ($request->status == 'on') {
            $request->status = 1;
        } else {
            $request->status = 0;
        }
        $this->postDao->updatePost($request,$userId);
    }
    public function deletePost(Post $post,int $userId)
    {
        $this->postDao->deletePost($post,$userId);
    }
    public function exportPost(Request $request)
    {
      log::info("interface");
      log::info($request);
      log::info(gettype($request));
      $search = NULL;
      if(!empty($request)){
        $search = $request->search;
      }
       
        if($search == NULL){
          $posts = $this->postDao->exportPost(Auth::user()->type,Auth::user()->id);
          return $posts;
        }
        else{
          $posts = $this->postDao->searchPostList($search);
          return $posts;
        }
    }
    public function importData(Request $request, int $userId)
    {
        $file_name =  $request->file->getClientOriginalName();
        $path = 'uploads/' . $userId . '/csv';
        $name = time() . '_' . $request->file->getClientOriginalName();
        $request->file('file')->storeAs($path, $name, 'public');
        $file = $request->file('file');
        $filePath = $file->getRealPath();
        log::info("filePath");
        log::info($filePath);
        $file = fopen($filePath, 'r');
        while (($line = fgetcsv($file)) !== FALSE) {
          $rowData = implode(" ",$line);
          $row = explode(";",$rowData); 
          if($row[2] != NULL){           
            $row[2] = (int)$row[2];
          }
          log::info(gettype($row[2]));
          log::info(is_int(gettype($row[2])));
          $import_message = '';
          if($row[0]==NULL){
            $import_message = "Upload file failed because of empty data in first column";
            return $import_message;
          }
          else if($row[1]==NULL){
            $import_message = "Upload file failed because of empty data in second column";
            return $import_message;
          }
          else if($row[2] == NULL){
            $import_message = "Upload file failed because of empty data in third column";
            return $import_message;
          }
          else if(!(is_int($row[2]))){
            $import_message = $row[2] . "Upload file failed because of integer data must be in third column";
            return $import_message;
          }
          else if(!($row[2] == 1 || $row[2] == 0 )){
            $import_message = "Upload file failed because of integer value 0 and 1 value must be in third column";
            return $import_message;
          }

          else{
            $this->postDao->importData($row,$userId); 
            $import_message = $file_name . " file is uploaded successfully";
          }
       
        }
        fclose($file);
        return $import_message;
    }
}
