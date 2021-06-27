@extends('common.layout')
@section('content')
<div class="createform">
    <div class="row">
        <h3 class="col-md-4 bg-text">Add New User</h3>
        <a class="btn btn-primary" href="{{ route('post.postlist') }}"> Back</a>
    </div>
    <br>
    <form action="{{route('post.confirmPost')}}" class="confirmForm" method="POST" id="myForm">
        @csrf
        <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label">Post Title</label>
            <div class="col-sm-6">
                <input type="text" name="title" id="title" placeholder="enter title" class="form-control" value="{{$posts->title}}">
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="description" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-6">
                <textarea type="text" class="form-control" id="description" style="height:100px" name="description" placeholder="enter description">{{ $posts->description }}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group mt-5 row">
            <button class="btn btn-primary" type="button" onclick="clearValue()">Clear</button>
            <div class="col-sm-6">
                <button class="btn btn-primary" type="submit">Confirm</button>
            </div>
        </div>
    </form>
</div>
<script>
function clearValue()
{
    $('#title').val("");
    $('#description').val("");
}
console.log("erors",$errors)
</script>

@endsection