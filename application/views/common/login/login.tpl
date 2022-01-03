{include_php file=$zCssJs}
<link href="{$zBasePath}assets/css/bootstrap.min.css?aaaa2017V320180404" rel="stylesheet">
<div id="container">
    <div class="container-fluid">
        <div class="row homepage">
					
            <div class="col-md-8 col-sm-5 col-xs-12 text-center boxes" {if sizeof($oData.toGetHomeArticle)>0 AND $oData.toGetHomeArticle.0.home_text==""} style="top:20px!important;" {/if}>
				<img src="" id="img_slider" width="95%" style="margin:12% 0 0 0;">

				{if sizeof($oData.toGetHomeArticle)>0}
				{foreach from=$oData.toGetHomeArticle item=toGetHomeArticle}

				{if $toGetHomeArticle.home_topText==1}
				{if $toGetHomeArticle.home_text !=""}<h1 style="font-family: 'Dancing Script'" class="homeMobileImage homeTopDesk">&nbsp;{$toGetHomeArticle.home_text}&nbsp;</h1>{/if}
				{/if}

				{if $toGetHomeArticle.home_image != ""}
					<!--img class="homeMobileImage" src="{$zBasePath}assets/common/img/{$toGetHomeArticle.home_image}?{$oData.date}" {if $toGetHomeArticle.home_text !=""} width="{$toGetHomeArticle.home_pourcent}%" {else} width="70%" {/if} alt="" style="vertical-align:middle"-->
				{/if}

				{if $toGetHomeArticle.home_topText==0}
				{if $toGetHomeArticle.home_text !=""}<h1 style="font-family: 'Dancing Script'" class="homeDesk">{if $toGetHomeArticle.hime_isLien==1}<a href="{$zBasePath}assets/accueil/upload/ilovepdf_merged(1).pdf" target="_blank">&nbsp;{/if}{$toGetHomeArticle.home_text}&nbsp;{if $toGetHomeArticle.hime_isLien==1}</a>{/if}</h1>{/if}
				{if $toGetHomeArticle.home_article != ""}<h1 style="font-family: 'Dancing Script'" class="homeDesk"><span>({$toGetHomeArticle.home_article})</span></h1>{/if}
				{/if}
				{/foreach}
				{/if}
			</div>
			<div class="col-md-5 col-md-push-7 col-sm-7 col-sm-push-5 col-xs-12  col-xs-push-0 animateinHome">
				<!--- login --->
					{include_php file=$zLogin}
				<!--- fin --->

				<!--- Inscription -->
					{include_php file=$zInscription}
				<!--- fin inscription -->

				<!--- Changement PassWord -->
					{include_php file=$zChangePassword}
					{if $toGetHomeArticle.home_topText==0}
					{if $toGetHomeArticle.home_text !=""}<h1 style="font-family: 'Dancing Script'" class="homeMobile">{if $toGetHomeArticle.hime_isLien==1}<a href="{$zBasePath}assets/accueil/upload/ilovepdf_merged(1).pdf" target="_blank">&nbsp;{/if}{$toGetHomeArticle.home_text}&nbsp;{if $toGetHomeArticle.hime_isLien==1}</a>{/if}</h1>{/if}
					{if $toGetHomeArticle.home_article != ""}<h1 style="font-family: 'Dancing Script'" class="homeMobile"><span>({$toGetHomeArticle.home_article})</span></h1>{/if}
					{/if}
				<!--- fin password  -->
			</div>
    </div> <!-- /row -->
</div> <!-- /container -->
{literal}

<script>
jQuery(document).ready(function() {

	var zBasePath = '{/literal}{$zBasePath}{literal}';
	var passbtn = jQuery('.resetPass');
	var inscrbtn = jQuery('.signUp');
	{/literal}{if isset($oData.type) && ($oData.type == 1)}{literal}
	passbtn.click();
	{/literal}{/if}{literal}
	{/literal}{if isset($oData.type) && ($oData.type == 2)}{literal}
	inscrbtn.click();
	{/literal}{/if}{literal}
	
	 $("#img_slider").attr("src",zBasePath + "/assets/images/2.png");
	 window.setInterval("ChangerImage()", 3000);
		
})


function ChangerImage() {
	var _zBasePath = '{/literal}{$zBasePath}{literal}';
	var image = new Array ();
		image[0] = _zBasePath + "/assets/images/1.png";
		image[1] = _zBasePath + "/assets/images/2.png";
		/*image[2] = _zBasePath + "/assets/images/3.jpg";
		image[3] = _zBasePath + "/assets/images/4.png";*/
		var size = image.length;
		var x = Math.floor(size*Math.random());
		console.log(image[x]);
		$("#img_slider").attr("src",image[x]);
}

function showMessage(){
	{/literal}{if isset($oData.type) && ($oData.message)}{literal}
	bootbox.alert('{/literal}{$oData.message}{literal}') ;
	{/literal}{/if}{literal}
}


jQuery(document).ready(function() {
	$('input').tooltip();
	$('select').tooltip();
	$('button').tooltip();

	$("#validationChangePseudo").click(function(){
		var iRet = 1 ; 
		
			$(".obligatoire").each (function ()
			{	
				$(this).next().show();
				$(this).parent().removeClass("error");
				if($(this).val()=="")
				{
					$(this).parent().addClass("error");
					$(this).next().hide();
					 iRet = 0 ;
				}
			}) ;

			$(".StatutObligatoire").parent().removeClass("error");
			$(".StatutObligatoire").next().show();
			if ($(".StatutObligatoire option:selected").val() == '1')
			{
				$(".StatutObligatoire").parent().addClass("error");
				$(".StatutObligatoire").next().hide();
				iRet = 0 ;
			}
			
			if (iRet == 1)
			{	
				$("#changeMotDePasse").submit();
			} 
	})

	$("#validationInscription").click(function(){
		var iRet = 1 ; 
		
			$(".obligatoireInscr").each (function ()
			{	
				$(this).next().show();
				$(this).parent().removeClass("error");
				if($(this).val()=="")
				{
					$(this).parent().addClass("error");
					$(this).next().hide();
					 iRet = 0 ;
				}
			}) ;

			$(".StatutObligatoire1").parent().removeClass("error");
			$(".StatutObligatoire1").next().show();
			if ($(".StatutObligatoire1 option:selected").val() == '1')
			{
				$(".StatutObligatoire1").parent().addClass("error");
				$(".StatutObligatoire1").next().hide();
				iRet = 0 ;
			}
			
			if (iRet == 1)
			{	
				$("#create_form").submit();
			} 
	})

})

function validerForm(){

	var iRet = true ; 
	$(".br").hide();
	jQuery(document).ready(function() {
		$(".obligatoireLogin").each (function ()
		{
			$(this).next().show();
			$(this).parent().removeClass("error");
			if($(this).val()=="")
			{
				$(this).parent().addClass("error");
				$(this).next().hide();
				 iRet = false ;
			}
		}) ;

	}) ;

	return iRet ; 

}

function changeStatut(_iStatut,_iValue){
	$(document).ready(function() {
		$("#matricule"+ _iValue).val("");
		$("#nom").focus();
		switch(_iStatut)
		{
			case "1":
				$("#matricule"+ _iValue).attr("readonly","readonly");
				$("#matricule"+ _iValue).attr("placeholder","");
				$("#matricule"+ _iValue).val("");
				break;
			case "2":
				$("#matricule"+ _iValue).attr("readonly","readonly");
				$("#matricule"+ _iValue).mask("AAA");
				$("#matricule"+ _iValue).val("ECD");
				break;
			case "3":
				$("#matricule"+ _iValue).attr("readonly","Votre matricule");
				$("#matricule"+ _iValue).removeAttr("readonly");
				$("#matricule"+ _iValue).mask("999 999");
				$("#matricule"+ _iValue).focus();
				break;
			case "4":
				$("#matricule"+ _iValue).attr("readonly","readonly");
				$("#matricule"+ _iValue).mask("AAA");
				$("#matricule"+ _iValue).val("EMO");
				break;
			case "5":
				$("#matricule"+ _iValue).attr("placeholder","Votre matricule");
				$("#matricule"+ _iValue).removeAttr("readonly");
				$("#matricule"+ _iValue).mask("999 999");
				$("#matricule"+ _iValue).focus();
				break;
			case "6":
				$("#matricule"+ _iValue).attr("readonly","readonly");
				$("#matricule"+ _iValue).mask("AAA");
				$("#matricule"+ _iValue).val("ES");
				break;	
			case "7":
				$("#matricule"+ _iValue).attr("placeholder","Votre matricule");
				$("#matricule"+ _iValue).removeAttr("readonly");
				$("#matricule"+ _iValue).mask("999 999");
				$("#matricule"+ _iValue).focus();
				break;
			case "8":
				$("#matricule"+ _iValue).attr("placeholder","Votre matricule");
				$("#matricule"+ _iValue).removeAttr("readonly");
				$("#matricule"+ _iValue).mask("999 999");
				$("#matricule"+ _iValue).focus();
				break;
		}
	});	
}

function clickPrenom(){
  	 var matricule = $('#matricule111').val();
  		matricule = matricule.replace(' ','');
       var nom = $('#nom').val();
       var prenom = $('#prenom').val();
       if(matricule == ''){
       	bootbox.alert("Remplir votre matricule d'abord");
           //$('#message').html("Remplir votre matricule d'abord");
           $('#matricule111').focus();
           error = true;
       }
       else if(nom == ''){
       	bootbox.alert("Veuillez remplir votre nom");
          // $('#message').html("Veuillez remplir votre nom");
           $('#nom').focus();
           error = true;
       }
  		var statut = $('#statut').val();
       if((statut == 3 || statut == 7 || statut == 5 || statut == 8) && (prenom=="")){
           $.ajax({
               url: "{/literal}{$zBasePath}{literal}user/verify_im_nom/"+matricule+"/"+nom,
               type: 'get',
               success: function(data, textStatus, jqXHR) {
                   var obj = $.parseJSON(data);
  					if(obj){
  						if(obj.statut){
  							switch(obj.statut){
  								case 1:
  								  $('#prenom').val(obj.prenom);
  								  $('#prenom').attr('readonly','readonly');
  								  $('#nom').attr('readonly','readonly');
  								  $('#cin11').val(obj.cin);
  								  if(obj.cin!='')
  									$('#cin11').attr('readonly','readonly');
  								  $('#message').html("");
  								  $('#sexe').focus();
  								  break;
  								case 2:
  								   //$('#message').html(obj.msg);
  								   bootbox.alert(obj.msg);
  								   $('#matricule111').focus();
  								  break;
  								case 3:
  								  // $('#message').html(obj.msg);
  								   bootbox.alert(obj.msg);
  								   $('#nom').focus();	
  								   break;
  								case 4:
  									$('#message').html('');
  								break;
  							}
  						}
  					}  
               },
               async: false
            });
       }
  }

</script>
{/literal}