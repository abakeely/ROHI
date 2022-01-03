
<script src="<?php echo base_url();?>assets/calendrier/dhtmlxscheduler.js"></script>
<link href="<?php echo base_url();?>assets/calendrier/dhtmlxscheduler.css" rel="stylesheet">


<style type="text/css" media="screen">
	html, body{
		margin:0px;
		padding:0px;
		height:100%;
	}
</style>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		init();
	});
	function init() {
		scheduler.config.multi_day = true;
		scheduler.config.max_month_events = 3;
		scheduler.config.xml_date="%d/%m/%Y";
		scheduler.init('scheduler_here', new Date(2017,3,20),"month");
		scheduler.parse([
			<?php $sizep = sizeof($projets);$cpt_projet= 0 ;foreach($projets as $projet) {$cpt_projet++;?>
				<?php $sizet = sizeof($projet->taches); $cpt_tache= 0 ;foreach($projet->taches as $tache) {$cpt_tache++;?>
					{"id":<?php echo $cpt_projet.$cpt_tache?>, "text":"<?php echo $projet->pnom.'-'.$tache->text?>", "start_date":"<?php echo $tache->start_date?>", "end_date":"<?php echo $tache->end_date?>"}
					<?php if($sizet>$cpt_tache) echo ",";?>
				<?php }?>
			<?php }?>
		],
		'json');
	}
</script>

<div id="scheduler_here" class="dhx_cal_container" style="width:100%; height:400px;">
	<div class="dhx_cal_navline">
		<div class="dhx_cal_prev_button">&nbsp;</div>
		<div class="dhx_cal_next_button">&nbsp;</div>
		<div class="dhx_cal_today_button"></div>
		<div class="dhx_cal_date"></div>
		<div class="dhx_cal_tab" name="day_tab" style="right:204px;"></div>
		<div class="dhx_cal_tab" name="week_tab" style="right:140px;"></div>
		<div class="dhx_cal_tab" name="month_tab" style="right:76px;"></div>
	</div>
	<div class="dhx_cal_header">
	</div>
	<div class="dhx_cal_data">
	</div>
</div>