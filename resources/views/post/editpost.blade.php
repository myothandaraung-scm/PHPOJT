@extends('common.layout')
@section('content')

<div class="row">
    <div class="col-md-4 bg-text">Update User</div>
    <a class="btn btn-primary" href="{{ route('post.postlist') }}"> Back</a>

</div>
<br>
<form action="{{route('post.confirmeditpost')}}" method="POST">
    @csrf
    <input type="text" name="id" class="form-control" value="{{$post->id}}" hidden>
    <div class="form-group row">
        <label for="title" class="col-sm-2 col-form-label">Post Title</label>
        <div class="col-sm-6">
            <input type="text" name="title" id="title" class="form-control" placeholder="Enter title" value="{{$post->title}}">
        </div>
    </div>
    <div class="form-group row">
        <label for="description" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-6">
            <textarea type="text" class="form-control" id="description" style="height:100px" name="description" placeholder="Enter description">{{ $post->description }}</textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="status" class="col-sm-2 col-form-label">Status</label>
        <div class="col-sm-6">
            <input data-id="{{$post->status}}" class="toggle-class" type="checkbox" name="status" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $post->status ? 'checked' : '' }}>
        </div>
    </div>

    <div class="form-group row">
        <button class="btn btn-primary" type="button" onclick="clearEditValue()">Clear</button>
        <div class="col-sm-6">
            <button class="btn btn-primary" type="submit">Confirm</button>
        </div>
    </div>

</form>
<script>
function clearEditValue()
{
    document.getElementById("title").value="";
    document.getElementById("description").value="";
}
</script>


@endsection