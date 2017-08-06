@extends("social/profile")



@section("profile_section")

<table class="col-md-12">
	<form method="POST" action='{{url("/editAbout")}}'>
	{{csrf_field()}}
	<tr>
		<th></th>
		<th></th>
	</tr>
	<tr>
		
		<td class="col-md-1">Birthday</td>
		<td class="col-md-11">
			<input type="date" name="birthday" class="form-control" value="{{Auth::user()->birthday}}">
		</td>
	</tr>
	<tr>
		<td class="col-md-1">Address</td>
		<td class="col-md-11"><input type="text" name="address" class="form-control" value="{{Auth::user()->address}}"></td>
	</tr>
	<tr>
		<td class="col-md-1">Contacts</td>
		<td class="col-md-11">
			<input type="text" name="contact" class="form-control" value="{{Auth::user()->contact}}">
		</td>
	</tr>
	<tr>
		<td class="col-md-1">Bio</td>
		<td class="col-md-11"><input type="text" name="bio" class="form-control" value="{{Auth::user()->bio}}"></td>
	</tr>
	<tr>
		<td class="col-md-1"></td>
		<td class="col-md-11">
			<input type="submit" name="save" value="Save" class="btn btn-info">

			<!-- <button class="btn btn-info">Cancel</button>
 -->		</td>

	</tr>
	</form>
</table>





@endsection

