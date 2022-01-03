<!-- Header -->
<div class="header" 
{if !empty($oRowUserTheme)>0}
{if $oRowUserTheme.0.fondPage_couleur !='' && $oRowUserTheme.0.fondPage_couleur != 'style-fond'}
style="background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, .3), rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.6)), url({$zBasePath}assets/common/img/{$oRowUserTheme.0.fondPage_photo}.jpg);background-position:left;background-attachment: fixed;"
{/if}
{/if}
>

	<!-- Logo -->
	<div class="header-left">
		<a href="http://rohi.mef.gov.mg:8088/ROHI/accueil/communique" class="logo">
			<img src="{$zBasePath}assets/light/assets/img/logo.png" width="90" height="88" alt="">
		</a>
	</div>
	<!-- /Logo -->
	
	<a id="toggle_btn" href="javascript:void(0);">
		<span class="bar-icon">
			<span></span>
			<span></span>
			<span></span>
		</span>
	</a>
	
	<!-- Header Title -->
	<div class="page-title-box">
		<h3>RessOurces Humaines Informatisées</h3>
	</div>
	<!-- /Header Title -->
	
	<a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="la la-bars"></i></a>
	
	<!-- Header Menu -->
	<ul class="nav user-menu">
		<!-- Flag -->
		{$zCount}
		<!-- /Flag -->
	
		<!-- Notifications -->
		<li class="nav-item dropdown">
			<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
				<i class="ace-icon la la-cog"></i>
			</a>
			<input type="hidden" name="base" id="base" value="{$zBasePath}">
			<div class="dropdown-menu notifications">
				<div class="topnav-dropdown-header">
					<span class="notification-title">Thèmes</span>
					<a href="javascript:void(0)" class="clear-noti">&nbsp;</a>
				</div>
				<div class="noti-content">
					<ul class="notification-list">
					    <li class="notification-message">
							<a href="javascript:;" data-theme="style">
								<div class="media">
									<span class="avatar">
										<img alt="" src="{$zBasePath}assets/common/img/def/fond-gris.png">
									</span>
									<div class="media-body">
										<p class="noti-details"><span class="noti-title">Fond unis</span></p>
									</div>
								</div>
							</a>
						</li> 
						<li class="notification-message">
							<a href="javascript:;" data-theme="isalo">
								<div class="media">
									<span class="avatar">
										<img alt="" src="{$zBasePath}assets/common/img/def/isalo.jpg">
									</span>
									<div class="media-body">
										<p class="noti-details"><span class="noti-title">Isalo</span></p>
									</div>
								</div>
							</a>
						</li>
						<li class="notification-message">
							<a href="javascript:;" data-theme="lily">
								<div class="media">
									<span class="avatar">
										<img alt="" src="{$zBasePath}assets/common/img/def/lily.jpg">
									</span>
									<div class="media-body">
										<p class="noti-details"><span class="noti-title">chute de la lily</span></p>
									</div>
								</div>
							</a>
						</li>
						<li class="notification-message">
							<a href="javascript:;" data-theme="baobab22">
								<div class="media">
									<span class="avatar">
										<img alt="" src="{$zBasePath}assets/common/img/def/baobab22.jpg">
									</span>
									<div class="media-body">
										<p class="noti-details"><span class="noti-title">Allée des baobabs</span></p>
									</div>
								</div>
							</a>
						</li>
						<li class="notification-message">
							<a href="javascript:;" data-theme="vondro">
								<div class="media">
									<span class="avatar">
										<img alt="" src="{$zBasePath}assets/common/img/def/vondro.jpg">
									</span>
									<div class="media-body">
										<p class="noti-details"><span class="noti-title">Village du pêcheur</span></p>
									</div>
								</div>
							</a>
						</li>
						<li class="notification-message">
							<a href="javascript:;" data-theme="tsingy2">
								<div class="media">
									<span class="avatar">
										<img alt="" src="{$zBasePath}assets/common/img/def/tsingy2.jpg">
									</span>
									<div class="media-body">
										<p class="noti-details"><span class="noti-title">Tsingy coucher de soleil</span></p>
									</div>
								</div>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</li>
		
		</li>
		<!-- /Message Notifications -->

		<li class="nav-item dropdown has-arrow main-drop">
			<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
				<span class="user-img"><img src="{$zImageUrl}">
				<span class="status online" style="top:auto;left:auto"></span></span>
				<span>
				{if $oCandidat[0]->nom!='' && $oCandidat[0]->prenom !=''}
					{$oCandidat[0]->nom}&nbsp;{$oCandidat[0]->prenom}
				{else}
					{$oUser.nom}&nbsp;{$oUser.prenom}
				{/if}
				</span>
			</a>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item" href="{$zBasePath}cv2/mon_cv">Mon profil</a>
				
				<a class="dropdown-item" href="{$zBasePath}user/change_password">Changer Mot de passe</a>
				<a class="dropdown-item" href="{$zBasePath}gcap/deconnexion">Déconnexion</a>
			</div>
		</li>
	</ul>
	<!-- /Header Menu -->
	
	<!-- Mobile Menu -->
	<div class="dropdown mobile-user-menu">
		<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="la la-ellipsis-v"></i></a>
		<div class="dropdown-menu dropdown-menu-right">
			<a class="dropdown-item" href="{$zBasePath}cv2/mon_cv">Mon profil</a>
			
			<a class="dropdown-item" href="{$zBasePath}user/change_password">Changer Mot de passe</a>
			<a class="dropdown-item" href="{$zBasePath}gcap/deconnexion">Déconnexion</a>
		</div>
	</div>
	<!-- /Mobile Menu -->
	
</div>
<script>
	AOS.init();
</script>
<!-- /Header -->
{include_php file=$zLeft}
	
	<!-- Page Wrapper -->
	<div class="page-wrapper">
	
	<!-- Page Content -->
	<div class="content container-fluid">	
		<input type="hidden" id="zDateToDayDefault" name="zDateToDayDefault" value="{$zDateToDayDefault}">
		{assign var="iTest" value="0"}
		{assign var="i" value="1"}
		{if sizeof($toMenus)>0}
		<div class="page-menu">
			<div class="row">
				<div class="col-sm-12">
					<ul class="menu-rohi nav-tabs">
					{foreach from=$toMenus item=oMenus }
					<li class="nav-item {if $oData.menu == $oMenus.page_id} current{/if}" ><a {if  $oMenus.page_url != '#'}href="{$zBasePath}{$oMenus.page_url}"{/if} style="cursor:pointer;" {if $oMenus.page_javascript == 1} href="#" id="{$oMenus.page_zHashUrl}"{/if} data-hover="{$oMenus.page_libelle}">{$oMenus.page_libelle}</a></li>
					{/foreach}
					</ul>
				</div>
			</div>
		</div>
		{/if}
		
		<div class="row">
			<div class="col-sm-12">
				&nbsp;
			</div>
		</div>