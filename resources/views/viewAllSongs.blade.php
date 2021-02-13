@extends('layouts.appmaster') @section('title','HomePage')

@section('content')
<div class="containerfull">
	
	@if(isset($songs))
	<table border="1">
			<th>Image</th>
			<th>Name</th>
			<th>Artist</th>

		@foreach ($songs as $s)
		<tr>
			<td><img
			src="{{ $s['IMAGE']}}"
			height="100" width="100"> </td>
			<td>{{ $s['NAME']}}</td>
			<td>{{ $s['ARTIST']}}</td>
			

<!-- 			<td><form action="viewPlaylist" method="post"> -->
<!-- 					<input type="hidden" name="_token" value="{{ csrf_token()}}" /> <input -->
<!-- 						type="hidden" name="id" value="{{ $s['ID'] }}" /> <input -->
<!-- 						type="submit" class="btn btn-secondary btn-large" -->
<!-- 						value="View Playlist" /> -->
<!-- 				</form></td> -->
		</tr>
		@endforeach
	</table>

         @endif
         <?php
        if (isset($msg)) {
            echo $msg;
        }
        ?>
</div>
@endsection
