@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update User</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('users') }}/{{$user_edit->id}}">
                        {{ csrf_field() }}
                        {{method_field('PUT')}}
                        <input type="hidden" name="user_id" value="{{$user_edit->id}}">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{isset($user_edit) ? $user_edit->name : ''}}" required autofocus>


                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{isset($user_edit) ? $user_edit->email : ''}}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                   
                        <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                            <label for="gender" class="col-md-4 control-label">select gender</label>

                            <div class="col-md-6">
                               <select name="gender" class="form-control">
                                   <option value="">select gender</option>
                                   <option value="male" {{ $user_edit->gender == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ $user_edit->gender == 'female'? 'selected' : '' }}>Female</option>

                               </select>

                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                     <div class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }}">
                            <label for="role_id" class="col-md-4 control-label">select role</label>

                            <div class="col-md-6">
                               <select name="role_id" class="form-control">
                                   <option value="">select role</option>
                                   <option value="1" {{ $user_edit->role_id == 1 ? 'selected' : '' }}>Admin</option>
                                   <option value="2" {{ $user_edit->role_id == 2 ? 'selected' : '' }}> User</option>
                                   <option value="3" {{ $user_edit->role_id == 3 ? 'selected' : '' }}> Employee</option>
                                   <option value="4" {{ $user_edit->role_id == 4 ? 'selected' : '' }}> Client</option>
                               </select>

                                @if ($errors->has('role_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('role_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
