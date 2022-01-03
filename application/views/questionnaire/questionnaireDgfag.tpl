{include_php file=$zCssJs}
<script src="{$zBasePath}assets/message/js/mustache.js"></script><!--!-->
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">ENQUÊTE</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Gestion des absences</a></li>
									<li class="breadcrumb-item">Suivi des actes</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<div class="clear"></div>
								<div id="innerContent">
									<div class="panel-body">
										<h3>ENQUÊTE SUR LES CONDITIONS DE TRAVAIL DES AGENTS DE LA DGFAG</h3>
									</div>
									<div class="row">
										<div id="quiz">
											<div id="info_question">
												Nous vous remercions de bien vouloir consacrer quelques instants pour répondre à ce sondage organisé par la DGFAG. Vos réponses sont précieuses car elles permettront de dresser la situation actuelle des conditions de travail des agents de la DGFAG sur l’étendue du territoire national. Les résultats serviront de base pour mieux cibler les projets d’amélioration à mettre en place.
											</div>
											<ul id="list_answers">
												Isaorana ianao mba hanokana fotoana hamaliana ity fanadihadiana nokarakarain'ny DGFAG ity. Sarobidy ny valin-teninao satria hamela anay hanadihady ny fepetra ahafahan'ny mpiasa miasa eto anivon'ny DGFAG manerana ny faritany nasionaly. Ny vokatra azo dia mba hahazoana mikendry kokoa ireo tetik'asa fanatsarana hotanterahina.
											</ul>
											<div id="list_comments"></div>
											<div id="list_btn">
												<a onclick="suivant(1,1)">Suivant</a>
											</div>
										</div>
									</div>
								</div>              

								<div id="template_info_question" style="display:none;">
									<h4>LIEU DE TRAVAIL A ANALAMANGA</h4>
									<p>[[data.quizz_questions_libelle_fr]] / [[data.quizz_questions_libelle_mg]]? *</p>
								</div>	
								<div id="template_question" style="display:none;">
									<li><input type="radio" [[data.checked]] value="[[data.quiz_answers_id]]" name="question_number_[[data.quiz_questions_id]]">[[data.quiz_answers_libelle_mg]]</li>
								</div>
								<div id="template_list_btn" style="display:none;">
									<a onclick="retour([[data.quiz_questions_id]],[[data.quizz_questions_previous]])">Retour</a>
									<a onclick="suivant([[data.quiz_questions_id]],[[data.quizz_questions_next]])">Suivant</a>
								</div>
								<div id="template_commentaire" style="display:none;">
									<p>Pourquoi ?/Inona ny antony?</p>
									<p>(FACULTATIF / TSY VOATERY FENOINA)</p>
									<textarea cols="5" rows="5" id="answer_comments" >[[data.quiz_resultats_commentaire]]</textarea>
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

$(document).ready(function(){
	
	
});

function retour(question_id,previous_question_id){
	var answer_id 		= $('input:checked').val(); 
	var answer_comments = $('#answer_comments').val(); 
	$.ajax({
		url: '{/literal}{$zBasePath}{literal}Questionnaire/ajaxGetPreviousQuestion',
		type: "GET",
		data: {
			previous_question_id: previous_question_id,
			question_id: question_id,
			answer_id: answer_id,
			answer_comments: answer_comments,
		},
		success: function (data) {
			var retours						= JSON.parse(data);
			if( retours.length > 0 ){
				//info question
				var rendered					= "";
				var question					= retours[0];
				Mustache.tags					= ["[[", "]]"];
				var template_info_question		= $('#template_info_question').html();
				Mustache.parse(template_info_question);
				rendered						= Mustache.render(template_info_question, {data :question});
				$('#info_question').html(rendered);
				//list btn
				var rendered					= "";
				var question					= retours[0];
				Mustache.tags					= ["[[", "]]"];
				var template_list_btn			= $('#template_list_btn').html();
				Mustache.parse(template_list_btn);
				rendered						= Mustache.render(template_list_btn, {data :question});
				$('#list_btn').html(rendered);
				//list comments
				if(question.quizz_questions_has_comments == 1){
					var rendered					= "";
					var question					= retours[0];
					Mustache.tags					= ["[[", "]]"];
					var template_commentaire		= $('#template_commentaire').html();
					Mustache.parse(template_commentaire);
					rendered						= Mustache.render(template_commentaire, {data :question});
					$('#list_comments').html(rendered);
				}
				//list answers
				var rendered					= "";
				for ( var iIndex = 0;iIndex<retours.length;iIndex++){
					Mustache.tags					= ["[[", "]]"];
					var template_question			= $('#template_question').html();
					Mustache.parse(template_question);
					if( retours[iIndex].quiz_answers_id == retours[iIndex].answer_choose){
						retours[iIndex].checked = "checked";
					}else{
						retours[iIndex].checked = "";
					}
					rendered						= rendered + Mustache.render(template_question, {data :retours[iIndex]});
				}
				$('#list_answers').html(rendered);
			}else{
				$("#quiz").html("Merci d'avoir consacré du temps pour répondre à ce questionnaire! MANKASITRAKA INDRINDRA TOMPOKO!") ;
			}
		}
	});
}

function suivant(question_id,next_question_id){
	var answer_id 		= $('input:checked').val(); 
	var answer_comments = $('#answer_comments').val(); 
	$.ajax({
		url: '{/literal}{$zBasePath}{literal}Questionnaire/ajaxGetNextQuestion',
		type: "GET",
		data: {
			next_question_id: next_question_id,
			question_id: question_id,
			answer_id: answer_id,
			answer_comments: answer_comments
		},
		success: function (data) {
			var retours						= JSON.parse(data);
			if( retours.length > 0 ){
				//info question
				var rendered					= "";
				var question					= retours[0];
				Mustache.tags					= ["[[", "]]"];
				var template_info_question		= $('#template_info_question').html();
				Mustache.parse(template_info_question);
				rendered						= Mustache.render(template_info_question, {data :question});
				$('#info_question').html(rendered);
				//list btn
				var rendered					= "";
				var question					= retours[0];
				Mustache.tags					= ["[[", "]]"];
				var template_list_btn			= $('#template_list_btn').html();
				Mustache.parse(template_list_btn);
				rendered						= Mustache.render(template_list_btn, {data :question});
				$('#list_btn').html(rendered);
				//list comments
				if(question.quizz_questions_has_comments == 1){
					var rendered					= "";
					var question					= retours[0];
					Mustache.tags					= ["[[", "]]"];
					var template_commentaire		= $('#template_commentaire').html();
					Mustache.parse(template_commentaire);
					rendered						= Mustache.render(template_commentaire, {data :question});
					$('#list_comments').html(rendered);
				}
				//list answers
				var rendered					= "";
				for ( var iIndex = 0;iIndex<retours.length;iIndex++){
					Mustache.tags					= ["[[", "]]"];
					var template_question			= $('#template_question').html();
					Mustache.parse(template_question);
					if( retours[iIndex].quiz_answers_id == retours[iIndex].answer_choose){
						retours[iIndex].checked = "checked";
					}else{
						retours[iIndex].checked = "";
					}
					rendered						= rendered + Mustache.render(template_question, {data :retours[iIndex]});
				}
				$('#list_answers').html(rendered);
			}else{
				$("#quiz").html("Merci d'avoir consacré du temps pour répondre à ce questionnaire! MANKASITRAKA INDRINDRA TOMPOKO!") ;
			}
		}
	});
}	
</script>
{/literal}