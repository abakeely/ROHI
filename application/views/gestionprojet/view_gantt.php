<!DOCTYPE html>


<script src="<?php echo base_url();?>assets/gantt/dhtmlxgantt.js"></script>
<link href="<?php echo base_url();?>assets/gantt/dhtmlxgantt.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>assets/gantt/sources/locale/locale_fr.js" charset="utf-8"> </script>
	
<br><br>	
<div align=center>
	<div id="gantt_here" style="width:100%; height:500px;"></div>
</div>
</section>
	
<br><br>	

<script type="text/javascript">
        var tasks =  {
			data : [
			<?php $cpt_projet= 0 ;foreach($projets as $projet) {$cpt_projet++;?>
				{id:<?php echo $cpt_projet?>, text:"<?php echo $projet->pnom?>",
				progress:0.4, open: true}
				<?php echo ",";?>
				<?php $cpt_tache= 0 ;foreach($projet->taches as $tache) {$cpt_tache++;?>
					{id:<?php echo $cpt_projet.$cpt_tache?>, text:"<?php echo $tache->text?>", start_date:"<?php echo $tache->start_date?>", duration:<?php echo $tache->duration?>,
					"parent":"<?php echo $cpt_projet?>",progress:0.4, open: true}
					<?php echo ",";?>
				<?php }?>
			<?php }?>
			
		   ]
        };

		gantt.init("gantt_here");


		gantt.parse(tasks);
</script>