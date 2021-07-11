@extends('common.layout')
@section('content')
<div>
    @if ($message = Session::get('roleError'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="row">
        <div class="col-md-10 col-sm-10 form-horizontal">
            <form action="{{ route('user.searchUser') }}" method="GET" role="search">
                {{ csrf_field() }}
                <div class="input-group mb-3">
                    <div class="col-md-2 col-sm-2">
                        <input type="search" class="form-control" name="namesearch" placeholder="Enter Name" aria-label="Search" aria-describedby="search-addon" value="{{ app('request')->input('namesearch') }}" />
                    </div>
                    <div class="col-md-2 col-sm-2">
                        <input type="search" class="form-control" name="emailsearch" placeholder=" Enter Email" value="{{ app('request')->input('emailsearch') }}"/>

                    </div>
                    <div class="col-md-3 col-sm-3">
                        <input type="date" class="form-control" name="createdfromsearch" placeholder="Enter Created From" value="{{ app('request')->input('createdfromsearch') }}"/>

                    </div>
                    <div class="col-md-3 col-sm-3">
                        <input type="date" class="form-control" name="createdtosearch" placeholder="Enter Created To" value="{{ app('request')->input('createdtosearch') }}"/>
                    </div>
                    <div class="col-md-2 col-sm-2">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>

                </div>
            </form>
        </div>
        @if(Auth::user()->type == 0)
            <div class="col-md-2 col-sm-2">
                <a class="btn btn-info btn-md" href="{{route('user.register')}}">Add</a>           
            </div>
        @endif
        
    </div>
    <table class="table table-striped">
        <thead class="thead-light">
            <thead>
                <tr>
                    <td>No.</td>
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
                <td>{{ ++$i }}</td>
                <td>
                    <a type="button" data-toggle="modal" data-target="#userDetailModal_{{$user->id}}">{{$user->name}}</a>
                    <div class="modal fade" id="userDetailModal_{{$user->id}}" tabindex="-1" role="dialog" >
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">User Detail Information</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <label for="title" class="col-sm-6 col-form-label">User Name</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="name" readonly class="form-control-plaintext" value="{{$user->name}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="description" class="col-sm-6 col-form-label">Email</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="email" readonly class="form-control-plaintext" value="{{$user->email}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="title" class="col-sm-6 col-form-label">phone</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="phone" readonly class="form-control-plaintext" value="{{$user->phone}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="description" class="col-sm-6 col-form-label">Birth Of Birth</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="dob" readonly class="form-control-plaintext" value="{{ \Carbon\Carbon::parse($user->dob)->format('Y/m/d') }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="title" class="col-sm-6 col-form-label">Address</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="address" readonly class="form-control-plaintext" value="{{$user->address}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="description" class="col-sm-6 col-form-label">Created_at</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="created_at" readonly class="form-control-plaintext" value="{{ \Carbon\Carbon::parse($user->created_at)->format('Y/m/d') }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="description" class="col-sm-6 col-form-label">Created_User</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="created_user" readonly class="form-control-plaintext" value="{{$user->createduserName}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="description" class="col-sm-6 col-form-label">LastUpdated_at</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="updated_at" readonly class="form-control-plaintext" value="{{ \Carbon\Carbon::parse($user->updated_at)->format('Y/m/d') }}">
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label for="description" class="col-sm-6 col-form-label">Updated_user</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="created_user" readonly class="form-control-plaintext" value="{{$user->updateduserName}}">
                                        </div>
                                    </div>                   
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    </div>
                </td>
                <td>{{$user->email}}</td>
                <td>{{$user->createduserName}}</td>
                <td>{{$user->phone}}</td>
                <td>{{$user->dob}}</td>
                <td>{{$user->created_at}}</td>
                <td>
                @if(Auth::user()->type == 0)
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

                @endif
                    
                </td>

            </tr>
            @endforeach
        
        @endif
           
        </tbody>
    </table>
</div>
{!!$users->links()!!}
@endsection
