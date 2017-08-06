@extends("../layout/master")


@section("main_content")
	@if(Auth::check())
	<div class="col-md-12">

		<div class="panel-group" style="margin-bottom: 10%;">
			<div class="panel panel-default">
				<div class="panel-heading" style="height: 200px; position: relative;background: url('{{asset($accounts->cover)}}');background-size: auto 200px;		background-repeat: no-repeat;background-position: center;">

					<img src='{{asset("$accounts->avatar")}}' class="img-circle" style="margin-bottom: -50%;width: 200px; height: 200px;">
								</div>
				<div class="panel-body" style="padding-bottom: 0;border: 1px solid #ddd;">
					<div class="col-md-4">
					 </div>
					<ul class="profile_ul col-md-8">
						<li>
							<a href='{{url("/profile/$accounts->id")}}'>Post</a>
						</li>
						@if(Auth::user()->id == $accounts->id)
						<li>
							<a href='{{url("about/$accounts->id")}}'>About</a>
						</li>
						@endif
						<li>
							<a href='{{url("friends/$accounts->id")}}'>Friends</a>
						</li>
						<li>
							<a href="#">Likes</a>
						</li>
						@if (Auth::user()->id == $accounts->id)
						<li style="margin-left: 30%;">
							<button type="button" data-toggle='modal' data-target="#myModal" class="btn btn-default" style="margin-bottom: 10px;">Edit Profile</button>
						</li>
						@else
						
						@if (Auth::user()->id != $accounts->id && !$connections->contains($accounts->id) )
						<li>
						<form method="POST" action='{{"/addFriend/$accounts->id"}}'>
						{{csrf_field() }}
						<button class="btn btn-default" style="position: absolute;bottom: 10px;right: 10px;">Add As Friend</button>
						</form>
						</li>
						@elseif(Auth::user()->id != $accounts->id && $connections->contains($accounts->id) && $friends->contains($accounts->id))
						<li>
						<form method="POST" action='{{"/unfriend/$accounts->id"}}'>
						{{csrf_field() }}
						<button id="friend" class="btn btn-info" style="position: absolute;bottom: 10px;right: 10px;">Friends <span class="fa fa-check"></span><span class="fa fa-check"></span></button>
						</form>
						</li>
						@elseif(Auth::user()->id != $accounts->id && $pending_requests->contains($accounts->id))
						<li>
						<form method="POST" action='{{"/acceptFriend/$accounts->id"}}'>
						{{csrf_field() }}
						<button class="btn btn-default" style="position: absolute;bottom: 10px;right: 10px;">Accept Request</button>
						</form>
						</li>
						@else
						<li>
						<form method="POST" action='{{"/cancelFriend/$accounts->id"}}'>
						{{csrf_field() }}
						<button class="btn btn-info" style="position: absolute;bottom: 10px;right: 10px;">Friend Request Sent</button>
						</form>
						</li>
					@endif
						
					@endif	
					</ul>
				</div>
			</div>
			<div id="myModal" class="modal fade" role="dialog">
				<div class="modal-dialog modal-md">
					
					<div class="modal-content">
						<div class="modal-body">
							<form method="post" enctype="multipart/form-data" action='{{url("/profile")}}'>
								<table>
									<tr>
										<th class="col-md-4"></th>
										<th class="col-md-8"></th>
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
											Cover Photo
										</td>
										<td>
											<input class="form-control" type="file" name="cover" value="{{Auth::user()->cover}}">
										</td>
									</tr>
									<tr>
										<td>Profile Photo</td>
										<td>
											<input class="form-control" type="file" name="avatar">
										</td>
									</tr>
									<tr>
										<td>
											<!-- <button class="btn btn-success" type="submit">Save</button>
											<button class="btn btn-info" type="submit">cancel</button> -->
										</td>
										<td>
											<button class="btn btn-success" type="submit">Save</button>
											<button class="btn btn-info">cancel</button>
										</td>
									</tr>
								</table>
								
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-8 col-md-offset-2">
			@yield("profile_section")
		</div>


	</div>

@endif

@endsection

@section("right_sidebar")
<!-- 	<div class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading">
				<span class="col-md-9" style="font-size: 12px;padding: 0;">
					Friend Request
				</span>
				<span class="col-md-3
				" style="font-size: 12px;padding: 0;">
					<a href="#">See All </a>
				</span>
			</div>
			<div class="panel-body">
				
			</div>
		</div>
	</div> -->

@endsection

@section("left_sidebar")
@if(Auth::check())
	<h4>{{$accounts->name}}</h4>
	@if(!empty($accounts->birthday))
	<span>Born on <strong>{{$accounts->birthday}}</strong></span><br>
	@endif
	@if(!empty($accounts->address))
	<span>Lives in <strong>{{$accounts->address}}</strong></span><br>
	@endif
	@if(!empty($accounts->contact))
	<span>Mobile <strong>{{$accounts->contact}}</strong></span><br>
	@endif
	@if(!empty($accounts->bio))
	<p>{{$accounts->bio}}</p>
	@endif
@endif

@endsection

@extends("layouts/app")