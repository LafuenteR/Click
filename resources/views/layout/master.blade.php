@if(Auth::check())
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style type="text/css">
		body{
			width: 100%;
		}
		.form-control{
			border: 0;
		}
		.profile_ul > li {
			list-style-type: none;
			display: inline;
			margin-right: 10px;
		}
		.profile_ul{
			margin: 0;
			text-align: justify;
		}
		.profile_ul > li > button{
			border-radius: 12px;
		}
		.panel-body > ul.profile_ul > li > form > .btn-info:hover{
			background-color: red;

		}
		</style>
</head>
<body>
<!-- <div class="container"> -->
	<div class="row" style="margin-right: 0;">
		<div class="col-md-2" style="padding: 0;padding-left: 30px;">
			@yield("left_sidebar")
		</div>
		<div class="col-md-8">
			<!-- <div class="col-md-8 col-md-offset-2"> -->
			@yield("main_content")
			<!-- </div> -->
		</div>
		<div class="col-md-2" style="padding: 0;">
			@yield("right_sidebar")
		</div>
	</div>
<!-- </div> -->

</body>
</html>
@endif