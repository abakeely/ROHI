{include_php file=$zCssJs}
{include_php file=$zHeader}
<div id="container">
	<div id="breadcrumb">&nbsp;
	
	</div>
	
    <section id="content">
        {include_php file=$zLeft}	
		<div id="innerContent">
		<div id="ContentBloc" class="dialog-link-manuel-localite11">
				<input type="hidden" name="iUserId" id="iUserId" value="{$oData.iUserId}">
                <h2>
                    Communiqué
                </h2>
				<div id="breadcrumb">Fil d'ariane&nbsp;&nbsp;:&nbsp;&nbsp;<a style="text-decoration:none;" href="{$zBasePath}">Accueil</a> <span>&gt;</span> Communiqué</div>
				{* <div id="contenantVideo" style="display:none">
					<video id="largeVideo" width="100%" webkit-playsinline="true" autoplay="no" loop="yes" muted="true" data-weborama-videoplayer="true" preload="metadata" autobuffer="false" style="position: center; left: 0px; top: 0px; z-index: 200;" title="Double clic pour plein écran">
						<source type="video/mp4" src="{$zBasePath}assets/mfb.mp4">
					</video>
				</div> *}
                <div class="SSttlPage">
                    <div class="sort-Listing">
                        <ul class="nav ace-nav">
                            <li class="malefaka1 dropdown pull-left">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="http://rohi.dev/accueil/communique#" aria-expanded="false">
                                    Catégorie
                                    <i class="ace-icon la la-caret-down"></i>
                                </a>
								<input type="hidden" name="setDialog7" id="setDialog7" value="0">
                                <ul class="dropdown-menu">
									{foreach from=$oData.toCategorieRc item=toCategorieRc }
                                    <li>
                                        <a categorieid="{$toCategorieRc.categorieRc_id}" href="{$zBasePath}accueil/communique/{$toCategorieRc.categorieRc_id}" class="SelectCompte" style="cursor:pointer" aria-expanded="true">{$toCategorieRc.categorieRc_libelle}</a>
                                    </li>
                                   {/foreach}
									<li>
										<a categorieId="0" href="{$zBasePath}accueil/communique" class="SelectCompte" style="cursor:pointer" aria-expanded="true">Tous</a>
									</li>
                                </ul>
                            </li>
                            <li class="pull-right">
                                <span class="list-style-buttons">
                                    <a href="#" id="gridview" class="switcher active"><i class="la la-th-large" ></i></a>
                                    <a href="#" id="listview" class="switcher"><i class="la la-th-list" ></i></a>
                                </span>
                            </li>
                        </ul>

                    </div>
                </div>
                <div class="contenuePage">

					{assign var=iTest value="0"}
					{foreach from=$oData.toListe item=toListe }
						{if $toListe.revueCommunique_urgent==1}
						{assign var=iTest value="1"}
						{/if}
					{/foreach}  
					{if $iTest==1}
                    <div class="slider_slick">
                        <ul id="slide_slick">
                            {assign var=iIncrement value="0"}
							{if sizeof($oData.toListe)>0}
							{foreach from=$oData.toListe item=toListe }
							{if $toListe.revueCommunique_urgent ==1}
							<li>
                                
												{if $toListe.revueCommunique_image!=''}

													<div class="img_slick" style="background-image: url({$zBasePath}assets/accueil/upload/{$toListe.revueCommunique_image});">
												{else}
						
													<div class="img_slick" style="background-image: url({$zBasePath}assets/common/img/mef.jpg);">
												{/if}
												
												<span class="slidePict">
												   <img src="{$zBasePath}assets/common/img/icons/{$toListe.categorieRc_photoBg}" alt=""/> 
												</span>
												
											</div>
                                    <div class="captionSlide">
                                        <div class="contentMfb" >
														<p>{$toListe.categorieRc_libelle}</p>
                                                <a target="_blank"  href="{$zBasePath}assets/accueil/upload/{$toListe.revueCommunique_fichier}">
                                                    {$toListe.revueCommunique_titre}
                                                </a>
                                            <span ><br>Catégorie : {$toListe.categorieRc_libelle}</span>
                                            <span class="date">Publié le {$toListe.revueCommunique_date|date_format|utf8}</span>
                                            <p class="descCommunique">{$toListe.revueCommunique_descCourt}</p>
                                        </div>
                                    </div>
                                
                            </li>
                            {assign var=iIncrement value=$iIncrement+1}
							{/if} 
							{/foreach}
							{/if}   
                        </ul>
                    </div>
					{/if}
                    <div id="liste-Comm">
                        <ul id="products" class="grid">
                            {assign var=iIncrement value="0"}
							{if sizeof($oData.toListe)>0}
							{foreach from=$oData.toListe item=toListe }
							{if $toListe.revueCommunique_urgent!=1}
							
									<li class="clearfix" data-aos="fade-up" data-aos-duration="1000">
										<div class="margecomm">
											{if $toListe.photo!=''}
											<div class="photo photoLab"  style="background: url('{$toListe.photo}') no-repeat;background-position: center;">
												<a style="background:none!important;cursor:pointer;text-decoration:none" target="_blank" href="{$zBasePath}assets/accueil/upload/{$toListe.revueCommunique_fichier}">
												</a>
											</div>
											{else}
											 <div class="photo" style="background: url('img/no-photo.jpg') top center no-repeat;">
											<a style="cursor:pointer;text-decoration:none" target="_blank"  href="{$zBasePath}assets/accueil/upload/{$toListe.revueCommunique_fichier}">
												<img src="{$zBasePath}assets/common/img/icons/{$toListe.categorieRc_photoBg}" alt=""/> {$toListe.categorieRc_libelle}
											</a>
										</div>
											{/if}
											<div class="contentMfb">
														<span class="title">
															
															<a title="{$toListe.revueCommunique_titre}" alt="{$toListe.revueCommunique_titre}" style="cursor:pointer;text-decoration:none" {if $toListe.revueCommunique_type==1} target="_blank" href="{$zBasePath}assets/accueil/upload/{$toListe.revueCommunique_fichier}" {else} href="#" onclick="showVideo('{$toListe.revueCommunique_url}')" {/if}>{$toListe.revueCommunique_titre|truncate:90}</a>
														</span>
												<span class="slide" style="padding-top:5px">Catégorie : {$toListe.categorieRc_libelle}</span>
												<span class="date">Publié le {$toListe.revueCommunique_date|date_format|utf8}</span>
												<p class="descCommunique" title="{$toListe.revueCommunique_descCourt}" alt="{$toListe.revueCommunique_descCourt}">{$toListe.revueCommunique_descCourt}</p>
											</div>
										</div>
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
		<div id="calendar"></div>
		<div class="dialog-link-manuel-localite22"></div>
    </section>

    <section id="rightContent" class="clearfix">
		{include_php file=$zRight}
	</section>
    {include_php file=$zFooter}
</div>
<div id="dialog3" title="Dialog Title">
</div>
<div id="dialog6" title="Dialog Title">
</div>
<div id="dialog7" title="Information"></div>
<div id="dialog" title="">
  <img src="{$zBasePath}assets/common/img/fitsipika.png" alt=""/> 
</div>
{literal}

<script>
function showVideo(_zVideo) {
	$("#dialog7").html('<video id="largeVideo" width="100%" webkit-playsinline="true" autoplay="no" loop="yes" data-weborama-videoplayer="true" preload="metadata" controls="true" style="position: center; left: 0px; top: 0px; z-index: 200;"><source type="video/mp4" src="{/literal}{$zBasePath}{literal}assets/' + _zVideo + '"></video>');
	//$("#dialog7").dialog("open")
}
function getExtension(chemin) {
    var regex = /[^.]*$/i;
    var resultats = chemin.match(regex);
    return resultats[0]
}
$(document).ready(function() {
		 //$('#popop_img').modal();
		//$("#dialog").dialog("open");
        $("#popop_img").modal(
			{
				backdrop: 'static',
				keyboard: true, 
				show: true,
				opacity: 0.9
			}
		);
		
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
	line-height:18px!important;
}

.ui-dialog-buttonset{
	display:none;
}

#maj_login{
	padding:10%;
}
.title{
	font-size:20px;
	color:#ff8300;
}
</style>
{/literal}
</body>
</html>