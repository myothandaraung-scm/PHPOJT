@extends('common.layout')
@section('content')

<form action="{{route('post.createpost')}}" method="POST">
    @csrf
    <div class="form-group row">
        <label for="title" class="col-sm-2 col-form-label">Post Title</label>
        <div class="col-sm-6">
            <input type="text" name="title" readonly class="form-control-plaintext" value="{{$posts->title}}">
        </div>
    </div>
    <div class="form-group row">
        <label for="description" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-6">
            <input type="text" name="description" readonly class="form-control-plaintext" value="{{$posts->description}}">
        </div>
    </div>
    <div class="form-group row">
    <!-- {{ url()->previous() }} -->
        <button class="btn btn-primary" type="button" onclick="window.location='{{ url()->previous() }}/{{$posts->id}}'">Cancel</button>
        <!-- <button class="btn btn-primary" type="button" onclick="window.location='{{ url('post/create')}}/{{$posts->id}}'">Cancel</button> -->
        <div class="col-sm-6">
            <button class="btn btn-primary" type="submit">Create</button>
        </div>
    </div>

</form>

@endsection