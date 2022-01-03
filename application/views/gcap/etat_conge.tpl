{include_php file=$zCssJs}
<script src="{$zBasePath}assets/easyweb/js/jquery_1.12.1.js"></script>
<script src="{$zBasePath}assets/easyweb/js/jquery-ui.min.js"></script>
<script src="{$zBasePath}assets/easyweb/js/jquery.multiselect.js"></script>
<script src="{$zBasePath}assets/message/js/mustache.js"></script>

<script src="{$zBasePath}assets/easyweb/js/jquery.jqGrid.min.js"></script>
<script src="{$zBasePath}assets/easyweb/js/grid.locale-en.js"></script>
<link href="{$zBasePath}assets/easyweb/css/jquery-ui-1.10.4.css" rel="stylesheet">
<link href="{$zBasePath}assets/easyweb/css/jquery.jqGrid.css" rel="stylesheet">
<link href="{$zBasePath}assets/easyweb/css/jquery_grid_customize.css" rel="stylesheet">
<link href="{$zBasePath}assets/easyweb/css/jqGridMultiSelect.css" rel="stylesheet">
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">{$oData.zLibelle}</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Gestion des absences</a></li>
									<li class="breadcrumb-item">Etat de congés</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<div class="clear"></div>					
								<input type="hidden" name="iMatricule" autocomplete="off" id="iMatricule" value="{$oData.iMatricule}" placeholder="">
								<input type="hidden" name="iCin" autocomplete="off" id="iCin" value="{$oData.iMatricule}" placeholder="">
							
								<div class="contenuePage" style="overflow: hidden;">
									<div class="" style="margin:10px 0 0 0;">
										<table id="jqGrid"></table>
										<div id="jqGridPager"></div>
									</div>
									<div class="row">
										<div class="col-md-2">
											<a class="form-control btn-primary bouton" target="_blank"  href="{$zBasePath}Gcap/imprimer_etat" type="submit"/>Imprimer etat</a>
										</div>
									</div>
								</div>
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

		
<script>
	var dataPlan = {$oData.jsonData};
</script>
{literal}
		 <script type="text/javascript"> 
		$(document).ready(function () {
			var pageWidth = $("#jqGrid").parent().width() - 100;
            $("#jqGrid").jqGrid({
                url: '{/literal}{$zBasePath}{literal}Gcap/mesDecisions',
                mtype: "GET",
                datatype: "json",
                colModel: [
					{ label: 'Identifiant', name: 'decision_id',key: true,width:80,frozen:true},
					{ label: 'UserId', name: 'decision_userId',width:70, hidden:true},
					{ label: 'Matricule', name: 'matricule',width:90,},
                    { label: 'Nom', name: 'nom',width:180},
                    { label: 'Prenoms', name: 'prenom',width:180},
                    { label: 'Annee', name: 'decision_annee',width:180},
	
					{ label: 'Numero', name: 'decision_numero',width:270},
					{
						label: 'Nombre de Jour',
                        name: 'decision_nbrJour',
                        width: 150,
                        summaryTpl: "Total: {0}", // set the summary template to show the group summary
                        summaryType: "sum" // set the formula to calculate the summary type
                    },
                ],
				loadonce : true,
                height: 250,
                rowNum: 10,
                subGrid: true, // set the subGrid property to true to show expand buttons for each row
                subGridRowExpanded: showChildGrid, 
			    subGridOptions : {
					reloadOnExpand :false,
					selectOnExpand : false 
				},
                pager: "#jqGridPager",
				grouping: true,
				/*groupingView: {
                    groupField: ["matricule"],
                    groupColumnShow: [true],
                    groupText: ["<b>{0}</b>"],
                    groupOrder: ["asc"],
                    groupSummary: [true],
                    groupCollapse: false
                },*/
				autowidth: true,
				shrinkToFit : false,
            });
			
			//set responsive grid
			$("#jqGrid").setGridWidth( Math.round($(window).width(), true) );
			$(window).on("resize", function () {
				var newWidth = $("#jqGrid").closest(".ui-jqgrid").parent().width();
				$("#jqGrid").jqGrid("setGridWidth", newWidth, true);
			});

			//set width
        });
		
		// the event handler on expanding parent row receives two parameters
        // the ID of the grid tow  and the primary key of the row
        function showChildGrid(parentRowID, parentRowKey) {
            var childGridID = parentRowID + "_table";
            var childGridPagerID = parentRowID + "_pager";

            // send the parent row primary key to the server so that we know which grid to show
            var childGridURL = "detailDeMesDecisions?decision_id=" + parentRowKey;
            //childGridURL = childGridURL + "&parentRowID=" + encodeURIComponent(parentRowKey)

            // add a table and pager HTML elements to the parent grid row - we will render the child grid here
            $('#' + parentRowID).append('<table id=' + childGridID + '></table><div id=' + childGridPagerID + ' class=scroll></div>');

            $("#" + childGridID).jqGrid({
                url: childGridURL,
                mtype: "GET",
                datatype: "json",
                page: 1,
                colModel: [
                    { label: 'Gcap Id', name: 'gcap_id', key: true, width: 75 },
                    { label: 'Date debut', name: 'gcap_dateDebut', width: 150,formatter: 'date', formatoptions: {newformat: 'd/m/Y'} },
                    { label: 'Date fin', name: 'gcap_dateFin', width: 150 ,formatter: 'date', formatoptions: {newformat: 'd/m/Y'} },
                    { label: 'Nombre de Jour', name: 'fraction_nbrJour', width: 150 },
                    { label: 'Motif', name: 'gcap_motif', width: 180 },
                    { label: 'Lieu de Jouissance', name: 'gcap_lieuJouissance', width: 125 }
                ],
				loadonce: true,
                height: '100%',
                pager: "#" + childGridPagerID,
				rowList: [],        // disable page size dropdown
				pgbuttons: false,     // disable page control like next, back button
				pgtext: null,         // disable pager text like 'Page 0 of 10'
				viewrecords: false,   // disable current view record text like 'View 1-10 of 100' ,
				autowidth: true,
				shrinkToFit : false,
            });
        }
	 </script>
{/literal}
