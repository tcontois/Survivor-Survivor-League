<?php
define('BACK_PATH', '../'); // path back to the ROOT SSL directory

if(!isset($_COOKIE['username'])){
    header("Location: " . BACK_PATH);
    die;
}

include_once "../php/ServerConnect.php";
include_once "../php/Utilities.php";

// get week number
$week_sql = "select max(eliminated) from cast";
$week_result = mysqli_fetch_row(query($week_sql));
$current_week = $week_result[0] + 1;

?>
<html>
	<head>
		<title>Survivor Survivor League</title>
	</head>
	<body>
		<p>Hello <?php echo $_COOKIE['username'] ?>
		<a href="../account/logout.php">Log out</a></p>
		<h1>Survivor Survivor League: Week <?php echo $current_week ?></h1> 
		<h2>Current pick:</h2>
		<table>
			<tr>
				<td>
					<center>
					<?php
					//get current pick
					$sql = "select * from picks p join cast c on p.cid = c.id where p.uid = {$_COOKIE['uid']} and week = $current_week";
					$result = query($sql);
					$row = mysqli_fetch_assoc($result);
					if($row){
						echo "<img src='../{$row['img']}'/>";
						echo "<p>{$row['firstname']}</p>";
					}
					else{
						echo "<img src='../public/img/no_pick.jpg'>";
					}
					?>
					</center>
				</td>
			</tr>
		</table>
		<h2>Make pick:</h2>
		<table>
		<?php
		// get potential picks
		$sql = "select * from cast where eliminated is null and id not in (select cid from picks where uid = {$_COOKIE['uid']} and week < $current_week) order by id";
		$result = query($sql);
		$col_count = 0;
		echo "<tr>";
		while($row = mysqli_fetch_assoc($result)){
			if($col_count != 0 && $col_count % 7 == 0){
				echo "</tr>";
				echo "<tr>";
			}
			echo "<td>";
			echo "<center>";
			echo "<a href='pick.php?week=$current_week&cid={$row['id']}'><img src='../{$row['img']}'/></a>";
			echo "<p>{$row['firstname']}</p>";
			echo "</center>";
			echo "</td>";
			/*
			echo $row['firstname'];
			echo "<br>";
			*/
			$col_count++;
		}
		echo "</tr>";
		?>
		</table>
		<h2>Past picks:</h2>
		<table>
		<?php
		// get already picked
		$picked_sql = "SELECT * FROM cast c join picks p on c.id = p.cid WHERE p.uid = {$_COOKIE['uid']} and p.week < $current_week order by week";
		$result = query($picked_sql);
		$col_count = 0;
		echo "<tr>";
		while($row = mysqli_fetch_assoc($result)){
			if($col_count != 0 && $col_count % 7 == 0){
				echo "</tr>";
				echo "<tr>";
			}
			echo "<td>";
			echo "<center>";
			echo "<p>Week " . $row['week'] . ":</p>";
			echo "<img src='../{$row['img']}'/>";
			echo "<p>{$row['firstname']}</p>";
			if($row['correct'] == 1){
				echo " <p><font color='green'>Correct</font></p>";
			}
			else{
				echo " <p><font color='red'>Incorrect</font></p>";
			}
			echo "</center>";
			echo "</td>";
			/*
			echo "Week " . $row['week'] . ": " . $row['firstname'];
			if($row['correct'] == 1){
				echo " Correct";
			}
			else{
				echo " Incorrect";
			}
			echo "<br>";
			*/
			$col_count++;
		}
		echo "</tr>";
		?>
		</table>
		<h2>Eliminated:</h2>
		<table>
		<?php
		// get eliminated contestants
		$eliminated_sql = "select * from cast where eliminated is not null order by eliminated";
		$result = query($eliminated_sql);
		$col_count = 1;
		echo "<tr>";
		while($row = mysqli_fetch_assoc($result)){
			if($col_count != 0 && $col_count % 7 == 0){
				echo "</tr>";
				echo "<tr>";
			}
			echo "<td>";
			echo "<center>";
			echo "<p>Week " . $row['eliminated'] . ":</p>";
			echo "<img src='../{$row['img']}'/>";
			echo "<p>{$row['firstname']}</p>";
			echo "</center>";
			echo "</td>";
			/*
			echo "Week " . $row['eliminated'] . ": " . $row['firstname'];
			echo "<br>";
			*/
		}
		echo "</tr>";
		?>
		</table>
		<?php include_once(BACK_PATH . 'public/templates/footer.php');?>
	</body>
</html>