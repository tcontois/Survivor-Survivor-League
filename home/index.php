<?php 
define('BACK_PATH','../'); // path back to the ROOT SSL directory

if(!isset($_COOKIE['username'])){
    header("Location: " . BACK_PATH);
    die;
}

include_once "../php/ServerConnect.php";
include_once "../php/Utilities.php";

// get season, week, and the number of picks
$sql = "SELECT * FROM info";
$result = mysqli_fetch_row(query($sql));
$season = $result[0];
$current_week = $result[1];
$num_picks = $result[2];
// get eliminated and remaining contestants
$eliminated = array();
$remaining = array();
$can_pick = array();
$sql = "SELECT id, firstname, eliminated, img FROM cast WHERE season = $season ORDER BY eliminated";
$result = query($sql);
while($row = mysqli_fetch_assoc($result)){
	if(is_null($row['eliminated'])){
		$remaining[$row['id']] = array($row['firstname'], $row['img']);
		$can_pick[$row['id']] = array($row['firstname'], $row['img']);
	}
	else{
		$eliminated[$row['id']] = array($row['firstname'], $row['img'], $row['eliminated']);
	}
}
// get picks and who is available to pick
$picks = array();
$current_picks = array();
$sql = "SELECT week, cid FROM picks WHERE uid = {$_COOKIE['uid']} AND season = $season";
$result = query($sql);
while($row = mysqli_fetch_assoc($result)){
	if(isset($remaining[$row['cid']])){
		if($row['week'] == $current_week){
			$current_picks[] = array($row['cid'], $remaining[$row['cid']][0], $remaining[$row['cid']][1]); 
		}
		else{
			$picks[] = array($row['week'], $remaining[$row['cid']][0], $remaining[$row['cid']][1], 1);
			unset($can_pick[$row['cid']]);
		}
		// if none left, reset
		if(count($can_pick) == 0){
			$can_pick = $remaining;
		}
	}
	else{
		if($row['week'] == $eliminated[$row['cid']][2]){
			$picks[] = array($row['week'], $eliminated[$row['cid']][0], $eliminated[$row['cid']][1], 0);
		}
		else{
			$picks[] = array($row['week'], $eliminated[$row['cid']][0], $eliminated[$row['cid']][1], 1);
		}
	}
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
			<div class="center">
				<div class="floating">
					<h2>Survivor Survivor League: Week <?php echo $current_week ?></h2> 
					<h2>Current pick:</h2>
					<?php
					$no_pick_path = BACK_PATH . 'public/img/no_pick.jpg';
					if($num_picks == 1){
						$row = $current_picks[0];
						if($row){
							$img_path = BACK_PATH . $row[2];
						?>
							<div class="elem">
								<img src="<?php echo $img_path;?>"/>
								<span class="caption"><?php echo $row[1];?></span>
								<span class="caption"><a href="remove.php?cid=<?php echo $row[0]?>">[remove]</a></span>
							</div>
						<?php
						}
						else{
						?>
							<div class="elem">
								<img src="<?php echo $no_pick_path;?>"/>
								<span class="caption">No pick</span>
							</div>
						<?php
						}
					}
					?>
					<?php
					if($num_picks == 2){
						$count = 0;
						foreach($current_picks as $row){
							$count = $count + 1;
							$img_path = BACK_PATH . $row[2];
							?>
								<div class="elem">
									<img src="<?php echo $img_path;?>"/>
									<span class="caption"><?php echo $row[1];?></span>
									<span class="caption"><a href="remove.php?cid=<?php echo $row[0]?>">[remove]</a></span>
								</div>
							<?php
						}
						while($count < 2){
							?>
								<div class="elem">
									<img src="<?php echo $no_pick_path;?>"/>
									<span class="caption">No pick</span>
								</div>
							<?php
							$count = $count + 1;
						}
					}
					?>
					<h2>Make pick:</h2>
					<?php
					// get potential picks
					// $sql = "select * from cast where eliminated is null and id not in (select cid from picks where uid = {$_COOKIE['uid']} and week < $current_week) and season = $season order by id";
					// $result = query($sql);
					// while($row = mysqli_fetch_assoc($result)){
					foreach($can_pick as $id => $atts){
						$pick_path = "pick.php?cid=" . $id;
						$img_path = BACK_PATH . $atts[1];
					?>
						<div class="elem">
						<a href="<?php echo $pick_path;?>">
							<img src="<?php echo $img_path;?>"/>
						</a>
						<span class="caption"><?php echo $atts[0];?></span>
						</div>
					<?php
					}
					?>
					<h2>Past picks:</h2>
					<?php
					foreach($picks as $i => $atts){
						$week_txt = "Week " . $atts[0] . ":";
						$img_path = BACK_PATH . $atts[2];
					?>
						<div class="elem">
							<span class="caption"><?php echo $week_txt;?></span>
							<img src="<?php echo $img_path;?>"/>
							<span class="caption"><?php echo $atts[1];?></span>
							<?php
							if($atts[3] == 1){
							?>
								<p><font color='green'>Correct</font></p>
							<?php
							}
							else{
							?>
								<p><font color='red'>Incorrect</font></p>
							<?php
							}
							?>
						</div>
					<?php
					}
					?>
					<h2>Eliminated:</h2>
					<?php
					foreach($eliminated as $id => $atts){
						$week_txt = "Week " . $atts[2] . ":";
						$img_path = BACK_PATH . $atts[1];
					?>
						<div class="elem">
							<span class="caption"><?php echo $week_txt;?></span>
							<img src="<?php echo $img_path;?>"/>
							<span class="caption"><?php echo $atts[0];?></span>
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