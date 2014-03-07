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
			
			<div class="row">
				<div class="col-sm-8 col-md-8">
					<div id="sidebar">
						<h3>Send me an email</h3>
						<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" class="form-horizontal" role="form">
						    <div class="form-group">
						      <div class="col-sm-10">
						        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>" />
								<input type="hidden" name="posttitle" value="<?php echo $title; ?>" />
								<?php
									if (isset($message)) {
										echo "<p class='message'>".$_POST["message"]."</p>";
									}
								?>
						      </div>
						    </div>
						    <div class="form-group">
						      <div class="col-sm-10">
						        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
						      </div>
						    </div>
						    <div class="form-group">
						      <div class="col-sm-10">
						        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
						      </div>
						    </div>
						    <div class="form-group">
						      <div class="col-sm-10">
						        <textarea class="form-control" rows="3" id="message" name="message" placeholder="Message"></textarea>
						      </div>
						    </div>
						    <div class="form-group">
						      <div class="col-sm-offset-2 col-sm-10">
						        <button type="submit" class="btn btn-primary" name="postcomment">Email Me!</button>
						      </div>
						    </div>
						</form>
					</div>
					<!--sidebar ends-->
				</div><!--end col-->
				<div class="col-sm-6 col-md-6">
					
				</div>
			</div>	
				
			
		<?php include("footer.php"); ?>
		</div><!--end container-->
		
	</body>
</html>