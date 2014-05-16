<?php 
//open connection to the database
include ("functions.php");
include("./cms/db_connect.php");

//select 5 most recent posts
$myposts = [];
$sql = "SELECT post_id, title, post, DATE_FORMAT(postdate, '%e %b %Y at %H:%i') AS dateattime FROM posts ORDER BY postdate DESC, post_id DESC LIMIT 5";
$result = mysql_query($sql);
while($row = mysql_fetch_assoc($result)) {
	$myposts[] = $row;
}
?> 


<!doctype>
<html>
	<head>
		<meta charset="utf-8">
		<title>Julia Ann Campbell</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<link href='http://fonts.googleapis.com/css?family=Bilbo+Swash+Caps|Felipa|Swanky+and+Moo+Moo|Just+Me+Again+Down+Here' rel='stylesheet' type='text/css'>
		<script src="https://code.jquery.com/jquery.js"></script>
	    <!-- Include all compiled plugins (below), or include individual files as needed -->
	    <script src="../dist/js/bootstrap.min.js"></script>
		<link href="../dist/css/bootstrap.css" rel="stylesheet">
		<link href="../css/font-awesome.min.css" rel="stylesheet">
		<style type="text/css"> @import url(../css/julia.css); </style>

	</head>
	<body>
		<div class="container">
			
			<?php include("header.php"); ?>
			
			
			<!--this is the main part of the page-->
			<div class="row">
				<div class="col-sm-6 col-md-6">
					<div id="about">
						<h3>About Julia</h3>
					<p>
						Bio coming soon!!!
					</p>
					</div>
				</div><!--end col-6-->
				<div class="col-sm-6 col-md-6">
					<img id="juliaFace" alt="Julia smiling" src="../img/julia1-1.jpg">
				</div>
			</div><!--end row-->
			<?php include("footer.php"); ?>
		</div><!--end container-->
		
	</body>
</html>