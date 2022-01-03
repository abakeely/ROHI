 <?php 
    $date_demande_livre = date('d/m/Y');
	
	$theme_livre_edit =  0;
	$auteur_livre_edit =  0;
	$lieu_livre_edit =  0;
	$langue_livre_edit =  0;
    
	$id = "";
	$titre_livre = "";
	$cote_livre = "";
	$edition_livre = "";
	$format_livre = "";
	$nombre_page_livre = "";
	$nombre_explaire_livre = "";
	$observation_livre = "";
	 
	$image_url = base_url().'assets/upload_sad/default.jpg';
?>
 <style>
	.th_livre{
		background: Teal
	}	

</style>
 <div id="content-wrap" class="row"> 
  <div class="col-md-12"><br>
	<div class="text-center" >
		<div align="right">
			<?php if(!$display_btn_valide){?>
			<marquee><font size="5"><font face="Arial"><font color="#A9A9A9">Les Ouvrages ci-dessous</font> <font color="Teal">sont consultables sur place</font></font></font></marquee>
			<?php }?>
			<a href="<?php echo base_url();?>documentation/catalogue_livre" class="btn btn-success">Retour</a>
		</div>
		<h4><font color="DarkSlateGray"><u>LISTE DES OUVRAGES</u></font></h4>
	</div>
	<div class="row">
		<form class="form-horizontal" role="form" name="documentation" id="documentation" action="<?php echo base_url()?>documentaion/pret_livre" method="POST">		
		</form>
	</div>
	<table class="table table-striped table-bordered table-hover" id="table_pret_livre">
	   <thead>
		<tr >
			<th class="th_livre" style="width:10px">Ordre</th>
			<th class="th_livre">Th&ecirc;mes</th>
			<th class="th_livre">C&ocirc;tes</th>
			<th class="th_livre">Titres</th>
			<th class="th_livre">Auteurs</th>
			<th class="th_livre">Edition</th>
			<th class="th_livre">Lieu</th>
			<th class="th_livre">Langue</th>
			
			<th class="th_livre">Format</th>
			<th class="th_livre">Nb page</th>
			<th class="th_livre">Nb exemplaire</th>
			<th class="th_livre">Apperçu</th>
			
			<?php if($display_btn_valide){?> 
			<th class="th_livre">Action</th>
			<?php }?>
		</tr>
	   </thead>	
	   <?php foreach($list_livre as $livre){?>
		<tr>
			<td style="width:10px"><?php echo $livre->id;?></td>
		    <td><?php echo $livre->theme_livre?$livre->theme_livre['libele']:'';?></td>
			<td id="cote_<?php echo $livre->id;?>"><?php echo $livre->cote_livre;?></td>
			<td id="title_<?php echo $livre->id;?>"><?php echo $livre->titre_livre;?></td>
			<td><?php echo $livre->auteur_livre?$livre->auteur_livre['libele']:'';?></td>
			<td><?php echo $livre->edition_livre;?></td>
			<td><?php echo $livre->lieu_livre?$livre->lieu_livre['libele']:'';?></td>
			<td><?php echo $livre->langue_livre?$livre->langue_livre['libele']:'';?></td>
			
			
			<td><?php echo $livre->format_livre;?></td>
			<td><?php echo $livre->nombre_page_livre;?></td>
			<td><?php echo $livre->nombre_explaire_livre;?></td>
			
			<td id="td_<?php echo $livre->id;?>"><a href="<?php echo base_url();?>assets/pdf_sad/<?php echo $livre->cote_livre;?>.jpg">
			<img onmouseout="mouseSortie(<?php echo $livre->id;?>)" onmouseover="mouseEntre(<?php echo $livre->id;?>)" id="img_<?php echo $livre->id;?>"" 
			src="<?php echo base_url();?>assets/pdf_sad/<?php echo $livre->cote_livre;?>.jpg"  title="Cliquer pour visualiser" border="0" height="50" width="60"></a></td>
			<?php if($display_btn_valide){?>
			<td><a onclick="emprunter(<?php echo $livre->id;?>)" href="#"><button>Emprunter</button></a></td>
			<?php } ?>
		</tr>
	   <?php } ?>
	 
   </table>		
  </div>
  
  <div id="popop_img" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">X</span> <span class="sr-only">close</span></button>
                    <h4 id="modalTitleEvent" class="modal-title">Image test test test</h4>
                </div>-->
                <div  id="modalBodyEvent" class="modal-body" style="text-align:center">
                </div>
                <div class="modal-footer">
                    <button id="agenda_button_close_event" type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
	
<script>
function mouseEntre(i){
	var src = $('#img_'+i).attr('src');
	 var height = $('#td_'+i).height();
	 var height = height*3;
	 //$('#img_'+i).css("position","absolute");
     //$('#img_'+i).css("height",h3+"px"); 
	 //$('#td_'+i).css("height",height+"px");
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
	  bootbox.confirm("Voulez-vous reserver le livre : "+cote+" : "+title,
				function(result) { 
						if (result === false) {
											//Do nothing
						} else {
							document.location.href = "<?php echo base_url();?>documentation/reserver_livre/"+id;	
						}
				}
		); 
  }
  
  $(document).ready(function() {
        $('#table_pret_livre').dataTable();
	});	
  	$('#theme').change(function() {
        var theme = $(this).val();
        $.ajax({
            url: "<?php echo base_url() ?>documentation/recherche_livre",
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