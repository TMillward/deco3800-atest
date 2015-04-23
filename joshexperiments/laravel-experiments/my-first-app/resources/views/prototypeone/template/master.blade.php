<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	{!! HTML::style("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css") !!}
	<title>@yield("title")</title>
</head>
<body>
	<div class="container">
		@yield("content")
	</div>
</body>
</html>