<?php 
define('BACK_PATH',''); // path back to the ROOT SSL directory

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
					<form action="account/login.php" method="post">
						<p>Come on in, guys!</p>
						<table>
							<tr>
								<td>
									<p>Username:</p>
								</td>
								<td>
									<input type="text" name="username"/>
								</td>
							</tr>
							<tr>
								<td>
									<p>Password:</p>
								</td>
								<td>
									<input type="password" name="password"/>
								</td>
							</tr>
						</table>
						<button type="submit">Login</button>
					</form>
					<p><a class="link" href="account/forgot.php">Forgot password...</a></p>
				</div>
				<br>
				<!-- Sign up form -->
				<div class="floating">
					<p>Worth playing for?</p>
					<a href="account/signup.php"><button>Sign<br>Up</button></a>
				</div>
			</div>
			<!-- *** END EDITING CODE HERE *** -->
		</div>
		<?php include_once(BACK_PATH . 'public/templates/footer.php');?>
	</body>
</html>