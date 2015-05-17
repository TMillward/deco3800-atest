<!DOCTYPE html>
<html>
	<head>
		<title>ATEST Report</title>
	</head>
	<body>
		<h1>ATEST Report By: {{ $user->name }}</h1>
		<p>
			<strong>Created On:</strong>
			{{ $currentTime }}
		</p>
		<p>
			<strong>Contributed To By:</strong>
			{!! HTML::ul($contributor_names) !!}
		</p>
		<p>
			<strong>Content:</strong>
			<br>
			<br>
			{{ $note->research_text }}
		</p>
	</body>
</html>