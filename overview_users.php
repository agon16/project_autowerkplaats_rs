<?php
	session_start();

	require 'includes/head.php';
	require 'backend/db.php';

	$userID = $_SESSION['userID'];
?>
<!-- Wrapper -->
<div id="wrapper">

	<!-- Main -->
		<div id="main">
			<div class="inner">

				<!-- Header -->
				<?php
					require 'includes/header.php';
				?>

				<!-- Content -->
					<section>
						<header class="main">
							<h1>Gebruikers overzicht</h1>
						</header>

						<a href="add_user.php" class="button special">Gebruiker toevoegen</a>
							<br><br>

						<!-- Content -->
						<div class="row 200%">
							<div class="12u 12u$(medium)">

								<!-- Table -->
								<h3>Users</h3>

								<div class="table-wrapper">
									<table class="alt">
										<thead>
											<tr>
												<th>Rol</th>
												<th>Naam</th>
												<th>Voornaam</th>
												<th>Email</th>
												<th>Adres</th>
												<th>Tel. nummer</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											
											<?php
												$sql = "SELECT * FROM users INNER JOIN user_roles ON users.user_role_id = user_roles.id WHERE users.user_role_id > 0";
												$query = $conn->query($sql);

												while ($result = $query->fetch_assoc()) {
													$role = ucfirst($result['role']);
													$id = $result['id'];
													$firstname = $result['firstname'];
													$lastname = $result['lastname'];
													$email = $result['email'];
													$address = $result['address'];
													$phone = $result['phone'];

											?>

											<tr>
												<td><?php echo $role; ?></td>
												<td><?php echo $lastname; ?></td>
												<td><?php echo $firstname; ?></td>
												<td><?php echo $email; ?></td>
												<td><?php echo $address; ?></td>
												<td><?php echo $phone; ?></td>
												<td><a href="view_user.php?id=<?php echo $id; ?>" class="button icon fa-circle">Bekijken</a></td>
											</tr>

											<?php
												}
											?>
										</tbody>
									</table>
								</div>

							</div>
						</div>

					</section>

			</div>
		</div>

	<!-- Sidebar -->
	<?php
		require 'includes/sidebar.php';
	?>

</div>

<?php
	require 'includes/foot.php';
?>