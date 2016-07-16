<!DOCTYPE html>
<html>
	<head>
		<title>Entry Form</title>
		<link href="http://0.0.0.0:25003/file?file=Html/Css/search.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="search">
			<form method="get" action="search">
				<div class="form-items">
					<input type = "text" name="search" placeholder="Search for a Name">
				</div>
				<div class="form-submit">
					<input type = "submit" value="SEARCH">
				</div>
			</form>
		</div>
		<div class="box">
			<h3>Searched Results</h3>
				<table>
					<tr>
						<th>ID</th>
						<th>NAME</th>
						<th>AGE</th>
						<th>EMAIL</th>
					</tr>
					{{var}}
				</table>
			</form>
		</div>
		

	</body>
</html>