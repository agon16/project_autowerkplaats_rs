<?php
	if(isset($_SESSION['userID'])) {
		$id = $_SESSION['userID'];

		$sql = "SELECT * FROM users INNER JOIN user_roles ON user_roles.id = users.user_role_id WHERE users.id = '$id'";
		$query = $conn->query($sql);

		$result = $query->fetch_assoc();
		$name = $result['firstname'].' '.$result['lastname'];
		$role = ucfirst($result['role']);
	}
?>

<div id="sidebar">
	<div class="inner">

		<!-- Search -->
		<section id="search" class="alt">
			<form method="post" action="#">
				<input type="text" name="query" id="query" placeholder="Search" />
			</form>
		</section>

		<div align="center">
			<img src="images/RS autocar centre model 2.2.jpg" style="width: 175px; height: auto; border-radius: 100%">
		</div>

		<ul class="contact">
			<li class="fa-circle"><?php echo $name; ?></li>
			<li class="fa-gear"><?php echo $role; ?></li>
		</ul>

		<!-- Menu -->
		<nav id="menu">
			<header class="major">
				<h2>Menu</h2>
			</header>
			<ul>
				<li><a href="index.php">Dashboard</a></li>
				<li><a href="overview_activities.php">Werkzaamheden</a></li>
				<li>
					<span class="opener">Autokeuringen</span>
					<ul>
						<li><a href="overview_inspections.php">Recente autokeuringen</a></li>
						<li><a href="#">Vervallen autokeuringen</a></li>
					</ul>
				</li>
				<li>
					<span class="opener">Auto's</span>
					<ul>
						<li><a href="overview_cars.php">Auto's overzicht</a></li>
						<li><a href="overview_car_models.php">Auto modellen</a></li>
						<li><a href="overview_towed_cars.php">Overzicht gesleepte auto's</a></li>
					</ul>
				</li>
				<li>
					<span class="opener">Medewerkers</span>
					<ul>
						<li><a href="overview_users.php">Medewerkers overzicht</a></li>
						<li><a href="add_user.php">Medewerker toevoegen</a></li>
						<li><a href="overview_roles.php">Rollen</a></li>
						<li><a href="edit_profile.php">Profiel bewerken</a></li>
					</ul>
				</li>
				<li><a href="overview_clients.php">Klanten</a></li>
				<li><a href="#">Informeren</a></li>
				<li><a href="overview_companies.php">Bedrijven</a></li>
				<li><a href="overview_logs.php">Logs</a></li>
				<li><a href="login.php">Uitloggen</a></li>
			</ul>
		</nav>

		<section>
			<header class="major">
				<h2>Over ons</h2>
			</header>
			<p>Wij als programmeurs zijn bereid u te helpen met software oplossingen en andere IT gerelateerde solutions. Neem vandaag nog contact met ons.</p>
			<ul class="contact">
				<li class="fa-envelope-o"><a href="#">information@untitled.tld</a></li>
				<li class="fa-phone">(000) 000-0000</li>
				<li class="fa-home">1234 Somewhere Road #8254<br />
				Nashville, TN 00000-0000</li>
			</ul>
		</section>

		<!-- Footer -->
		<footer id="footer">
			<p class="copyright">&copy; RS Auto Werkplaats Web App. 
			<br>All rights reserved. 
				<br>
			Developed by: <a>Timothy Pocorni</a>,  <a>Sheldon Hupsel</a>, <a>Agon Emanuel</a> & <a>Rivaldo Vola</a>.</p>
		</footer>

	</div>
</div>