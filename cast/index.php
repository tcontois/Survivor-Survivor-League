<?php 
define('BACK_PATH','../'); // path back to the ROOT SSL directory

include_once(BACK_PATH . 'php/ServerConnect.php');
include_once(BACK_PATH . 'php/Utilities.php');
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
					<h2>Cast</h2>
					<!--p>Fill in and link pics to CBS</p-->
					<?php
					$sql = "select * from cast c, info i where c.season = i.season";
					$result = query($sql);
					while($row = mysqli_fetch_assoc($result)){
						$img_path = BACK_PATH . $row['img'];
					?>
						<div class="elem">
							<a href="<?php echo $row['url'];?>">
								<img src="<?php echo $img_path;?>"/>
							</a>
							<span class="caption"><?php echo $row['firstname'];?></span>
							<!--p><?//php echo $row['firstname'];?></p-->
        				</div>
					<?php
					}
					?>
				</div>
			</div>
			<!-- *** END EDITING CODE HERE *** -->
		</div>
		<?php include_once(BACK_PATH . 'public/templates/footer.php');?>
	</body>
</html>