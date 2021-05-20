@extends('common.layout')
@section('content')
<div class="createform">
    <div class="row">
        <div class="col-md-4 bg-text">Add New User</div>
        <a class="btn btn-primary" href="{{ route('post.postlist') }}"> Back</a>

    </div>
    <br>
    <script>console.log("erors",$errors)</script>
    @if ($errors->any())
    <HelpBlock>
        @foreach ($errors->all() as $error)
        <span>{{ $error }}</span>
        @endforeach
    </HelpBlock>
    @endif
    <form action="{{route('post.confirmPost')}}" method="POST" id="myForm">
        @csrf
        <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label">Post Title</label>
            <div class="col-sm-6">
                <input type="text" name="title" id="title" placeholder="enter title" class="form-control" value="{{$posts->title}}">
            </div>
        </div>
        <div class="form-group row">
            <label for="description" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-6">
                <textarea type="text" class="form-control" id="description" style="height:100px" name="description" placeholder="description">{{ $posts->description }}</textarea>
            </div>
        </div>
        <div class="form-group row">
            <button class="btn btn-primary" type="button" onclick="clearValue()">Cancel</button>
            <div class="col-sm-6">
                <button class="btn btn-primary" type="submit">Create</button>
            </div>
        </div>
    </form>
</div>
<script>
function clearValue()
{
    //$("#myForm").trigger("reset");
    // alert("eee");
    // document.getElementsByName("title").value = "";
    // document.getElementsByName("description").value = "";
    document.getElementById("title").value="";
    document.getElementById("description").value="";
}
console.log("erors",$errors)
</script>

@endsection