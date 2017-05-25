<div class="avatar-wrapper">
	<?php

	$sql = "SELECT * FROM users";
	$query = $conn->query($sql);

	while ($result = $query->fetch_assoc()) {
		$image = $result['image'];
		$fullname = $result['firstname'].' '.$result['lastname'];

		echo '<img class="avatar" src="'.$image.'" title="'.$fullname.'" alt="avatar" />';
	}

	?>
</div>