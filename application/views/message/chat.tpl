{include_php file=$zHeader }
<script type="text/javascript" src="{$zBasePath}assets/message/livesearch/js/jquery.marcopolo.js"></script>
<script type="text/javascript" src="{$zBasePath}assets/message/livesearch/js/jquery.manifest.js"></script>
<script type="text/javascript" src="{$zBasePath}assets/message/bootstrap/dist/js/bootstrap.js"></script>
<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/message/bootstrap/dist/css/bootstrap.css">
<section id="mainContent" class="clearfix">
	<div id="leftContent">
		{include_php file=$zLeft}
		
	</div>
	<div id="innerContent">
        {assign var="oCandidat" value=$oData['oCandidat']}
        <div class="row" style="font-size: 16px;">
                
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-comment"></span> RohiCh@t
                    </div>
                    <div class="panel-body" style="">
                        <div class="col-lg-2 row">
                            
                                <button class="btn btn-primary btn-sm" id="submit">Nouveau message</button>
                            
                        </div>
                        
                        <div class="col-lg-6 row" style="height: auto">
                            <div class="panel">    
								<div class="panel-heading">
									
								</div>
								
								<div class="panel-body">
									<span id="noMessage">
										Demmarez une conversation
									</span>
									<div>
										
										<label>To:</label>
										<input id="destinataire" name="destinataire" type="text" class="form-control input-sm" placeholder="Tappez le nom de la personne" />
										<ul id="searchResult" data-toggle="true"></ul>
									</div>
									<ul class="chat" id="received" style="height: 500px">
										
									</ul>
								</div>
								
								<div class="panel-footer row">
									<div class="clearfix">
										<div id="msg_block">
											<div class="input-group">
												<input id="message" type="text" class="form-control input-sm" placeholder="Type your message here..." />
												<span class="input-group-btn">
													<button class="btn btn-warning btn-sm" id="submit" type="submit">Send</button>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>
                        </div>
                        
                        <div class="col-lg-2 row" style="float: right">
                            <div class="panel">
								<div class="panel-heading">Personne(s) Connectee(s)</div>
								
								<div class="panel-body">
									{if $oData.oConnected==null}
										<span>Aucun utilisateur connectes</span>
									{else}
									<ul>
										{foreach from=$oData.oConnected item=oConnected}
											<li><a href=# onclick=>{$oConnected.zNomPrenom}</a><br></li>
										{/foreach}
									</ul>
									{/if}
								</div>
							</div>
							
                        </div>
                        
                    </div>
                    
                </div>
                
        </div>
        
    </div>
</section>
{literal}


<script>
	$(function(){
		$('#destinataire').manifest({
			formatDisplay: function (data, $item, $mpItem) {
				return data.nomPrenom;
			},
			formatValue: function (data, $value, $item, $mpItem) {
				return data.userId;
			},
			marcoPolo : {
				url:'{/literal}{$zBasePath}{literal}message/autocomplete/',
				
				formatData : function(data){
					return data;
				},
				formatItem:function(data, $item){
					return data.nomPrenom;
				},
				
				minChars:2,
				param : 'query'
			},
			
			required : true
		});
	});
	
	
	function update_chats(){
		if(typeof(request_timestamp) == 'undefined' || request_timestamp == 0){
			var offset = 60*15; // 15min
			request_timestamp = parseInt( Date.now() / 1000 - offset );
		}
		
		$.ajax({
			url :"{/literal}{$zBasePath}{literal}message/get_message",
			type : "POST",
			data : {timestamp : request_timestamp,destinataireId : $(".mf_value").val()},
			success : function(data, textStatus, jqXHR){
				$("#received").html(data);
				var newIndex = data.length-1;
				if(typeof(data[newIndex]) != 'undefined'){
					request_timestamp = data[newIndex].timestamp;
				}
			}
		});
		
		
	}
	
	$(document).on('click', '#submit',function (e) {
		e.preventDefault();
		$.ajax({
			type: "POST",
			url: "{/literal}{$zBasePath}{literal}message/send_message", 
			data: {message: $("#message").val(),destinataireId : $(".mf_value").val()},  
			cache:false,
			success: 
              function(data){
				return true;  
              }
        });
		
		function callback (){
			$('#message').val('').removeClass('disabled').removeAttr('disabled');
		}
		callback();
		return false;
	});
	
	$('#message').keyup(function (e) {
		if (e.which == 13) {
			$('#submit').trigger('click');
		}
	});
	$(function(){
		setInterval(function (){
			update_chats();
		}, 1500);
	});

	
</script>

<style>
	/*** Manifest ***/

/* Manifest container that wraps the elements and now acts as, and should be
   styled as, the input. */
div.mf_container {
  border: 1px solid #000000;
  cursor: text;
  display: inline-block;
  padding: 2px;
  width: 494px;
}

/* Ordered list for displaying selected items. */
div.mf_container ol.mf_list {
  display: inline;
}

/* Selected item, regardless of state (highlighted, selected). */
div.mf_container ol.mf_list li.mf_item {
  border: 1px solid #C0C0C0;
  cursor: pointer;
  display: inline-block;
  margin: 2px;
  padding: 4px 4px 5px;
}

/* Selected item that's highlighted by mouseover. */
div.mf_container ol.mf_list li.mf_item.mf_highlighted {
  background-color: #E0E0E0;
}

/* Selected item that's selected by click or keyboard. */
div.mf_container ol.mf_list li.mf_item.mf_selected {
  background-color: #C0C0C0;
}

/* Remove link. */
div.mf_container ol.mf_list li.mf_item a.mf_remove {
  color: #E0E0E0;
  margin-left: 10px;
  text-decoration: none;
}

/* Remove link that's highlighted. */
div.mf_container ol.mf_list li.mf_item.mf_highlighted a.mf_remove {
  color: #FFFFFF;
}

/* Remove link that's selected. */
div.mf_container ol.mf_list li.mf_item.mf_selected a.mf_remove {
  color: #FFFFFF;
}

/* Actual input, styled to be invisible within the container. */
div.mf_container input.mf_input {
  border: 0;
  font: inherit;
  font-size: 100%;
  margin: 2px;
  outline: none;
  padding: 4px;
}

/*** Marco Polo ***/

/* Ordered list for display results. */
ol.mp_list {
  background-color: #FFFFFF;
  border-left: 1px solid #C0C0C0;
  border-right: 1px solid #C0C0C0;
  overflow: hidden;
  position: absolute;
  width: 498px;
  z-index: 99999;
}

/* Each list item, regardless of success, error, etc. */
ol.mp_list li {
  border-bottom: 1px solid #C0C0C0;
  padding: 4px 4px 5px 9px;
}

/* Each list item from a successful request. */
ol.mp_list li.mp_item {

}

/* Each list item that's selectable. */
ol.mp_list li.mp_selectable {
  cursor: pointer;
}

/* Currently highlighted list item. */
ol.mp_list li.mp_highlighted {
  background-color: #E0E0E0;
}

/* When a request is made that returns zero results. */
ol.mp_list li.mp_no_results {

}

/* When a request is made that doesn't meet the 'minChars' length option. */
ol.mp_list li.mp_min_chars {

}

/* When a request is made that fails during the ajax request. */
ol.mp_list li.mp_error {

}

</style>
{/literal}

{include_php file=$zFooter}
