@extends('layouts.logoutappmaster')

@section('title','Login')

@section('content')
<div class="container">
<form action="login" method="POST">
	<input type="hidden" name="_token" value=" <?php echo csrf_token()?>" />
	<h2>Login</h2>
	<table>
		<tr>
			<td>Username</td>
			<td><input type="text" name="username" maxlength="15"/></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type="text" name="password" maxlength="15"/></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="submit" class="btn btn-dark btn-lg" name="Login" /></td>
		</tr>
	</table>
</form>
<br>
	<a style="color: black;">Need a new account?</a>
	<input type="button" class="btn btn-dark btn-lg" value="Register" onclick=" registerlink()">
<script>
//used to hyperlink with bootstrap button
function registerlink()
{
     location.href = "register";
} 
</script>
@if($errors->count() != 0)
	<h5 align="center">List of Errors</h5>
	@foreach($errors->all() as $message)
		<p align="center">{{ $message }} </p><br>
	@endforeach
@endif

<h5 align="center"><?php if (isset($msg)){
    //checks if message is instantiated, if so echos message
        echo $msg;
}?></h5>
@endsection
</div>