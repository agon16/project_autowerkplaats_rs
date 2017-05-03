<?php
	session_start();

	require 'includes/head.php';
	require 'backend/db.php';

	/**
	* Login
	* @param email, password
	*/
	if(isset($_POST['login'])) {
		$email = $_POST['email'];
		$password = sha1($_POST['password']);
		$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
		$query = $conn->query($sql);

		if($query->num_rows == 1) {
			$_SESSION['userID'] = $query->fetch_assoc()['id'];
			header("Location: overview_users.php");
		}
	}
	
?>

<!-- Wrapper -->
<div id="wrapper">

	<!-- Main -->
		<div id="main">
			<div class="inner">

				<!-- Content -->
				<section>
					<header class="main">
						<div align="center">
							<h1>RS Auto Werkplaats</h1>
						</div>
					</header>
						<br>

					<!-- Content -->
						<div class="row 200%">
							<div class="4u 12u$(medium)">
								<p style="color: white">.</p>
							</div>
							<div class="4u 12u$(medium)">

								<!-- Login form -->
								<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
									<div class="row uniform">
										<div class="12u 12u$(xsmall)">
											<input name="email" id="email" value="" placeholder="Email" type="text" required="">
										</div>
										<div class="12u$ 12u$(xsmall)">
											<input name="password" id="password" value="" placeholder="Password" type="password" required="dsfds">
										</div>

										<!-- Break -->
										<div class="12u$">
											<ul class="actions">
												<li><input value="Login" class="special" name="login" type="submit"></li>
											</ul>
										</div>
									</div>
								</form>

							</div>
						</div>

				</section>

			</div>
		</div>

</div>

<?php
	require 'includes/foot.php';
?>