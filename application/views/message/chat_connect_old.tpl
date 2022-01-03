{include_php file=$zCssJs}
{include_php file=$zHeader}
<div id="container">
	<div id="breadcrumb"><a href="{$zBasePath}">Accueil</a> <span>&gt;</span>RohiCh@t</div>
	
	{literal}<script>var zBasePath = "{/literal}{$zBasePath}{literal}"; var socket;</script>{/literal}
	<script type="text/javascript" src="{$zBasePath}assets/message/livesearch/js/jquery.marcopolo.js"></script>
	<script type="text/javascript" src="{$zBasePath}assets/message/livesearch/js/jquery.manifest.js"></script>
	<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/message/css/message.css">
	<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/message/css/bubble.css">
	<link rel="stylesheet" media="screen and (max-width : 992px)" type="text/css" href="{$zBasePath}assets/message/css/message_992px.css">
	<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/message/css/perfect-scrollbar.css">
	<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/message/css/emojione.css">
	<link href="{$zBasePath}assets/message/mdi/css/materialdesignicons.min.css" media="all" rel="stylesheet" type="text/css" />
	<link rel="stylesheet/less" type="text/css" href="{$zBasePath}assets/message/css/chat_less.less">
	<script src="{$zBasePath}assets/message/js/less.js" type="text/javascript"></script>
	<section id="content">
        {include_php file=$zLeft}	
		<div id="innerContent">
		<div id="ContentBloc">
		<input id="user_id_connected" value="{$oData['oCandidat'][0]->user_id}" type="hidden"/>
		<input id="matricule_connected" value="{$oData['oCandidat'][0]->matricule}" type="hidden"/>
		<input id="user_id_destinataire" value="" type="hidden"/>

		<div class="error-feeds alert alert-danger" id="error-socket" style="display:none;"></div>
        <style id="dynamic-styles"></style>
		<div id="chat-window" class="">
			<div id="chat-head" class="style-bg">
				<i class="mdi mdi-arrow-left"></i> <i class="mdi mdi-fullscreen-exit"></i> <i class="mdi mdi-menu"></i> 
				<span id="myName">
					{if $oData['oCandidat'][0]->nom!='' && $oData['oCandidat'][0]->prenom !=''}
						{$ooData['oCandidat'][0]->nom}&nbsp;{$oData['oCandidat'][0]->prenom}
					{else}
						{$oData['oUser'].nom}&nbsp;{$oData['oUser'].prenom}
					{/if}
				</span>
				<span id="theirName"></span>
				<i class="mdi mdi-chevron-down"></i>
			</div>  
			<div id="chat-content">
				<div id="dialog_confirm" title="Suppresion">
					<div class="dialog_top">
						Voulez-vous vraiment supprimer ce message?
					</div>
					<div class="dialog_bottom">
						<div class="dialog_annule">
							Annuler
						</div>
						<div class="dialog_suppr">
							Supprimer
						</div>
					</div>
				</div>
				<div class="overlay"></div>
				<div id="floater-position">
				  <div id="add-contact-floater" class="floater control style-bg hidden"><i class="mdi mdi-plus"></i></div>          
				  <div id="chat-floater" class="floater control style-bg hidden"><i class="mdi mdi-comment-text-outline"></i></div>   
				</div>
				
				<div class="card menu">
					<div class="header">
						<img src="{$zBasePath}assets/upload/{$oData['oCandidat'][0]->id}.{$oData['oCandidat'][0]->type_photo}" />
						<h3></h3>
					</div>
					<div class="content">
						<div class="i-group">
						  
						</div>        
						<br />
						<div class="center"><canvas id="colorpick" width="250" height="220" ></canvas></div>                        
					</div>
				</div>
				
				<div class="list-same-service">
					<div class="meta-bar"><input class="nostyle search-filter" type="text" placeholder="Recherche" /></div>
					<ul class="list mat-ripple scrollable_connected" >
						{if $oData.oConnected==null}
							<span>Aucun agent connect&eacute;</span>
						{else}
							{foreach from=$oData.oMemeService item=oConnected}
								{if $oData['oUser'].id != $oConnected.iUserId}
									<li class="each_connected">
										{if $oConnected.state == 1}
											<span class="connected_state online"></span>
										{else}
											<span class="connected_state away"></span>
										{/if} 
										
										<img src="{$zBasePath}assets/upload/{$oConnected.idPhoto}.{$oConnected.typePhoto}"> 
										<span class="name">{$oConnected.zNomPrenom}</span>
										<input class="iUserId" value="{$oConnected.iUserId}" type="hidden"/>
									</li>
								{/if}
							{/foreach}
						{/if}
					</ul>
				</div>
				<div class="chat_left">
					<div class="people hidden" id="mustache_left">
						<div class="aucune_personne hidden">
							Commencez une nouvelle conversation avec les agents de votre service en allant sur le menu en bas à gauche de ce chat( <i class="mdi mdi-account-circle"></i> ) et en cliquant sur un destinataire voulu.
							Veuillez actualiser votre  page avec CTRL+F5 si vous rencontrez un problème,ceci est encore une version test. Merci!
						</div>
					</div>
					<div class="spinner-feeds" style="text-align: center; margin-top:150px;"><i class="la la-spinner fa-spin fa-5x"></i></div>
				</div>
				
				<div class="list-connected">
					<div class="meta-bar"><input class="nostyle search-filter" type="text" placeholder="Recherche" /></div>
					<ul class="list mat-ripple scrollable_connected">
					{$oData.iCountConnected}
					{if $oData.oConnected==null}
						<span>Aucun agent connect&eacute;</span>
					{else}
						{foreach from=$oData.oConnected item=oConnected}
							{if $oData['oUser'].id != $oConnected.iUserId}
							<li class="each_connected">
								<span class="connected_state online"></span>
								<img src="{$zBasePath}assets/upload/{$oConnected.idPhoto}.{$oConnected.typePhoto}"> 
								<span class="name">{$oConnected.zNomPrenom}</span>
								<input class="iUserId" value="{$oConnected.iUserId}" type="hidden"/>
							</li>
							{/if}
						{/foreach}
					{/if}
				</div>
				
				<div class="chat_right">
					<div id="_toLoadEnd" class="hidden">
						<div class="chat" data-chat="nouveau" >
							<input id="destMessage" value="" type="hidden"/>
							<span class="destTexte">Demarrez une nouvelle conversation avec <span class="destName"></span> <i class="mdi mdi-twitch"></i></span>
						</div>
						<div class="chat" data-chat="nouveauGrp" >
							<span class="destTexte">En maintenance........ <i class="mdi mdi-twitch"></i></span>
						</div>
					</div>
					<div id='typingLoad' class="hidden">
						<div id='typing' class="isTyping--active">
						  <span class='isTyping__dot'>•</span>
						  <span class='isTyping__dot'>•</span>
						  <span class='isTyping__dot'>•</span>
						</div>
					</div>
					<div id="content_message"></div>
					<div id="content_left"></div>
					<div id="mustache_message">
						<div class="chat" data-chat="personne[[id]]" data-destinataire="[[dest]]">
							<input class="dest" value="[[id]]" type="hidden"/>
							<div class="scrollable" id="mustache_right[[id]]" >
							</div>
						</div>
						<div class="list-smiley hidden">
						<table>
							<tbody>
								<tr>
									<td><img class="img-smiley" alt=":blush:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f60a.png"/></td>
									<td><img class="img-smiley" alt=":heart_eyes:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f60d.png"/></td>
									<td><img class="img-smiley" alt=":sob:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f62d.png"/></td>
									<td><img class="img-smiley" alt=":stuck_out_tongue_winking_eye:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f61c.png"/></td>
									<td><img class="img-smiley" alt=":stuck_out_tongue_closed_eyes:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f61d.png"/></td>
								</tr>
								<tr>
									<td><img class="img-smiley" alt=":grin:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f601.png"/></td>
									<td><img class="img-smiley" alt=":joy:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f602.png"/></td>
									<td><img class="img-smiley" alt=":smiley:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f603.png"/></td>
									<td><img class="img-smiley" alt=":smile:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f604.png"/></td>
									<td><img class="img-smiley" alt=":sweat_smile:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f605.png"/></td>
								</tr>
								<tr>
									<td><img class="img-smiley" alt=":laughing:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f606.png"/></td>
									<td><img class="img-smiley" alt=":innocent:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f607.png"/></td>
									<td><img class="img-smiley" alt=":wink:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f609.png"/></td>
									<td><img class="img-smiley" alt=":kissing_heart:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f618.png"/></td>
									<td><img class="img-smiley" alt=":kissing_smiling_eyes:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f619.png"/></td>
								</tr>
								<tr>
									<td><img class="img-smiley" alt=":slight_smile:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f642.png"/></td>
									<td><img class="img-smiley" alt=":angry:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f620.png"/></td>
									<td><img class="img-smiley" alt=":rage:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f621.png"/></td>
									<td><img class="img-smiley" alt=":expressionless:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f611.png"/></td>
									<td><img class="img-smiley" alt=":rolling_eyes:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f644.png"/></td>
								</tr>
								<tr>
									<td><img class="img-smiley" alt=":unamused:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f612.png"/></td>
									<td><img class="img-smiley" alt=":sweat:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f613.png"/></td>
									<td><img class="img-smiley" alt=":pensive:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f614.png"/></td>
									<td><img class="img-smiley" alt=":confused:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f615.png"/></td>
									<td><img class="img-smiley" alt=":confounded:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f616.png"/></td>
								</tr>
								<tr>
									<td><img class="img-smiley" alt=":cry:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f622.png"/></td>
									<td><img class="img-smiley" alt=":persevere:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f623.png"/></td>
									<td><img class="img-smiley" alt=":triumph:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f624.png"/></td>
									<td><img class="img-smiley" alt=":sunglasses:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f60e.png"/></td>
									<td><img class="img-smiley" alt=":astonished:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f632.png"/></td>
								</tr>
								<tr>
									<td><img class="img-smiley" alt=":cold_sweat:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f630.png"/></td>
									<td><img class="img-smiley" alt=":scream:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f631.png"/></td>
									<td><img class="img-smiley" alt=":mask:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f637.png"/></td>
									<td><img class="img-smiley" alt=":sleeping:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f634.png"/></td>
									<td><img class="img-smiley" alt=":dizzy_face:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f635.png"/></td>
								</tr>
								<tr>
									<td><img class="img-smiley" alt=":heartbeat:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f493.png"/></td>
									<td><img class="img-smiley" alt=":broken_heart:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f494.png"/></td>
									<td><img class="img-smiley" alt=":two_hearts:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f495.png"/></td>
									<td><img class="img-smiley" alt=":cupid:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f498.png"/></td>
									<td><img class="img-smiley" alt=":heartpulse:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f497.png"/></td>
								</tr>
								<tr>
									<td><img class="img-smiley" alt=":no_mouth:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f636.png"/></td>
									<td><img class="img-smiley" alt=":upside_down:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f643.png"/></td>
									<td><img class="img-smiley" alt=":rofl:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f923.png"/></td>
									<td><img class="img-smiley" alt=":thinking:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f914.png"/></td>
									<td><img class="img-smiley" alt=":money_mouth:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f911.png"/></td>
								</tr>
								<tr>
									<td><img class="img-smiley" alt=":lips:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f444.png"/></td>
									<td><img class="img-smiley" alt=":tongue:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f445.png"/></td>
									<td><img class="img-smiley" alt=":whale:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f433.png"/></td>
									<td><img class="img-smiley" alt=":horse:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f434.png"/></td>
									<td><img class="img-smiley" alt=":monkey_face:" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{$zBasePath}assets/message/image/png/1f435.png"/></td>
								</tr>
								<tr>
									<td><img class="img-smiley" alt="::" src="{$zBasePath}assets/message/image/png/1f6.png"/></td>
									<td><img class="img-smiley" alt="::" src="{$zBasePath}assets/message/image/png/1f6.png"/></td>
									<td><img class="img-smiley" alt="::" src="{$zBasePath}assets/message/image/png/1f6.png"/></td>
									<td><img class="img-smiley" alt="::" src="{$zBasePath}assets/message/image/png/1f6.png"/></td>
									<td><img class="img-smiley" alt="::" src="{$zBasePath}assets/message/image/png/1f6.png"/></td>
								</tr>
							</tbody>
						</table>
					</div>
					</div>
					<div id="tplRight" class="hidden">
						<div class="chat-bubble" data-messageId="[[idMsg]]">
								<div class="delete delete_you hidden"><i class="mdi mdi-delete"></i></div>
								<div class="avatar" title="[[right.prenom]]">
									<img class="avatar__img" src="{$zBasePath}assets/upload/[[right.idPhoto]].[[right.typePhoto]]"/>
								</div>
							<div class="msg_time hidden">[[right.dateEtHeure]]</div>
							<div class="bubble  [[right.bubble]]">
								<span class="msg_content">{literal}[[right.message]]{/literal}</span>
							</div>
								<div class="delete delete_me hidden"><i class="mdi mdi-delete"></i></div>
						</div>
					</div>
					<div id="tplLeft" class="hidden">
							<div class="chat_personne" data-chat ="personne[[left.id]]">
								<input class="left_destId" type="hidden" value="[[left.id]]" />
								<div class="img_personne">
									<img src="{$zBasePath}assets/upload/[[id_photo]].[[type_photo]]" alt="bubble_client" />
								</div>
								<div class="data_personne ||#left.unread|| unread ||/left.unread||">
									<span class="name">[[left.nomP]]</span>
									<span class="time">[[left.dateEtHeure]]</span>
									{literal}
									<span class="preview">[[left.message]]</span>
									{/literal}
								</div>
							</div>
					</div>
					<div class="write">
						<textarea id="message" type="text" placeholder="Votre message..." ></textarea>
						<ul class="groupe_droite">
							<li>
								<input type="file" name="fichier" id="fichier" class="inputfile" />
								<label for="fichier" class="attach mdi mdi-folder-multiple" alt="Envoyer un fichier" title="Envoyer un fichier"></label>
							</li>
							<li>
								<span id="submit" type="submit" title="Envoyer"><i class="mdi mdi-send"></i></span>
							</li>
						</ul>
					</div>
				</div>
				<ul class="chat-nav control mat-ripple tiny">
					<li title="Liste de tous les agents" data-route=".list-same-service"><i class="mdi mdi-account-circle"></i></li>
					<li title="Liste des messages" data-route=".chat_left" class="li_route"><i class="mdi mdi-comment-text"></i></li>
					<li title="Liste des connectés" data-route=".list-connected"><i class="mdi mdi-account-multiple"></i></li>
				</ul>
			</div>
        </div>
			
     <div class="container theme-showcase" role="main">
        <div class="error-feeds alert alert-danger" style="display:none;margin: 0px;">Desol&eacute; , il sav&eagrave;re qu'il y ait un petit probl&eagrave;me avec le serveur</div>	
        <div class="panel panel-default" id="chat-window" style="display:none;"></div>
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
<script src="http://rohi.mef.gov.mg:3000/socket.io/socket.io.js"></script>
<script src="{$zBasePath}assets/message/js/delivery.js"></script>
<script src="{$zBasePath}assets/message/js/perfect-scrollbar.jquery.js"></script>
<script src="{$zBasePath}assets/message/js/mustache.js"></script><!--!-->
<script src="{$zBasePath}assets/message/js/emojione.js"></script>
<script src="{$zBasePath}assets/message/js/animation_chat.js" type="text/javascript"></script>
<script src="{$zBasePath}assets/message/js/client.js"></script>

<script src="{$zBasePath}assets/sau/js/moment.min.js"></script>
<script src="{$zBasePath}assets/sau/js/fullcalendar.min.js"></script>
<script src="{$zBasePath}assets/sau/js/bootbox.js"></script>
<script src="{$zBasePath}assets/sau/js/lang-all.js"></script>
<script src="{$zBasePath}assets/sau/js/getcalendar.js?sdsd"></script>


{literal}
    <script>
	loadCSS = function(href) {
		var cssLink		= $("<link rel='stylesheet' type='text/css' href='"+href+"'>");
		$("head").append(cssLink); 
	};	
	
	var selectedValue	= 1;
	$('#select_connected').change(function(){
        selectedValue	= $(this).val();
        $('.bubble_connected').addClass('hidden');
		$('.bubble_connected[data-connect='+selectedValue+']').removeClass('hidden') ;
        $('#select_connected').removeAttr('selected');
    });

	$(function(){
		$('.scrollable_connected').perfectScrollbar({
            suppressScrollX : true,
            MinScrollbarLength : 15
        });
		$('.chat_left').perfectScrollbar({
            suppressScrollX : true,
            MinScrollbarLength : 15
        });
		$('#dialog_confirm').hide();
		$('.error-feeds').hide();
		$('.spinner-feeds').show();
	});
</script>

{/literal}
{include_php file=$zFooter}
</div>

</body>
</html>

