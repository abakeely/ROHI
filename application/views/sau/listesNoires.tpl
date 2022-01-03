{include_php file=$zCssJs}
<input type="hidden" name="switchBadgePorte" id="switchBadgePorte" value="1">
<input type="hidden" name="isListeNoire" id="isListeNoire" value="0">
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								{* <h3 class="page-title">Agents > Situation irrégulière</h3> *}
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
								<div class="no-skin">

									<div class="main-content-inner1">
									{include_php file=$zTileHeader}
									</div>
									<div class="main-container ace-save-state" id="main-container">
										<script type="text/javascript">
											
										</script>

										

										<div class="main-content">
											<div class="main-content-inner">
												<div class="breadcrumbs ace-save-state" id="breadcrumbs">
													<ul class="breadcrumb">
														<li>
															<i class="ace-icon la la-home home-icon"></i>
															<a href="#">Accueil</a>
														</li>

														<li>
															<a href="#">Gestion des visiteurs</a>
														</li>
														<li class="active">Liste noire</li>
													</ul><!-- /.breadcrumb -->

													<div class="nav-search" id="nav-search">
														<form class="form-search">
															<span class="input-icon">
																<input type="text" placeholder="Recherche ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
																<i class="ace-icon la la-search nav-search-icon"></i>
															</span>
														</form>
													</div><!-- /.nav-search -->
												</div>

												<div class="" id="liste">
													<div class="col-xs-12">
														
														<div class="clearfix">
															<div class="tableTools-container"></div>
														</div>
														<div class="table-header">
															Résultat pour les visiteurs dans la liste noire
														</div>

														<!-- div.table-responsive -->

														<!-- div.dataTables_borderWrap -->
														<div>
															<table id="dynamic-table" class="table table-striped table-bordered table-hover">
																<thead>
																	<tr>
																		<th>Nom</th>
																		<th>Prénom</th>
																		<th class="hidden-480">CIN</th>
																		<th class="hidden-480">Motifs</th>
																		<th>Action</th>
																	</tr>
																</thead>

																<tbody>
																	{if sizeof($oData.oListe)>0}
																	{foreach from=$oData.oListe item=oListe }
																	<tr>
																		<td>
																			<a href="#">{$oListe.visiteur_nom}</a>
																		</td>
																		<td>{$oListe.visiteur_prenom}</td>
																		<td><span class="label label-sm label-info arrowed arrowed-righ">{$oListe.visiteur_cin}</span></td>
																		<td>{$oListe.visiteur_motifsListeNoire}</td>
																		<td>
																			<div class="hidden-sm hidden-xs action-buttons">
																				<a  class="green submitSanction" href="#" setId="{$oListe.visiteur_id}">
																					<i style="color: #F10610;" class="ace-icon la la-close bigger-130"></i>
																				</a>
																			</div>
																		</td>
																	</tr>
																	{/foreach}
																	{else}
																	<tr><td style="text-align:center;border:none" colspan="12">Aucun enregistrement</td></tr>
																	{/if}
																</tbody>
															</table>
														</div>
													</div>
												</div>

												<!-- PAGE CONTENT ENDS -->
											</div><!-- /.col -->
										</div><!-- /.row -->
									</div><!-- /.page-content -->
								</div>
			
								<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
									<i class="ace-icon la la-angle-double-up icon-only bigger-110"></i>
								</a>
							</div>
						</div>

					</div>
				</div>
    		</div>
			<!-- /Page Content -->
					
        </div>
		<!-- /Page Wrapper -->
		<div id="dialog" title="Dialog Title"></div>
		<form name="leverSanction" id="leverSanction" method="POST" action="{$zBasePath}sau/leverSanction">
			<input type="hidden" name="iVisiteurId" id="iVisiteurId" value="">
		</form>
	</div>
	<!-- /Main Wrapper -->

{include_php file=$zFooter}

		
		<!-- basic scripts -->

		<!--[if !IE]> -->
		
		

		<!-- <![endif]-->

		<!--[if IE]>
<script src="{$zBasePath}assets/sau/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="{$zBasePath}assets/sau/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->
		<script src="{$zBasePath}assets/sau/js/jquery.dataTables.min.js"></script>
		<script src="{$zBasePath}assets/sau/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="{$zBasePath}assets/sau/js/dataTables.buttons.min.js"></script>
		<script src="{$zBasePath}assets/sau/js/buttons.flash.min.js"></script>
		<script src="{$zBasePath}assets/sau/js/buttons.html5.min.js"></script>
		<script src="{$zBasePath}assets/sau/js/buttons.print.min.js"></script>
		<script src="{$zBasePath}assets/sau/js/buttons.colVis.min.js"></script>
		<script src="{$zBasePath}assets/sau/js/dataTables.select.min.js"></script>
		
		<!-- ace scripts -->
		<script src="{$zBasePath}assets/sau/js/ace-elements.min.js"></script>
		<script src="{$zBasePath}assets/sau/js/ace.min.js"></script>
<script type="text/javascript">
{literal}
			
			
			
			jQuery(function($) {
				
				
				$(".submitSanction").on('click', function(e) {
					var iVisiteurId = $(this).attr("setId");

					if (confirm("Êtes vous sur de vouloir lever la sanction pour cet visiteur ?")){
						$("#iVisiteurId").val(iVisiteurId);
						$("#leverSanction").submit();
					}
					
				});
				
				//initiate dataTables plugin
				var myTable = 
				$('#dynamic-table')

				.DataTable( {
					bAutoWidth: false,
					"aoColumns": [
					 null,null,null, null,
					  { "bSortable": false }
					],
					"aaSorting": [],
					select: {
						style: 'multi'
					}
			    } );
				
				$.fn.dataTable.Buttons.defaults.dom.container.className = '';
				
				new $.fn.dataTable.Buttons( myTable, {
					buttons: [
					  {
						"extend": "colvis",
						"text": "<i class='la la-search bigger-110 blue'></i> <span class='hidden'>Afficher/Cacher colonne</span>",
						"className": "btn btn-white btn-primary btn-bold",
						columns: ':not(:first):not(:last)'
					  },
					  {
						"extend": "copy",
						"text": "<i class='la la-copy bigger-110 pink'></i> <span class='hidden'>Copier</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "csv",
						"text": "<i class='la la-database bigger-110 orange'></i> <span class='hidden'>Exporter en CSV</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "excel",
						"text": "<i class='la la-file-excel-o bigger-110 green'></i> <span class='hidden'>Exporter en excel</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "pdf",
						"text": "<i class='la la-file-pdf-o bigger-110 red'></i> <span class='hidden'>Exporter en PDF</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "print",
						"text": "<i class='la la-print bigger-110 grey'></i> <span class='hidden'>Imprimer</span>",
						"className": "btn btn-white btn-primary btn-bold",
						autoPrint: false,
						message: ''
					  }		  
					]
				} );
				myTable.buttons().container().appendTo( $('.tableTools-container') );
				
				//style the message box
				var defaultCopyAction = myTable.button(1).action();
				myTable.button(1).action(function (e, dt, button, config) {
					defaultCopyAction(e, dt, button, config);
					$('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
				});
				
				var defaultColvisAction = myTable.button(0).action();
				myTable.button(0).action(function (e, dt, button, config) {
					
					defaultColvisAction(e, dt, button, config);
					
					
					if($('.dt-button-collection > .dropdown-menu').length == 0) {
						$('.dt-button-collection')
						.wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
						.find('a').attr('href', '#').wrap("<li />")
					}
					$('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
				});
			
				////
			
				setTimeout(function() {
					$($('.tableTools-container')).find('a.dt-button').each(function() {
						var div = $(this).find(' > div').first();
						if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
						else $(this).tooltip({container: 'body', title: $(this).text()});
					});
				}, 500);
				
				
				myTable.on( 'select', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', true);
					}
				} );
				myTable.on( 'deselect', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', false);
					}
				} );
			
			
			
			
				/////////////////////////////////
				//table checkboxes
				$('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
				
				//select/deselect all rows according to table header checkbox
				$('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$('#dynamic-table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) myTable.row(row).select();
						else  myTable.row(row).deselect();
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
					var row = $(this).closest('tr').get(0);
					if(this.checked) myTable.row(row).deselect();
					else myTable.row(row).select();
				});
			
			
			
				$(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
					e.stopImmediatePropagation();
					e.stopPropagation();
					e.preventDefault();
				});
				
				
				
			})

			
			{/literal}
		</script>
