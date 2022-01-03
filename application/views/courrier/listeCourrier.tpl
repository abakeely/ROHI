{include_php file=$zCssJs}
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Liste courriers</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item">Gestion de courrier</li>
								</ul>
							</div>
                            <div class="col-auto float-right ml-auto">
								<button class="pure-materiel-button-contained" data-toggle="modal" data-target="#add_ticket"><i class="la la-envelope m-r-5"></i></button>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
                                <div class="table-responsive">
                                    <table id="table-liste-courriers" class="datatable table table-stripped mb-0">
                                        <thead>
                                            <tr>
                                                <th>Reférence</th>
                                                <th>Source</th>
                                                <th>Resp Saisie</th>
                                                <th>Statut</th>
                                                <th>Resp Assignation</th>
                                                <th>Type de dossier</th>
                                                <th>Priorité</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        
                                    </table>
                                </div>
						
							</div>
						</div>

					</div>
                    <div id="add_ticket" class="modal custom-modal fade" role="dialog">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="col-md-10">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Responsable du courrier - Insertion courrier</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div id="add_courrier" class="pro-overview tab-pane fade show active">
                                        <div class="modal-body">
                                            <form method="POST" class="needs-validation" novalidate action="" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form--group form-focus">
                                                            <label class="focus-label">Réf</label>
                                                            <input type="text" readonly="true" data-dd-jump="5" onclick="fn_set_ref_courrier()"  id="ref_courrier_add" name="ref_courrier" value="" class="form-control floating" required>
                                                            <div class="invalid-feedback">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group form-focus select-focus">
                                                            <label class="focus-label">Type</label>
                                                            <select name="id_type" class="select">
                                                                <option value="">Sélectionner</option>
                                                                <option value="1">Bordereau d'envoi</option>
                                                                <option value="2">Circulaire</option>
                                                                <option value="3">Communiqu&eacute;</option>
                                                                <option value="4">Envellope</option>
                                                                <option value="5">Invitation</option>
                                                                <option value="6">Lettre</option>
                                                                <option value="7">Note de service</option>
                                                                <option value="8">Soit-transmis</option>
                                                                <option value="9">Renouvelement contrat</option>
                                                                <option value="10">Avenant au contrat</option>
                                                                <option value="11">Avenant reclassement</option>
                                                                <option value="12">Avancement</option>
                                                                <option value="13">Int&eacute;gration</option>
                                                                <option value="14">Autres mouvements</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-focus">
                                                            <div class="cal-icon">
                                                                <input id="date-input" name="date_dossier" class="form-control floating datetimepicker" type="text" required>
                                                            </div>	
                                                            <label class="focus-label">Date dossier</label>
                                                            <div class="invalid-feedback">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group form-focus">
                                                            <label class="focus-label">Réf dossier</label>
                                                            <textarea  name="ref_dossier" class="form-control floating"></textarea>
                                                            <div class="invalid-feedback">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-focus">
                                                            <div class="cal-icon">
                                                                <input id="date-input" name="date_creation" class="form-control floating datetimepicker" type="text" required>
                                                            </div>	
                                                            <label class="focus-label">Date d'effet</label>
                                                            <div class="invalid-feedback">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form--group form-focus">
                                                            <label class="focus-label">Titre</label>
                                                            <input type="text"  id="titre_add" name="titre" value="" class="form-control floating" required>
                                                            <div class="invalid-feedback">
                                                            </div>
                                                        </div>
                                                    </div>	
                                                    <div class="col-md-4">
                                                        <div class="form-group form-focus select-focus">
                                                            <label class="focus-label">Niveau de priorité</label>
                                                            <select name="id_priorite" class="select" required>
                                                                <option value="NORMAL">Normal</option>
                                                                <option value="URGENT">Urgent</option>
                                                                <option value="PRIORITE">Priorité</option>
                                                            </select>
                                                            <div class="invalid-feedback">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group form-focus">
                                                            <label class="focus-label">Descriptions :</label>
                                                            <textarea  name="description" class="form-control floating"></textarea>
                                                            <div class="invalid-feedback">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>	
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input class="form-control" type="file" name="piece_jointe">
                                                        </div>
                                                    </div>
                                                    <!---div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label>Taper tous les IM concernés :</label>
                                                            <select class="select" id="agents_concernes" name="agents_concernes[]" required multiple="multiple">
                                                                <option value="">Sélectionner</option>
                                                            </select>
                                                            <div class="invalid-feedback">
                                                                Veuillez choisir  les IM concernés
                                                            </div>
                                                        </div>
                                                    </div-->
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label>Taper tous les IM concernés(*)</label>
                                                            <select class="select"  id="agents_concernes" name="agents_concernes[]" required multiple="multiple">
                                                                <option value="">Sélectionner</option>
                                                            </select>
                                                            <div class="invalid-feedback">
                                                                Veuillez choisir tous les IM concernés.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="submit-section">
                                                            <button class="pure-materil-button-contained">Insérer</button>
                                                        </div>
                                                    </div>	
                                                </div>	
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
    		</div>
			<!-- /Page Content -->
					
        </div>
		<!-- /Page Wrapper -->

	</div>
	<!-- /Main Wrapper -->

{include_php file=$zFooter}

{literal}
    <script>
        $(document).ready (function (){
            $('#table-liste-courriers').DataTable( {
                "processing": true,
                bDestroy : true,
                "serverSide": true,
                "order": [[ 0, "desc" ]],
                "pageLength": 5,
                "ajax":{
                    url :"{/literal}{$zBasePath}{literal}gcap/extrants/gestion-absence/ajax", 
                    data: function ( d ) {
                        d.iMatricule = $("#iMatricule").val(),
                        d.iCin = $("#iCin").val()
                    },
                    type: "post",  
                    error: function(){  

                    }
                }
            });
        })
    </script>
{/literal}
