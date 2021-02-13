@extends('layouts.appmaster')

@section('title','Login')

@section('content')
<div class="container">
<form action="addplaylist" method="POST">
	<input type="hidden" name="_token" value=" <?php echo csrf_token()?>" />
	<h2>Create a new Playlist</h2>
	<table>
		<tr>
			<td>Name</td>
			<td><input type="text" name="name" maxlength="45"/></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="submit" class="btn btn-dark btn-lg" name="Create" /></td>
		</tr>
	</table>
</form>
<h5 align="center"><?php
//checks if message is instantiated, if so echos message
if (isset($msg)) {
    echo $msg;
}
?></h5>
@endsection
</div>