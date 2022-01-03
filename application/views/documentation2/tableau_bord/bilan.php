<style>
	.class_td{
		font-size:20px!important;
		text-align:center;
	}
	
	.class_th{
		font-size:22px!important;
		text-weight : bold;
		text-align:center;
	}
</style>
<br><br>
<div class="text-center" >
		<h1><font color="Teal">BILAN GLOBAL 2017</font></h1>
</div>
<script src="<?php echo base_url();?>assets/js/canvasjs.min.js"></script>

<div align="right">
		<a href="<?php echo base_url();?>documentation/tableau_bord" class="btn btn-success">RETOUR</a>
	</div>
<div  class="row" style="height: 49px;">
<!--<div  class="row">	
	<div class="col-md-12">		
		<div class="text-center" >
			<h1>Nombre Restitution par nom</h1>
        </div>
		<table>
			<tr>
				<th class="class_th">Nom et Prenom</th>
			</tr>
			<//?php foreach($sListePlanning as $pret){?>
			<tr>
				<td class="class_td"> <//?php echo $pret->nom_prenom_restitution?></td>
			</tr>
			<//?php }?>
		</table>
	</div>		
</div>-->
<div  class="row">	
	<div class="col-md-12">
		<div class="text-center" >
			<h2>Liste des departement qui emprunte plus de livre</h2>
        </div>
		<table>
			<tr>
				<th class="class_th">Département</th>
				<th class="class_th">Nombre</th>
			</tr>
			<?php foreach($sListeDepartement as $pret){?>
			<tr>
				<td class="class_td"> <?php echo $pret->dept?></td>
				<td class="class_td"><?php echo $pret->nombre?></td>
			</tr>
			<?php }?>
		</table>
	</div>		
</div>
<div  class="row">	
	<div class="col-md-12">			
		<div class="text-center" >
			<h2>Liste des direction qui emprunte plus de livre</h2>
        </div>
		<table>
			<tr>
				<th class="class_th">Direction</th>
				<th class="class_th">Nombre</th>
			</tr>
			<?php foreach($sListeDirection as $pret){?>
			<tr>
				<td class="class_td"> <?php echo $pret->direction?></td>
				<td class="class_td"><?php echo $pret->nombre?></td>
			</tr>
			<?php }?>
		</table>
	</div>		
</div>
<div  class="row">	
	<div class="col-md-12">
		<div class="text-center" >
			<h2>Liste des service qui emprunte plus de livre</h2>
        </div>
		<table>
			<tr>
				<th class="class_th">Service</th>
				<th class="class_th">Nombre</th>
			</tr>
			<?php foreach($sListeService as $pret){?>
			<tr>
				<td class="class_td"> <?php echo $pret->service?></td>
				<td class="class_td"><?php echo $pret->nombre?></td>
			</tr>
			<?php }?>
			
		</table>
	</div>		
</div>
<div  class="row">	
	<div class="col-md-12">			
		<div class="text-center" >
			<h2>Liste des agents qui emprunte plus des livres</h2>
        </div>
		<table>
			<tr>
				<th class="class_th">Agent</th>
				<th class="class_th">Service</th>
				<th class="class_th">Direction</th>
				<th class="class_th">Departement</th>
				<th class="class_th">Nombre</th>
			</tr>
			<?php foreach($sListeAgentBcpLivre as $pret){?>
			<tr>
				<td class="class_td"> <?php echo $pret->nom .' '.$pret->prenom   ?></td>
				<td class="class_td"> <?php echo $pret->service ?></td>
				<td class="class_td"> <?php echo $pret->direction ?></td>
				<td class="class_td"> <?php echo $pret->dept ?></td>
				<td class="class_td"><?php echo $pret->nombre ?></td>
			</tr>
			<?php }?>
			
		</table>
	</div>		
</div>
<div  class="row">	
	<div class="col-md-12">			
		<div class="text-center" >
			<h2>Liste des livres les plus empruntés</h2>
        </div>
		<table>
			<tr>
				<th class="class_th">Livres</th>
				<th class="class_th">Cote</th>
				<th class="class_th">Nombre</th>
			</tr>
			<?php foreach($sListeLivreEmpreinte as $pret){?>
			<tr>
				<td class="class_td"> <?php echo $pret->titre_livre ; ?></td>
				<td class="class_td"> <?php echo $pret->cote_livre ; ?></td>
				<td class="class_td"><?php echo $pret->nombre ;?></td>
			</tr>
			<?php }?>
		</table>
		<?php
		?>	
	</div>	
</div>
<div  class="row">	
	<div class="col-md-12">			
		<div class="text-center" >
			<h2>Liste des agents qui éffectue beaucoup de prêt</h2>
        </div>
		<table>
			<tr>
				<th class="class_th">Agent</th>
				<th class="class_th">Service</th>
				<th class="class_th">Direction</th>
				<th class="class_th">Département</th>
				<th class="class_th">Nombre</th>
			</tr>
			<?php foreach($sListeAgentBcpLivre as $pret){?>
			<tr>
				<td class="class_td"> <?php echo $pret->nom .' '.$pret->prenom   ?></td>
				<td class="class_td"> <?php echo $pret->service ; ?></td>
				<td class="class_td"> <?php echo $pret->direction ; ?></td>
				<td class="class_td"> <?php echo $pret->dept ; ?></td>
				<td class="class_td"> <?php echo $pret->nombre ; ?></td>
			</tr>
			<?php }?>
		</table>
	</div>		
</div>
<div  class="row">
	<div class="col-md-12">			
		<div class="text-center" >
			<h2>Liste des livres le plus empruntés par un agents</h2>
        </div>
		<table>
			<tr>
				<th class="class_th">Côtes</th>
				<th class="class_th">Titres</th>
				<th class="class_th">Agents</th>
			</tr>
			<?php foreach($sListeAgentUnLivre as $pret){?>
			<tr>
				<td class="class_td"> <?php echo $pret->cote_livre ; ?></td>
				<td class="class_td"> <?php echo $pret->titre_livre ; ?></td>
				<td class="class_td"> <?php echo $pret->nom .' '.$pret->prenom   ?></td>
			</tr>
			<?php }?>
		</table>
	</div>		
</div> 