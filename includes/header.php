<?php
	if(isset($_SESSION['userID'])) {
		$id = $_SESSION['userID'];

		$sql = "SELECT busy FROM users WHERE id = '$id'";
		$query = $conn->query($sql);

		$result = $query->fetch_assoc();
		$busy = $result['busy'];
		if($busy == "yes") {
			$busy = '<button onclick="state(\''.$id.'\');" style="margin-right: 20px" class="button special">Set status: <u>Beschikbaar</u></button>';
		} else if($busy == "no") {
			$busy = '<button onclick="state(\''.$id.'\');" style="margin-right: 20px" class="button">Set status: <u>Bezig</u></button>';
		} 
	}
?>
<header id="header">
	<a href="#" class="logo"><strong>RS Auto Werkplaats Web App</strong> developed by The Crew</a>

	<ul class="icons">
		<?php echo $busy; ?>
		<li><a class="icon fa-bell-slash"><span class="label">Notifications</span></a></li>
	</ul>
</header>