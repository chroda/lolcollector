				<div class="panel">
					<?php echo adsence('7935726087',false,90,970);?>
				</div>
			</div>
			<div id="column">
				<div class="panel panel-default">
					<div class="panel-heading"><h6 class="panel-title text-center"><small>FACEBOOK</small></h6></div>
					<div class="panel-body">
						<div class="fb-like-box" data-href="https://www.facebook.com/lolcollector" data-width="200" data-height="400" data-colorscheme="dark" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
					</div>
					<div class="panel-footer"><h6 class="panel-title text-center"><small>FACEBOOK</small></h6></div>
				</div>
				<br />
				<div class="panel panel-default">
					<div class="panel-heading"><h6 class="panel-title text-center"><small>PARCEIROS</small></h6></div>
					<div class="panel-body">
						<a href="https://www.facebook.com/messages/459397237525644" target="_blank">
							<img src="<?php echo CDN_DIR;?>img/partner.png" />
						</a>
						<hr />						
						<a href="https://www.facebook.com/NyankoShop" target="_blank">
							<img src="<?php echo DATA_DIR;?>partners/nyanko.jpg" />
						</a>
					</div>
					<div class="panel-footer"><h6 class="panel-title text-center"><small>PARCEIROS</small></h6></div>
				</div>
				<br />
				<div class="panel panel-default">
					<div class="panel-heading"><h6 class="panel-title text-center"><small>PUBLICIDADE</small></h6></div>
					<div class="panel-body">
						<?php rewrite(1)!=='' ? $resp = true : $resp = false; ?>
						<?php echo adsence('5120030489',$resp);?>
						<?php echo adsence('2026963288',$resp);?>
						<?php echo adsence('4561627281',$resp);?>
						<?php //echo adsence('2026963288',$resp);?>
						<?php //echo adsence('6177961287',$resp);?>
					</div>
					<div class="panel-footer"><h6 class="panel-title text-center"><small>PUBLICIDADE</small></h6></div>
				</div>
			</div>
		</div>
		<footer class="navbar navbar-inverse" role="navigation">
			<div class="col-lg-11">
				<p class="navbar-text"><?php echo $_SESSION['seo']['copyright'];?></p>
			</div>
			<div class="col-lg-1">
				<a href="<?php echo $_SESSION['social']['facebook']	;?>" target="_blank" class="btn navbar-btn btn-default btn-social"><i class="fa fa-facebook"></i></a>
				<a href="<?php echo $_SESSION['social']['twitter']	;?>" target="_blank" class="btn navbar-btn btn-default btn-social"><i class="fa fa-twitter"></i></a>
			</div>
		</footer>
		<!-- !js -->
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.0";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		<script type="text/javascript">
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		  ga('create', 'UA-49850415-1', 'lolcollector.com.br');
		  ga('send', 'pageview');
		</script>
		<script type="text/javascript"	src="<?php echo CDN_DIR; ?>js/jquery.min.js"						></script>
		<!-- <script type="text/javascript"	src="<?php echo CDN_DIR; ?>js/jquery-ui.min.js"					></script> -->
		<script type="text/javascript"	src="<?php echo CDN_DIR; ?>js/bootstrap.min.js"						></script>
		<script type="text/javascript"	src="<?php echo CDN_DIR; ?>js/maskedinput.js"						></script>
		<script type="text/javascript"  src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js" async></script>
		<script type='text/javascript'>
			jQuery.App={
			    url:		'<?php location(false,false,false);?>',
			    locale:		'<?php echo $_SESSION['user']['locale'];?>',
			    platform:	'<?php echo $_SESSION['user']['platform'];?>',
				graphics:	new Array(
					<?php foreach(topChampionShuffle(null,true) as $grafic):?>
						'<?php echo CDN_DIR.'img/nav-random/'.$grafic;?>',
					<?php endforeach;?>
				''),
			}
		</script>
		<script type="text/javascript" src="<?php echo CDN_DIR; ?>js/functions.js" 							></script>
		<script type="text/javascript" src="<?php echo CDN_DIR; ?>js/events.js" 							></script>
		<?php if(@$_SESSION['user']['authenticated']['username'] === rewrite(2)):?>
			<script type="text/javascript" src="<?php echo CDN_DIR; ?>js/collect.js"						></script>
		<?php endif;?>
		<?php if(file_exists(__ROOT__.'cdn/js/'.rewrite(2).'.js')):?><script type="text/javascript" src="<?php echo CDN_DIR.'js/'.rewrite(2).'.js';?>"></script><?php endif;?>
	</body>
</html>