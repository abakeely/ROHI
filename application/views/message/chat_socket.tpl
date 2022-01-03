{include_php file=$zCssJs}
{include_php file=$zHeader}
<div id="container">
	<div id="breadcrumb"><a href="{$zBasePath}">Accueil</a> <span>&gt;</span>RohitCh@t</div>
	
	{literal}<script>var zBasePath = "{/literal}{$zBasePath}{literal}"; var socket;</script>{/literal}
	<script type="text/javascript" src="{$zBasePath}assets/message/livesearch/js/jquery.marcopolo.js"></script>
	<script type="text/javascript" src="{$zBasePath}assets/message/livesearch/js/jquery.manifest.js"></script>
	<link rel="stylesheet" media="screen and (max-width : 992px)" type="text/css" href="{$zBasePath}assets/message/css/message_992px.css">
	<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/message/css/perfect-scrollbar.css">
	<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/message/css/bubble.css">
	<link rel="stylesheet/less" type="text/css" href="{$zBasePath}assets/message/css/rohi_chat.css">
	<link rel="stylesheet/less" type="text/css" href="{$zBasePath}assets/message/css/jquery.contextMenu.min.css">
	<script src="{$zBasePath}assets/message/js/less.js" type="text/javascript"></script>
	<section id="content">
        {include_php file=$zLeft}	
		<div id="innerContent">
		<div id="ContentBloc">

		<input id="user_id_connected" value="{$oData['oCandidat'][0]->user_id}" type="hidden"/>
		<input id="matricule_connected" value="{$oData['oCandidat'][0]->matricule}" type="hidden"/>
		<input id="user_id_destinataire" value="" type="hidden"/>
		<input id="last_expediteur_id" value="{$oData['oLastMessage']['message_expediteurId']}" type="hidden"/>
		<input id="last_expediteur_nom" value="{$oData['oLastMessage']['nom']} {$oData['oLastMessage']['prenom']}" type="hidden"/>
		<input id="last_onglet" value="" type="hidden"/>
		<h3 class="text-left">Rohi@tchat </h3>
		<div class="error-feeds alert alert-danger" id="error-socket" style="display:none;"></div>
				<div class="container">
				<ul class="chat-nav tabs">
					<li title="Liste des messages"  class="list_des_messages" id="nav_inbox_chat"><i class="la la-envelope-o" aria-hidden="true"></i></li>
					<li title="Liste des agents"  class="list_des_connectes" id="nav_list_des_connectes"><i class="la la-user" aria-hidden="true"></i></li>
					<p id="img_destinataire_en_cours"></p> 
					<p id="nom_destinataire_en_cours"><span></span></p>
					<span id="statut_destinataire_en_cours" class=""></span>
				</ul>
				<div class="messaging">
					  <div class="inbox_msg">
						
						<div class="inbox_people">
						  <div class="headind_srch">
							<div class="srch_bar">
							  <div class="stylish-input-group">
								<input type="text" id="search-bar" class="search-bar"  placeholder="Recherche" >
							  </div>
							</div>
						  </div>
						  <div class="list_des_messages inbox_chat" id="inbox_chat"></div>
						  <div class="list_des_connectes inbox_chat" id="list_des_connectes"></div>
						  <div class="list_tous_les_agents inbox_chat" id="list_tous_les_agents"></div>
						</div>

						<div class="mesgs">
						  <div class="msg_history" id="msg_history"></div>
						  <div class="type_msg">
							<div class="input_msg_write">
							  <input type="text" class="write_msg" id="text_msg" placeholder="Rédiger votre message ici" />
							  <input type="text" class="hidden" id="text_msg_to_post" />
							  <input type="text" class="hidden" id="action_en_cours" value="new" />
							  <input type="text" class="hidden" id="message_id" value="" />
							  <button class="msg_send_btn" id="msg_send_btn" type="button">
								<i class="la la-paper-plane-o" aria-hidden="true"></i>
							  </button>
							  <button class="msg_choose_file inputfile" id="choose_file" type="button" name="msg_choose_file">
								<i class="la la-folder" aria-hidden="true"></i>
							  </button>
							  <button class="msg_similey" id="choose_smiley" type="button">
								<i class="la la-smile-o" aria-hidden="true" ></i> 
							  </button>
							  <input type="file" name="fichier" id="fichier" class="hidden" />
							</div>
						  </div>
						</div>
					  </div>
					  <p class="text-center top_spac"> Design by <a target="_blank" href="#">DRH 2019</a></p>
			</div></div>
		
		<div id="calendar"></div></div>
	</section>
	<section id="rightContent" class="clearfix">
		{include_php file=$zRight}
	</section>

	<div id="template_chat_list" style="display:none">
		<div class="chat_list list_message" onclick="destinataire([[data.message_id]],[[data.user_id]],'[[data.nom]] [[data.prenom]]',$(this))">
		  <div class="chat_people" style="cursor:pointer;" >
			<div class="chat_img"> <img src="http://rohi.mef.gov.mg:8088/ROHI/assets/upload/[[data.photo]]" alt="no image"> </div>
			<div class="chat_ib" >
			  <h5 >[[data.nom]] [[data.prenom]]<span class="chat_date">[[data.date]]</span></h5>
			  <p class="template_chat_list_message  message_[[data.message_statut]]" style="color:black;" message_id="[[data.message_id]]" message="[[data.message]]">[[data.message]] </p>
			</div>
		  </div>
		</div>
	</div>

	<div id="template_history_chat_me" style="display:none">
		<div class="[[data.class1]]">
		  <div class="incoming_msg_img [[data.class4]] chat_img"> 
		  <img width="20px" src="http://rohi.mef.gov.mg:8088/ROHI/assets/upload/[[data.photo]]" alt="no image"> 
		  </div>
		  <div class="[[data.class2]]">
			<div class="[[data.class3]] [[data.class5]]">
			  <p class="chat_message [[data.class1]] message" message_id="[[data.message_id]]" message="[[data.message]]">[[data.message]]</p>
			  [[#data.pdf_file]]
					<embed src="http://rohi.mef.gov.mg:8088/ROHI/assets/upload_tchat/[[data.file_name]]" type="application/pdf" width="100%" page="1" height="400px" />
			  [[/data.pdf_file]]
			  <span class="time_date">[[data.date]]</span>
			  [[#data.message_vue]]
			  <span class="la la-check" aria-hidden="true">
				Vu : [[data.message_date_vue]]</span>
			  </div>
			  [[/data.message_vue]]
			  <img src="http://rohi.mef.gov.mg:8088/ROHI/assets/upload_tchat/[[data.file_name]]" alt="&nbsp;" />
			  
			  [[#data.file]]
			   <a target="_blank" href="http://rohi.mef.gov.mg:8088/ROHI/assets/upload_tchat/[[data.file_name]]" alt="&nbsp;"/>Télecharger</a>
			  [[/data.file]]
			  </div>
		  </div> 
		</div>
	</div>

	<div id="template_history_chat_you" style="display:none">
		<div class="[[data.class1]]">
		  <div class="incoming_msg_img [[data.class4]] chat_img"> 
		  <img width="20px" src="http://rohi.mef.gov.mg:8088/ROHI/assets/upload/[[data.photo]]" alt="no image"> 
		  </div>
		  <div class="[[data.class2]]">
			<div class="[[data.class3]] [[data.class5]]">
			  <p class="chat_message [[data.class1]] message" message_id="[[data.message_id]]" message="[[data.message]]">[[data.message]]</p>
			  [[#data.pdf_file]]
					<embed src="http://rohi.mef.gov.mg:8088/ROHI/assets/upload_tchat/[[data.file_name]]" type="application/pdf" width="100%" page="1" height="400px" />
			  [[/data.pdf_file]]
			  <span class="time_date">[[data.date]]</span>
			  <img src="http://rohi.mef.gov.mg:8088/ROHI/assets/upload_tchat/[[data.file_name]]" alt="&nbsp;" />
			  
			  [[#data.file]]
			   <a target="_blank" href="http://rohi.mef.gov.mg:8088/ROHI/assets/upload_tchat/[[data.file_name]]" alt="&nbsp;"/>Télecharger</a>
			  [[/data.file]]
			  </div>
		  </div> 
		</div>
	</div>

	<div id="template_list_connectes" style="display:none">
		<div class="chat_list" onclick="destinataire('',[[data.user_id]],'[[data.nom]] [[data.prenom]]',$(this))">
		  <div class="chat_people" style="cursor:pointer;"  >
			<div class="chat_img"> <img  width="20px" src="http://rohi.mef.gov.mg:8088/ROHI/assets/upload/[[data.photo]]" alt="no image"> </div>
			<div class="chat_ib">
			  <h5>[[data.nom]] [[data.prenom]]<span class="chat_date online">[[data.date]]</span></h5>
			</div>
		  </div>
		</div>
	</div>

	<div id="template_list_agents" style="display:none">
		<div class="chat_list" onclick="destinataire('',[[data.user_id]],'[[data.nom]] [[data.prenom]]',$(this))">
		  <div class="chat_people" style="cursor:pointer;"  >
			<div class="chat_img"> <img src="http://rohi.mef.gov.mg:8088/ROHI/assets/upload/[[data.photo]]" alt="no image"> </div>
			<div class="chat_ib">
			  <h5 >[[data.nom]] [[data.prenom]]<span class="chat_date [[data.statut]]">&nbsp;</span></h5>
			</div>
		  </div>
		</div>
	</div>

	<div id="template_filtre_agents" style="display:none">
		<div class="chat_list" onclick="destinataire('',[[data.user_id]],'[[data.nom]] [[data.prenom]]',$(this))">
		  <div class="chat_people" style="cursor:pointer;" >
			<div class="chat_img"> <img src="http://rohi.mef.gov.mg:8088/ROHI/assets/upload/[[data.photo]]" alt="no image"> </div>
			<div class="chat_ib">
			  <h5 >[[data.nom]] [[data.prenom]]<span class="chat_date [[data.statut]]">&nbsp;</span></h5>
			</div>
		  </div>
		</div>
	</div>

	<div id="template_image_agent" style="display:none">
		<img style='width:37px;height:33px;border-radius:50%;' src='http://rohi.mef.gov.mg:8088/ROHI/assets/upload/[[data.file]]' alt='no image'>
	</div>

	<div class="list-smiley hidden">
		<table>
			<tbody>
				<tr>
					<td><img class="img-smiley" alt=":blush:" data-src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" src="{$zBasePath}assets/message/image/png/1f60a.png"/></td>
					<td><img class="img-smiley" alt=":heart_eyes:" data-src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" src="{$zBasePath}assets/message/image/png/1f60d.png"/></td>
					<td><img class="img-smiley" alt=":sob:" data-src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" src="{$zBasePath}assets/message/image/png/1f62d.png"/></td>
					<td><img class="img-smiley" alt=":stuck_out_tongue_winking_eye:" data-src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" src="{$zBasePath}assets/message/image/png/1f61c.png"/></td>
					<td><img class="img-smiley" alt=":lips:" data-src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" src="{$zBasePath}assets/message/image/png/1f444.png"/></td>
				</tr>
				<tr>
					<td><img class="img-smiley" alt=":grin:" data-src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" src="{$zBasePath}assets/message/image/png/1f601.png"/></td>
					<td><img class="img-smiley" alt=":joy:" data-src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" src="{$zBasePath}assets/message/image/png/1f602.png"/></td>
					<td><img class="img-smiley" alt=":smiley:" data-src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" src="{$zBasePath}assets/message/image/png/1f603.png"/></td>
					<td><img class="img-smiley" alt=":smile:" data-src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" src="{$zBasePath}assets/message/image/png/1f604.png"/></td>
					<td><img class="img-smiley" alt=":sweat_smile:" data-src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" src="{$zBasePath}assets/message/image/png/1f605.png"/></td>
				</tr>

			</tbody>
		</table>
	</div>

<script src="http://rohi.mef.gov.mg:3000/socket.io/socket.io.js"></script>
<script src="{$zBasePath}assets/message/js/mustache.js"></script><!--!-->
<script src="{$zBasePath}assets/message/js/animation_chat.js" type="text/javascript"></script>
<script src="{$zBasePath}assets/message/js/emojione.js"></script>
<script src="{$zBasePath}assets/message/js/jquery.ui.position.js"></script>
<script src="{$zBasePath}assets/message/js/jquery.contextMenu.js"></script>
<script src="{$zBasePath}assets/message/js/client.js"></script>

{literal}

{/literal}
{include_php file=$zFooter}
</div>

</body>
</html>

