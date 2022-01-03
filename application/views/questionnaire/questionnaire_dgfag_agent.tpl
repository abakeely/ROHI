<div class="panel-body">
	<div class="row">
		{if $oData.enquete_effectue == "0"}
		<div id="quiz" class="wizard-question col-md-7">
			<div id="info_question" class="info_item">
				<p>Nous vous remercions de bien vouloir consacrer quelques instants pour répondre à ce sondage organisé par la DGFAG. Vos réponses sont précieuses car elles permettront de dresser la situation actuelle des conditions de travail des agents de la DGFAG sur l’étendue du territoire national. Les résultats serviront de base pour mieux cibler les projets d’amélioration à mettre en place.</p>
			</div>
			<ul id="list_answers" class="info_item">
				<li><p>Isaorana ianao mba hanokana fotoana hamaliana ity fanadihadiana nokarakarain'ny DGFAG ity. Sarobidy ny valin-teninao satria hamela anay hanadihady ny fepetra ahafahan'ny mpiasa miasa eto anivon'ny DGFAG manerana ny faritany nasionaly. Ny vokatra azo dia mba hahazoana mikendry kokoa ireo tetik'asa fanatsarana hotanterahina.</p></li>
			</ul>
			<div id="list_comments"></div>
			<div id="list_btn">
				<a class="btn_forward" onclick="suivant(1,1)">Suivant</a>
			</div>
		</div>
		<div class="col-md-5">
			<figure><img src="{$zBasePath}assets/img/enquete.jpg" alt="" class="img-fluid"></figure>
		</div>
		{else}
			<div id="quiz" class="wizard-question col-md-7">
				<div id="info_question" class="info_item">
					<p>Vous avez déjà repondu toutes les questions. Merci!</p>
				</div>
			</div>
			<div class="col-md-5">
				<figure><img src="{$zBasePath}assets/img/enquete.jpg" alt="" class="img-fluid"></figure>
			</div>
		{/if }
	</div>
</div>.               


<div class="wizard_container wizard-question">
	<div id="template_info_question" class="main_question wizard-header" style="display:none;">
		<p class="custum_progress">[[data.quizz_questions_rang]] sur 34</p>
		<p class="title_question">[[data.quizz_questions_titre]]</p>
		<p class="desc_question">[[data.quizz_questions_libelle_fr]] / [[data.quizz_questions_libelle_mg]] <label class="label_required">*<label></p>
	</div>	
	<div id="template_question" style="display:none;" >
		<ul class="[[data.classs]]">
			<li class="form-group"><label><input type="radio" [[data.checked]] value="[[data.quiz_answers_id]]" name="question_number_[[data.quiz_questions_id]]">[[data.quiz_answers_libelle_fr]]  [[data.quiz_answers_libelle_mg]]</label></li>
		</ul>
	</div>
	<div id="template_list_btn" class="actions clearfix" style="display:none;">
		<a class="btn_forward" onclick="retour([[data.quiz_questions_id]],[[data.quizz_questions_previous]])">Retour</a>
		<a class="btn_forward" onclick="suivant([[data.quiz_questions_id]],[[data.quizz_questions_next]])">Suivant</a>
	</div>
	<div id="template_commentaire" style="display:none;">
		<div class="info_item">
			<p>Pourquoi ?/Inona ny antony?</p>
			<textarea cols="5" rows="5" id="answer_comments" >[[data.quiz_resultats_commentaire]]</textarea>
		</div>
	</div>
</div>

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
					$("#info_question").html("<p>Nous vous remercions de bien vouloir consacrer quelques instants pour répondre à ce sondage organisé par la DGFAG. Vos réponses sont précieuses car elles permettront de dresser la situation actuelle des conditions de travail des agents de la DGFAG sur l’étendue du territoire national. Les résultats serviront de base pour mieux cibler les projets d’amélioration à mettre en place.</p>") ;
					
					$("#list_answers").html("<li><p>Isaorana ianao mba hanokana fotoana hamaliana ity fanadihadiana nokarakarain'ny DGFAG ity. Sarobidy ny valin-teninao satria hamela anay hanadihady ny fepetra ahafahan'ny mpiasa miasa eto anivon'ny DGFAG manerana ny faritany nasionaly. Ny vokatra azo dia mba hahazoana mikendry kokoa ireo tetik'asa fanatsarana hotanterahina.</p></li>") ;
					
					$("#list_btn").html("<a class='btn_forward' onclick='suivant(1,1)'>Suivant</a>") ;
					
				}
			}
		});
	}

	function suivant(question_id,next_question_id){
		var answer_id 		= $('input:checked').val(); 
		var answer_comments = $('#answer_comments').val(); 
		if(next_question_id =="1"){
			answer_id = 0;
		}
		if(answer_id === undefined){
			alert("Veuillez choisir une reponse!");
			return false;
		}
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
						if( retours[iIndex].quiz_answers_id ){
							retours[iIndex].classs = "visible";
						}else{
							retours[iIndex].classs = "invisible";
						}
						rendered						= rendered + Mustache.render(template_question, {data :retours[iIndex]});
						
					}
					$('#list_answers').html(rendered);
				}else{
					$("#quiz").html("<p class='end_answers'>Merci d'avoir consacré du temps pour répondre à ce questionnaire! MANKASITRAKA INDRINDRA TOMPOKO!<p>") ;
				}
			}
		});
	}	
</script>
{/literal}
