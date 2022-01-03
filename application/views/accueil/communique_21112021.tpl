{include_php file=$zCssJs}
        <div class="main-wrapper">
			{include_php file=$zHeader}
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
						</div>
					</div>
					<div>
					<div>
						{foreach from=$oData.toCategorieRc item=toCategorieRc }
							<a href="#" class="btn-flip" data-search="categ{$toCategorieRc.categorieRc_id}" data-back="{$toCategorieRc.categorieRc_libelle}" data-front="{$toCategorieRc.categorieRc_libelle}"></a>
						{/foreach}
					</div>
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
												  <a  target="_blank"  href="{$zBasePath}assets/accueil/upload/{$toListe.revueCommunique_fichier}">
													<img class="communiquepostit vert">
													<h2>{$toListe.revueCommunique_titre|lower|ucfirst|truncate:50:"...":true}</h2>
													<p>{$toListe.revueCommunique_descCourt|lower|ucfirst|truncate:140:"...":true}</p>
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

		{include_php file=$zFooter}
		
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

#maj_login{
	padding:10%;
}
</style>
{/literal}
</body>
</html>