{include_php file=$zCssJs}
<link rel="stylesheet" href="{$zBasePath}assets/reclassement/css/style.css" />
<script src="{$zBasePath}assets/js/jquery.dataTables.js?V2"></script>
<script src="{$zBasePath}assets/js/dataTables.bootstrap.js?V2"></script>
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}


					{foreach from=$oData.oModuleActif item=oModuleActif }
						<h2>Accueil&nbsp;{$oModuleActif.module_libelle}</h2>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>{$oModuleActif.module_descriptionPage}</p>
						
						{if $oData.iModuleId == 2}
							<ul>
								<li><a href="{$zBasePath}assets/Decret.pdf" style="color:blue;text-decoration:underline;" target="_blank">D&eacute;cret n° 2004-812 du 24 ao&ucirc;t 2004 fixant le r&eacute;gime des cong&eacute;s, des permissions et des autorisations d'absence des fonctionnaires.</a>&nbsp;&nbsp;&nbsp;
								<a id="zonemsbb" class="fade" rel="example_group" onmouseover="over()" onmouseout="out()" alt="starbox-MSBB" title="Cliquez pour agrandir">
									<i id="image2" style="display:inline-block;color:#0089DC;font-size:16px;" title="Modifier" alt="Modifier" class="la la-search"></i>
								</a>
								
								</li>
							</ul>
							<img id="image" src="{$zBasePath}assets/Decret-1.png" style="display:none;width:800px;z-index:10000;position:absolute">
						{/if}
					{/foreach}

					<link rel="stylesheet" href="{$zBasePath}assets/common/css/fullcalendar.min.css"/>
					<div id="calendar"></div>

    			</div>
    		</div>
			<!-- /Page Content -->
					
        </div>
		<!-- /Page Wrapper -->

	</div>
	<!-- /Main Wrapper -->

{include_php file=$zFooter}