@extends('layouts.appmaster') @section('title','HomePage')

@section('content')
<div class="containerfull">
	<form action="addToPlaylist" method="post">
		<input type="hidden" name="_token" value="{{ csrf_token()}}" /> <input
			type="hidden" name="id" value="{{ $playlistid }}" /> <input
			type="submit" class="btn btn-secondary btn-large w-50"
			value="ADD SONGS" />
	</form>


	@if(isset($songs))

	<!-- Fixed header table-->
	<div class="table-responsive">
		<table class="table table-fixed">
			<thead>

				<tr>
					<th scope="col" class="col-3">Album Image</th>
					<th scope="col" class="col-3">Name</th>
					<th scope="col" class="col-3">Artist</th>
					<th scope="col" class="col-3">Delete Song</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($songs as $s)
				<tr>
					<th scope="row" class="col-3"><img src="{{ $s['IMAGE']}}"
						height="100" width="100"></th>
					<th scope="row" class="col-3">{{ $s['NAME']}}</th>
					<th scope="row" class="col-3">{{ $s['ARTIST']}}</th>

					<td class="col-3"><form action="deleteSong" method="post">
							<input type="hidden" name="_token" value="{{ csrf_token()}}" /> <input
								type="hidden" name="playlistid" value="{{ $playlistid }}" /><input
								type="hidden" name="songid" value="{{ $s['ID'] }}" /> <input
								type="submit" class="btn btn-secondary btn-large" value="-" />
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
