@extends('layouts.logoutappmaster')

@section('title','Register')

@section('content')
<div class="container">
<form action="register" method="POST">
	<input type="hidden" name="_token" value=" <?php echo csrf_token()?>" />
	<h2>Register a New Account</h2>
	<table>
		<tr>
			<td>First Name</td>
			<td><input type="text" name="firstName" maxlength="15"/></td>
		</tr>
		<tr>
			<td>Last Name</td>
			<td><input type="text" name="lastName" maxlength="15"/></td>
		</tr>
		<tr>
			<td>Email</td>
			<td><input type="text" name="email" maxlength="50"/></td>
		</tr>
		<tr>
			<td>Username</td>
			<td><input type="text" name="username" maxlength="50"/></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type="text" name="password"/></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="submit" class="btn btn-dark btn-lg" value="Register" /></td>
		</tr>
	</table>
	<br>
	<a style="color: black;">Already a member?</a> <input type="button"
			class="btn btn-dark btn-lg" value="Login" onclick=" loginlink()">
</form>
@if($errors->count() != 0)
	<h5 align="center">List of Errors</h5>
	@foreach($errors->all() as $message)
		<p align="center">{{ $message }} </p><br>
	@endforeach
@endif
<h5 align="center"><?php
//checks if message is instantiated, if so echos message
if (isset($msg)) {
    echo $msg;
}
?></h5>

<script>
// used to hyperlink with a button
function loginlink()
{
     location.href = "login";
} 
</script>
@endsection
</div>