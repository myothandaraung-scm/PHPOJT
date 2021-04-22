@extends('common.layout')
@section('content')
<table class="table table-striped">
    <thead>
        <tr>
          <td>Post Title</td>
          <td>Post Description</td>
          <td>Posted User</td>
          <td>Posted Date</td>
          <td></td>
          <td></td>
        </tr>
    </thead>
    <tbody>
        @foreach($posts as $post)
        <tr>
            <td>{{$post->title}}</td>
            <td>{{$post->description}}</td>
            <td>{{$post->name}}</td>
            <td>{{$post->created_at}}</td>
            <td><a href="#" class="text-info">Edit</a></td>
            <td><a href="#" class="text-info">Delete</a></td>
        </tr>
        @endforeach
    </tbody>
  </table>
@endsection