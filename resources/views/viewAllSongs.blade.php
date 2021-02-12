@extends('layouts.appmaster')

@section('title','HomePage')

@section('content')
<div class="container">
	<table id="UserTable" border="1">
	<tr>
		<th>Name</th>
		<th>Location</th>
		<th>Company</th>
		<th>Requirements</th>
		<th>Description</th>
		<th>View Job</th>
	</tr>
	@foreach ($job as $j)
	<tr>
		<td>{{ $j['Name']}}</td>
		<td>{{ $j['Location']}}</td>
		<td>{{ $j['Company']}}</td>
		<td>{{ $j['Requirements']}}</td>
		<td>{{ $j['Description']}}</td>


		<td><form action="viewOtherJob" method="post">
				<input type="hidden" name="_token" value="{{ csrf_token()}}" /> <input
					type="hidden" name="id" value="{{ $j['id'] }}" /> <input
					type="submit" class="btn btn-secondary btn-large" value="View Job" />
			</form></td>
	</tr>
	@endforeach
</table>
@endif
</div>
@endsection
