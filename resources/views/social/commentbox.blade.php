
		 					@foreach($comments as $comment)
		 					@foreach($accounts as $acc)
		 					<table>
		 					@if($comment->post_id == $post->id && $comment->user_id == $acc->id)
		 						<tr class="deleteComment{{$comment->id}}">
		 							<th rowspan="3" class="col-md-1">
		 								<img src='{{asset("$acc->avatar")}}' width="30px;" style="margin-bottom: 10px;" class="img-circle">
		 							</th>
		 							<th colspan="1" class="col-md-11" style="padding-left: 0px;">
		 								<a href='{{"/profile/$acc->id"}}' style="font-size: 12px;">{{$acc->name}}</a>	
		 							</th>
		 						</tr>	
		 						<tr class="deleteComment{{$comment->id}}">
		 							<td>
		 								{{$comment->comment}}
		 							</td>
		 						</tr>
		 						<tr class="deleteComment{{$comment->id}}">
		 							<td style="padding-left: 0px;padding-right: 0px;">
		 								<span style="font-size: 8px;">{{$comment->created_at->diffForHumans()}}</span>
		 						 	</td>
		 						 
		 						 	@if($comment->user_id == Auth::user()->id || $post->user_id == Auth::user()->id)
		 						 
		 							<td>
		 								<a role="button" id="deleteComment{{$comment->id}}" onclick="deleteComment({{$comment->id}});" style="font-size: 8px;">Delete</a>
		 							</td>
		 							@endif	 		
		 						</tr>
		 							
		 					@endif
		 					</table>
		 					@endforeach
		 					@endforeach