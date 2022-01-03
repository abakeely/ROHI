<br><br>
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
?>

<section>
	<div class="row" style="width: 100%;height: 20em;">
		<div class="col-md-4" style="text-align:center">
			<img class="img_cat" id="cat_politique" src="<?php echo base_url();?>assets/img/nouv_/<?php echo $livre['id_livre'];?>.jpg" border="0" height="200" width="220">
		</div>
		
		<div class="col-md-3" style="text-align:left">
			Themes : <?php echo $livre['theme'];?><br>
			Cote : <?php echo $livre['cote_livre'];?><br>
			Titre : <?php echo $livre['titre_livre'];?><br>
			Auteurs : <?php echo $livre['auteur'];?><br>
			Edition : <?php echo $livre['edition_livre'];?><br>
			Lieu : <?php echo $livre['lieu'];?><br>
			Langue : <?php echo $livre['langue'];?><br>
			Nb exemplaire : <?php echo $livre['npmbre_explaire_livre'];?><br><br>
			
			<a onclick="emprunter(<?php echo $livre->id;?>)" href="#"><button>Emprunter</button></a>
		
		</div>
		
	</div>

	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
  </ol>

	<!-- Wrapper for slides -->
	
  <div class="carousel-inner" role="listbox">
    <div class="item active">
        <div class="container-fluid">
            <div class="row no-gutter popup-gallery">		
			<?php for($i=1;$i<7;$i++){?>
                <div class="col-md-2 border_galery">
                    <a href="<?php echo base_url('assets/img/nouv_/'.$i.'.jpg')?>" class="portfolio-box" >
                        <img src="<?php echo base_url('assets/img/nouv_/'.$i.'.jpg')?>" class="img-responsive" alt=""height="30">
                        <div class="portfolio-box-caption">
                        </div>
                    </a>
                </div>
            <?php }?> 
            </div>
        </div>
	</div>
	<div class="item">
		<div class="container-fluid">
            <div class="row no-gutter popup-gallery">		
			<?php for($i=7;$i<13;$i++){?>
                <div class="col-md-2 border_galery">
                    <a href="<?php echo base_url('assets/img/nouv_/'.$i.'.jpg')?>" class="portfolio-box">
                    <img src="<?php echo base_url('assets/img/nouv_/'.$i.'.jpg')?>" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                        </div>
                    </a>
                </div>
            <?php }?> 
            </div>
        </div>
	</div>
</div>
<!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</section>
	
	
	
	
	
<style>
	.border_galery{
		border: solid;
		border-color: green;
	}
	.image_slide{
	height:824px!important
	}
	.carousel-caption {
	left: 54%;
	right: 581px;
	height:700px!important;
	z-index:0;
	bottom:0;
	animation-name: my_animation;
	animation-duration: 2s;
}

.carousel-control.right {
	background-image: none;
	width="47%";
}

.carousel-control.left {
	background-image: none;
}

</style>
<section class="no-padding" id="portfolio">

</section>
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
	  var title = "<?php echo $livre['titre_livre'];?>";
	  var cote = "<?php echo $livre['cote_livre'];?>";
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
					$('#edition_livre').empty();
					 $.each(data.list_edition, function(index,row){
						 var opt = $('<option />'); // here we're creating a new select option with for each format
		                    opt.val(row.edition_livre);
		                    opt.text(row.edition_livre);
		                    $('#edition_livre').append(opt);
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
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	