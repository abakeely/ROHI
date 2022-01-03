<div id="certificat_cv">
    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" style="left: 0; width: 50%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div align="center"
							<h4>Attestation de recensement</h4>
					</div>
                </div>
                <div class="modal-body" id="detailPrint">
                    <table width="100%" border="0" style="font-size: 9px; text-align: center;display:none" id="headPrint">
                            <tr>
                                    <td style="width: 10%;"><img src="<?php echo base_url();?>assets/img/mfb.png" width="50px"/></td>
                                    <td style="width: 83%;">
                                            MINISTERE DES FINANCES ET DU BUDGET<br>
                                            SECRETARIAT GENERAL<br>
                                            Direction des Ressources Humaines et de l&acute;Appui<br><br><br><br>
                                            ATTESTATION D'INSCRIPTION
                                    </td>
                                    <td style="width: 10%;text-align: right;"><img src="<?php echo base_url();?>assets/img/logo_drha.png" width="50px"/></td>
                            </tr>
                    </table>
                    <br>	
                    <table width="80%" border="0" style="line-height: 20px;">
                            <tr>
                                    <td>Numero :  <?php echo $id;?></td>
                                    <td colspan="5" style="text-align: right;">
                                            
                                    </td>
                            </tr>
                            <tr><td colspan="6" ><br><br></td></tr>
                            <tr>
                                <td colspan="6">
                               <!-- ATTESTASTION D'INSCRIPTION-->
                                <?php echo $genre==1?'Mr':'Mme' ?> <?php echo $nom_prenom ;?><?php echo $matricule;?>
                                en service au sein de la <?php echo $direction;?> 
                                au Minist&egrave;re des Finances et du Budget dans la r&eacute;gion  <?php echo $region?$region['libele']:'';?> depuis le <?php echo $date_service; ?>,
                                a &eacute;chu le  processus de recensement.
								<br>
								<br>
								</td>
							
                            </tr> 
                            <tr><td colspan="6" ><br><br></td></tr>
                            <tr>
                                <td colspan="6" style="text-align: right">
                                Fait &agrave; Antaninarenina le <?php echo $date; ?>.
								<br><br><br><br><br><br><br>
                                </td>
                            </tr>
							
							<tr>
								<td colspan="6" ><hr style="height: 2px;background-color: #808080" noshade></td>
							</tr>
							
							<tr>
								<td colspan="6" >
									<u><br> Vos identifiants:</u>
									<br>Pseudo :  <?php echo $login; ?> <br>  Mot de passe : <?php echo $password; ?>
                                
								</td>
							</tr>

                    </table>
                    
                </div>
                <div class="modal-footer">
                      <!--  <a type="button" class="btn btn-default"  id="editerPop" href="">EDITER</a>-->
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
    var prtContent = document.getElementById('detailPrint');
    var WinPrint = window.open("");
    WinPrint.document.write(prtContent.innerHTML);
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close(); 
}
</script>