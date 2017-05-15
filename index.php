<?php 
	require 'includes/head.php';


 ?>
<div id="wrapper">
	<div id="main">
	<div class="nav_bar">
				
			</div>
		<div class="inner">
			
			<!-- Content -->
			<br>
			<br>
			<div id="chartContainer2" class="grafieken"></div>
			<div id="chartContainer" class="grafieken"></div>
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
			<div class="box box-warning direct-chat direct-chat-warning" style="width: 75%;">
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