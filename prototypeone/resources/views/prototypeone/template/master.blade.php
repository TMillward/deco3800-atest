<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	{!! HTML::style("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css") !!}
	<!-- Place a new button in the form with the id: "style_select" and a html::style thingy below with the appropriate info-->
	{!! HTML::style("css/app.css", array('title' => 'default'))!!}
	{!! HTML::style("css/test.css", array('title' => 'test'))!!}
	{!! HTML::style("css/test2.css", array('title' => 'test2'))!!}
	<title>@yield("title")</title>
	{!!HTML::script('scripts/style_change.js')!!}
	@yield('javascript')
</head>
<body onload="set_style_from_cookie()">
<form id="style_select">
<input type="submit" onclick="switch_style('default');return false;" name="theme" value="default" id="default">
<input type="submit" onclick="switch_style('test');return false;" name="theme" value="test" id="test">
<input type="submit" onclick="switch_style('test2');return false;" name="theme" value="test2" id="test2">
</form> 
	<div class="container">
		@yield("content")
	</div>
	<div> 
		@yield("message_feed")
	</div>
</body>
</html>