@extends('common.layout')
@section('content')
@if ($errors->any())
<HelpBlock>
    @foreach ($errors->all() as $error)
    <span>{{ $error }}</span>
    @endforeach
</HelpBlock>
@endif
<form action="{{route('post.importfile')}}" method="POST" enctype="multipart/form-data" >
    @csrf
    <div class="form-group row">
        <label for="title" class="col-sm-2 col-form-label">Choose File</label>
        <div class="col-sm-6">
            <input type="file" name="file" id="chooseFile">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-6">
            <button class="btn btn-primary" type="submit">Import</button>
        </div>
    </div>
</form>
@endsection