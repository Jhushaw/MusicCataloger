@extends('layouts.appmaster') @section('title','HomePage')

@section('content')
<div class="containerfull">
	
	@if(isset($songs))
                <!-- Fixed header table-->
                <div class="table-responsive">
                    <table class="table table-fixed">
                        <thead>
                            <tr>
                                <th scope="col" class="col-3">Image</th>
                                <th scope="col" class="col-3">Name</th>
                                <th scope="col" class="col-3">Artist</th>
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
