<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="initial-scale=1.0, maximum-scale=1.0, user-scalable=yes" name="viewport"/>
    <title>ROHI - GCAP</title>

	<!-- ace styles -->
	<link rel="stylesheet" href="{$zBasePath}assets/sau/css/bootstrap1.css" />
	<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/sau/css/fullcalendar.min.css" />
	<link rel="stylesheet" href="{$zBasePath}assets/sau/css/ace1.css" class="ace-main-stylesheet" id="main-ace-style" />
	<link rel="stylesheet" href="{$zBasePath}assets/accueil/css/components.css?sdsds" type="text/css">

    <link rel="stylesheet" type="text/css" href="{$zBasePath}assets/gcap/css/app/app.css?2017v3">
	<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/gcap/css/app/select2.css">
	<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/gcap/css/vendor/jquery-ui.css?sdsds1122" >
    <link rel="stylesheet" type="text/css" href="{$zBasePath}assets/gcap/css/vendor/font-awesome.min.css" >
	<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/gcap/css/agenda.css">

	<script type="text/javascript" src="{$zBasePath}assets/gcap/js/vendor/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="{$zBasePath}assets/gcap/js/vendor/jquery-ui.js"></script>
	<script type="text/javascript" src="{$zBasePath}assets/gcap/js/app/main.js"></script>
	<script type="text/javascript" src="{$zBasePath}assets/gcap/js/app/main_save.js"></script>
	<script type="text/javascript" src="{$zBasePath}assets/gcap/js/app/select2.js"></script>
	<script src="{$zBasePath}assets/js/bootstrap.min.js"></script>

	
</head>
<body>
    <header id="mainHeader">
		<!--<div class="fall_snow"></div>-->
		<!--<div class="tree"></div>-->
        <div id="mainHeaderTop">
            <div class="logo">
                <div><span><img src="{$zBasePath}assets/gcap/images/def3.jpg" alt=""></span></div>
            </div>
            <div class="info" style="text-align:justify">
				{if sizeof($oModuleActif)>0}
					{foreach from=$oModuleActif item=oModuleActif }
					<h1>{$oModuleActif.module_entete}</h1>
					<hr>
					<p>{$oModuleActif.module_descriptionEntete}</p>
					{/foreach}
				{else}
					<h1>&nbsp;</h1>
					<p>&nbsp;</p>
				{/if}
				<!--<br>
				<a href="{$zBasePath}common/plandusite" class="btnTousHeaderJaunes"><img style="width:12px;" src="{$zBasePath}assets/gcap/images/trie.png">&nbsp;&nbsp;&nbsp;PLAN DU SITE</a>
				<a href="{$zBasePath}common/contact" class="btnTousHeader"><img style="width:20px;" src="{$zBasePath}/assets/gcap/images/main.png">&nbsp;&nbsp;CONTACTEZ-NOUS</a>-->
            </div>
			<div class="logo">
                <div><span><img src="{$zBasePath}assets/gcap/images/def2.jpg" alt=""></span></div>
            </div>
        </div>
         <div id="mainHeaderBottom" style="padding:0px;">
            <!--<p><a href="#" title="">{$oCandidat[0]->nom}&nbsp;{$oCandidat[0]->prenom} <span><img src="{$zBasePath}assets/gcap/images/user.jpg" alt=""></span></a></p>-->
			<form name="setCompte" id="setCompte" action="{$zBasePath}gcap/setSessionCompte" method="POST">
				<input type="hidden" name="zUrlRedirect" id="zUrlRedirect" value="{$zUrl}">
				<input type="hidden" name="iCompteId" id="iCompteId" value="">
			</form>
			<div id="navbar" class="navbar navbar-default          ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				
				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<li id="boutonCalendrier" style="cursor:pointer;">
							<a data-toggle="dropdown" class="dropdown-toggle calendrier" href="#">
							<i class="ace-icon la la-calendar"></i>
							</a>
						</li>
						<!--
						<li class="purple dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon la la-bell icon-animated-bell"></i>
								<span class="badge badge-important">8</span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon la la-exclamation-triangle"></i>
									8 Notifications
								</li>

								<li class="dropdown-content ace-scroll" style="position: relative;"><div class="scroll-track" style="display: none;"><div class="scroll-bar"></div></div><div class="scroll-content" style="max-height: 200px;">
									<ul class="dropdown-menu dropdown-navbar navbar-pink">
										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-pink la la-comment"></i>
														New Comments
													</span>
													<span class="pull-right badge badge-info">+12</span>
												</div>
											</a>
										</li>

										<li>
											<a href="#">
												<i class="btn btn-xs btn-primary la la-user"></i>
												Bob just signed up as an editor ...
											</a>
										</li>

										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-success la la-shopping-cart"></i>
														New Orders
													</span>
													<span class="pull-right badge badge-success">+8</span>
												</div>
											</a>
										</li>

										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-info la la-twitter"></i>
														Followers
													</span>
													<span class="pull-right badge badge-info">+11</span>
												</div>
											</a>
										</li>
									</ul>
								</div></li>

								<li class="dropdown-footer">
									<a href="#">
										See all notifications
										<i class="ace-icon la la-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

						<li class="green dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon la la-envelope icon-animated-vertical"></i>
								<span class="badge badge-success">5</span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon la la-envelope-o"></i>
									5 Messages
								</li>

								<li class="dropdown-content ace-scroll" style="position: relative;"><div class="scroll-track" style="display: none;"><div class="scroll-bar"></div></div><div class="scroll-content" style="max-height: 200px;">
									<ul class="dropdown-menu dropdown-navbar">
										<li>
											<a href="#" class="clearfix">
												<img src="{$zBasePath}assets/gcap/images/user.jpg" class="msg-photo" alt="Alex's Avatar">
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue">Alex:</span>
														Ciao sociis natoque penatibus et auctor ...
													</span>

													<span class="msg-time">
														<i class="ace-icon la la-clock-o"></i>
														<span>a moment ago</span>
													</span>
												</span>
											</a>
										</li>

									</ul>
							</ul>
						</li>
						-->

						<li class="malefaka1 dropdown active">
							<a data-toggle="dropdown" class="dropdown-toggle" style="font-size:1.2em;" href="#" aria-expanded="false">
								{if $iSessionCompte > 1}
									{foreach from=$toComptes item=oComptes }
									{if $iSessionCompte == $oComptes.compte_id}
									{$oComptes.compte_libelle}
									{/if}
									{/foreach}
								{else}
									Compte agent&nbsp;
								{/if}
								<i class="ace-icon la la-caret-down bigger-110 width-auto"></i>
							</a>
							{if sizeof($toComptes)>0}
							<ul class="dropdown-menu dropdown-info">
								{if $iSessionCompte > 1}
									<li>
										<a data-toggle="tab" class="SelectCompte" selectId="1" style="cursor:pointer" aria-expanded="true">Compte agent&nbsp;</a>
									</li>
								{/if}
								{foreach from=$toComptes item=oComptes }
								{if $iSessionCompte != $oComptes.compte_id}
								<li>
									<a data-toggle="tab" class="SelectCompte" selectId="{$oComptes.compte_id}" style="cursor:pointer" aria-expanded="true">{$oComptes.compte_libelle}</a>
								</li>
								{/if}
								{/foreach}
							</ul>
							{/if}
						</li>

						<li class=" mihamalefaka dropdown">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle" style="font-size:1.2em;" aria-expanded="false">
								<img class="nav-user-photo" src="{$zImageUrl}" alt="Photo de {$oCandidat[0]->nom}&nbsp;{$oCandidat[0]->prenom}">
									<span id="username">
									{if $oCandidat[0]->nom!='' && $oCandidat[0]->prenom !=''}
									{$oCandidat[0]->nom}&nbsp;{$oCandidat[0]->prenom}
									{else}
									{$oUser.nom}&nbsp;{$oUser.prenom}
									{/if}
									</span>

								<i class="ace-icon la la-caret-down bigger-110 width-auto"></i>
							</a>
							<ul class="dropdown-menu dropdown-info dropdown-menu-right">
								
								<li>
									<a href="{$zBasePath}cv/mon_cv">
										<i class="ace-icon la la-user"></i>
										Mon CV
									</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="{$zBasePath}gcap/deconnexion">
										<i class="ace-icon la la-power-off"></i>
										Déconnexion
									</a>
								</li>
								<li>
									<a href="{$zBasePath}cv/changePassword">
										<i class="ace-icon la la-power-off"></i>
										Déconnexion
									</a>
								</li>
								
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div><!-- /.navbar-container -->
		</div>
        <div id="mainHeaderMenu" {if $oData.iModuleId == -1} class="formationMenuNav" style="display:none;" {/if}>
			{if $oData.iModuleId == -1}
			<nav>
				<ul>
				<li>
					<a >OFFRES</a>
					<ul style="width:230px;">
							<li><a href="{$zBasePath}sfao/page/offres-locales">Offres locales</a></li>
							<li><a href="{$zBasePath}sfao/page/bourses">Bourses</a></li>
							<li><a href="{$zBasePath}sfao/page/concours">Concours</a></li>
							<li><a href="{$zBasePath}sfao/page/formations-payantes">Formations externes payantes</a></li>
					</ul>
				</li>
				<li>
					<a >REPORTING</a>
					<ul style="width:230px;">
							<li><a href="{$zBasePath}sfao/page/rapports-de-formations">Rapports de formations</a></li>
							<li><a href="{$zBasePath}sfao/page/autres-rapports">Autres Rapports</a></li>
					</ul>
				</li>
				<li>
					<a >LIENS UTILES</a>
					<ul style="width:230px;">
							<li><a href="{$zBasePath}sfao/page/textes-de-references">Textes de réferences</a></li>
							<li><a href="{$zBasePath}sfao/page/documents-points-focaux-formations">Documents points focaux formations</a></li>
							<li><a href="{$zBasePath}sfao/page/info-com" >INFO COM</a></li>
					</ul>
				</li>
				<li>
					<a >ARCHIVES</a>
					<ul style="width:230px;">
						<li><a href="{$zBasePath}sfao/page/photos" >Photos</a></li>
						<li><a href="{$zBasePath}sfao/page/trombinoscope" >Trombinoscope</a></li>
					</ul>
				</li>
			</ul>

			</nav>
			{else}
            <nav>
				<ul>
				{assign var="iTest" value="0"}
				{assign var="i" value="1"}
				{foreach from=$toMenus item=oMenus }
				
				{if  $oMenus.page_parent != 0}

					{if $i == 1}
						{if $iTest == 0}
						 {assign var="iTest" value="1"}
						{/if}
						
					<ul style="width:230px;">
					{assign var="i" value="0"}
					{/if}
				{else}
					{assign var="i" value="1"}
					{if $iTest == 1}
					</ul>
					{assign var="iTest" value="0"}
					{/if}
				{/if}
				<li {if $oData.menu == $oMenus.page_id}class="active"{/if}><a {if $oMenus.page_target==1} target="_blank" {/if} {if  $oMenus.page_url != '#'}href="{$zBasePath}{$oMenus.page_url}"{/if}><i class="fa {$oMenus.page_icone}"></i>&nbsp;&nbsp;{$oMenus.page_libelle}</a>

				{if  $oMenus.page_parent != 0}
				</li>
				{/if}
				{/foreach}
				</ul></li>
            </nav>
		   {/if}
			
        </div>
    </header>
<!-- start fondPartage-->
<!--
<div class="fondPartage">
	<a href="{$zBasePath}common/plandusite/">	<img style="width:35px" src="{$zBasePath}assets/gcap/images/trie.png"/><br/>	<span>Plan du Site</span>	</a>	<a href="{$zBasePath}common/contact">	<img style="width:35px" src="{$zBasePath}assets/gcap/images/coeur.png"/><br/>	<span>Contact</span>	</a>	<a href="{$zBasePath}common/contacteznous">	<img style="width:35px" src="{$zBasePath}assets/gcap/images/main.png"/><br/>	<span>Nous contacter</span>	</a> 
</div>
-->
{literal}
<style>
/*start fondPartage*/
.fondPartage{
  width: 84px;
  border: solid 1px #fff;
  border-radius: 1px;
  -moz-border-radius:1px;
  -webkit-border-radius:1px;
  position: fixed;
  right: 0;
 /* top: 10%;*/
  z-index: 9999;
   opacity: 0;
    visibility: hidden;
   /* -webkit-transform: translateX(80px);
    -moz-transform: translateX(80px);
    -o-transform: translateX(80px);
    transform: translateX(80px);
    -webkit-transition: all 500ms ease;
    -moz-transition: all 500ms ease;
    -o-transition: all 500ms ease;
    transition: all 500ms ease*/
}
.fondPartage.visible {
    opacity: 1;
    visibility: visible;
   /* -webkit-transform: translateX(0);
    -moz-transform: translateX(0);
    -o-transform: translateX(0);
    transform: translateX(0)

    transform: translateX(0)*/

}

.fondPartage a{
  padding-top: 14px;
  padding-bottom: 7px;
  padding-left: 7px;
  padding-right: 7px;
  width: 70px;
  display: block;
  text-align: center;
  border-bottom: solid 1px #fff;
  background: #0cbd49;
 
}

.fondPartage a:first-child{
  background: #0aad42;
}
.fondPartage a:last-child{
  border: none
}
.fondPartage a img{
  margin-bottom: 11px;
}
.fondPartage a span{
   font-family: 'LatoBold',arial;
   font-size: 12px;
   color: #fff;
  line-height: 16px;
  text-transform: uppercase;
}
.fondPartage {
    position: fixed;
    right: 0;
    top: 38%;
    margin-right: 7px;
    z-index: 8;
    visibility: visible;
    opacity: 1;
    /*top: 590px;*/
}

#calendar {
    font-size:1.2em;
}

@media only screen and (max-width: 1300px) {
	#boutonCalendrier{ display:none;};
}

@media only screen and (min-width: 1301px) {
	#boutonCalendrier{ display:block;};
}

@media (min-width: 480px) and (max-width: 540px),
(max-width: 360px) {
	.user-menu {width:350px;}
}
</style>
{/literal}