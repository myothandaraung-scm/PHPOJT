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
      @foreach($posts as $post)
      <tr>
        <td>{{ ++$i }}</td>
        <td>{{$post->title}}</td>
        <td>{{$post->description}}</td>
        <td>{{$post->name}}</td>
        <td>{{$post->created_at}}</td>
        <td><a class="btn btn-primary-outline" href="{{route('post.editpost',$post->id)}}">Edit</a></td>
        <td>
          <!-- <button type="submit" class="btn btn-danger">Delete</button> -->
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
    </tbody>
  </table>
  @if(count($posts) == 0)
  <HelpBlock>
    <span class="row justify-content-center">Search data is Empty</span>
  </HelpBlock>
  @endif
</div>
<script>
  function myFunction() {
    $('#confirmModal').show();
  }
</script>
{!!$posts->links()!!}

@endsection