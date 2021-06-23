@extends('common.layout')
@section('content')
<div>
  <div class="row">
    <div class="col-md-8 col-sm-8">
      <form action="{{ route('post.searchPost') }}" method="GET" role="search">
        {{ csrf_field() }}
        <div class="input-group mb-3">
          <input type="search" class="form-control" name="postserach" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
          <div class="input-group-append">
            <span class="input-group-btn">
              <button type="submit" class="btn btn-primary">Search</button>
            </span>
          </div>
        </div>
      </form>
    </div>
    <div class="col-md-4 col-sm-4">
      <!-- <button type="button" class="btn btn-primary" href="window.location='{{ url('post/importCSV')}}'">Upload</button> -->
      <a class="btn btn-info btn-md" href="{{route('post.importCSV')}}">Upload</a>
      <a class="btn btn-info btn-md" href="{{route('post.export')}}">Download</a>
      <!-- <button type="button" class="btn btn-secondary">Download</button> -->
      <a class="btn btn-info btn-md" href="{{route('post.create')}}">Add</a>
    </div>
  </div>
  <table class="table table-striped">
    <thead class="thead-light">
      <tr>
        <th>id</th>
        <th>Post Title</th>
        <th>Post Description</th>
        <th>Posted User</th>
        <th>Posted Date</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    @if(count($posts) == 0)
      <td colspan="7">
            <HelpBlock>
                <span class="row justify-content-center">Search data is Empty</span>
            </HelpBlock>
        </td>
    @else
      @foreach($posts as $post)
      <tr>
        <td>{{ ++$i }}</td>
        <td>
          <a type="button" class="btn btn-primary-outline" data-toggle="modal" data-target="#postDetailModal_{{$post->id}}">{{$post->title}}</a>
            <div class="modal fade" id="postDetailModal_{{$post->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Post Detail Information</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <div class="form-group row">
                        <label for="title" class="col-sm-6 col-form-label">Post Title</label>
                        <div class="col-sm-6">
                            <input type="text" name="title" readonly class="form-control-plaintext" value="{{$post->title}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-6 col-form-label">Description</label>
                        <div class="col-sm-6">
                            <input type="text" name="description" readonly class="form-control-plaintext" value="{{$post->description}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="title" class="col-sm-6 col-form-label">status</label>
                        <div class="col-sm-6">
                            <input type="text" name="status" readonly class="form-control-plaintext" value="{{$post->status}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-6 col-form-label">Create_at</label>
                        <div class="col-sm-6">
                            <input type="text" name="created_at" readonly class="form-control-plaintext" value="{{$post->created_at}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="title" class="col-sm-6 col-form-label">Created User</label>
                        <div class="col-sm-6">
                            <input type="text" name="createusesr" readonly class="form-control-plaintext" value="{{$post->createuser}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-6 col-form-label">LastUpdated User</label>
                        <div class="col-sm-6">
                            <input type="text" name="updateuser" readonly class="form-control-plaintext" value="{{$post->updateuser}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-6 col-form-label">LastUpdated_at</label>
                        <div class="col-sm-6">
                            <input type="text" name="updated_at" readonly class="form-control-plaintext" value="{{$post->updated_at}}">
                        </div>
                    </div>                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
                  </div>
                </div>
              </div>
            </div>
        </td>
        <td>{{$post->description}}</td>
        <td>{{$post->createuser}}</td>
        <td>{{$post->created_at}}</td>
        <td><a class="btn btn-primary-outline" href="{{route('post.editpost',$post->id)}}">Edit</a></td>
        <td>
          <form action="{{route('post.deletepost',$post->id)}}" method="POST">
            <button type="button" class="btn btn-primary-outline" data-toggle="modal" data-target="#confirmModal_{{$post->id}}">Delete</button>
            <div class="modal fade" id="confirmModal_{{$post->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <p>Do you want to delete "{{$post->title}}" ?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    {{ csrf_field() }}
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </td>
      </tr>
      @endforeach    
    @endif     
    </tbody>
  </table>
</div>
<script>
  function myFunction() {
    $('#confirmModal').show();
  }
  function myFunction1() {
    $('#postDetailModal__').show();
  }
</script>
{!!$posts->links()!!}

@endsection