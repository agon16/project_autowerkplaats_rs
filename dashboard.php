<?php
	session_start();
	require 'includes/head.php';
	require 'backend/db.php';

	// $style = 'none';

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
							<h1>Werkzaamheden</h1>
						</header>

						<!-- Content -->
						<div class="row 200%">
							<div class="9u 12u$(medium)">

								<div id="chartContainer2" class="grafieken"></div>
								<div id="chartContainer" class="grafieken"></div>

							</div>
							
							<!-- Recent posts -->
							<div class="3u 12u$(medium)">
								<article class="box post-summary">
									<h3><a href="#">Banden verwisselen</a></h3>
									<ul class="alt">
										<li><span class="icon fa-clock-o"> </span>10:30 PM</li>
										<li><span class="icon fa-comments"> </span>Hij heeft dat gedaan</li>
									</ul>
								</article>

								<article class="box post-summary">
									<h3><a href="#">Banden pompen</a></h3>
									<ul class="alt">
										<li><span class="icon fa-clock-o"> </span>9 hours ago</li>
										<li><span class="icon fa-comments"> </span>Vader heeft drie banden gepompt</li>
									</ul>
								</article>

								<article class="box post-summary">
									<h3><a href="#">Banden pompen</a></h3>
									<ul class="alt">
										<li><span class="icon fa-clock-o"> </span>9 hours ago</li>
										<li><span class="icon fa-comments"> </span>Vader heeft drie banden gepompt</li>
									</ul>
								</article>
							</div>

							<div class="12u">
								<div class="box box-warning direct-chat direct-chat-warning">
					                <div class="box-header with-border">
					                  <h3 class="box-title">Notificatie</h3>

					                  <div class="box-tools pull-right">
					                    <span data-toggle="tooltip" title="3 New Messages" class="badge bg-yellow">3</span>
					                  </div>
					                </div>
					                <div class="box-body">
					                  <div class="direct-chat-messages">
					                    <div class="direct-chat-msg">
					                      <div class="direct-chat-info clearfix">
					                        <span class="direct-chat-name pull-left">Emanuel A.</span>
					                        <span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>
					                      </div>
					                      <img class="direct-chat-img" src="images/profile_foto_1.jpg" alt="message user image">
					                      <div class="direct-chat-text">
					                        Er zijn geen banden meer
					                      </div>
					                    </div>
					                    <div class="direct-chat-msg right">
					                      <div class="direct-chat-info clearfix">
					                        <span class="direct-chat-name pull-right">Tim Poco</span>
					                        <span class="direct-chat-timestamp pull-left">23 Jan 2:05 pm</span>
					                      </div>
					                      <img class="direct-chat-img" src="images/profile_foto_1.jpg" alt="message user image">
					                      <div class="direct-chat-text">
					                        Banden gekocht
					                      </div>
					                    </div>
					                    <div class="direct-chat-msg">
					                      <div class="direct-chat-info clearfix">
					                        <span class="direct-chat-name pull-left">Hupi Cheli</span>
					                        <span class="direct-chat-timestamp pull-right">23 Jan 5:37 pm</span>
					                      </div>
					                      <img class="direct-chat-img" src="images/profile_foto_1.jpg" alt="message user image">
					                      <div class="direct-chat-text">
					                        Auto met plaat 23-65 AP niet af maar morgen vrij.
					                      </div>
					                    </div>
					                    <div class="direct-chat-msg right">
					                      <div class="direct-chat-info clearfix">
					                        <span class="direct-chat-name pull-right">Tim Poco</span>
					                        <span class="direct-chat-timestamp pull-left">23 Jan 6:10 pm</span>
					                      </div>
					                      <img class="direct-chat-img" src="images/profile_foto_1.jpg" alt="message user image">
					                      <div class="direct-chat-text">
					                        Oke Riva gaat morgen eraan werken
					                      </div>
					                    </div>
					                  </div>
					                </div>
					              </div>
							</div>
						</div> <!-- row 200% -->

					</section>

			</div>
			<!-- Avatars -->
			<?php
				require 'includes/avatars.php';
			?>
		</div>

	<!-- Sidebar -->
	<?php
		require 'includes/sidebar.php';
	?>
	
</div> <!-- Wrapper -->

<?php
	require 'includes/foot.php';
?>