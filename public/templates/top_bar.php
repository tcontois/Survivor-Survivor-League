<div class="nav">
	<div class="new_logo">
		<a href="<?php echo BACK_PATH;?>"><img src="<?php echo BACK_PATH;?>public/img/new_logo.png"></a>
	</div>
	<div class="menu">
		<ul>
			<li><a href="<?php echo BACK_PATH;?>">HOME</a></li>
			<li><a href="<?php echo BACK_PATH;?>rules/">RULES</a></li>
			<li><a href="<?php echo BACK_PATH;?>cast/">CAST</a></li>
		</ul>
	</div>
	<?php if(isset($_COOKIE['username'])) { ?>
		<div class="hello">
			 <div class="dropdown">
			 	<img src="<?php echo BACK_PATH;?>public/img/user_logo.png">
			 	<div class="dropdown-content">
			 		<a href="<?php echo BACK_PATH;?>account/logout.php">Log out</a>
			  	</div>
			</div>
		</div>
	<?php } ?>
</div>
<div class="divider"><!-- Add spacing between forms --></div>