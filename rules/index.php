<?php 
define('BACK_PATH','../'); // path back to the ROOT SSL directory
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
			<div class="center">
				<div class="floating">
					<h2>Rules</h2>
					<img src="<?php echo BACK_PATH;?>public/img/jeff.jpg"/>
				</div>
				<div class="floating">
					<div class="rules">
						<p>Yooo welcome to survivor survivor league here is how it works:</p>
						<ol>
							<li>Each week you pick one castaway who you don't think will be eliminated that week and if they aren't eliminated then you survive until the next week</li>
							<li>write here or tell me or Tim who you are picking</li>
							<li>once you pick someone for the week you can't pick that person again on other weeks! Unless you have no other options besides people you've already picked.</li>
							<li>if the person you pick to survive also gets eliminated that week then you're out (but you can still play for fun)</li>
							<li>looking at next weeks preview is not against the rules</li>
							<li>No money involved this season but feel free to make side bets on which of us will last longer with your rivals (I.e Alex and Aaron)</li>
							<li>medevacs and quits count (if two people leave one week they both count as well)</li>
							<li>you can pick the same person as other people</li>					
						</ol>
						<p>Survivors Ready? Go!</p>
					</div>
				</div>
			</div>
			<!-- *** END EDITING CODE HERE *** -->
		</div>
		<?php include_once(BACK_PATH . 'public/templates/footer.php');?>
	</body>
</html>