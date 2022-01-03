<div id="certificat_cv">
    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" style="left: 0; width: 50%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    REMERCIEMMENT
                </div>
                <div class="modal-body" id="detailPrint">
                    <table width="100%" border="0" style="font-size: 9px; text-align: center;display:none" id="headPrint">
                            <tr>
                                    <td style="width: 10%;"><img src="<?php echo base_url();?>assets/img/mfb.png" width="50px"/></td>
                                    <td style="width: 83%;">
                                            MINISTERE DES FINANCES ET DU BUDGET<br>
                                            SECRETARIAT GENERAL<br>
                                            Direction des Ressources Humaines et de l&acute;Appui<br>
                                            ATTESTATION D'INSCRIPTION
                                    </td>
                                    <td style="width: 10%;text-align: right;"><img src="<?php echo base_url();?>assets/img/logo_drha.png" width="50px"/></td>
                            </tr>
                    </table>
                    <br>	
                    
                </div>
                <div class="modal-footer">
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