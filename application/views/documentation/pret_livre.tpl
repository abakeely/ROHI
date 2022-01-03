{include_php file=$zCssJs}
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Prêt Livre</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="{$zBasePath}documentation/infprat/sad/inf-prat">Archives et Documentations</a></li>
									<li class="breadcrumb-item"><a href="{$zBasePath}documentation/service/sad/service-propose">Servises Proposés</a></li>
									<li class="breadcrumb-item">Listes des Prêts</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">		
								{assign var=date_demande_livre value="date('d/m/Y')"}
								{assign var=theme_livre_edit value="0"}
								{assign var=auteur_livre_edit value="0"}
								{assign var=lieu_livre_edit value="0"}
								{assign var=langue_livre_edit value="0"}

								{assign var=id value=""}
								{assign var=titre_livre value=""}
								{assign var=cote_livre value=""}
								{assign var=edition_livre value=""}
								{assign var=format_livre value=""}
								{assign var=nombre_page_livre value=""}
								{assign var=nombre_explaire_livre value=""}
								{assign var=observation_livre value=""}

								{assign var=image_url value="base_url().'assets/upload_sad/default.jpg'"}
									
								<br>
								<div class="text-center">
									<div align="right">
										{*{if !$display_btn_valide}
											<marquee><font size="5"><font face="Arial"><font color="#1794AC">Les Ouvrages ci-dessous</font> <font color="#B38967">sont consultables sur place</font></font></font></marquee>
										{/if}*}
										<br><br>
										<a href="{$zBasePath}documentation/ouvrage/sad/divers-ouvrages" class="btn">Retour</a>
									</div>
									<br>
									<h3 style=" border-bottom: none; important! font-size: 1.1em; font-weight: bold; font-family: Lato;">
										<div align="center">LISTE DES OUVRAGES </div>
									</h3>
								</div>	
								<div class="row">
									<form class="form-horizontal" role="form" name="documentation" id="documentation" action="{$zBasePath}documentaion/pret_livre/sad/pret-livre" method="POST"></form>
								</div>
								<table class="table table-striped table-bordered table-hover" id="table-liste-prets">
								<thead>
										<tr >
											<th>Ordre</th>
											<th>Th&ecirc;mes</th>
											<th>C&ocirc;tes</th>
											<th>Titres</th>
											<th>Auteurs</th>
											<th>Edition</th>
											<th>Lieu</th>
											<th>Langue</th>
											<th>Format</th>
											<th>Nb page</th>
											<th>Nb exemplaire</th>
											<th>Apperçu</th>
											<th>Action</th>
										</tr>
									</thead>
									
								</table>

								<div id="popop_img" style="z-index:9999" class="modal fade">
									<div class="modal-dialog">
										<div class="modal-content">
											<div  id="modalBodyEvent" class="modal-body" style="text-align:center">
											</div>
											<div class="modal-footer">
												<button id="agenda_button_close_event" type="button" class="btn" data-dismiss="modal">Fermer</button>
											</div>
										</div>
									</div>
								</div>

								<div id="calendar"></div>
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

	var prets = $('#table-liste-prets').DataTable( {
		"processing": true,
		"serverSide": true,
		"order": [[ 0, "desc" ]],
		"ajax":{
			url :"{/literal}{$zBasePath}{literal}documentation/get_livre/sad/ajax/{/literal}{$oData.theme_livre}{literal}", 
			data: function ( d ) {
			},
			type: "post",  
			error: function(){  

			}
		}
	}); 


	function getListePret(){
		prets.ajax.reload();
	}

	function mouseEntre(i){
	var src = $('#img_'+i).attr('src');
	 var height = $('#td_'+i).height();
	 var height = height*3;
     $('#modalBodyEvent').html('<img src="'+src+'" style="height: 50%;" class="form-control"/>'); 
	 $('#popop_img').modal();	 
	 //alert(h3);
  }
  function mouseSortie(i){
	 $('#img_'+i).css("position","");
     $('#img_'+i).css("height",""); 
	 $('#td_'+i).css("height",""); 
  }

  function emprunter(id){
	  var title = $('#title_'+id).text();
	  var cote = $('#cote_'+id).text();
	  bootbox.confirm("Voulez-vous emprunter l'ouvrage : "+cote+" : "+title,
				function(result) { 
						if (result === false) {
											//Do nothing
						} else {
							document.location.href = "{/literal}{$zBasePath}{literal}documentation/reserver_livre/sad/reserver-livre/"+id;
						}
				}
		); 
	}
	
	$(document).ready(function() {
        $('#dataTables-example').dataTable();
	});
	
  	$('#theme').change(function() {
        var theme = $(this).val();
        $.ajax({
           url: "{/literal}{$zBasePath}{literal}documentation/recherche_livre/sad/recherche-livre",
            async: false,
            type: "POST",
            data: "theme_livre_id=" + theme,
            dataType: "json",
            success: function(data) {
            	$('#table_liste_boky tbody').empty();
				var i = 1;
				
				if(data.list_edition){
					$('#edition').empty();
					 $.each(data.list_edition, function(index,row){
						 var opt = $('<option />'); // here we're creating a new select option with for each format
		                    opt.val(row.edition_livre);
		                    opt.text(row.edition_livre);
		                    $('#edition').append(opt);
					 });
				}

				if(data.list_langue){
					$('#langue').empty();
					 $.each(data.list_langue, function(index,row){
						 var opt = $('<option />'); // here we're creating a new select option with for each format
		                    opt.val(row.id);
		                    opt.text(row.libele);
		                    $('#langue').append(opt);
					 });
				}

				if(data.list_auteur){
					$('#auteur').empty();
					 $.each(data.list_auteur, function(index,row){
						 var opt = $('<option />'); // here we're creating a new select option with for each format
		                    opt.val(row.id);
		                    opt.text(row.libele);
		                    $('#auteur').append(opt);
					 });
				}

				if(data.list_livre){
					
	                $.each(data.list_livre, function(index,row) //here we're doing a foeach loop round each format
	                {
	                	var opt = $('<option />'); // here we're creating a new select option with for each format
	                    opt.val(row.id);
	                    opt.text(row.titre_livre);
	                    $('#titre').append(opt);
	
	                    var tr = $('<tr />');
	                    var td1 = $('<td />');
	                    var td2 = $('<td />');
	                    var td3 = $('<td />');
	                    var td4 = $('<td />');
	                    var td5 = $('<td />');
	                    var td6 = $('<td />');
	                    var td7 = $('<td />');
	                    var td8 = $('<td />');
	                    var td9 = $('<td />');
	                    var btn = $('<a />');
	
	                    td1.text(i);
	                    td2.text(row.theme_livre?row.theme_livre.libele:'');
	                    td3.text(row.cote_livre);
	                    td4.text(row.titre_livre);
	                    td5.text(row.auteur_livre?row.auteur_livre.libele:'');
	                    td6.text(row.edition_livre);
	                    td7.text(row.lieu_livre?row.lieu_livre.libele:'');
	                    td8.text(row.langue_livre?row.langue_livre.libele:'');
	                    
	                    td9.append('<a href="" >RESERVER</a>');
	
	                    tr.append(td1);
	                    tr.append(td2);
	                    tr.append(td3);
	                    tr.append(td4);
	                    tr.append(td5);
	                    tr.append(td6);
	                    tr.append(td7);
	                    tr.append(td8);
	                    tr.append(td9);
	
	                    $('#table_liste_boky tbody').append(tr);
	                    
	                    i++;
	                });
	        	}
            }
        });
    });
</script>
<style>
.bootbox {
	z-index:9999!important;
}
</style>
{/literal}
