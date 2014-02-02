<?php 
//open connection to database
include("../cms/db_connect.php");

$q = (isset($_REQUEST["q"]))?$_REQUEST["q"]:"";
$q = trim(strip_tags($q));

if ($q != "") {
	//select posts grouped by month and year
	$sql = "SELECT post_id, title, summary, DATE_FORMAT(postdate, '%e %b %Y at %H:%i')
	AS dateattime FROM posts WHERE 
	MATCH (title,summary,post) AGAINST ('$q') LIMIT 50";
	$result = mysql_query($sql);
	$myposts = mysql_fetch_array($result);
}

//format search for HTML display
$q = stripslashes(htmlentities($q));

include("functions.php");
?>

<!doctype>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
		<title>Julia's Blog</title>
		<link rel="stylesheet" type="text/css" href="/juliablog/css/reset.css">
		<link href='http://fonts.googleapis.com/css?family=Bilbo+Swash+Caps|Bad+Script|Felipa|Swanky+and+Moo+Moo|Just+Me+Again+Down+Here|Rock+Salt|Qwigley' rel='stylesheet' type='text/css'>

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
		<style type="text/css"> @import url(/juliablog/css/julia.css); </style>
	</head>
	<body>
		
		<?php include("header.php"); ?>

		<!--this is the main part of the page -->
		<div id="maincontent">
			
			<div id="posts">
				<h2>Search Results</h2>
				<div id="results">
					<?php
					if($myposts) {
						$numresults = mysql_num_rows($result);
						$plural1 = ($numresults==1) ? "is" : "are";
						$plural2 = ($numresults==1) ? "" : "s";
						echo "<p>There $plural1 <em>$numresults</em> post$plural2 matching your search for <cite>$q</cite>.</p>";
						echo "<dl>\n";
						do {
							$post_id = $myposts["post_id"];
							$title = $myposts["title"];
							$summary = $myposts["summary"];
						echo "<dt><a href='post.php?post_id=$post_id'>$title</a></dt>\n";
						echo "<dd>$summary</dd>\n";
						} while ($myposts = mysql_fetch_array($result));
						echo "</dl>";
					} else {
						echo "<p>There were no posts matching your search for <cite>$q</cite>.</p>";
					}
					?>
				</div>
			</div>
			
			<!--sidebar ends -->
		</div>
		<!--maincontent ends -->
		<?php include("footer.php"); ?>
	</body>
</html>