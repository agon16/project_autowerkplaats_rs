<?php
	session_start();

	require 'includes/head.php';
	require 'backend/db.php';
	
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

				<div align="center" class="logo">
					<img id="border" src="images/border.png">
					<img id="frame" src="images/frame.png">
				</div>
					<br>

				<div class="row 200%">
					<div class="4u 12u$(medium)">
						<p style="color: white">.</p>
					</div>
					<div class="4u 12u$(medium)">

						<!-- Login form -->
						<form method="post" id="formSubmit">
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

						<div class="box" style="display: none"></div>

					</div>
				</div>

			</section>

		</div>
	</div>

</div>

<?php
	require 'includes/foot.php';
?>