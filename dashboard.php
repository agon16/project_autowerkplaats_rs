<?php 
	require 'includes/head.php';


 ?>
<div id="wrapper">
	<div id="main">
		<div class="inner">
			<!-- Header -->
				<?php
					require 'includes/header.php';
					require 'includes/head.php';
				?>

			<!-- Content -->
			<section calss="row 200%">
				<header class="main">
					<div align="center"><h2>Dashboard</h2></div>
				</header>
			</section>
			<div id="chartContainer2" style="height: 400px; width: 75%;"></div>
			<div id="chartContainer" style="height: 400px; width: 75%;"></div>
			<div class="recent_werzaamheden">
				<section>
					<h2 class="major"><span>Recent Posts</span></h2>
					<ul class="divided">
						<li>
							<article class="box post-summary">
								<h3><a href="#">Banden verwisselen</a></h3>
								<ul class="meta">
									<li class="icon fa-clock-o">1 uur geleden</li>
									<li class="icon fa-comments"><a href="#">Vader heeft drie banden gepompt</a></li>
								</ul>
							</article>
						</li>
						<li>
							<article class="box post-summary">
								<h3><a href="#">banden pompen</a></h3>
								<ul class="meta">
									<li class="icon fa-clock-o">9 hours ago</li>
									<li class="icon fa-comments"><a href="#">Vader heeft drie banden gepompt</a></li>
								</ul>
							</article>
						</li>
						<li>
							<article class="box post-summary">
								<h3><a href="#">Schokenbreker vervagen</a></h3>
								<ul class="meta">
									<li class="icon fa-clock-o">Yesterday</li>
									<li class="icon fa-comments"><a href="#">Vader heeft drie banden gepompt</a></li>
								</ul>
							</article>
						</li>
					</ul>
				</section>
			</div>
		</div>
	</div>
</div>
<footer style="background-color: red; height: 50px;">
	<div class="main_profile_page">
		<div class="profile_holder inline">
			<span class="avatar ">
				<img class="profile_foto" src="images/profile_foto_1.jpg" alt="">
				<div class="aanwezig"></div>
			</span>
		</div>
		<div class="profile_holder inline">
			<span class="avatar">
				<img class="profile_foto" src="images/profile_foto_1.jpg" alt="">
			</span>
		</div>
		<div class="profile_holder inline">
			<span class="avatar">
				<img class="profile_foto" src="images/profile_foto_1.jpg" alt="">
			</span>
		</div>	
		<div class="profile_holder inline">
			<span class="avatar">
				<img class="profile_foto" src="images/profile_foto_1.jpg" alt="">
			</span>
		</div>
		<div class="profile_holder inline">
			<span class="avatar">
				<img class="profile_foto" src="images/profile_foto_1.jpg" alt="">
			</span>
		</div>
	</div>
</footer>


	<!-- Sidebar -->
	<?php
		require 'includes/sidebar.php';
	?>

</div>

<?php
	require 'includes/foot.php';
?>

<script type="text/javascript">
	$("#user").val(<?php echo $user_id; // Set role ID ?>);
</script>