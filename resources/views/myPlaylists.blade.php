@extends('layouts.appmaster')

@section('title','HomePage')

@section('content')
<div class="containerfull">
<form action="createplaylist" method="GET">
	<input type="hidden" name="_token" value=" <?php echo csrf_token()?>" />
	<h2>Create a Playlist</h2>
	<table>
		<tr>
			<td colspan="2" align="center"><input type="submit" class="btn btn-dark btn-lg" name="Create Playlist" /></td>
		</tr>
	</table>
</form>
@if(isset($playlists))
<table border="1">
        <tr>
            <th>NAME</th>
        </tr>
		
        @foreach ($playlists as $p) 
        <tr>
            <td>{{ $p['NAME']}}</td>
            
            <td><form action ="viewPlaylist" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token()}}" />
            <input type="hidden" name="id" value="{{ $p['ID'] }}"/>
            <input type="submit" class="btn btn-secondary btn-large" value="View Playlist"/>
            </form></td>
            </tr>
            </table>
         @endforeach
         @endif
         <?php
         if (isset($msg)) {
    echo $msg;
}
?></h5>
</div>
@endsection
