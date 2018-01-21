@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            @if(session()->has('update_msg'))
             <div class="alert alert-success " >
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Successfully !</strong> 
                         <span style="font-family: sans-serif;">
                             {{ session()->get('update_msg')}}
                         </span>
                </div>
                @endif
            <div class="panel panel-default">
                <div class="panel-heading">User Records</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(Auth::user()->role->role_name == 'Admin')

                     <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                           <thead>
                                <tr>
                                    <th> Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Created_at</th>
                                    <th>update</th>
                                    <th>remove  </th>
                                </tr>
                            </thead>
                                <tbody>
                                   @foreach($users as $user)
                                <tr>
                                    <td>
                                        <a href="{{url('user/profile')}}/{{$user->slug}}/{{$user->id}}">      {{$user->name}} <input type="hidden" name="user_id" value="{{$user->id}}"> 
                                         </a> 
                                    </td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->role->role_name}}</td>
                                    <td>
                                        @if($user->status == 1)
                                             <span class="active_div" style="cursor: pointer;    color: burlywood;">
                                                 <input type="hidden" class="active_id" value="{{$user->status}}">
                                                 <input type="hidden" class="token" value="{{csrf_token()}}">
                                                <input type="hidden" class="activeUrl" value="{{url('active')}}">
                                                <input type="hidden" class="user_id" value="{{$user->id}}">
                                                 <b  >Active</b>
                                             </span>
                                        @else
                                             <span class="inactive_div" style="cursor: pointer;    color: palevioletred;">
                                                 <input type="hidden" class="inactive_id" value="{{$user->status}}">
                                                  <input type="hidden" class="token" value="{{csrf_token()}}">
                                                 <input type="hidden" class="user_id" value="{{$user->id}}">
                                                  <input type="hidden" class="inactiveUrl" value="{{url('inactive')}}">
                                                    <b>Inactive</b>
                                             </span>
                                        @endif

                                     </td>
                                    <td>{{$user->created_at->diffForHumans()}}</td>
                                    <td>
                                        <form action="{{url('users')}}/{{$user->id}}/edit" method="get">
                                            {{csrf_field()}}
                                            {{method_field('PUT')}}
                                            <button class="btn btn-danger edit_btn" >Edit</button>
                                        </form>
                                        <!-- <a class="btn btn-danger edit_btn" >Edit
                                           <input type="hidden" name="edit_id" class="edit_id" value="{{$user->id}}">
                                        </a> -->
                                    </td>
                                    <td>
                                        <a class="btn btn-success delete_btn" >Delete
                                           <input type="hidden" name="delete_id" class="delete_id" value="{{$user->id}}">
                                           <input type="hidden"  class="deleteUrl" value="{{url('users')}}/{{$user->id}}">
                                        </a>
                                    </td>

                                      @endforeach 
                            </tbody>
                        </table>
                    @else
                         loginuser is user

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script type="text/javascript" src="{{asset('js/app.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();

    $('#remove_msg').hide();
    $('.delete_btn').on('click',function(){
        var delete_id = $(this).find('.delete_id').val();
        var url = $(this).find('.deleteUrl').val();
        
        $.ajax({
            type:'DELETE',
            url : url,
            headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data :{'delete_id' : delete_id},

            success:function(response){
            // console.log(response);
                    window.location.href = "{{url('users')}}"; 
                    $('#remove_msg').show('slow');
                    $('#remove_msg').html(response.msg);
                    $('#remove_msg').fadeOut(5000);
            }
        })
    });
    
//Inactive user which user is Active
    $('.active_div').on('click',function(){
            var active =  $('.active_id').val(); 
            var user_id =  $(this).find('.user_id').val(); 
            var token =  $(this).find('.token').val(); 
           var url =  $(this).find('.activeUrl').val();
            //alert(token);
           $.ajax({
                type:'GET',
                url : url,
                data : {'active_status':active , 'user_id':user_id,'token':token},

                success:function(response){
                    console.log(response);
                     /*$('#remove_msg').show('slow');
                     $('#remove_msg').html(response.msg);
                     $('#remove_msg').fadeOut(5000);*/
                        window.location.reload(); 
                      //$("#remove_msg").load($(this).attr(href));
                }
           })
    });



 // Active user which user is Inactive
    $('.inactive_div').on('click',function(){
            var inactive =  $('.inactive_id').val(); 
            var user_id =  $(this).find('.user_id').val(); 
            var token =  $(this).find('.token').val(); 
           var url =  $(this).find('.inactiveUrl').val();
            //alert(url);
            $.ajax({
                type:'GET',
                url : url,
                data : {'inactive_status':inactive , 'user_id':user_id,'token':token},

                success:function(response){
                    console.log(response);
                     /*$('#remove_msg').show('slow');
                     $('#remove_msg').html(response.msg);
                     $('#remove_msg').fadeOut(5000);*/
                        window.location.reload(); 
                      //$("#remove_msg").load($(this).attr(href));
                }
           })
           
    })
});
</script>