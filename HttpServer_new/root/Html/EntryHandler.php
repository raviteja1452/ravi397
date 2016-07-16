<!DOCTYPE html>
<html>
	<head>
		<title>Entry Form</title>
		<link href="http://0.0.0.0:25003/file?file=Html/Css/entry.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="box">
			<h3>Enter Your Details</h3>
			<form method="get" action="entry">
				<div class="form-items">
					<div class= "label" >Name :</div><input type = "text" name="name" placeholder="Enter Your Name">
				</div>
				<div class="form-items">
					<div class= "label">Age :</div><input type = "text" name="age" placeholder="Enter Your Age">
				</div>
				<div class="form-items">
					<div class= "label">Email :</div><input type = "text" name="email" placeholder="Enter Your Email">
				</div>
				<div class="form-submit">
					<input type = "submit" value="SUBMIT">
				</div>
			</form>
		</div>
		<div class="second">
			<div class="display">
				<form method="get" action="display">
					<div class="form-submit">
						<input type = "submit" value="DISPLAY">
					</div>
				</form>
			</div>
			<div class="search">
				<form method="get" action="search">
					<div class="form-items inline">
						<input type = "text" name="search" placeholder="Search for a Name">
					</div>
					<div class="form-submit inline">
						<input type = "submit" value="SEARCH">
					</div>
				</form>
			</div>
		</div>
	</body>
</html>