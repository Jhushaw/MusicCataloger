@extends('layouts.appmaster') @section('title','HomePage')

@section('content')
<div class="containerfull">
	<form action="createplaylist" method="GET">
		<input type="hidden" name="_token" value=" <?php echo csrf_token()?>" />
		<h2>Create a Playlist</h2>
		<table>
			<tr>
				<td colspan="2" align="center"><input type="submit"
					class="btn btn-dark btn-lg" value="Create Playlist" /></td>
			</tr>
		</table>
	</form>
	@if(isset($playlists))
	<!-- Fixed header table-->
	<div class="table-responsive">
		<table class="table table-fixed">
			<thead>
				<tr>
					<th scope="col" class="col-3">Name</th>
					<th scope="col" class="col-3">View Playlist</th>
					<th scope="col" class="col-3">Edit Playlist</th>
					<th scope="col" class="col-3">Delete Playlist</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($playlists as $p)
				<tr>
					<td scope="row" class="col-3">{{ $p['NAME']}}</td>
					<td class="col-3"><form action="viewPlaylist" method="post">
							<input type="hidden" name="_token" value="{{ csrf_token()}}" /> <input
								type="hidden" name="id" value="{{ $p['ID'] }}" /> <input
								type="submit" class="btn btn-secondary btn-large"
								value="View Playlist" />
						</form></td>
					<td class="col-3"><form action="editPlaylistView" method="post">
							<input type="hidden" name="_token" value="{{ csrf_token()}}" /> <input
								type="hidden" name="id" value="{{ $p['ID'] }}" /> 
								<input type="hidden" name="name" value="{{ $p['NAME'] }}" /><input
								type="submit" class="btn btn-secondary btn-large"
								value="Edit Name" />
						</form></td>					
					<td class="col-3"><form action="deletePlaylist" method="post">
							<input type="hidden" name="_token" value="{{ csrf_token()}}" /> <input
								type="hidden" name="id" value="{{ $p['ID'] }}" /> <input
								type="submit" class="btn btn-secondary btn-large"
								value="Delete Playlist" />
						</form></td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<!-- End -->

         @endif
         
         
         
         <?php
        if (isset($msg)) {
            echo $msg;
        }
        ?>
</div>
@endsection
