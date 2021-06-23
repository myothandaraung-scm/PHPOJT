@extends('common.layout')
@section('content')
<div>
    <div class="row">
        <div class="col-md-10 col-sm-10 form-horizontal">
            <form action="{{ route('user.searchUser') }}" method="GET" role="search">
                {{ csrf_field() }}
                <div class="input-group mb-3">
                    <div class="col-md-2 col-sm-2">
                        <input type="search" class="form-control" name="namesearch" placeholder="Enter Name" aria-label="Search" aria-describedby="search-addon" />
                    </div>
                    <div class="col-md-2 col-sm-2">
                        <input type="search" class="form-control" name="emailsearch" placeholder=" Enter Email" />

                    </div>
                    <div class="col-md-3 col-sm-3">
                        <input type="date" class="form-control" name="createdfromsearch" placeholder="Enter Created From" />

                    </div>
                    <div class="col-md-3 col-sm-3">
                        <input type="date" class="form-control" name="createdtosearch" placeholder="Enter Created To" />
                    </div>
                    <div class="col-md-2 col-sm-2">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>

                </div>
            </form>
        </div>
        <div class="col-md-2 col-sm-2">
            <!-- <button type="button" class="btn btn-secondary">Download</button> -->
            <a class="btn btn-info btn-md" href="{{route('user.register')}}">Add</a>
            
        </div>
    </div>
    <table class="table table-striped">
        <thead class="thead-light">
            <thead>
                <tr>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Created User</td>
                    <td>Phone</td>
                    <td>Date of birth</td>
                    <td>Created At</td>
                    <td colspan=2>Actions</td>
                </tr>
            </thead>
        <tbody>
        @if(count($users) == 0)
        <td colspan="7">
            <HelpBlock>
                <span class="row justify-content-center">Search data is Empty</span>
            </HelpBlock>
        </td>                
        @else
            @foreach($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->createduserName}}</td>
                <td>{{$user->phone}}</td>
                <td>{{$user->dob}}</td>
                <td>{{$user->created_at}}</td>
                <td>
                    <!-- <a class="btn btn-primary-outline" href="{{route('user.edituser',$user->id)}}">Edit</a> -->
                    <form action="{{route('user.deleteuser',$user->id)}}" method="POST">
                        <button type="button" class="btn btn-primary-outline" data-toggle="modal" data-target="#userDeleteModal_{{$user->id}}">Delete</button>
                        <div class="modal fade" id="userDeleteModal_{{$user->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Confirmation</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <p>Do you want to delete "{{$user->name}}" ?</p>
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
{!!$users->links()!!}
@endsection
