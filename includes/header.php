<?php
	if(isset($_SESSION['userID'])) {
		$id = $_SESSION['userID'];
	}
?>
<header id="header">
	<a href="#" class="logo"><strong>RS Auto Werkplaats Web App</strong> developed by The Crew</a>

	<ul class="icons">
		<button id="busy" onclick="state('<?php echo $id; ?>');" style="margin-right: 20px" class="button">Set status: <u>Bezig</u></button>
		<li><a class="icon fa-bell-slash"><span class="label">Notifications</span></a></li>
	</ul>
</header>