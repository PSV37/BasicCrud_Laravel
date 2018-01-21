<!DOCTYPE html>
<html>
<head>
	<title>Verify Account</title>

     <link rel="stylesheet" href="{{asset('css/app.css')}}">
	 
</head>
<body>

	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2>Hello , {{$user->name}}</h2>
				<h4>Verify Your Account...</h4>
			</div>
			<div class="panel-body">
				  <p>Hi, {{$user->name}} You need to verify your account,click on below button </p>
				  <div class="container">
				  	 <a href="{{url('verify',['email'=>$user->email , 'verifyToken'=>$user->verifyToken])}}" class="btn btn-primary">Verify Account</a>
				  </div>
			</div>
			<div class="panel-footer">Panel Footer</div>
			
		</div>

		
	</div>

</body>
</html>