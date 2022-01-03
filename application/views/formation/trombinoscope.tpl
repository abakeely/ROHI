{include_php file=$zCssJs}
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">
									Trombinoscopes{if $oData.iSessionCompte == COMPTE_AUTORITE || $oData.iSessionCompte == COMPTE_ADMIN}
									&agrave; finaliser
									{elseif $oData.iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL}
									&agrave; imprimer
									{/if}
								</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">Formation</a></li>
									<li class="breadcrumb-item"><a href="{$zBasePath}formation/programmeFormation/formation/programme-formation">Reporting</a></li>
									<li class="breadcrumb-item">Fichier unique de formation</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<div class="">

									{literal}		
									<style>
										button {
											padding: 4px 20px;
											background-color: #A9A9A9;
											border: 1px solid white! important;
										}

										th, td {
										border:1px solid #E6E6FA;
										width:20%;
										}
										td {
										text-align:center;
										}
										caption {
										font-weight:bold
										}
										
										/* Style des lignes de séparation */
										.table-separateur {
										font-size : 12px;
										font-family : Verdana, arial, helvetica, sans-serif;
										color : #333333;
										background-color :#F5F5F5;
										}

										.th_livre{
												background: Teal
											}	


										.zoom {
											height:160px;
												}
											.zoom p {
											text-align:center;
											}
											.zoom img {
											width:200px;
											height:190px;
											}
											.zoom img:hover {
											width:250px;
											height:210px;
										}
									
									</style>
									{/literal}
									<br><br>

									<div id="wowslider-container1">
										<div class="ws_images">
											<ul>
												<?php $i=1;foreach($list_image as $img){?>
												<li><img src="<?php echo base_url('assets/img/img_sfao/'.$img);?>" alt="" title="" id="wows1_<?php echo $i;?>"/></li>	
												<?php $i++;}?>			
											</ul>
										</div>
										<div class="ws_script" style="position:absolute;left:-99%"></div>
										<div class="ws_shadow"></div>
									</div>	
							
									{literal}  
									<script type="text/javascript" src="{$zBasePath}assets/sad/sfao/wowslider.js"></script>
									<script type="text/javascript" src="{$zBasePath}assets/sad/sfao/script.js"></script>
									{/literal}

								</div>
								<div id="calendar"></div>
								<form name="formDelete" id="formDelete" action="{$zBasePath}gcap/delete/{$oData.zHashModule}/{$oData.zHashUrl}" method="POST">
									<input type="hidden" name="zMessage" id="zMessage" value="&Ecirc;tes vous s&ucirc;r de vouloir supprimer cet enregistrement ?">
									<input type="hidden" name="AucunResultat" id="AucunResultat" value="Aucun r&eacute;sultat trouv&eacute;">
									<input type="hidden" name="chargement" id="chargement" value="Chargement des r&eacute;sultats ...">

									<input type="hidden" name="idSelect" id="idSelect" value="{if sizeof($oData.oCandidatSearch)>0}{$oData.oCandidatSearch->user_id}{/if}">
									<input type="hidden" name="textSelect" id="textSelect" value="{if sizeof($oData.oCandidatSearch)>0}{$oData.oCandidatSearch->nom}&nbsp;{$oData.oCandidatSearch->prenom}{/if}">

									<input type="hidden" name="iElementId" id="iValueId" value="">
									<input type="hidden" name="zUrl" id="zUrl" value="{$zBasePath}gcap/liste/{$oData.zHashModule}/{$oData.zHashUrl}">
								</form>
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