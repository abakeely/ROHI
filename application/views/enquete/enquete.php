
<?php
	$current_reponduer = $user;
	$sql = 'select * from
			cat_questionnaire
			join (
			select
			candidat.fonction_actuel,
			user.id,
			candidat_fonc.fonction_Design,
			candidat_fonc.fonction_Cat
			from candidat
			join user on candidat.user_id = user.id
			left join candidat_fonc on substring(candidat_fonc.fonction_Design, 1, length(candidat.fonction_actuel)) = candidat_fonc.fonction_Design
			where user.id='.$current_reponduer.'
			)a on cat_questionnaire.cat_Type <= a.fonction_Cat GROUP BY cat_Id';
	//$sql = 'select * from questionnaire where cat_Id = @categorie';
	$req = mysql_query($sql) or die('Erreur SQL !<br/>'.$sql.'<br/>'.mysql_error());
	//echo $sql;
	$nbrReponse = 0;
	$nbrQuestion = 0;
	?>
	
<!-- //banner -->
<!-- banner-bottom -->
<input type ="hidden" value="<?php echo base_url()?>" id="controller_url">
<!--<form class="form-horizontal" role="form" name="enquete" id="enquete_form" action="<?php echo base_url()?>" method="POST" enctype="multipart/form-data">-->
<div id="apparel" class="banner-bottom">
	<div class="table-responsive" align="center">
	<div class="col-lg-12">
		<div class="col-lg-1">
		</div>
		<div class="col-lg-10">
		<br/><br/><br/>
		<p>
		Par constat, le niveau de la qualité des conditions de travail au sein du Ministère des Finances et du Budget impacte considérablement sur la motivation et la performance des agents. Consciente de ce fait, la DRHA invite tous les agents du Ministère des Finances et du Budget de toutes les régions de Madagascar à remplir ce questionnaire afin de recenser leurs avis, requêtes et suggestions. Par la suite, les résultats seront transmis aux Directeurs et Chefs de Service concernés pour mieux cibler les projets d´amélioration des conditions de travail à mettre en place. <br/><br/>

				<div class="col-lg-12">
<div class="col-lg-1">
</div>
<div class="col-lg-11">
<br/>
Etes-vous en accord ou en d&eacute;saccord avec les affirmations suivantes:																															
<br/><i>(Ahoana ny hevitrao mahakasika ireto manaraka ireto)</i>																														
<br/><br/>
</div>			
</div>
<div class="col-lg-12">
<font size="4rem">																											
<div class="col-lg-4">
<table>

<tr><td><b><font color="red">1&nbsp;:&nbsp;</font></b></td> <td>Pas du tout d'accord</td></tr>
<tr><td></td><td><i> Mand&agrave;</i></td></tr>
</table>
</div>
<div class="col-lg-4">
<table>
<font color="red">
<tr><td><b><font color="red">2&nbsp;:&nbsp;</font></b></td> </font><td>Plut&ocirc;t d'accord</td></tr>
<tr><td></td><td><i>Azo ekena</i></td></tr>
</table>														
</div>
<div class="col-lg-4">		

<table>
<font color="red">
<tr><td><b><font color="red">3&nbsp;:&nbsp;</font></b></td> </font><td>Tout &agrave; fait d'accord</td></tr>
<tr><td></td><td><i>Manaiky tanteraka</i></td></tr>
</table>	
<br/><br/>

</div>
 </font>
</div>
<div class="col-lg-12">
<div class="col-lg-12">
<font color="red">*</font> Il est à noter que vos r&eacute;ponses ne sont pas modifiables<br/>
<i>Marihana fa tsy azo iverenana intsony ny valin'ny fanontaniana izay napetraka teo ambony</i>
</div>
<div class="col-lg-12">
<br/>
<font color="red">*</font> Les réponses que vous nous donnerez seront traitées dans la confidentialité la plus stricte<br/><br/>
<i></i>
</div>
		</p>
		<br/>
		<br/>
<div class="col-lg-12">
		<?php
                
                        
                        $proposition_ = "";
						$categ = "";
			$i = 1;
			
			
			while (($data = mysql_fetch_array($req))) {
			$categ = $data['fonction_Cat'];
			/*echo "<pre>" ; 
			
			print_r ($data);
			
			echo "</pre>";*/
				
			$sql2 = 'select DISTINCT  question_Design, question_Id, question_Trad, cat_Id from questionnaire where cat_Id =\''.$data['cat_Id'].'\'';
			$req2 = mysql_query($sql2) or die('Erreur SQL !<br />'.$sql2.'<br />'.mysql_error());
			//$sql3 = 'select * from reponse where ';
			
			echo"<tr>";
				echo "<b><font face=\"verdana\" size=\"3\" color=\"428BCA\">".$data['cat_Id'].'. '.$data['cat_Design'].' </b> <br /><i> '.$data['cat_Trad'].'</i></font>';
				
				echo"<table class=\"table table-condensed table-striped table-hover table-heading\" id=\"dataTables-example\"><thead><tr  bgcolor=\"#428BCA\"><th></th><th><font color=\"#ffffff\">1</font></th><th><font color=\"#ffffff\">2</font></th><th><font color=\"#ffffff\">3</font></th></tr></font></thead>";
				$j = 1;
				
				while ($data2 = mysql_fetch_array($req2)) {
                                        $sql3 = 'select * from reponse where question_Id=\''.$data2['question_Id'].'\' and repondeur_Id='.$current_reponduer;
                                        $req3 = mysql_query($sql3) or die('Erreur SQL !<br />'.$sql3.'<br />'.mysql_error());
                                        $nb_row = 0;
										
                                        while ($data3 = mysql_fetch_array($req3)) {
                                            $proposition_ = $data3['proposition'];
                                            $nb_row = 1;
                                            $choix1 = '';
                                            $choix2 = '';
                                            $choix3 = '';
                                            switch($data3['choix_Id']){
                                                case 1:$choix1 = 'checked';break;
                                                case 2:$choix2 = 'checked';break;
                                                case 3:$choix3 = 'checked';break;
                                            }
                                            
                                            echo"<tr>";
                                            echo"<td width='88%'><b>".$data2['question_Id'].'. '.$data2['question_Design'].'</b><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i> '.$data2['question_Trad'].'</i></td>';
                                            echo"<td width='4%'><input id=\"checkbox_row_".$i.$j.(1)."\" name=\"".$data2['question_Id']."\" data-toggle=\"tooltip\" data-original-title=\" Manda\"type=\"checkbox\" ".$choix1." disabled></input></td>";
                                            echo"<td width='4%'><input id=\"checkbox_row_".$i.$j.(2)."\" name=\"".$data2['question_Id']."\" data-toggle=\"tooltip\" data-original-title=\" Azo ekena\"type=\"checkbox\" ".$choix2." disabled></input></td>";
                                            echo"<td width='4%'><input id=\"checkbox_row_".$i.$j.(3)."\" name=\"".$data2['question_Id']."\" data-toggle=\"tooltip\" data-original-title=\" Manaiky tanteraka\"type=\"checkbox\" ".$choix3." disabled></input></td>";
                                            echo"</tr>";
                                        }
										$nbrReponse  += $nb_row; 
                                        mysql_free_result ($req3);
                                        if($nb_row == 0){
                                        //
                                            echo"<tr>";
                                            echo"<td width='88%'><b>".$data2['question_Id'].'. '.$data2['question_Design'].'</b>	<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i> '.$data2['question_Trad'].'</i></td>';
                                            echo"<td width='4%'><input id=\"checkbox_row_".$i.$j.(1)."\" name=\"".$data2['question_Id']."\" data-toggle=\"tooltip\" title=\"Mand&agrave;\" type=\"checkbox\" onClick=\"verifyCheckBoxes('checkbox_row_".$i.$j.(1)."', 'checkbox_row_".$i.$j.(2)."',1, 'checkbox_row_".$i.$j.(3)."');\"></input></td>";
                                            echo"<td width='4%'><input id=\"checkbox_row_".$i.$j.(2)."\" name=\"".$data2['question_Id']."\" data-toggle=\"tooltip\" title=\"Azo ekena\" type=\"checkbox\" onClick=\"verifyCheckBoxes('checkbox_row_".$i.$j.(2)."', 'checkbox_row_".$i.$j.(1)."',2, 'checkbox_row_".$i.$j.(3)."');\"></input></td>";
                                            echo"<td width='4%'><input id=\"checkbox_row_".$i.$j.(3)."\" name=\"".$data2['question_Id']."\" data-toggle=\"tooltip\" title=\"Manaiky tanteraka\" type=\"checkbox\" onClick=\"verifyCheckBoxes('checkbox_row_".$i.$j.(3)."', 'checkbox_row_".$i.$j.(1)."',3, 'checkbox_row_".$i.$j.(2)."');\"></input></td>";
                                            echo"</tr>";
                                        }
					$j++;
				}
				$nbrQuestion += ($j-1);
				echo"</table><br/>";

				$i++; 
				mysql_free_result ($req2);
			} ?>
			
			
</div>		
			<input type="hidden" id="categ_" value="<?php echo $categ?>">
			<br/>
			<font face="verdana" size="3" color="3e89f8"><b>AVEZ-VOUS DES PROPOSITIONS D'AMELIORATION?</b> 
<br/><i>MANANA SOSO-KEVITRA FANATSARANA VE IANAO?</i></font>
<br/>
<div class="col-lg-12">
    <form class="form-horizontal" role="form" name="enquete" id="enquete_form" action="<?php echo ".../cv/enregistrer"?>" method="POST" enctype="multipart/form-data">
			
			<div class="col-lg-2">
			</div>
<div class="col-lg-8">
<?php
		$prop_sql = 'select * from enquete_proposition where repondeur_Id='.$current_reponduer;
		$req_prop = mysql_query($prop_sql) or die('Erreur SQL !<br />'.$prop_sql.'<br />'.mysql_error());
				while ($data_prop = mysql_fetch_array($req_prop)) {
					$proposition_ = $data_prop['proposition'];
					}
					mysql_free_result ($req_prop);
?>
                                <textarea  name="proposition" id="proposition" class="form-control" rows=2  <?php if($proposition_ != ""){echo "disabled";}?>><?php echo $proposition_;?></textarea>
				<br/><br/>
			</div>
			<div class="col-lg-2">
			</div>
    </form>
			</div>
	
		<?php
			mysql_free_result ($req);
			mysql_close ();
			
		?>
	</div>
	<div class="col-lg-1">
	</div>
	</div>
</div>
<div class="col-lg-12">
<div class="col-lg-5">
</div>
<div class="col-lg-2">
<input type="button" class="btn btn-primary form-control" id="save" value="Enregistrer" <?php if($proposition_ != "" && $nbrReponse == $nbrQuestion ){echo "disabled";}?>/>
<br/><br/><br/>
</div>
<div class="col-lg-5">
</div>
</div>
		</div>
	<script type="text/javascript">
	//$('input').tooltip();
	//$('checkbox').tooltip();
	//$('table').tooltip();
		$(document).ready(function() {
                        $('#save').click(function(){
							//
                            var propos = $('#proposition').val();
                            var save_url = $('#controller_url').val()+'enquete/enregistrer';
                            var categ = $('#categ_').val();
                            $.ajax({
                                url: save_url,
                                type: "POST",
                                data: "data="+propos+"&categorie="+categ,
                                success: function(data){
                                    alert(data);
									window.location.reload(true);
                                }
                            });
                        });
		});
						
		function verifyCheckBoxes(source, param1, reponse_id,  param2)
		{
			if(document.getElementById(source).checked == true)
			{
				document.getElementById(param1).checked = false;
				document.getElementById(param2).checked = false;
                                
			}
                        //$.post(url,data,callback,type);
                        var res = document.getElementById(source).checked;
                        var url = $('#controller_url').val()+'enquete/save_questionnaire';
						
                        var source_ = '#'+source;
                        var param1_ = '#'+param1;
                        var param2_ = '#'+param2;
                        var question_id = $(source_).attr('name');
                        //alert(question_id);
                        if(res != false){
                            $(source_).prop('disabled', true);
                            $(param1_).prop('disabled', true);
                            $(param2_).prop('disabled', true);
                            $.ajax({
                                url: url,
                                type: "POST",
                                data: "question_id="+question_id+"&reponse_id="+reponse_id,
                                success: function(data){
                                    //alert(data);
                                }
                            });
                        }
		}
	</script>
</body>
</html>