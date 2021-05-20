@extends('common.layout')
@section('content')

<form action="{{route('post.updatepost')}}" method="POST">
    @method('PUT')
    @csrf
    <input type="text" name="id" class="form-control" value="{{$post->id}}" hidden>
    <div class="form-group row">
        <label for="title" class="col-sm-2 col-form-label">Post Title</label>
        <div class="col-sm-6">
            <input type="text" name="title" readonly class="form-control-plaintext" value="{{$post->title}}">
        </div>
    </div>
    <div class="form-group row">
        <label for="description" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-6">
            <input type="text" name="description" readonly class="form-control-plaintext" value="{{$post->description}}">
        </div>
    </div>
    <div class="form-group row">
        <label for="status" class="col-sm-2 col-form-label">Status</label>
        <div class="col-sm-6">
        <input data-id="{{$post->status}}" class="toggle-class" type="checkbox" name="status" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $post->status ? 'checked' : '' }}>        </div>
    </div>
    <div class="form-group row">
        <button class="btn btn-primary" type="button" onclick="window.location='{{ url()->previous() }}'">Cancel</button>
        <div class="col-sm-6">
            <button class="btn btn-primary" type="submit">Update</button>
        </div>
    </div>

</form>

@endsection