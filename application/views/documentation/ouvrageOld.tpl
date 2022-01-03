{include_php file=$zCssJs}
	{include_php file=$zHeader}
<div id="container">
	<div id="breadcrumb">&nbsp;	</div>
	
	<section id="content">
		{include_php file=$zLeft}	
		<div id="innerContent">
			<div id="ContentBloc">
				<h2> Divers Ouvrages </h2>	
					<div id="breadcrumb">Fil d'ariane&nbsp;&nbsp;:&nbsp;&nbsp;<a href="{$zBasePath}">Accueil</a> <span>&gt;</span> <a href="{$zBasePath}documentation/infprat/sad/inf-prat">Archive et Documentation</a> <span>&gt;</span> <a href="{$zBasePath}documentation/catalogue/sad/catalogue-couverture">Catalogues </a> <span>&gt;</span> Divers Ouvrages </div>


<div class="contenuePage">
<br>
<center>
		{*
		{assign var=dataList value="array()"}
		{assign var=dataList[1] value="Formation"}
		{assign var=dataList[2] value="Politique Economique"}
		{assign var=dataList[3] value="Infrastructure et Environnement"}
		{assign var=dataList[4] value="Economie"}
		{assign var=dataList[5] value="Banque"}
		
		{assign var=dataList[6] value="Bailleur de Fonds"}
		{assign var=dataList[7] value="Budget"}
		{assign var=dataList[8] value="Douane"}	
		{assign var=dataList[9] value="Droit"}		
		{assign var=dataList[10] value="Tr&eacute;sor"}
		
		{assign var=dataList[11] value="Gestion Administration"}
		{assign var=dataList[12] value="Affaires Sociales"}
		{assign var=dataList[13] value="Dictionnaire et Lexique"}
		{assign var=dataList[14] value="Journal Officiel"}
		{assign var=dataList[15] value="Publication en s&eacute;rie"}
		{assign var=dataList[16] value="Divers"} 
		*}
<div><br>

<center>
<div class="row">
	<div align="right">
		<a href="{$zBasePath}documentation/catalogue/sad/catalogue-couverture" class="btn">Retour</a>
	</div>
	<br>
<div>		
<br><br>
	
  <div class="col-md-12">
    <div class="row">
		<div class="col-md-2">
		  <p><a href="{$zBasePath}documentation/pret_livre/sad/pret-economie/3">
			 <img  id="cat_economie" src="{$zBasePath}assets/img/img_sad/cat_/2.png" title="Economie" border="0" height="150" width="160">
		  </a></p><br>
		  <p><a href="{$zBasePath}documentation/pret_livre/sad/pret-economie/3" class="btn">Economie</a></p>		
		</div>
		
		<div class="col-md-2">
			<p><a href="{$zBasePath}documentation/pret_livre/sad/pret-budget/6">
			  <img  id="cat_budget" src="{$zBasePath}assets/img/img_sad/cat_/5.png" title="Budget" border="0" height="150" width="160">
			</a></p><br>
			<p><a href="{$zBasePath}documentation/pret_livre/sad/pret-budget/6" class="btn">Budget</a></p>
		</div>
		
		<div class="col-md-2">
			<p><a href="{$zBasePath}documentation/pret_livre/sad/pret-douane/7" >
			  <img id="cat_douane" src="{$zBasePath}assets/img/img_sad/cat_/11.png" title="Douane" border="0" height="150" width="160">
			  </a></p><br>
			<p><a href="{$zBasePath}documentation/pret_livre/sad/pret-douane/7" class="btn">Douane</a></p>	
		</div>
		
		<div class="col-md-2">
			<p><a href="{$zBasePath}documentation/pret_livre/sad/pret-impot/9">
			  <img  id="cat_impot" src="{$zBasePath}assets/img/img_sad/cat_/6.png"  title="Impôt" border="0" height="150" width="160">
			</a></p><br>
			<p><a href="{$zBasePath}documentation/pret_livre/sad/pret-impot/9" class="btn">Impôt</a></p>	
		</div>
		
		<div class="col-md-2">
			<p><a href="{$zBasePath}documentation/pret_livre/sad/pret-tresor/10">
			  <img id="cat_tresor" src="{$zBasePath}assets/img/img_sad/cat_/8.png" title="Trésor"  border="0" height="150" width="160">
			  </a></p><br>
			<p><a href="{$zBasePath}documentation/pret_livre/sad/pret-tresor/10" class="btn">Trésor</a></p>	
		</div>
		
		<div class="col-md-2">
			<p><a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/11">
			  <img  id="cat_gestion" src="{$zBasePath}assets/img/img_sad/cat_/12.png" title="Gestion" border="0" height="150" width="150">
			  </a></p><br>
			<p><a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/11" class="btn">Gestion</a></p>									
		</div>
	</div>
	<br>
	
	<div class="row">
	<div class="col-md-1"></div>
		<div class="col-md-2">
		  <p><a href="{$zBasePath}documentation/pret_livre/sad/pret-droit/8">
			<img  class="img_cat" id="cat_droit" src="{$zBasePath}assets/img/img_sad/cat_/1.png" title="Droit"  border="0" height="150" width="150">
			</a>
		  </p><br>
		  <p><a href="{$zBasePath}documentation/pret_livre/sad/pret-droit/8" class="btn">Droit</a></p>
		</div>
		
		<div class="col-md-2">
			<p><a href="{$zBasePath}documentation/pret_livre/sad/pret-politiqueeconomie/1">
			  <img  id="cat_politique" src="{$zBasePath}assets/img/img_sad/cat_/9.png" title="Politique Economique" border="0" height="150" width="160">
			</a></p><br>
			<p><a href="{$zBasePath}documentation/pret_livre/sad/pret-politiqueeconomie/1" class="btn">Politique Economique</a></p>	
		</div>
		
		<div class="col-md-2">
			<p><a href="{$zBasePath}documentation/pret_livre/sad/pret-environnement/2">
			  <img  id="cat_infra" src="{$zBasePath}assets/img/img_sad/cat_/4.png" title="Environnement" border="0" height="150" width="160">
			  </a></p><br>
			<p><a href="{$zBasePath}documentation/pret_livre/sad/pret-environnement/2" class="btn">Environnement</a></p>
		</div>
		
		<div class="col-md-2">
			<p><a href="{$zBasePath}documentation/pret_livre/sad/pret-banque/4">
			  <img id="cat_banque" src="{$zBasePath}assets/img/img_sad/cat_/3.png" title="Banque" border="0" height="150" width="160">
			</a></p><br>
			<p><a href="{$zBasePath}documentation/pret_livre/sad/pret-banque/4" class="btn">Banque</a></p>	
		</div>
		
		<div class="col-md-2">
			<p><a href="{$zBasePath}documentation/pret_livre/sad/pret-journalofficiel/5">
			  <img  id="cat_bailleur" src="{$zBasePath}assets/img/img_sad/cat_/10.png" title="Journal Officiel" border="0" height="150" width="160">
			  </a></p><br>
			<p><a href="{$zBasePath}documentation/pret_livre/sad/pret-journalofficiel/5" class="btn">Bailleurs de Fonds</a></p>	
		</div>
		
		
	</div>
	<br>
 
	<div class="row">
	<div class="col-md-1"></div>	
		<div class="col-md-2">
			<p><a href="{$zBasePath}documentation/pret_livre/sad/pret-affairesocial/12">
			  <img  id="cat_affaire" src="{$zBasePath}assets/img/img_sad/cat_/13.png" title="Affaire Sociale" border="0" height="150" width="160">
			</a></p><br>
			<p><a href="{$zBasePath}documentation/pret_livre/sad/pret-affairesocial/12" class="btn">Population et Affaire Sociale</a></p>	
		</div>
		
		<div class="col-md-2">
		   <p><a href="{$zBasePath}documentation/pret_livre/sad/pret-dictionnaire/13" >
			  <img  id="cat_dico" src="{$zBasePath}assets/img/img_sad/cat_/7.png" title="Dictionnaire" border="0" height="150" width="150">
			  </a></p><br>
			<p><a href="{$zBasePath}documentation/pret_livre/sad/pret-dictionnaire/13" class="btn">Dictionnaire et Lexiques</a></p>									
		</div>
		
		<div class="col-md-2">
			<p><a href="{$zBasePath}documentation/pret_livre/sad/pret-journal/14">
			  <img id="cat_journal" src="{$zBasePath}assets/img/img_sad/cat_/15.png" title="Journal Officiel" border="0" height="150" width="160">
			  </a></p><br>
			<p><a href="{$zBasePath}documentation/pret_livre/sad/pret-journal/14" class="btn">Journal Officiel</a></p>
		</div>
		
		<div class="col-md-2">
			<p><a href="{$zBasePath}documentation/memoire/sad/memeoire-etude">
			  <img id="cat_memoire" src="{$zBasePath}assets/img/img_sad/cat_/memoire.jpg" title="Memoire de fin d'etude" border="0" height="150" width="160">
			  </a></p><br>
			<p><a href="{$zBasePath}documentation/memoire/sad/memeoire-etude" class="btn">Memoire de fin d'etude</a></p>
		</div>
		
		<div class="col-md-2">
			<p><a href="{$zBasePath}documentation/pret_livre/sad/pret-divers/17" >
			  <img id="cat_divers" src="{$zBasePath}assets/img/img_sad/cat_/16.png" title="Divers" border="0" height="150" width="160">
			</a></p><br>
			<p><a href="{$zBasePath}documentation/pret_livre/sad/pret-divers/17" class="btn">Divers</a></p>
		</div>
    </div>
  
<div class="row">
	<div class="col-md-1"></div>
</div>
</center>
 </div> <br><br>
 </div>

{literal}	 
<script>
  
  function mouseEntre(i){
	 var height = $('#td_'+i).height();
	 var h3 = height*3;
	 $('#img_'+i).css("position","absolute");
     $('#img_'+i).css("height",h3+"px"); 
	 $('#td_'+i).css("height",height+"px"); 
  }
  function mouseSortie(i){
	 $('#img_'+i).css("position","");
     $('#img_'+i).css("height",""); 
	 $('#td_'+i).css("height",""); 
  }
  
  $(document).ready(function() {
	 
	 
	  $('#table_catalogue_liste').dataTable();
      });
  
	  var img1 = "{/literal}{$zBasePath}{literal}assets/img/img_sad/cat_/1_.png";
	  var img11 = "{/literal}{$zBasePath}{literal}assets/img/img_sad/cat_/1.png";
	  $('#cat_droit').on("mouseout",function(){
		  $('#cat_droit').attr("src",img11);
	 });
	  $('#cat_droit').on("mouseover",function(){
		  $('#cat_droit').attr("src",img1);
	   });
	   

	  var img2 = "{/literal}{$zBasePath}{literal}assets/img/img_sad/cat_/2_.png";
	  var img22 = "{/literal}{$zBasePath}{literal}assets/img/img_sad/cat_/2.png";
	  $('#cat_economie').on("mouseout",function(){
		  $('#cat_economie').attr("src",img22);
	 });
	  $('#cat_economie').on("mouseover",function(){
		  $('#cat_economie').attr("src",img2);
	   });

	  var img3 = "{/literal}{$zBasePath}{literal}assets/img/img_sad/cat_/3_.png";
	  var img33 = "{/literal}{$zBasePath}{literal}assets/img/img_sad/cat_/3.png"
	  $('#cat_banque').on("mouseout",function(){
		  $('#cat_banque').attr("src",img33);
	 });
	  $('#cat_banque').on("mouseover",function(){
		  $('#cat_banque').attr("src",img3);
	   });
	     
	  var img4 = "{/literal}{$zBasePath}{literal}assets/img/img_sad/cat_/4_.png";
	  var img44 = "{/literal}{$zBasePath}{literal}assets/img/img_sad/cat_/4.png";
	  $('#cat_infra').on("mouseout",function(){
		  $('#cat_infra').attr("src",img44);
	 });
	  $('#cat_infra').on("mouseover",function(){
		  $('#cat_infra').attr("src",img4);
	   });

	  var img5 = "{/literal}{$zBasePath}{literal}assets/img/img_sad/cat_/5_.png";
	  var img55 = "{/literal}{$zBasePath}{literal}assets/img/img_sad/cat_/5.png";
	  $('#cat_budget').on("mouseout",function(){
		  $('#cat_budget').attr("src",img55);
	 });
	  $('#cat_budget').on("mouseover",function(){
		  $('#cat_budget').attr("src",img5);
	   });
	   
	  var img6 = "{/literal}{$zBasePath}{literal}assets/img/img_sad/cat_/6_.png";
	  var img66 = "{/literal}{$zBasePath}{literal}assets/img/img_sad/cat_/6.png";
	  $('#cat_impot').on("mouseout",function(){
		  $('#cat_impot').attr("src",img66);
	 });
	  $('#cat_impot').on("mouseover",function(){
		  $('#cat_impot').attr("src",img6);
	   });

	  var img7 = "{/literal}{$zBasePath}{literal}assets/img/img_sad/cat_/7_.png";
	  var img77 = "{/literal}{$zBasePath}{literal}assets/img/img_sad/cat_/7.png";
	  $('#cat_dico').on("mouseout",function(){
		  $('#cat_dico').attr("src",img77);
	 });
	  $('#cat_dico').on("mouseover",function(){
		  $('#cat_dico').attr("src",img7);
	   });
	   
	  var img8 = "{/literal}{$zBasePath}{literal}assets/img/img_sad/cat_/8_.png";
	  var img88 = "{/literal}{$zBasePath}{literal}assets/img/img_sad/cat_/8.png";
	  $('#cat_tresor').on("mouseout",function(){
		  $('#cat_tresor').attr("src",img88);
	 });
	  $('#cat_tresor').on("mouseover",function(){
		  $('#cat_tresor').attr("src",img8);
	   });
	   
	  var img9 = "{/literal}{$zBasePath}{literal}assets/img/img_sad/cat_/9_.png";
	  var img99 = "{/literal}{$zBasePath}{literal}assets/img/img_sad/cat_/9.png";
	  $('#cat_politique').on("mouseout",function(){
		  $('#cat_politique').attr("src",img99);
	 });
	  $('#cat_politique').on("mouseover",function(){
		  $('#cat_politique').attr("src",img9);
	   });
	   
	  var img10 = "{/literal}{$zBasePath}{literal}assets/img/img_sad/cat_/10_.png";
	  var img100 = "{/literal}{$zBasePath}{literal}assets/img/img_sad/cat_/10.png";
	  $('#cat_bailleur').on("mouseout",function(){
		  $('#cat_bailleur').attr("src",img100);
	 });
	  $('#cat_bailleur').on("mouseover",function(){
		  $('#cat_bailleur').attr("src",img10);
	   });
	   
	  var img20 = "{/literal}{$zBasePath}{literal}assets/img/img_sad/cat_/11_.png";
	  var img200 = "{/literal}{$zBasePath}{literal}assets/img/img_sad/cat_/11.png";
	  $('#cat_douane').on("mouseout",function(){
		  $('#cat_douane').attr("src",img200);
	 });
	  $('#cat_douane').on("mouseover",function(){
		  $('#cat_douane').attr("src",img20);
	   });
	   
	  var img30 = "{/literal}{$zBasePath}{literal}assets/img/img_sad/cat_/12_.png";
	  var img300 = "{/literal}{$zBasePath}{literal}assets/img/img_sad/cat_/12.png";
	  $('#cat_gestion').on("mouseout",function(){
		  $('#cat_gestion').attr("src",img300);
	 });
	  $('#cat_gestion').on("mouseover",function(){
		  $('#cat_gestion').attr("src",img30);
	   });
	   
	  var img40 = "{/literal}{$zBasePath}{literal}assets/img/img_sad/cat_/13_.png";
	  var img400 = "{/literal}{$zBasePath}{literal}assets/img/img_sad/cat_/13.png";
	  $('#cat_affaire').on("mouseout",function(){
		  $('#cat_affaire').attr("src",img400);
	 });
	  $('#cat_affaire').on("mouseover",function(){
		  $('#cat_affaire').attr("src",img40);
	   });
	   var img60 = "{/literal}{$zBasePath}{literal}assets/img/img_sad/cat_/14_.png";
	  var img600 = "{/literal}{$zBasePath}{literal}assets/img/img_sad/cat_/14.png";
	  $('#cat_serie').on("mouseout",function(){
		  $('#cat_serie').attr("src",img600);
	 });
	  $('#cat_serie').on("mouseover",function(){
		  $('#cat_serie').attr("src",img60);
	   });
	   
	 var img50 = "{/literal}{$zBasePath}{literal}assets/img/img_sad/cat_/15_.png";
	 var img500 = "{/literal}{$zBasePath}{literal}assets/img/img_sad/cat_/15.png";
	 $('#cat_journal').on("mouseout",function(){
		  $('#cat_journal').attr("src",img500);
	 });
	 $('#cat_journal').on("mouseover",function(){
		  $('#cat_journal').attr("src",img50);
	 });

	 var imgmemoire50 = "{/literal}{$zBasePath}{literal}assets/img/img_sad/cat_/memoire.jpg";
	 var imgmemoire500 = "{/literal}{$zBasePath}{literal}assets/img/img_sad/cat_/memoire1.jpg";
	 $('#cat_memoire').on("mouseout",function(){
		  $('#cat_memoire').attr("src",imgmemoire500);
	 });
	 $('#cat_memoire').on("mouseover",function(){
		  $('#cat_memoire').attr("src",imgmemoire50);
	 });


	  var img80 = "{/literal}{$zBasePath}{literal}assets/img/img_sad/cat_/16_.png";
	  var img800 = "{/literal}{$zBasePath}{literal}assets/img/img_sad/cat_/16.png";
	  $('#cat_divers').on("mouseout",function(){
		  $('#cat_divers').attr("src",img800);
	 });
	  $('#cat_divers').on("mouseover",function(){
		  $('#cat_divers').attr("src",img80);
	   });
	   	   
	var img01 = "{/literal}{$zBasePath}{literal}assets/img/img_sad/cat_/cat_b/pied.png";
	  var img001 = "{/literal}{$zBasePath}{literal}assets/img/img_sad/cat_/cat_b/1.png";
	  $('#cat_1').on("mouseout",function(){
		  $('#cat_2').attr("src",img001);
	 });
	  $('#cat_1').on("mouseover",function(){
		  $('#cat_1').attr("src",img01);
	   });   
	   
</script>
{/literal}	

<div id="calendar"></div>
</section>
<section id="rightContent" class="clearfix">
{include_php file=$zRight}
</section>
{include_php file=$zFooter}
</div>