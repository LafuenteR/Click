@extends("social/profile")

@section("profile_section")
	
	<table>
		<!-- <h1>Friends</h1> -->
		@foreach($friends as $friend)
		<tr>
			<td class="col-md-4">
				<img src='{{asset("$friend->avatar")}}' class="img-circle" width="100px" height="100px" style="margin-bottom: 20px;">
			</td>
			<td class="col-md-8">
				<a href='{{url("/profile/$friend->id")}}'>{{$friend->name}}</a>
			</td>
		</tr>
		@endforeach
	</table>




@endsection