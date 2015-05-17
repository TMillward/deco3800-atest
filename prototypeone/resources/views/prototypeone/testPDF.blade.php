<!doctype html>
<html lang="en">
	<head>
		<title>Test PDF</title>
	</head>
	<body>
		<div class="container">
			<h1>About This Prototype</h1>
			<p>
			This is the prototype which was made after the first progress 
			report for this semester. There is much more functionality 
			in this prototype (compared to the 
			previous prototype) like the following:
			</p>
			{!! HTML::ul(array(
				"Multiple User Accounts" => array(
					"AT Professional" => array(
						"A user who is a member of the panel system", 
						"User's purpose is to review the AT Seeker's 
							research notes."
					), 
					"AT Seeker" => array(
						"A user who is looking for Assistive Technology",
						"This user can create research notes and 
						submit these research notes to be reviewed by 
						a panel of AT experts"
					), 
					"AT Supplier" => array(
						"A user who suppliers Assistive Technology", 
						"This user provides information on the 
						Assistive Technology they supply, which 
						should include the cost"
					), 
					"AT Expert User" => array(
						"A user who has used this application before 
						and knows how it works", 
						"This user supports AT Seekers who need help 
						using this application"
					)
				), 
				"Panel System" => array(
					"AT Seekers can now send their research notes 
					for review by a panel. When they do, the 
					research note becomes a case", 
					"The panel and the AT Seeker can communicate with 
					each other on the particular case"
				),
				"More to come...",
			)) 
			!!}
		</div>
		
		<div class="container">
			<p>{!! HTML::link(".", "Back to login page") !!}</p>
		</div>
	</body>
</html>