<?php 
define('BACK_PATH','../'); // path back to the ROOT SSL directory

if(isset($_COOKIE['username'])){
    header("Location: " . BACK_PATH . "home/");
    die;
}
?>
<!DOCTYPE html>
<html>
	<!-- Head template -->
	<?php include_once(BACK_PATH . 'public/templates/head.php');?>
	<body>
		<!-- Page content -->
		<div class="background">
			<!-- Title bar and Navigation Bar -->
			<?php include_once(BACK_PATH . 'public/templates/top_bar.php');?>
			<!-- *** START EDITING CODE HERE *** -->
			<!-- Login form -->
			<div class="center">
				<div class="floating">
					<h2>Forgot your password?</h2>
					<br>
					<p class="left">If you are in the original Survivor Survivor League and know Tim, contact Tim directly.</p>
					<br>
					<p class="left">If not, contact <a href="mailto:survivorsurvivorleague@gmail.com">survivorsurvivorleague@gmail.com</a></p>
				</div>
			</div>
			<!-- *** END EDITING CODE HERE *** -->
		</div>
		<?php include_once(BACK_PATH . 'public/templates/footer.php');?>
	</body>
</html>