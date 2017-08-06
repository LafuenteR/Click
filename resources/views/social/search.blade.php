@extends("layout/master")

@section("main_content")
	<table>
		<h3>Search Results      {{count($accounts)}}</h3>
	@foreach ($accounts as $account)
		
	<tr>
		<td class="col-md-3">
			<a href="{{url('/profile/{$account->id}')}}">
				<img src="{{$account->avatar}}" class="img-circle" style="width: 100px;height: 100px;margin-bottom: 20px;">
			</a>
		</td>
		<td class="col-md-9">
			<a href='{{url("/profile/$account->id")}}'>
				<span>{{$account->name}}</span>
			</a><br>
			<!-- <span>Mutual</span> -->
		</td>
		<!-- <td class="col-md-4">
			@if(Auth::user()->id != $account->id)
			<button>Add Me</button>
			@endif

		</td> -->

	</tr>
	
	@endforeach
	</table>


@endsection

@extends('layouts.app')
