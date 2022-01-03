{include_php file=$zCssJs}
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Vidéos Restitution</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="{$zBasePath}documentation/infprat/sad/inf-prat">Archives et Documentations</a></li>
									<li class="breadcrumb-item">Images et Vidéos</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								{literal}
								<style>
									#citations blockquote:nth-child(2) {
									animation-delay: 30s;
								}
								</style>
								{/literal}

								<br>
								<div align="right">	
									<a href="{$zBasePath}documentation/restitution/sad/video-annuel18/2018#carousel-documentaion1" class="btn">Retour</a>	
								</div>
								<br>
								<div align="center" id="large" class="view">
									<div id="large" class="view">
										
										<video id="largeVideo" height="463" width="583" controls="true" poster="videoposter.jpg" webkit-playsinline="true" 
										autoplay="no"  loop="yes" width="700" height="500" muted="true" data-weborama-videoplayer="true" preload="metadata" autobuffer="false" 
										style="position: center; left: 0px; top: 0px; z-index: 200;" title="Double clic pour plein écran">
											<!--<source type="video/webm" src="<?php echo base_url('assets/img/img_sad/restitution/video/'.$restitution->restitution_url_video);?>" ></source>-->
											<!--<source type="video/webm" src="http://192.168.100.160:8001/1.webm"<?php echo $restitution->restitution_url_video;?> ></source>-->
											<!--<source type="video/webm" src="http://­192.168.100.160:8001/­<?php echo $restitution->restit­ution_url_video;?>" ></source>-->
											<!--source type="video/webm" src="http://192.168.100.160:8001/{$oData.restitution->restitution_url_video}" ></source-->
											
											
										</video>		
										
										<div class="clickArea"></div>
									</div>
								</div>
								<div id="calendar"></div>
							</div>
						</div>

					</div>
				</div>
			</div>
			<!-- /Page Content -->
					
		</div>
		<!-- /Page Wrapper -->

	</div>
	<!-- /Main Wrapper -->


	{literal}	
	<script>
		$( document ).ready(function() {
		$('#citations .citation:gt(0)').hide();
		setInterval(
			function(){
				$("#citations > :first-child").fadeOut(1000, function() {
					$(this).next('.citation').fadeIn(1000).end().appendTo('#citations')
				});
			}, 6000
		);
		
		});
	</script>
	{/literal}

{include_php file=$zFooter}