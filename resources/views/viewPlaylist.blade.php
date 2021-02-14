@extends('layouts.appmaster') @section('title','HomePage')

@section('content')
<div class="containerfull">
	<form action="viewPlaylist" method="GET">
		<input type="hidden" name="_token" value=" <?php echo csrf_token()?>" />
		
		 <td class="col-3"><form action="addToPlaylist" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token()}}" /> <input
						type="hidden" name="id" value="" /> <input
						type="submit" class="btn btn-secondary btn-large w-50"
						value="ADD SONGS" />
						
	
	@if(isset($playlists))
	
	                <!-- Fixed header table-->
                <div class="table-responsive">
                    <table class="table table-fixed">
                        <thead>
                       
                            <tr>
                                <th scope="col" class="col-3">Name</th>
                                <th scope="col" class="col-3">Artist</th>
                                <th scope="col" class="col-3">Delete Song</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($playlists as $p)
                            <tr>
                                <th scope="row" class="col-3">{{ $p['NAME']}} </th>
                                <th scope="row" class="col-3">{{ $p['ARTIST']}} </th>
                   
                                <td class="col-3"><form action="deleteSong" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token()}}" /> <input
						type="hidden" name="id" value="{{ $p['ID'] }}" /> <input
						type="submit" class="btn btn-secondary btn-large"
						value="-" />
				</form></td>
                            </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div><!-- End -->

         @endif
         
         
         
         <?php
        if (isset($msg)) {
            echo $msg;
        }
        ?>
</div>
@endsection
