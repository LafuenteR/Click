@extends("social/profile")

@section("editprofile")
	<form method="post" enctype="multipart/form-data" action='{{url("/profile")}}'>
		<table>
			<tr>
				<th></th>
				<th></th>
			</tr>
			<tr>
				<td>
					Name
				</td>
				<td>
					<input class="form-control" type="text" name="name" value="{{Auth::user()->name}}">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
				</td>
			</tr>
			<tr>
				<td>
					Email
				</td>
				<td>
					<input class="form-control" type="email" name="email" value="{{Auth::user()->email}}">
				</td>
			</tr>
			<tr>
				<td>Hi</td>
				<td>Hello</td>
			</tr>
			<tr>
				<td>Profile Photo</td>
				<td>
					<input class="form-control" type="file" name="avatar" value="{{Auth::user()->avatar}}">
				</td>
			</tr>
			<tr>
				<td>
					<button class="btn btn-success" type="submit">Save</button>
					<!-- <button class="btn btn-info" type="submit">cancel</button> -->
				</td>
			</tr>
		</table>
		
	</form>

@endsection

<!-- @extends("layouts.app") -->



