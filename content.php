<?php 
	include 'v1/src/session.php';
	include 'v1/src/database.php';
	include 'v1/src/comments.php'; 
	include 'v1/src/threads.php';
	include 'v1/view/indexview.php';
	include 'v1/view/contentview.php';

	$database  = new Database();
	$comments  = new Comments();
	$threads   = new Threads($comments);
	$indexview = new IndexView($comments);
	$contentview = new ContentView($comments);
	$session   = new Session();


	if (isset($_GET['threadid']) &&  preg_match('#^[0-9]+$#', $_GET['threadid'])) {
		$threadid = $_GET['threadid'];
		$thread =  $threads->thread($threadid);
		$addr = load_config('system_config');
		if (! $threads->has_viewed_thread($addr['IP_ADDR'], $threadid)) {
			$viewed = ($session->isSession('userid')) ? $session->getSession('username') : 'guest';
			$threads->view_thread(['threadid' => $threadid, 'viewed' => $viewed, 'title' => $thread['title'], 'address' => $addr['IP_ADDR'], 'dateviewed' => date("Y-m-d")]);
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Content page</title>
	<link rel="stylesheet" type="text/css" href="v1/tools/css/content.css">
	<script type="text/javascript" src="jquery-3.6.4.js"></script>
</head>
<body>
	<div class="header">
		<?php $contentview->header_view($session);?>		
		<div class="theme"><h2>Blogspot</h2></div>
	</div>
	<div class="container">
		<?php $contentview->content_container($thread);?>
	</div>
	<footer><p style="text-align: center;">All rights reserved @blogspot date:<?php echo date("Y-m-d");?></p></footer>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#login').on('click', function() {
				window.location.href = 'login.php';
			});
			$('#sign').on('click', function() {
				window.location.href = 'signup.php';
			});
		})		
	</script>
</body>
</html>