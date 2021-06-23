@extends('common.layout')
@section('content')
<div class="row">
        <h3 class="col-md-4 bg-text">Confirmation Create Post</h3>
</div>
<br>
<form action="{{route('post.createpost')}}" class="confirmForm" method="POST">
    @csrf
    <div class="form-group row">
        <label for="title" class="col-sm-2 col-form-label">Post Title</label>
        <div class="col-sm-6">
            <input type="text" name="title" readonly class="form-control-plaintext" value="{{$posts->title}}">
        </div>
    </div>
    <div class="form-group row">
        <label for="description" class="col-sm-2 col-form-label">Description</label>
        <div class="col-sm-6">
            <input type="text" name="description" readonly class="form-control-plaintext" value="{{$posts->description}}">
        </div>
    </div>
    <div class="form-group mt-5 row">
        <button class="btn btn-primary" type="button" onclick="window.location='{{ url()->previous() }}/{{$posts->id}}'">Cancel</button>
        <div class="col-sm-6">
            <button class="btn btn-primary" type="submit">Create</button>
        </div>
    </div>

</form>

@endsection