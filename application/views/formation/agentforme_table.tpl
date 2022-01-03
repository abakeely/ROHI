
 
{php} 
	$agentforme_id = "";
	$agentforme_date= "";
	$agentforme_lieu = "";
	$agentforme_nomprenom = "";
	$agentforme_prenom = "";
	$agentforme_fonction = "";
	$agentforme_intitule = "";	
	
	$annee_de_formation = "";
	$lieu_de_formation = "";		

{/php}

{literal}	
 <style>
	.th_livre{
		background: Teal
	}
	.text_1 {
	  text-decoration : blink;
	  color:#FF4367;
	}
</style>
{/literal}


 <div id="content-wrap" class="row"> 
	<div class="col-md-12">
	<h2 style="color:#008080; font-size: 1.5em; font-weight: bold; font-family: Arial;">
	<div align="right">
		<a href="<?php echo base_url();?>formation/agentforme" class="btn btn-success">RETOUR</a>
	</div>
        <div align="center">LISTE DES AGENTS FORM&Eacute;S<?php 
		
		 if ( $liste[0]->agentforme_date > 0 ) 
		 {
			 	$annee_de_formation = $annee.$liste[0]->agentforme_date;
				
				if( $liste[0]->agentforme_madagascar == 0 )
				{
					$lieu_de_formation = " &agrave;	L'&Eacute;TRANGER ";
				}
				
				if( $liste[0]->agentforme_madagascar == 1 )
				{
					$lieu_de_formation = " &agrave;	MADAGASCAR ";
				}
		 }
		 
		 if ( $annee_de_formation > 0 )
		 { echo ' '.$lieu_de_formation.' EN '.$annee.$liste[0]->agentforme_date; }
		 
		 
		  ?>
          
          </div></h2>  
 	<br>
	<table class="table table-striped table-bordered table-hover" id="table_planning">
	   <thead>
		<tr >
		<!--	<th class="th_livre" style="width:20px"><font size="3"><font face="Times New Roman">Ordre</font></font></th>
		 	<th class="th_livre" style="width:20px"><font size="3"><font face="Times New Roman">Ann&eacute;e</font></font></th> -->
			<th class="th_livre"><font size="3"><font face="Times New Roman">INSTITUT PARTENAIRE</font></font></th>
			<th class="th_livre"><font size="3"><font face="Times New Roman">NOM</font></font></th>
			<th class="th_livre"><font size="3"><font face="Times New Roman">DEPARTEMENT</font></font></th>
			<th class="th_livre"><font size="3"><font face="Times New Roman">INTITUL&Eacute;</font></font></th>
		</tr>
	   </thead>	
		<?php foreach($liste as $agentforme){?>	
	    
		<tr>
		<!--		 <td style="width:20px"><font size="4"><font face="Times New Roman"><?php echo $agentforme->agentforme_id?></font></font></td>
		    <td style="width:20px"><font size="4"><font face="Times New Roman"><?php echo $agentforme->agentforme_date?></font></font></td>   -->
			<td><font size="4"><font face="Times New Roman"><?php echo $agentforme->agentforme_lieu;?></font></font></td>
			<td><font size="4"><font face="Times New Roman"><?php echo $agentforme->agentforme_nomprenom.' '.$agentforme->agentforme_prenom;?></font></font></td>
			<td><font size="4"><font face="Times New Roman"><?php echo $agentforme->agentforme_fonction;?></font></font></td>
			<td><font size="4"><font face="Times New Roman"><?php echo $agentforme->agentforme_intitule;?></font></font></td>
		</tr>
	<?php } ?>
   </table>			
  </div>
  <script>

    $(document).ready(function() {
       $('#table_planning').dataTable({
	   "ordering" : false
	   });	
	});	
  </script>		
