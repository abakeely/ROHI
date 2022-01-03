{include_php file=$zCssJs}
<script src="{$zBasePath}assets/js/jquery.dataTables.js?V2"></script>
<script src="{$zBasePath}assets/js/dataTables.bootstrap.js?V2"></script>
<script src="{$zBasePath}assets/js/jquery.maskedinput.js?V2"></script>
<script type="text/javascript" src="{$zBasePath}assets/common/js/app/carriere.js?{$zClearCache}"></script>
{include_php file=$zHeader}
<div id="container">
    <section id="content">
        {include_php file=$zLeft}	
		<div id="innerContent">
		<div id="ContentBloc">
		<h2>Importation d'un excel</h2>
		<div id="breadcrumb">Fil d'ariane&nbsp;&nbsp;:&nbsp;&nbsp;<a href="{$zBasePath}">Accueil</a> <span>&gt;</span> <a href="#">RH</a> <span>&gt;</span> <a href="#">GCAP</a> <span>&gt;</span> importation </div>
		{assign var=nom value=""}
        {assign var=typeGcap_libelle value=""}
        {assign var=type_libelle value=""}
        {assign var=gcap_motif value=""}
        {assign var=gcap_lieuJouissance value=""}
        {assign var=gcap_dateDebut value="date('d/m/Y')"}
        {assign var=gcap_dateFin value="date('d/m/Y')"}
        {assign var=gcap_pieceJointe value=""}
        <div class="contenuePage">
		<!--*Debut Contenue*-->
            <ul class="tabs">
                <li class="tab-link current" onclick="" imodeid="1" data-tab="tab-1" id="liTab-1" >
                   Importation
                </li>
            </ul>
            <div id="tab-1" class="tab-content current">
                <div class="row1">
                    <form action="#" method="POST" name="formulaireExcel" id="formulaireExcel" style="display:block!important">
                        <fieldset>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="field">
                                        <label>Premiere Ligne</label>
                                        <input type="text" name="PremiereLigne" id="PremiereLigne" value="7" placeholder="Nom"/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="field">
                                        <label>Fichier Excel</label>
                                        <div class="field">
                                            <td><input type="file" name="file_excel" id="file_excel" style="display:none"  class="inputfile inputfile-1 inputDotation" data-multiple-caption="files selected" accept=".xlsx, .xls"/>
                                            <label for="file_excel">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> 
                                            <span>Fichier joint</span></label>&nbsp;&nbsp;
                                            </td>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="margin:50px"class="clearfix">
                                <div class="field col-xs-12 col-sm-12 text-center">
                                    <input type="button" class="button" onClick="saveDotation();" name="" id="Importer" value="Importer">
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <br>
                <div class="text-center" >
                    <br><h3 style=" border-bottom: none; important! font-size: 1.1em; font-weight: bold; font-family: Lato;">
                        <div align="center">LISTE DES GCAP </div></h3>
                </div>
                <!--<div class="row">
                    <form class="form-horizontal" role="form" name="gcap2" id="gcap2" action="{$zBasePath}gcap2/importer" method="POST"></form>
                </div>	-->
                <table class="table table-striped table-bordered table-hover" id="table-liste-prets">
                    <thead>
                            <tr >
								<th>Matricule</th>
								<th>CIN</th>
								<th>DEPARTEMENT</th>
								<th>DIRECTION</th>
                                <th>Nom et Pr&eacute;nom</th>
                                <th>Type d'absence</th>
                                <th>Type d'autorisation</th>
								<th>Date de D&eacute;but</th>
                                <th>Date de Fin</th>
                                <th>Motif</th>
                                <th>Lieu de jouissance</th>
                                <th>Pi&egrave;ce jointe</th>
                                <th>Action</th>
                            </tr>
                    </thead>
                </table>
            </div>

            <div id="popop_img" style="z-index:9999" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div  id="modalBodyEvent" class="modal-body" style="text-align:center">
                        </div>
                        <div class="modal-footer">
                            <button id="agenda_button_close_event" type="button" class="btn" data-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
		
    <!--*Fin Contenue*-->
    </div>
	</div>
	<div id="calendar"></div>
	</div>
</section>
<section id="rightContent" class="clearfix">
	{include_php file=$zRight}
</section>
<div id="dialog" title="Dialog Title"></div>
{include_php file=$zFooter}

<style>
{literal}
.separateur.separateur1, h3 {
    border-bottom: none!important;
}
{/literal}
</style>
<script type="text/javascript">
{literal}
    var prets = $('#table-liste-prets').DataTable( {
		"processing": true,
		"serverSide": true,
		"order": [[ 0, "desc" ]],
		"ajax":{
			url :"{/literal}{$zBasePath}{literal}gcap2/get_gcap", 
			data: function ( d ) {
               
			},
			type: "POST",  
			error: function(){  
                console.log("erreur");
            }
		},
	}); 


	function getListePret()
    {
		prets.ajax.reload();
	}

function saveDotation()
{
   
	var form = $('#formulaireExcel');
    var lien = "{/literal}{$zBasePath}gcap2/importer"{literal};
    var urlsave = "{/literal}{$zBasePath}gcap2/importation/"{literal}+$('#PremiereLigne').val();
    var formdata = (window.FormData) ? new FormData(form[0]) : null;
    var data = (formdata !== null) ? formdata : form.serialize();
    $.ajax({
        type : "POST",
        url  : urlsave.replace(/\s/g, ''),
        contentType: false, // obligatoire pour de l'upload
        processData: false, // obligatoire pour de l'upload
        dataType: 'html', // selon le retour attendu
        data : data,
        success: function(data){
            window.location.href = lien.replace(/\s/g, '');
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(xhr.responseText);
            alert(thrownError);
        },
        async:false
    });
    //return false;
}
	
$(document).ready (function ()
		{
			'use strict';

            //input fichier lettre
            ;( function ( document, window, index )
            {
                var inputs = document.querySelectorAll( '.inputDotation' );
                Array.prototype.forEach.call( inputs, function( input )
                {
                    var label	 = input.nextElementSibling,
                        labelVal = label.innerHTML;

                    input.addEventListener( 'change', function( e )
                    {
                        var fileName = '';
                        if( this.files && this.files.length > 1 )
                            fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
                        else
                            fileName = e.target.value.split( '\\' ).pop();

                        if( fileName )
                            label.querySelector( 'span' ).innerHTML = fileName;
                        else
                            label.innerHTML = labelVal;
                    });

                    // Firefox bug fix
                    input.addEventListener( 'focus', function(){ input.classList.add( 'has-focus' ); });
                    input.addEventListener( 'blur', function(){ input.classList.remove( 'has-focus' ); });
                });
            }( document, window, 0 ));
		});


        
{/literal}
</script>
<style>
{literal}
.fa {
	font-size: 20px !important;
}

form .cell {
    width: 50%;
    float: left !important;
}

/* upload fichier*/
.js .inputfile {
    width: 0.1px;
    height: 0.1px;
    opacity: 0;
    overflow: hidden;
    position: absolute;
    z-index: -1;
}

.inputfile + label {
    width:auto!important;
	max-width:300px!important;
	min-width:120px!important;
    text-overflow: ellipsis;
    white-space: nowrap;
    cursor: pointer;
    display: inline-block;
    overflow: hidden;
    padding: 0.625rem 1.25rem;
    /* 10px 20px */
}

.no-js .inputfile + label {
    display: none;
}

.inputfile:focus + label,
.inputfile.has-focus + label {
    outline: 1px dotted #000;
    outline: -webkit-focus-ring-color auto 5px;
}

.inputfile + label * {
    /* pointer-events: none; */
    /* in case of FastClick lib use */
}

.inputfile + label svg {
    width: 1em;
    height: 1em;
    vertical-align: middle;
    fill: currentColor;
    margin-top: -0.25em;
    /* 4px */
    margin-right: 0.25em;
    /* 4px */
}


/* style 1 */

.inputfile-1 + label {
    color: #f1e5e6;
    background-color: #58688b;
}

.inputfile-1:focus + label,
.inputfile-1.has-focus + label,
.inputfile-1 + label:hover {
    background-color: #722040;
}


/* style 2 */

.inputfile_2 + label {
    color: #d3394c;
    border: 2px solid currentColor;
}

.inputfile_2:focus + label,
.inputfile_2.has-focus + label,
.inputfile_2 + label:hover {
    color: #722040;
}


/* style 3 */

.inputfile_3 + label {
    color: #d3394c;
}

.inputfile_3:focus + label,
.inputfile_3.has-focus + label,
.inputfile_3 + label:hover {
    color: #722040;
}


/* style 4 */

.inputfile_4 + label {
    color: #d3394c;
}

.inputfile_4:focus + label,
.inputfile_4.has-focus + label,
.inputfile_4 + label:hover {
    color: #722040;
}

.inputfile_4 + label figure {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background-color: #d3394c;
    display: block;
    padding: 20px;
    margin: 0 auto 10px;
}

.inputfile_4:focus + label figure,
.inputfile_4.has-focus + label figure,
.inputfile_4 + label:hover figure {
    background-color: #722040;
}

.inputfile_4 + label svg {
    width: 100%;
    height: 100%;
    fill: #f1e5e6;
}


/* style 5 */

.inputfile_5 + label {
    color: #d3394c;
}

.inputfile_5:focus + label,
.inputfile_5.has-focus + label,
.inputfile_5 + label:hover {
    color: #722040;
}

.inputfile_5 + label figure {
    width: 100px;
    height: 135px;
    background-color: #d3394c;
    display: block;
    position: relative;
    padding: 30px;
    margin: 0 auto 10px;
}

.inputfile_5:focus + label figure,
.inputfile_5.has-focus + label figure,
.inputfile_5 + label:hover figure {
    background-color: #722040;
}

.inputfile_5 + label figure::before,
.inputfile_5 + label figure::after {
    width: 0;
    height: 0;
    content: '';
    position: absolute;
    top: 0;
    right: 0;
}

.inputfile_5 + label figure::before {
    border-top: 20px solid #dfc8ca;
    border-left: 20px solid transparent;
}

.inputfile_5 + label figure::after {
    border-bottom: 20px solid #722040;
    border-right: 20px solid transparent;
}

.inputfile_5:focus + label figure::after,
.inputfile_5.has-focus + label figure::after,
.inputfile_5 + label:hover figure::after {
    border-bottom-color: #d3394c;
}

.inputfile_5 + label svg {
    width: 100%;
    height: 100%;
    fill: #f1e5e6;
}


/* style 6 */

.inputfile_6 + label {
    color: #d3394c;
}

.inputfile_6 + label {
    border: 1px solid #d3394c;
    background-color: #f1e5e6;
    padding: 0;
}

.inputfile_6:focus + label,
.inputfile_6.has-focus + label,
.inputfile_6 + label:hover {
    border-color: #722040;
}

.inputfile_6 + label span,
.inputfile_6 + label strong {
    padding: 0.625rem 1.25rem;
    /* 10px 20px */
}

.inputfile_6 + label span {
    width: 200px;
    min-height: 2em;
    display: inline-block;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
    vertical-align: top;
}

.inputfile_6 + label strong {
    height: 100%;
    color: #f1e5e6;
    background-color: #d3394c;
    display: inline-block;
}

.inputfile_6:focus + label strong,
.inputfile_6.has-focus + label strong,
.inputfile_6 + label:hover strong {
    background-color: #722040;
}

@media screen and (max-width: 50em) {
	.inputfile_6 + label strong {
		display: block;
	}
}

{/literal}
</style>
</div>

</body>
</html>