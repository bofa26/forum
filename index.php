<?php
	include 'v1/src/session.php';
	include 'v1/src/database.php';
	include 'v1/src/react.php';
	include 'v1/src/comments.php'; 
	include 'v1/src/threads.php';
	include 'v1/view/indexview.php';

	$session   = new Session();
	$database  = new Database();
	$comments  = new Comments();
	$reacts = new Reacts();
	$threads   = new Threads($comments, $reacts);
	$indexview = new IndexView($comments, $reacts, $session);

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Home page</title>
	<link rel="stylesheet" type="text/css" href="v1/tools/css/index.css">
	<script type="text/javascript" src="jquery-3.6.4.js"></script>
</head>
<body>
	<div class="header">
		<?php $indexview->header_view();?>		
		<div class="theme"><h2>Blogspot</h2></div>
	</div>
	<div class="container">
		<ul>
			<?php $indexview->container_list_view();?>
		</ul>
	</div>
	<footer><p style="text-align: center;">All rights reserved @blogspot date:<?php echo date("Y-m-d");?></p></footer>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#login').on('click', function() {
			window.location.href = 'signup.php';
		});
		})		
	</script>
</body>
</html>