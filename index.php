<?php 
//open connection to the database
include ("functions.php");
include("./cms/db_connect.php");

//select 5 most recent posts
$sql = "SELECT post_id, title, post, DATE_FORMAT(postdate, '%e %b %Y at %H:%i') AS dateattime FROM posts ORDER BY post_id DESC LIMIT 7";
$result = mysql_query($sql);
$myposts = mysql_fetch_array($result);
?> 


<!doctype>
<html>
	<head>
		<meta charset="utf-8">
		<title>That Girl Julia</title>
		<link rel="stylesheet" type="text/css" href="../css/reset.css">
		<link href='http://fonts.googleapis.com/css?family=Bilbo+Swash+Caps|Bad+Script|Felipa|Swanky+and+Moo+Moo|Just+Me+Again+Down+Here|Rock+Salt|Qwigley' rel='stylesheet' type='text/css'>

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
		<style type="text/css"> @import url(../css/julia.css); </style>
		<style type="text/css">@import url(http://fonts.googleapis.com/css?family=Felipa);</style>
	</head>
	<body>
		
		<?php include("header.php"); ?>

		<!--this is the main part of the page-->
		<div id="maincontent">
			<div id="posts">
				<?php 
				if($myposts) {
					do {
						$post_id = $myposts["post_id"];
						$title = $myposts["title"];
						$post = format($myposts["post"]);
						$dateattime = $myposts["dateattime"];
						echo "<h2 id='post$post_id'><a href='post.php?post_id=$post_id' rel='bookmark'>
						$title</a></h2>\n";
						echo "<h4>Posted on $dateattime</h4>\n";
						echo "<div class='post'>$post</div>";
					} while ($myposts = mysql_fetch_array($result));
				} else {
					echo "<p>I haven't posted to my blog yet.</p>";
				}
				?>
			</div>
			<div id="sidebar">
				<div id="about">
					<h3>About this</h3>
					<p>This is a diary by ME.</p>
				</div>
				
				

				<div id="recent">
					<h3>Recent posts</h3>
					<?php
					mysql_data_seek($result, 0);
					$myposts = mysql_fetch_array($result);

					if($myposts) {
						echo "<ul>\n";
						do {
							$post_id = $myposts["post_id"];
							$title = $myposts["title"];
						echo "<li><a href='post.php?post_id=$post_id' rel='bookmark'>
						$title</a></li>\n";
						} while ($myposts = mysql_fetch_array($result));
						echo "</ul>";
					}
					?>
				</div>
			</div>
			<!--sidebar ends-->
			
		</div>
		<!--maincontent ends-->
		<?php include("footer.php"); ?>
	</body>
</html>