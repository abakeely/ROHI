{include_php file=$zCssJs}
<script>
	var zBasePath = '{/literal}{$zBasePath}{literal}' ; 
</script>
<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/sfao/style.css">
<script type="text/javascript" src="{$zBasePath}assets/sfao/sfao.js"></script>
<input type="hidden" name="zPageId" id="zPageId" value="">
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Agents > Situation irrégulière</h3>
								{* <ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Reclassement</a></li>
									<li class="breadcrumb-item">Visualisations</li>
								</ul> *}
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<div>
									<ul id="sdt_menu" class="sdt_menu" style="width:100%">
										<li iLeft="300px" style="width:300px;">
											<a style="width:300px;border-radius: 15px 0 0 15px;" >
												<img style="width:300px;" src="{$zBasePath}assets/sfao/images/offre.jpg" alt="" style="overflow: hidden; width: 0px; display: block; height: 0px; left: 60px;">
												<span class="sdt_active" style="overflow: hidden; height: 0px; display: block;width:300px"></span>
												<span class="sdt_wrap" style="top: 18px;width:300px;">
													<span class="sdt_link">OFFRES DE FORMATIONS</span>
													<span class="sdt_descr">&nbsp;</span>
												</span>
											</a>
											<div class="sdt_box sdt_box1"  style="display: none;left: 300px;">
													<a href="{$zBasePath}sfao/page/offres-locales">Offres locales</a>
													<a href="{$zBasePath}sfao/page/bourses">Bourses</a>
													<a href="{$zBasePath}sfao/page/concours">Concours</a>
													<a href="{$zBasePath}sfao/page/formations-payantes">Formations externes payantes</a>
											</div>
										</li>
										<li iLeft="170px"> 
											<a >
												<img src="{$zBasePath}assets/sfao/images/reporting.jpg" alt="" style="overflow: hidden; width: 0px; display: block; height: 0px; left: 60px;">
												<span class="sdt_active" style="overflow: hidden; height: 0px; display: block;"></span>
												<span class="sdt_wrap" style="top: 18px;">
													<span class="sdt_link">REPORTING</span>
													<span class="sdt_descr">&nbsp;</span>
												</span>
											</a>
											<div class="sdt_box sdt_box1"  style="display: none; left: 300px;">
													<a href="{$zBasePath}sfao/page/rapports-de-formations">Rapports de formations</a>
													<a href="{$zBasePath}sfao/page/autres-rapports">Autres Rapports</a>
											</div>
										</li>
										<li iLeft="170px">
											<a >
												<img src="{$zBasePath}assets/sfao/images/lien.jpg" alt="" style="width: 0px; display: block; height: 0px; left: 60px; overflow: hidden;">
												<span class="sdt_active" style="height: 0px; display: block; overflow: hidden;"></span>
												<span class="sdt_wrap" style="top: 18px;">
													<span class="sdt_link">LIENS UTILES</span>
													<span class="sdt_descr">&nbsp;</span>
												</span>
											</a>
											<div class="sdt_box sdt_box1"  style="display: none; left: 300px;">
													<a href="{$zBasePath}sfao/page/textes-de-references">Textes de réferences</a>
													<a href="{$zBasePath}sfao/page/documents-points-focaux-formations">Documents points focaux formations</a>
													<a href="{$zBasePath}sfao/page/info-com" >INFO COM</a>
											</div>
										</li>
										<li iLeft="170px">
											<a style="border-radius: 0 15px 15px 0" >
												<img src="{$zBasePath}assets/sfao/images/lien_.jpg" alt="" style="overflow: hidden; width: 0px; display: block; height: 0px; left: 60px;">
												<span class="sdt_active" style="overflow: hidden; height: 0px; display: block;"></span>
												<span class="sdt_wrap" style="top: 18px;">
													<span class="sdt_link">ARCHIVES</span>
													<span class="sdt_descr">&nbsp;</span>
												</span>
											</a>
											<div class="sdt_box" style="display: none; left: 0px;">
												<a href="{$zBasePath}sfao/page/photos" >Photos</a>
												<a href="{$zBasePath}sfao/page/trombinoscope" >Trombinoscope</a>
											</div>
										</li>
									</ul>

								
								</div>
								{* <div id="mainHeaderMenu"  class="formationMenuNav" style="display:none;">
								<nav>
									<ul style="text-align:left;padding-left:25%;">
									<li>
										<a href="#">OFFRES DE FORMATIONS</a>
										<ul style="width:230px;">
												<li><a href="{$zBasePath}sfao/page/offres-locales">Offres locales</a></li>
												<li><a href="{$zBasePath}sfao/page/bourses">Bourses</a></li>
												<li><a href="{$zBasePath}sfao/page/concours">Concours</a></li>
												<li><a href="{$zBasePath}sfao/page/formations-payantes">Formations externes payantes</a></li>
										</ul>
									</li>
									<li>
										<a href="#">REPORTING</a>
										<ul style="width:230px;">
												<li><a href="{$zBasePath}sfao/page/rapports-de-formations">Rapports de formations</a></li>
												<li><a href="{$zBasePath}sfao/page/autres-rapports">Autres Rapports</a></li>
										</ul>
									</li>
									<li>
										<a href="#">LIENS UTILES</a>
										<ul style="width:230px;">
												<li><a href="{$zBasePath}sfao/page/textes-de-references">Textes de réferences</a></li>
												<li><a href="{$zBasePath}sfao/page/documents-points-focaux-formations">Documents points focaux formations</a></li>
												<li><a href="{$zBasePath}sfao/page/info-com" >INFO COM</a></li>
										</ul>
									</li>
									<li>
										<a href="#">ARCHIVES</a>
										<ul style="width:230px;">
											<li><a href="{$zBasePath}sfao/page/photos" >Photos</a></li>
											<li><a href="{$zBasePath}sfao/page/trombinoscope" >Trombinoscope</a></li>
										</ul>
									</li>
								</ul>

								</nav>
								</div>
								*}
								
								<div id="innerContent2" class="listEspace" style="float:left;width:100%;padding-top:25px;">
									{if $oData.iPageId == ''}
										{*<h3>Accueil formation et appui operationnel</h3>*}
										<div id="owl-demo1" class="clearfix" style="position: relative;">
											{* debut*}
											<div class="item" style="text-align:left;width:80%;float:left;">
												<img style="width:100%" src="{$zBasePath}assets/sfao/images/tv-sfao2.png">
											</div>
											<div class="sfao">
												<img src="{$zBasePath}assets/sfao/images/parchemin.png">
												<marquee direction="up"><h1 class="deepshadow"><span>S</span>ERVIR<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="la la-star-o"></i><br/><br/><span>F</span>ORMER<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="la la-star-o"></i><br/><br/><span>A</span>PPYUER<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="la la-star-o"></i><br/><br/><span>O</span>RIENTER</h1></marquee>
											</div>
											{* fin*}
											
										</div>
									{else}
									{if $oData.iAfficheEdit==1}
									<span style="float:right">
									<a style="font-size:25px;" zPageId="{$oData.zHashUrl}" class="dialog-link" ><i style="color:#12105A" title="Modifier" alt="Modifier" class="la la-edit"></i></a>
									</span>
									{/if}
									<h3>{$oData.zTitle}</h3>
									{$oData.zContent}
									{/if}
								</div>
							</div>
						</div>

					</div>
				</div>
    		</div>
			<!-- /Page Content -->
					
        </div>
		<!-- /Page Wrapper -->
		<div id="dialog" title="Dialog Title"></div>
	</div>
	<!-- /Main Wrapper -->

{include_php file=$zFooter}

