{include_php file=$zCssJs}
        <div class="main-wrapper">
			{include_php file=$zHeader}
			<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/galop/css/jquery.galpop.css">
			<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/galop/css/vote.css">
			<script type="text/javascript" src="{$zBasePath}assets/galop/js/popper.min.js"></script>
			<script src="{$zBasePath}assets/galop/js/bootstrap.min.js"></script>
			<link href="{$zBasePath}assets/galop/css/font-awesome.min.css" rel="stylesheet" />
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<!--h3 class="page-title">Communiqué</h3-->
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item">Communiqué</li>
								</ul>
							</div>
					
					
						<div class="tabs section" id="RevueBlock" style="margin: 0px 15px 0 15px;">
							<ul class="nav nav-tabs " style="background:none" role="tablist">
							   {foreach from=$oData.toCategorieRc item=toCategorieRc }
									<li style="" {if ($oDistinctAnnee.iAnnee==$oData.zDateEnCours|date_format:"%Y"|intval)} class="active"{/if}><a href="#" data-search="categ{$toCategorieRc.categorieRc_id}" class="btn-flip" role="tab" data-toggle="tab">{$toCategorieRc.categorieRc_libelle}</a></li>
								{/foreach}
							</ul>
						</div>
					
					
					<!-- /Page Header -->
						<div class="col-xs-12">
							<div class="box">
									<div class="card-bodyT">
										<ul>
												{assign var=iIncrement value="0"}
												{if sizeof($oData.toListe)>0}
												{foreach from=$oData.toListe item=toListe }
												{if $toListe.revueCommunique_urgent!=1}
												<li class="btn-flip1 categ{$toListe.categorieRc_id}">
												  <a {if $toListe.revueCommunique_url!=""} style="cursor:pointer;" id="hafatra" onclick="showVideo('{$toListe.revueCommunique_url}', '{$toListe.revueCommunique_titre|lower|ucfirst|truncate:50:"...":true}')"   {else} class="galpop-single11" target="_blank" href="{$zBasePath}assets/accueil/upload/{$toListe.revueCommunique_fichier}{$toListe.revueCommunique_url}"  {/if} >
													<img class="communiquepostit vert" src="{$zBasePath}assets/light/assets/img/14696.png">
													<h2 style="margin:0">{$toListe.revueCommunique_titre|lower|ucfirst|truncate:50:"...":true}</h2>
													{if $toListe.revueCommunique_image != ''}
													<img height="30%" width="100%" src="{$zBasePath}/assets/accueil/upload/{$toListe.revueCommunique_image}">
													{/if}
													{if $toListe.revueCommunique_image != ''}
													<p>{$toListe.revueCommunique_descCourt|lower|ucfirst|truncate:110:"...":true}</p>
													{else}
													<p>{$toListe.revueCommunique_descCourt|lower|ucfirst|truncate:140:"...":true}</p>
													{/if}
													<p>Catégorie : {$toListe.categorieRc_libelle}</p>
												  </a>
												</li>
												{assign var=iIncrement value=$iIncrement+1}
												{/if}
												{/foreach}
												{else}
												<p style="font-size:1.2em;">Aucun enregistrement correspondant</p>
												{/if}       
										  </ul>
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
		<script type="text/javascript" src="{$zBasePath}assets/galop/js/jquery.galpop.js"></script>
		<script src="{$zBasePath}assets/js/jquery.maskedinput.js?V2"></script>
		<script type="text/javascript">
		{literal}
		$(document).ready(function() {

			$('.galpop-single').galpop();
		});
		
		</script>
		{/literal}
		<div id="dialog7" title="Information"></div>	
		{include_php file=$zFooter}
	
{literal}

<script>
function showVideo(_zVideo, _zTtile) {
	$("#dialog7").html('<video controls="false" id="largeVideo" width="100%" webkit-playsinline="true" autoplay="no" loop="no" data-weborama-videoplayer="true" preload="metadata" controls="true" style="position: center; left: 0px; top: 0px; z-index: 200;"><source type="video/mp4" src="{/literal}{$zBasePath}{literal}assets/accueil/upload/' + _zVideo + '"></video>');
	$("#dialog7").dialog('option', 'title', _zTtile);
	
	
	//$("#largeVideo").play();
	$("#dialog7").dialog("open");
}
function getExtension(chemin) {
    var regex = /[^.]*$/i;
    var resultats = chemin.match(regex);
    return resultats[0]
}

$(document).ready(function() {
		 
		$("#dialog7").dialog({width:'50%',modal:!0,autoOpen:true,dialogClass:'myPosition',close:function(){document.getElementById("largeVideo").pause()}})
		$("#hafatra").click();
		
		{/literal}{if $oData.iAfficheMinistre==1}{literal}
		
		{/literal}{else}{literal}
		$("#dialog7").dialog("close");
		{/literal}{/if}{literal}
		
		$(".content").scroll(function()
		{
			AOS.init();
		});
		//$('#popop_img').modal();
		//$("#dialog").dialog("open");
        /*$("#popop_img").modal(
			{
				backdrop: 'static',
				keyboard: true, 
				show: true,
				opacity: 0.9
			}
		);*/
		
		$('.malefaka').click(function() {
			var idActive = $(this).attr('idActive');
			$('.malefaka a').removeClass("active");
			$(this).find('a').addClass("active");
			$(".all").hide();
			$("." + idActive).show()
		})

		$("#slide_slick").slick({
			dots: true,
			arrows: true,
			infinite: true,
			autoplay: false,
			autoplaySpeed: 2000,
			slidesToShow: 1,
			slidesToScroll: 1
		});
 });
  AOS.init();
</script>
<style>



#liste-Comm {
	line-height:12px!important;
}

.ui-dialog-buttonset{
	/*display:none;*/
}

#RevueBlock ul.nav-tabs li {
    border: none;
    box-shadow: none;
    padding-left: 3px;
    margin-bottom: 3px;
}

#RevueBlock ul.nav-tabs li a {
    color: black!important;
    background: #eaae62;
    font-size: 11px;
}

#maj_login{
	padding:10%;
}
</style>
{/literal}
</body>
</html>