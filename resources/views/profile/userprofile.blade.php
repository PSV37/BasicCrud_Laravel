@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <!-- Display User Must login -->
            @if(session()->has('update_profile'))
                <div class="alert alert-success fade in">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Suucessfully !</strong> 
                         <span style="font-family: sans-serif;">
                             {{ session()->get('update_profile')}}
                         </span>
                </div>
            @endif

            <div class="col-md-12 " style="margin-top: 5%">
                <div class="col-md-4">
                    <form action="{{url('user/profile')}}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="{{$user_profile[0]->id}}">
                        {{csrf_field()}}
                        <img src="{{url('images')}}/{{$user_profile[0]->image}}" height="300px" class="img-thumbnail" style="height: 341px;width: 75%;">
                       <br>
                        <input type="file" name="image" class="upload_profile" style="display:none;width: 64%;margin-top: 12px;">
                        <button class="btn btn-primary btn-sm upload_profile" style="display: none;width: 74%;margin-top: 12px;">Upload Profile</button>
                    </form>
                     <button class="btn btn-primary btn-sm" id="change_profile" style="width: 74%;">Change user_profile</button>
                </div>
                <div class="col-md-8">
                   <div class="panel panel-primary">
                       <div class="panel-heading">
                          <h3><b> User Profile</b></h3>
                       </div>
                       <div class="panel-body">
                             <form action="{{url('update/profile')}}" method="post" data-parsley-validate>
                                {{csrf_field()}}
                                  <input type="hidden" name="id" value="{{$user_profile[0]->id}}">
                               <div class="form-group">
                                   <label>Name</label>
                                   <input type="text" name="name" class="form-control" value="{{$user_profile[0]->name}}">
                               </div>
                               <div class="form-group">
                                   <label>Email</label>
                                   <input type="email" name="email" class="form-control" value="{{$user_profile[0]->email}}">
                               </div>
                               <div class="form-group">
                                   <label>Password</label>
                                   <input type="password" name="password" id="password" class="form-control" placeholder="Password" >
                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                               </div>
                                  
                               <div class="form-group">
                                   <label>Re-Type Password</label>
                                   <input type="password" name="password_confirmation" class="form-control" placeholder="Re-Type Password" data-parsley-equalto="#password">
                               </div>
                               <div class="form-group">
                                   <input type="submit"  class="btn btn-primary" value="Update">
                               </div>
                             </form> 
                       </div>
                   </div>
                </div>   
            </div>
            <div class="text-center">
                <p><b><a href="{{url('users')}}" style="color:black ">GoBack...</a></b></p>
            </div>
        </div>
    </div>
</div>
@endsection

<script type="text/javascript" src="{{asset('js/app.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#change_profile').on('click',function(e){
            e.preventDefault();
             $('.upload_profile').show('slow');
             $('#change_profile').hide('slow');
        })
    })
</script>