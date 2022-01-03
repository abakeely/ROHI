<div id="popupDetail" style="display:none;">
			<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog" style="left: 0; width: 50%;">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Formulaire d'un Agent
					  </div>
  <div class="modal-body" id="detailPrint">
					
					<table width="100%" border="0" style="font-size: 9px; text-align: center;display:none" id="headPrint">
						<tr>
							<td style="width: 10%;"><img src="<?php echo base_url();?>assets/img/mfb.png" width="50px"/></td>
							<td style="width: 83%;">
								MINISTERE DES FINANCES ET DU BUDGET<br>
								SECRETARIAT GENERAL<br>
								Direction des Ressources Humaines et de l&acute;Appui<br>
                                                                ATTESTATION D'UN CURRICULUM VITAE
							</td>
							<td style="width: 10%;text-align: right;"><img src="<?php echo base_url();?>assets/img/logo_drha.png" width="50px"/></td>
						</tr>
					</table>
					<br>	
					<table width="80%" border="0" style="line-height: 20px; margin-left: 10%;">
						<tr>
							<td></td>
							<td rowspan="5" style="text-align: right;">
								<img id="photo" src="" style="width: 155px;"/>
							</td>
						</tr>
						<tr>
							<td id="im"></td>
						</tr>
                                                <tr>
							<td id="cin"></td>
						</tr>
						<tr>
							<td id="nom_prenom" ></td>
						</tr>
						<tr>
							<td id="sexe" ></td>
						</tr>
						<tr>
							<td id="date_naiss" ></td>
						</tr>
						<tr>
							<td id="sit_mat" ></td>
						</tr>
						<tr>
							<td id="address" ></td>
						</tr>
						<tr>
							<td id="phone" ></td>
						</tr>
						<tr>
							<td id="email" ></td>
						</tr>
                                                <tr>
							<td id="nom_conjoint" ></td>
                                                       
						</tr>
                                                <tr>
                                                    <td id="nbr_enfant" ></td>
                                                </tr>
                                                 
					</table>
					<table width="80%" border="0" style="line-height: 20px; margin-left: 10%;">
						<tr>
							<td colspan="2">
								<hr style="height: 4px;background-color: #808080" noshade>
							</td>
						</tr>
                        <tr>
							<td>Type de Contrat : </td>
							<td id="type_contrat" ></td>
						</tr>
						<tr>
							<td>Date de service </td>
							<td id="date_service" ></td>
						</tr>
						<tr>
							<td>Dipl&oslash;mes obtenus : </td>
							<td>
								<textarea name="diplome" style="background-color: white; border: medium none;cursor:default" id="diplome" class="form-control disabled" rows=5 disabled></textarea>
							</td>
						</tr>
				
						<tr>
							<td>Domaine : </td>
							<td>
								<textarea name="domaine" style="background-color: white; border: medium none;cursor:default" id="domaine" class="form-control disabled" rows=5 disabled></textarea>
							</td>
						</tr>
                                                <tr>
							<td>Experience professionnelle : </td>
							<td>
								<textarea name="experience" style="background-color: white; border: medium none;cursor:default" id="experience" class="form-control disabled" rows=5 disabled></textarea>
							</td>
						</tr>
                                                <tr>
							<td>Dernier employeur : </td>
							<td id="dernier_emp" ></td>
						</tr>
                                                <tr>
                                                    <td>Anciennet&eacute; : </td>
                                                    <td id="anciennete_der_emp" ></td>
						</tr>
						<tr>
							<td>Fonction actuelle : </td>
							<td id="fonction_actuel" ></td>
						</tr>
						<tr>
							<td>Corps : </td>
							<td id="corps" ></td>
						</tr>
						<tr>
							<td>Grade : </td>
							<td id="grade" ></td>
						</tr>
						<tr>
							<td>Indice : </td>
							<td id="indice" ></td>
						</tr>
						<tr>
							<td>D&eacute;partement : </td>
							<td id="dep" ></td>
						</tr>
						<tr>
							<td>Direction : </td>
							<td id="dir" ></td>
						</tr>
						<tr>
							<td>Service : </td>
							<td id="serv" ></td>
						</tr>
						<tr>
							<td>Division : </td>
							<td id="division" ></td>
						</tr>
						<tr>
							<td>Localit&eacute; de Service : </td>
							<td id="localite_service"></td>
						</tr>
						<tr>
							<td>Date du Mise a jour : </td>
							<td id="date_maj" ></td>
						</tr>
						
					</table>
					<br>
					<table width="100%" border="0" style="font-size: 9px; text-align: center;display:none" id="footPrint">
						<tr id="headPrint">
							
							<td style="width:25%;">DRHA Porte 356</td>
							<td style="width:50%;">email : sgdrha@gmail.com</td>
							<td style="width:25%;">Tel : 032 11 070 91</td>
							
						</tr>
					</table>
					<!--
				    <div class="row">
						<div  class="md-col-4">Photo</div>
						<div  class="md-col-4"><img id="photo" src="" style="width: 100px;"/></div>
						<div  class="md-col-4"></div>
					</div>
					<br>
					<div class="row">
						<div  class="md-col-4">Ref</div>
						<div id="ref" class="md-col-4"></div>
						<div  class="md-col-4"></div>
					</div>
					<br>
					<div class="row">
						<div  class="md-col-4">Date</div>
						<div id="date_depot" class="md-col-4"></div>
						<div  class="md-col-4"></div>
					</div>
					<br>
					<div class="row">
						<div  class="md-col-4">Nom et prenom</div>
						<div id="nom_prenom" class="md-col-4"></div>
						<div  class="md-col-4"></div>
					</div>
					<br>
					<div class="row">
						<div  class="md-col-4">Sexe</div>
						<div id="sexe" class="md-col-4"></div>
						<div  class="md-col-4"></div>
					</div>
					<br>
					<div class="row">
						<div  class="md-col-4">Date naissance</div>
						<div id="date_naiss" class="md-col-4"></div>
						<div  class="md-col-4"></div>
					</div>
					<br>
					<div class="row">
						<div  class="md-col-4">Situation matrimoniale</div>
						<div id="sit_mat" class="md-col-4"></div>
						<div  class="md-col-4"></div>
					</div>
					<br>
					<div class="row">
						<div  class="md-col-4">Experience</div>
						<div id="experience" class="md-col-4"></div>
						<div  class="md-col-4"></div>
					</div>
					<br>
					<div class="row">
						<div  class="md-col-4">Telephone</div>
						<div id="phone" class="md-col-4"></div>
						<div  class="md-col-4"></div>
					</div>
					<br>
					<div class="row">
						<div  class="md-col-4">Niveau</div>
						<div id="niveau" class="md-col-4"></div>
						<div  class="md-col-4"></div>
					</div>
					-->
				  </div>
				  <div class="modal-footer">
					<a type="button" class="btn btn-default"  id="editerPop" href="">EDITER</a>
					<button type="button" class="btn btn-default" data-dismiss="modal" id="fermerApropos" onclick="printDetail()">IMPRIMER</button>
					<button type="button" class="btn btn-default" data-dismiss="modal" id="fermerApropos">FERMER</button>
				  </div>
				</div>
			  </div>
		  </div>
</div>
<script>
function printDetail(){
	document.getElementById('headPrint').style.display = '';
	document.getElementById('footPrint').style.display = '';
    var prtContent = document.getElementById('detailPrint');
    var WinPrint = window.open("");
    WinPrint.document.write(prtContent.innerHTML);
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close(); 
}
</script>