<input type="hidden" name="sizeListe" id="sizeListe" value="{$iCountListe}">
<input type="hidden" name="sizeSortie" id="sizeSortie" value="{$iCountSortie}">
<div class="row">
	<div class="col-sm-12">
		<h3 class="header blue lighter smaller">
			<i class="ace-icon la la-calendar-o smaller-90"></i>
			RECHERCHE PAR DATE
		</h3>
		<div class="">
			<div class="col-xs-3 cellinfo">
				<div class="input-group input-group-sm">
					<input type="text" placeholder="Date début" id="date_debut" value="{$zDateDebut}" class="form-control datedropper-range-fiche obligatoire" />
					<span class="input-group-addon">
						<i class="ace-icon la la-calendar"></i>
					</span>
				</div>
			</div>
			<div class="col-xs-3 cellinfo">
				<div class="input-group input-group-sm">
					<input type="text" placeholder="Date fin" id="date_fin" value="{$zDateFin}" class="form-control datedropper-range-fiche obligatoire" />
					<span class="input-group-addon">
						<i class="ace-icon la la-calendar"></i>
					</span>
				</div>
			</div>

			<div class="col-xs-5 cellinfo">
				<div class="input-group input-group-sm">
					<button style="width:125px;margin-right:15px!important;" class="btn btn-xs btn-succes submitSearch">
						Rechercher
						<i class="ace-icon la la-arrow-right icon-on-right"></i>
					</button>
					
					<button style="width:125px;background-color:green!important;border-color:green!important" class="btn btn-xs btn-succes sumbitRafraichir">
						Rafraîchir
						<i class="ace-icon la la-refresh"></i>
					</button>
				</div>
			</div>
		</div>
	</div><!-- ./span -->
</div>
		<div class="clearfix">
			<div class="tableTools-container"></div>
		</div>
		<br>
		<div class="col-xs-12">
			<div class="tabbable">
				<ul class="nav nav-tabs" id="myTab1" style="font-size:17px">
					<li class="active" id="liEnVisite">
						<a data-toggle="tab" href="#EnVisite">
							En visite
						</a>
					</li>
					<li id="liEnSortie">
						<a data-toggle="tab" href="#EnSortie">
							En sortie
						</a>
					</li>
				</ul>
			</div>
		</div><!-- /.col -->
		<br>
		<div class="col-xs-12">
		<div class="table-header">
			<span id="resultatPour">Résultat pour les visiteurs du jour</span>
		</div>	

		<div class="col-xs-12" style="padding:0px;" id="EnVisite" style="display:block;">
			<table id="dynamic-table" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>
							Badge
						</th>
						<th class="hidden-nom center">Nom</th>
						<th>Prénom</th>
						<th class="hidden-porte">Porte</th>
						<th class="hidden-date">Date</th>
						<th class="hidden-heureEntree">
							<i class="ace-icon la la-clock-o bigger-110 hidden-480"></i>
							Heure d'entrée
						</th>
						<th class="center">Action</th>
					</tr>
				</thead>

				<tbody>
					{if sizeof($oListe)>0}
					{foreach from=$oListe item=oListe }
					<tr>
						<td>{$oListe.badge_nom}</td>
						<td class="hidden-nom">
							<a href="#">{$oListe.visiteur_nom|upper}</a>
						</td>
						<td>{$oListe.visiteur_prenom}</td>
						<td class="hidden-porte">{$oListe.porte_nom}</td>
						
						<td class="hidden-date">{$oListe.visite_date|date_format:"%d/%m/%Y"}</td>
						<td class="hidden-heureEntree">{$oListe.visite_heureEntree}</td>
						<td>
							<div class="hidden-sm hidden-xs action-buttons">
								{if $oListe.visite_heureSortie == ''}
								<button class="btn btn-xs btn-danger submitSortie" setId="{$oListe.visite_id}">
									Sortie
									<i class="ace-icon la la-arrow-right icon-on-right"></i>
								</button>
								{/if}
							</div>

							<div class="hidden-md hidden-lg">
								<div class="inline pos-rel">
									<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
										<i class="ace-icon la la-caret-down icon-only bigger-120"></i>
									</button>

									<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
										<li>
											<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
												<span class="blue">
													<i class="ace-icon la la-search-plus bigger-120"></i>
												</span>
											</a>
										</li>

										<li>
											<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
												<span class="green">
													<i class="ace-icon la la-pencil-square-o bigger-120"></i>
												</span>
											</a>
										</li>

										<li>
											<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
												<span class="red">
													<i class="ace-icon la la-trash-o bigger-120"></i>
												</span>
											</a>
										</li>
									</ul>
								</div>
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

		<div class="col-xs-12" style="padding:0px;" id="EnSortie" style="display:none;">
				<table id="sortieTable" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>
								Badge
							</th>
							<th class="hidden-nom center">Nom</th>
							<th>Prénom</th>
							<th class="hidden-porte">Porte</th>
							<th class="hidden-date">Date</th>
							<th class="hidden-heureEntree">
								<i class="ace-icon la la-clock-o bigger-110 hidden-480"></i>
								Heure d'entrée
							</th>
							<th>
								<i class="ace-icon la la-clock-o bigger-110 hidden-480"></i>
								Heure de sortie
							</th>
						</tr>
					</thead>

					<tbody>
						{if sizeof($oListeSortie)>0}
						{foreach from=$oListeSortie item=oListe }
						<tr>
							<td>{$oListe.badge_nom}</td>
							<td class="hidden-nom center">
								<a href="#">{$oListe.visiteur_nom|upper}</a>
							</td>
							<td>{$oListe.visiteur_prenom}</td>
							<td class="hidden-porte">{$oListe.porte_nom}</td>
							
							<td class="hidden-date">{$oListe.visite_date|date_format:"%d/%m/%Y"}</td>
							<td class="hidden-heureEntree" >{$oListe.visite_heureEntree}</td>
							<td>
								{$oListe.visite_heureSortie}
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
</div>
{literal}
<style>

@media only screen and (max-width: 1300px){
	.cellinfo {
		width: 100%!important;
		float: none!important;
		padding:10px!important;
	}
}

@media only screen and (max-width: 1500px){
	
	.hidden-porte {
		display:none!important;
	}
	
	.hidden-heureEntree {
		display:none!important;
	}
}


@media only screen and (max-width: 1500px){
	.hidden-heureEntree {
		display:none!important;
	}

	.hidden-date {
		display:none!important;
	}

	.hidden-nom {
		display:none!important;
	}

	.hidden-porte {
		display:none!important;
	}

	

}
.tableTools-container {
	padding-left:10px;
	padding-top:20px;
}
table {
	font-size:1.2em!important;
}
</style>
<script type="text/javascript">

	$(document).ready (function ()
	{
		$( ".datepicker" ).datepicker({
			dateFormat: "dd/mm/yy",
			showOtherMonths: true,
			selectOtherMonths: false,

		});

		$( ".fa-calendar" ).datepicker({
			dateFormat: "dd/mm/yy",
			showOtherMonths: true,
			selectOtherMonths: false,

		});
		
		$(".submitSortie").on('click', function(e) {
			var iVisitId = $(this).attr("setId");
			var zDateDebut = $("#date_debut").val();
			var zDateFin   = $("#date_fin").val();
			$.ajax({
				url: "{/literal}{$zBasePath}{literal}sau/setUpdateVisit" ,
				method: "POST",
				data: {iVisitId:iVisitId},
				success: function(data, textStatus, jqXHR) {
					listeVisiteToDay(zDateDebut, zDateFin);
					$("#liEnSortie").removeClass("active");
					$("#liEnVisite").addClass("active");
					$("#EnVisite").show();
					$("#EnSortie").hide();
					$("#dynamic-table").show();
					$("#sortieTable").hide();
				},
				async: false
			});
		});

		$(".submitSearch").on('click', function(e) {
			var zDateDebut = $("#date_debut").val();
			var zDateFin   = $("#date_fin").val();

			listeVisiteToDay(zDateDebut, zDateFin);
			if (zDateDebut=='' && zDateFin==''){
				$("#titleVisiteur").html("Liste des visiteurs ajoutés aujourd'hui");
				$("#resultatPour").html("Résultat pour les visiteurs du jour");
			} else {
				if (zDateDebut != zDateFin) {
					$("#titleVisiteur").html("Liste des visiteurs du " + zDateDebut + " au " + zDateFin);
					$("#resultatPour").html("Résultat pour les visiteurs du " + zDateDebut + " au " + zDateFin);
				} else {
					$("#titleVisiteur").html("Liste des visiteurs du " + zDateDebut );
					$("#resultatPour").html("Résultat pour les visiteurs du " + zDateDebut );
				}
				$("#countVisit").html('');
			}
			
		});

		$(".sumbitRafraichir").on('click', function(e) {
			var zDateDebut = $("#date_debut").val();
			var zDateFin   = $("#date_fin").val();

			listeVisiteToDay(zDateDebut, zDateFin);
			if (zDateDebut=='' && zDateFin==''){
				$("#titleVisiteur").html("Liste des visiteurs ajoutés aujourd'hui");
				$("#resultatPour").html("Résultat pour les visiteurs du jour");
			} else {
				if (zDateDebut != zDateFin) {
					$("#titleVisiteur").html("Liste des visiteurs du " + zDateDebut + " au " + zDateFin);
					$("#resultatPour").html("Résultat pour les visiteurs du " + zDateDebut + " au " + zDateFin);
				} else {
					$("#titleVisiteur").html("Liste des visiteurs du " + zDateDebut );
					$("#resultatPour").html("Résultat pour les visiteurs du " + zDateDebut );
				}
				$("#countVisit").html('');
			}
			
		});

		

		$('#myTab1 a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

			if($(e.target).attr('href') == "#EnVisite"){
				$("#EnVisite").show();
				$("#EnSortie").hide();
				$("#sortieTable").hide();
				$("#dynamic-table").show();
				
			} else {
				$("#EnVisite").hide();
				$("#EnSortie").show();
				$("#dynamic-table").hide();
				$("#sortieTable").show();

			}
			
		})

		
	});
	
	if($("#sizeListe").val() > 0) { 

		$("#EnVisite").show();
		$("#EnSortie").hide();
		$("#sortieTable").hide();
		$("#dynamic-table").show();

		jQuery(function($) {
			
			var myTable = 
			$('#dynamic-table')
			.DataTable( {
				bAutoWidth: false,
				"aoColumns": [
				 null,null, null,null,null, null,
				  { "bSortable": false }
				],
				"aaSorting": [],
				
				select: {
					style: 'multi'
				},
				"iDisplayLength": 100
			} );
			
			
			$.fn.dataTable.Buttons.defaults.dom.container.className = '';
			
			new $.fn.dataTable.Buttons( myTable, {
				buttons: [
				  {
					"extend": "colvis",
					"text": "<i class='la la-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
					"className": "btn btn-white btn-primary btn-bold",
					columns: ':not(:first):not(:last)'
				  },
				  {
					"extend": "copy",
					"text": "<i class='la la-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
					"className": "btn btn-white btn-primary btn-bold"
				  },
				  {
					"extend": "csv",
					"text": "<i class='la la-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
					"className": "btn btn-white btn-primary btn-bold"
				  },
				  {
					"extend": "excel",
					"text": "<i class='la la-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
					"className": "btn btn-white btn-primary btn-bold"
				  },
				  {
					"extend": "pdf",
					"text": "<i class='la la-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
					"className": "btn btn-white btn-primary btn-bold"
				  },
				  {
					"extend": "print",
					"text": "<i class='la la-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
					"className": "btn btn-white btn-primary btn-bold",
					autoPrint: false,
					message: 'This print was produced using the Print button for DataTables'
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
		
			$(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
				e.stopImmediatePropagation();
				e.stopPropagation();
				e.preventDefault();
			});
			
			
			
		})
	} else {
	
		$("#liEnSortie").addClass("active");
		$("#liEnVisite").removeClass("active");
		$("#EnVisite").hide();
		$("#EnSortie").show();
		$("#dynamic-table").hide();
		$("#sortieTable").show();
	}

	if($("#sizeSortie").val() > 0) { 

		jQuery(function($) {
			
			var myTableSortie = 
			$('#sortieTable')
			.DataTable( {
				bAutoWidth: false,
				"aoColumns": [
				 null,null, null,null,null, null,
				  { "bSortable": false }
				],
				"aaSorting": [],
				
				select: {
					style: 'multi'
				}
			} );


			
			
		})
	}

	
	{/literal}
</script>
