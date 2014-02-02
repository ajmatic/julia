<?php 
//open connection to the database

include("../cms/db_connect.php");

//Get post_id from query string
$post_id = (isset($_REQUEST["post_id"]))?$_REQUEST["post_id"]:"";

//If post_id is a number get post from darabase
if (preg_match("/^[0-9]+$/", $post_id)) {
	$sql = "SELECT post_id, title, post, DATE_FORMAT(postdate, '%e %b %Y at %H:%i') AS dateattime FROM posts 
	WHERE post_id=$post_id LIMIT 1";
		$result = mysql_query($sql);
		$myposts = mysql_fetch_array($result);
}

include("functions.php");

//If comment has been submitted and post exists then add comment to database
if (isset($_POST["postcomment"]) != "") {
	$posttitle = addslashes(trim(strip_tags($_POST["posttitle"])));
	$name = addslashes(trim(strip_tags($_POST["name"])));
	$email = addslashes(trim(strip_tags($_POST["email"])));
	$website = addslashes(trim(strip_tags($_POST["website"])));
	$comment = addslashes(trim(strip_tags($_POST["comment"])));

	$sql = "INSERT INTO comments
	(post_id, name, email, website, comment)
	VALUES ('$post_id', '$name', '$email', '$website', '$comment')";
	$result2 = mysql_query($sql);
	if (!$result2) {
		$message = "Failed to insert comment.";
	} else {
		$message = "Comment added.";
		$comment_id = mysql_insert_id();

		//send yourself an email when a comment is successfully added 
		$emailsubject = "Comment added to: ".$posttitle;

		$emailbody = "Comment on '".$posttitle."'"."\r\n"."http://www.ajmatic.com/post.php?post_id=".$post_id."#c".$comment_id."\r\n\r\n"
			.$comment."\r\n\r\n"
			.$name." (".website.")\r\n\r\n";
			$emailbody - stripcslashes($emailbody);

			$emailheader = "From: ".$name." <".$email.">\r\n"."Reply-To: ".$email;

			mail("adam.lamagna@yahoo.com", $emailsubject, $emailbody, $emailheader);

			// direct to post page to eliminate repeat posts
			header("Location: post.php?post_id=$post_id&message=$message");
	}
}


if ($myposts) {
	$sql = "SELECT comment_id, name, website, comment FROM comments WHERE post_id = $post_id";
	$result3 = mysql_query($sql);
	$mycomments = mysql_fetch_array($result3);
}
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
		<style type="text/css"> @import url(../css/julia.css); </style>
	</head>
	<body>
		
		<?php include("header.php"); ?>

		<!--this is the main part of the page -->
		<div id="maincontent">
			<div id="posts">
				<?php
				if($myposts) {
					do {
						$post_id = $myposts["post_id"];
						$title = $myposts["title"];
						$post = format($myposts["post"]);
						$dateattime = $myposts["dateattime"];
						echo "<h2>$title</h2>\n";
						echo "<h4>Posted on $dateattime</h4>\n";
						echo "<div class='post'>\n $post \n</div>";
					} while ($myposts = mysql_fetch_array($result));
				} else {
					echo "<p>There is no post matching a post_id of $post_id.</p>";
				}
				?>
				<div id="comments">
					<h2>Comments</h2>
					<?php
					if($mycomments) {
						echo "<dl>";
						do {
							$comment_id = $mycomments["comment_id"];
							$name = $mycomments["name"];
							$website = $mycomments["website"];
							$comment = format($mycomments["comment"]);
							if ($website != "") {
								echo "<dt><a href='$website'>$name</a> wrote:</dt>\n";
							} else {
								echo "<dt>$name wrote:</dt>\n";
							}
							echo "<dd>$comment</dd>\n";
						} while ($mycomments = mysql_fetch_array($result3));
						echo "</dl>"; 
						} else {
							echo "<p>There are no comments yet.</p>";
					}
					?>
					
				</div>
			</div>
			<div id="sidebar">
				
				
				<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
					<input type="hidden" name="post_id" value="<?=$post_id ?>" />
					<input type="hidden" name="posttitle" value="<?=$title ?>" />
					<h3>Add a comment</h3>
					<?php
					if (isset($message)) {
						echo "<p class='message'>".$_POST["message"]."</p>";
					}
					?>
					<p>Name: <input name="name" type="text" /></p>
					<p>Email: <input name="email" type="text" /></p>
					<p>Website: <input name="website" type="text" /></p>
					<p>Comment: <textarea name="comment" cols="25" rows="15"></textarea></p>
					<p><input type="submit" name="postcomment" value="Post comment" /></p>
				</form>
			</div>
			<!--sidebar ends-->

		</div>
		<!--maincontent ends -->
		<?php include("footer.php"); ?>
	</body>
</html>