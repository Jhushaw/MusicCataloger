@extends('layouts.appmaster') @section('title','HomePage')

@section('content')
<div class="containerfull">
	
	@if(isset($songs))
                <!-- Fixed header table-->
                <div class="table-responsive">
                    <table class="table table-fixed">
                        <thead>
                            <tr>
                                <th scope="col" class="col-3">Album Image</th>
                                <th scope="col" class="col-3">Name</th>
                                <th scope="col" class="col-3">Artist</th>
                                @if(isset($playlistid))
                                 <th scope="col" class="col-3">Add</th>
                                 @endif
                            </tr>
                        </thead>
                        <tbody>
						@foreach ($songs as $s)
                            <tr>
                                <th scope="row" class="col-3"><img
			src="{{ $s['IMAGE']}}"
			height="100" width="100"> </th>
                                <td class="col-3">{{ $s['NAME']}}</td>
                                <td class="col-3">{{ $s['ARTIST']}}</td>
                            @if(isset($playlistid))
                            	</form>		
                            				
							<td class="col-3"><form action="addSong" method="post">
							<input type="hidden" name="_token" value="{{ csrf_token()}}" /> <input
								type="hidden" name="songid" value="{{ $s['ID'] }}" /> <input
								type="hidden" name="playlistid" value="{{ $playlistid }}" /> <input
								type="submit" class="btn btn-secondary btn-large"
								value="+" />
						</form></td>
						@endif
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
