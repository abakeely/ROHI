{literal}
<style>
.two_block {
  background: #f5f5f5b5;
  border-radius: 6px;
  display: inline-block;
  height: 200px;
  margin: 1rem;
  position: relative;
  padding : 10px;
}
#left_block{
  width : 40%;
  float: left;
}
#right_block{
  width : 50%;
}
.info_inscription{
  font-family: Courier, monospace;
}
.two_block span{
  display: block;
}
.two_block .title_info{
  text-align: center;
}
.one_block .title_info{
  position : relative;
  display: block;
  margin-left: 10px;
}
.one_block b{
  font-family: Courier, monospace;
}
.one_block .info_inscription{
  margin : 15px 0 10px 40px;
}
.inscri_font{
  font-family: "Variable Bahnschrift", "FF DIN", "Franklin Gothic", "Helvetica Neue", sans-serif;
}
</style>
{/literal}
<div style="width : 75% !important" class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <span style="font-size : 15px !important;">Information sur l'inscription de <span class="inscri_font"> {$oInscription.oCandidat.nom} {$oInscription.oCandidat.prenom}</span></span>
      <span style=" font-size : 25px !important;" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true">X</span>

    </div>
    <div class="modal-body" style="font-size:1.5em">
      <div class="two_block" id="left_block">
        <div class="title_info">Information Personnelle</div><br>
        <div class="info_inscription">
          <span class="nom_prenom"> {$oInscription.oCandidat.nom} {$oInscription.oCandidat.prenom} </span>
          <span class="matricule">Matricule : {$oInscription.oCandidat.matricule}</span>
		  <span class="matricule">Poste : {$oInscription.inscriptionligne_poste}</span>
          <span class="depDirSer">DEP/DIR/SER : {$oInscription.oCandidat.zDepartement}/{$oInscription.oCandidat.zDirection}/{$oInscription.oCandidat.zService}</span>
          <span class="region">Region : {$oInscription.oCandidat.zRegion}</span>
        </div>
      </div>
      <div class="two_block" id="right_block">
        <div class="title_info">A propos de la formation</div><br>
        <div class="info_inscription">
          <span class="type_formation"> {$oInscription.oAboutFormation.formation_intitule}</span>
          <span class="institut_formation">Institut : {$oInscription.oAboutFormation.institut_libelle}</span>
          <span class="intitule_formation">Intitule : {$oInscription.oAboutFormation.intitule_libelle}</span>
          <span class="lieu_formation">Lieu : {$oInscription.inscriptionligne_lieuFormation}</span>
		  <span class="lieu_formation">Date : {$oInscription.inscriptionligne_dateFormation}</span>
		  <span class="lieu_formation">Organisme de financement : {if $oInscription.inscriptionligne_organismeId < 9} {$oInscription.zOrganisme[0].organisme_intitule} {else} {$oInscription.inscriptionligne_autrepartenaire} {/if} ({if $oInscription.inscriptionligne_partenaire == 1}Sûr(e) {else}Pas sûr(e) {/if}) </span>
        </div>
      </div>
      <div class="one_block">
        <div class="title_info">Savoir Faire (competence technique) requis pour le poste : </div>
		{foreach from=$oInscription.oTechnique item=val}
          <div class="info_inscription">
            <span class=""> - {$val.technique_value}</span>
          </div>
        {/foreach}
      </div>
      <div class="one_block">
        <div class="title_info">Savoir (connaissances th&eacute;oriques) requis pour le poste : </div>
		{foreach from=$oInscription.oTheorique item=val}
          <div class="info_inscription">
            <span class=""> - {$val.theorique_value}</span>
          </div>
        {/foreach}
      </div>
      <div class="one_block">
        <div class="title_info">Savoir &ecirc;tre (competence comportementales) requis pour le poste : </div>
		{foreach from=$oInscription.oComportementale item=val}
          <div class="info_inscription">
            <span class=""> - {$val.comportementale_value}</span>
          </div>
        {/foreach}
      </div>
      <div class="one_block">
        <div class="title_info">Tâche(s) quotidienne(s) : </div>
		{foreach from=$oInscription.oTache item=val}
          <div class="info_inscription">
            <span class=""> - {$val.tache_value}</span>
          </div>
        {/foreach}
      </div>
      <div class="one_block">
        <div class="title_info">Interlocuteurs (internes et externes) : </div>
        
          <div class="info_inscription">
            <span class=""> - {$oInscription.oAttente[0].oattente_interloc} </span>
          </div>
      </div>
	  <div class="one_block">
        <div class="title_info">Déjà suivi une formation sur ce thème ou un thème voisin : <b>{if $oInscription.oAttente[0].oattente_formation == 1} Oui {else} Non {/if}</b></div>
        {if $oInscription.oAttente[0].oattente_formation == 1}
          <div class="info_inscription">
            <span class=""> - {$oInscription.oAttente[0].oattente_themeFormation} / </span>
            <span class=""> {$oInscription.oAttente[0].oattente_dateFormation} / </span>
            <span class=""> {$oInscription.oAttente[0].oattente_lieuFormation} / </span>
            <span class=""> {$oInscription.oAttente[0].oattente_institutFormation} / </span>
            <span class=""> {$oInscription.oAttente[0].oattente_organisme} </span>
          </div>
		{/if}
      </div><br>
	  <div class="one_block">
        <div class="title_info">Demande personnelle de suivre la formation : <b>{if $oInscription.oAttente[0].oattente_demandeperso == 1} Oui {else} Non {/if}</b></div>
      </div><br>
	  <div class="one_block">
        <div class="title_info">Les difficultés ou les lacunes à combler : </div>
		<div class="info_inscription">
            <span class=""> - {$oInscription.oAttente[0].oattente_lacune} </span>
        </div>
      </div><br>
	  <div class="one_block">
        <div class="title_info">Attente par rapport à la formation : </div>
		<div class="info_inscription">
            <span class=""> - {if $oInscription.oAttente[0].oattente_attenteId < 8} {$oInscription.zAttente[0].attente_intitule} {else} {$oInscription.oAttente[0].oattente_autreattente} {/if} </span>
        </div>
      </div>
	  <div class="one_block">
        <div class="title_info">Motivation(s) personnelle(s) pour suivre la formation : </div>
		<div class="info_inscription">
            <span class=""> - {$oInscription.oAttente[0].oattente_motivation} </span>
        </div>
      </div>
	  <div class="one_block">
        <div class="title_info">Objectifs operationnels à atteindre à l'issue de la formation : </div>
		<div class="info_inscription">
            <span class=""> - {$oInscription.oAttente[0].oattente_objectif} </span>
        </div>
      </div>
    </div>
  </div>
</div>
