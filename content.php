<?php 
	include 'v1/src/session.php';
	include 'v1/src/database.php';
	include 'v1/src/react.php';
	include 'v1/src/comments.php'; 
	include 'v1/src/threads.php';
	include 'v1/view/indexview.php';
	include 'v1/view/contentview.php';

	$session   = new Session();
	$database  = new Database();
	$comments  = new Comments();
	$reacts = new Reacts();
	$threads   = new Threads($comments, $reacts);
	$indexview = new IndexView($comments, $reacts, $session);
	$contentview = new ContentView($comments, $reacts, $session);


	if (isset($_GET['threadid']) &&  preg_match('#^[0-9]+$#', $_GET['threadid'])) {
		$threadid = $_GET['threadid'];
		$thread =  $threads->thread($threadid);
		$sys = load_config('system_config');
		if (! $threads->has_viewed_thread($sys['IP_ADDR'], $threadid)) {
			$viewed = ($session->isSession('userid')) ? $session->getSession('username') : 'guest';
			$threads->view_thread(['threadid' => $threadid, 'viewed' => $viewed, 'title' => $thread['title'], 'address' => $sys['IP_ADDR'], 'dateviewed' => date("Y-m-d")]);
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
		<?php $contentview->header_view();?>		
		<div class="theme"><h2>Blogspot</h2></div>
	</div>
	<div class="container">
		<?php $contentview->content_container($thread);?>
		<?php $contentview->commentholder($threadid, $thread['title']);?>
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