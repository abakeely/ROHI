

 <style>
	.th_livre{
		background: teal
	}
</style>
 
  <div class="col-md-12">
	<!--<h2 style="color:#008080; font-size: 1.2em; font-weight:  font-family: arial;">
	    <div align="left"><font color="#00CED1">Carriere</font></div></h2>
	<table class="table table-striped table-bordered table-hover" id="table_planning">
	   <thead>
		<tr >
			<th class="th_livre" ><font size="3"><font face="Times New Roman">Situation Actuelle</font></font></th>
			<th class="th_livre" ><font size="3"><font face="Times New Roman">Prochain Avencement</font></font></th>
		</tr>
	   </thead>	
		
   </table>	-->
	<br><br>
		
	<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-3 libele_form" style="background:none; " >
					<label class="control-label ">Situation</label>
			</div>
		<div class="col-md-6">
			<form action="">
				<fieldset>
					<table id="carriere">
						<thead>
							<tr>
								<th style="text-align:left; font-family: Lato; font-size:10px;">Situation Actuelle</th>
								<th style="text-align:left;  font-family: Lato;">Prochaine avencement</th>
							</tr>
						</thead>
						<tr>
							<td style="text-align:left;  font-family: Lato; font-size:13px;">
							<b>Corps : Contratuels assimilés Cadre A</b> </td>
							<td></td>
						</tr>
						<tr>
							<td style="text-align:left;  font-family: Lato; font-size:13px;">
							<b>Grade : STOE</b></td>
							<td style="text-align:left;  font-family: Lato; font-size:13px;">
							<b>Grade : 2C1E</b></td>
						</tr>
						<tr>
							<td style="text-align:left;  font-family: Lato; font-size:13px;">
							<b>Indice : 650 </b></td>
							<td style="text-align:left;  font-family: Lato; font-size:13px;">
							<b>Indice : 705</b></td>
						</tr>
						<tr>
							<td style="text-align:left;  font-family: Lato; font-size:13px;">
							<b>Date d'effet : 09 avril 2015</b></td>
							<td style="text-align:left;  font-family: Lato; font-size:13px;">
							<b>Date d'effet : 09 avril 2017</b></td>
						</tr>
					</table>
				</fieldset>
			</form>
		</div>
	</div>
  <br><br>
  </div>
  
  <br>
  <?php include "avance.page.php" ;?>
  <br>
	    <div align="left"><b>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<b>Relève de Service</b>&nbsp;&nbsp;(<b> en cours)</b></div>
		
  <br>
  <script>


    $(document).ready(function() {
      // $('#table_planning').dataTable({
	   "ordering" : false
	   });	
	});

	$(document).ready(function() {
      // $('#carriere').dataTable({
	   "ordering" : false
	   });	
	});
  </script>		
