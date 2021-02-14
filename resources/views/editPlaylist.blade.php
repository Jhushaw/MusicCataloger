@extends('layouts.appmaster')

@section('title','Login')

@section('content')
<div class="container">
<form action="editplaylist" method="POST">
	<input type="hidden" name="_token" value=" <?php echo csrf_token()?>" />
	<h2>Edit Playlist Name</h2>
	<table>
		<tr>
			<td>Name</td>
			<td><input type="text" name="name" maxlength="45" value="{{ $playlist->getName()}}"/></td>
			<td><input type="hidden" name="id" value="{{ $playlist->getId()}}" /></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="submit" class="btn btn-dark btn-lg" value="Edit Playlist" /></td>
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