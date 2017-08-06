@extends("social.profile")

@section("profile_section")
	@if(Auth::check())
	@if($accounts->id == Auth::user()->id)
	<div class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading">
				<form class="form-inline" method="POST" action='{{url("/home")}}' enctype="multipart/form-data">
					{{csrf_field()}}
					<div class="form-group" style="background-color: white; width: 100%;">
					<div class="col-md-12" style="padding: 0;">
						<input type="text" name="description" placeholder="Say something..." class="form-control" style="width: 100%;padding-right: 0;">
					</div>
					<div class="col-md-12" style="padding-left: 0;">
					<input type="file" name="img" style="width: 100%;">
					</div>
					</div>
					<div class="col-md-offset-10">
						<input type="submit" name="post" value="Post" class="btn btn-primary" style="width: 100%;">	
					</div>			
				</form>
			</div>
		</div>
	</div>
	@endif
		@if(Auth::user()->id != $accounts->id && $connections->contains($accounts->id) && $friends->contains($accounts->id) || Auth::user()->id == $accounts->id)
		@if(!empty($accounts->id))
		
		@foreach($posts as $post)
		@if($accounts->id == $post->user_id)
		
		<div class="panel-group">
			<div class="panel panel-default">
				<div class="panel-body" style="position: relative;">
					<div class="col-md-1" style="padding-left: 0;">
						<img src="/{{$accounts->avatar}}"" style="width: 40px;height: 40px;"
						 class="img-circle">
					</div>
					<div class="col-md-11 dropdown">

						<a href='{{"/profile/$post->user_id"}}' style="margin-bottom: 0;">{{$accounts->name}}</a>
						@if($post->user_id == Auth::user()->id)
						<a  class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" style="position: absolute; right: 0;border-color:transparent; color: #3097d1;">
   						<span class="caret"></span></a>
   						@endif
   						<ul class="dropdown-menu" style="position: absolute;left: 65%; width: 50px;">
					      <li><a href="#">Delete</a></li>
					    </ul>
					    <p style="font-size: 10px;">{{$post->created_at->diffForHumans()}}</p>
					</div>
					<div class="col-md-12">
						<p>{{$post->description}}</p>
						@if (!empty($post->img))
						<div style="text-align: center">
						<img src='{{asset("$post->img")}}' style="width: 100%;">
						</div>
						@endif
						@if(count($post->likes) != 0)
						<div class="col-md-6" style="padding-left: 0;font-size: 10px;">
							{{count($post->likes)}} Like
						</div>	
						@endif
						@if(count($post->comments) != 0)
						<div class="col-md-6" style="padding-left: 0;font-size: 10px;">
							{{count($post->comments)}} Comments
						</div>
						@endif
						@if((count($post->comments) > 0) || (count($post->likes) > 0)) 
						<br>
						@endif		
						<hr style="margin: 10px 0px ;">
						@if(!Auth::user()->likes()->where('post_id',$post->id)->first())		 				
						<a role="button" name="like" onclick="like({{$post->id}});" id="like{{$post->id}}" class="col-md-6" style="padding-left: 0;">Like</a>
						@else
		 					<a role="button" name="unlike" onclick="like({{$post->id}});" id="like{{$post->id}}" class="col-md-6" style="padding-left: 0;">Unlike</a>
		 				@endif
		 					<a role="button" name="comment" id="comment{{$post->id}}" onclick="comment({{$post->id}})" class="col-md-6" style="padding-left: 0;">Comment</a>		
	 				</div>
				</div>
			</div>
		</div>
		@endif
		@endforeach
		@endif
		<script type="text/javascript">
						 function like(id){
			 	// alert(id);
			 		var token = '{{ csrf_token() }}';
			 		// alert(token);
			if($('#like'+id).attr('name')=='like'){ 
			 	$.post('/like',{
			 		_token : token,
			 		id : id,
			 	},function(data){
			 		$('#like'+id).attr('name','unlike');
			 		$('#like'+id).html('Unlike');
			 	});
			 } 
			 else {
			 	$.post('/unlike',{
			 		_token : token,
			 		id : id,
			 	},function(data){
			 		$('#like'+id).attr('name','like');
			 		$('#like'+id).html('Like');
			 });


			 }
}

		</script>
		@endif
		@endif

@endsection
