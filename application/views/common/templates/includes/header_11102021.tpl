    <header id="mainHeader">
		<div id="mainHeaderBottom" >
            <div id="navbar" class="navbar navbar-default  ace-save-state">
                <div class="navbar-container ace-save-state" id="navbar-container">
                    <div class="navbar-buttons navbar-header" role="navigation">
                        <span class="la la-bars menuRespons"></span>
						<ul class="nav ace-nav">
                            <li class="mihamalefaka user dropdown-modal">
                                <a data-toggle="dropdown" href="{$zBasePath}cv/index#" class="tropColle dropdown-toggle">
                                    <span class="user-pict">
										<img class="nav-user-photo" src="{$zImageUrl}" style="width:52px;" alt="Photo de {$oCandidat[0]->nom}&nbsp;{$oCandidat[0]->prenom}">
									</span>
								<span class="user-info">
								<small>Bienvenue, <span class="la la-angle-down"></span></small><br/>
									{if $oCandidat[0]->nom!='' && $oCandidat[0]->prenom !=''}
									{$oCandidat[0]->nom}&nbsp;{$oCandidat[0]->prenom}
									{else}
									{$oUser.nom}&nbsp;{$oUser.prenom}
									{/if}
                                </span>                          
                                </a>
                                <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                                    <li>
                                        <a href="{$zBasePath}cv2/mon_cv">
                                            <i class="ace-icon la la-user"></i>
                                            Mon CV
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{$zBasePath}gcap/deconnexion">
                                            <i class="ace-icon la la-power-off"></i>
                                            Déconnexion
                                        </a>
                                    </li>
											<li>
                                        <a href="{$zBasePath}user/change_password">
                                            <i class="ace-icon la la-power-off"></i>
                                            Changer Mot de passe
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            {$zCount}
							{if $iSessionCompte == COMPTE_AGENT AND $oCandidat[0]->fichePosteId != ''}
							<li style="padding: 5px 14px 5px 5px;" class="dialog-link-fdp1" title="Ma fiche de poste" iSearchFicheDePoste="{$oCandidat[0]->fichePosteId}" iAgentId="{$oUser.id}">
                                <button class="bouton16">Ma fiche de poste</button>
                            </li>
							{/if}
                            <li class="tab-link111" style="cursor:pointer;">
                                <a data-toggle="dropdown" class="dropdown-toggle calendrier" href="{$zBasePath}cv/index">
                                    <i class="ace-icon la la-calendar"></i>
									{if $iTotalEvent>0}
									<span style="color:white!important;" id="span_1">{$iTotalEvent}</span>
									{/if}
                                </a>
                            </li>
							
                            <li class="malefaka dropdown OptMn">
                                <a href="#" aria-expanded="true" class="optionpage"><i class="ace-icon la la-cog"></i></a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-optionpage">
                                    <div id="optTab">
                                        <ul>
                                            <li><a href="#opt-1">Couleur page</a></li>
                                            <!--<li><a href="#opt-2">Fond Page</a></li>-->
                                        </ul>
                                        <div id="opt-1"  class="menu-design" >
                                            <form action="">
                                                <h4>Theme</h4>
                                                <div>
                                                    <div id="colorchanger">
                                                        <ul class="theme-list clearfix">
															{assign var=zActifTheme value='style'}

															{if sizeof($oRowUserTheme)>0}
															{assign var=zActifTheme value=$oRowUserTheme.0.fondPage_photo}
															{/if}
                                                            <li {if $zActifTheme=='style'}class="active"{/if}><a href="javascript:;" class="colorred" data-theme="style"></a></li>
                                                            <li {if $zActifTheme=='themeblue'}class="active"{/if}><a href="javascript:;" class="colorblue" data-theme="themeblue"></a></li>
                                                            <li {if $zActifTheme=='themegreen'}class="active"{/if}><a href="javascript:;" class="colorgreen" data-theme="themegreen"></a></li>
                                                            <li {if $zActifTheme=='themepurple'}class="active"{/if}><a href="javascript:;" class="colorpurple" data-theme="themepurple"></a></li>
                                                            <li {if $zActifTheme=='themeorange'}class="active"{/if}><a href="javascript:;" class="colororange" data-theme="themeorange"></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!--<div id="opt-2" class="menu-design">
                                            <form id="my_form" name="my_form" method="POST" action="{$zBasePath}common/saveChangeBackGround" enctype="multipart/form-data"/>
                                                <h4>Image de Fond</h4>
                                                <div>
                                                    <label for="imageFond">Modifier</label>
                                                    <input type="file" name="imagefond" id="imageFond"/>
													
                                                </div>
                                            </form>
                                        </div>-->
                                    </div>
                                </div>
                            </li>


                        </ul>
                    </div>
                </div>
            </div><!-- /.navbar-container -->
        </div>
    </header>

    <!--   SI ONGLET EXISTE ici MENU BLOCKSSS-->

    <div id="mainHeaderMenu">
        <nav class="navbar navbar-inverse">
            <!--<ul>
                <li><a href="cv-eval-categ.html">Catégorie évaluation</a></li>
                <li><a href="cv-liste-agents.html">Liste des agents rattachés</a></li>
                <li><a href="cv-note.html">Saisie Manuelle des notes</a></li>
                <li class="active"><a href="cv-eval-evalue.html">Gestion Evaluateur / evalué</a></li>
            </ul>-->
				
				<div id="main-menu" style="margin-bottom: 0px;">
				<ul class="nav navbar-nav">
				{assign var="iTest" value="0"}
				{assign var="i" value="1"}
				{if sizeof($toMenus)>0}
					{foreach from=$toMenus item=oMenus }

					{if  $iTest==$oMenus.page_niveau && $iTest!=0}
					</li>
					</ul>
					{/if}
					
					<li class="{if  $oMenus.page_niveau%2!=0}dropdown{/if}{if isset($oData.menu)}{if $oData.menu == $oMenus.page_id} active{/if}{/if} tab-link"><a {if $oMenus.page_target==1} target="_blank" {/if} {if  $oMenus.page_url != '#'}href="{$zBasePath}{$oMenus.page_url}"{/if} style="cursor:pointer;" {if $oMenus.page_javascript == 1} href="#" id="{$oMenus.page_zHashUrl}"{/if}><i class="fa {$oMenus.page_icone}"></i>&nbsp;&nbsp;{$oMenus.page_libelle}{if $oMenus.page_niveau%2!=0 && $oMenus.page_niveau > 2}&nbsp;&nbsp;<b class="caret"></b>{/if}</a>
					
					{if  $oMenus.page_niveau%2!=0}
					<ul class="dropdown-menu jqueryFadeIn">
					{assign var="iTest" value=$oMenus.page_niveau}
					{/if}
					
					{/foreach}
				{/if}
				 <!--<li class="dropdown">
                        <a data-toggle="dropdown" href="#">SOUS MENU POUR SAD ET SFAO<b class="caret"></b></a>
                        <ul class="dropdown-menu jqueryFadeIn">
                            <li><a href="#">Sous menu 1</a></li>
                            <li><a href="#">Sous menu 2</a></li>
                            <li class="dropdown-submenu jqueryFadeIn">
                                <a data-toggle="dropdown"tabindex="-1" href="#">Sous menu 1</a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Sous menu Niveau2 1</a></li>
                                    <li><a href="#">Sous menu Niveau2 2</a></li>
                                    <li><a href="#">Sous menu Niveau2 3</a></li>
                                    <li><a href="#">Sous menu Niveau2 5</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
				</ul>-->
				</div>
				<ul class="nav navbar-nav">
					<!--li><a href="/ROHI/Questionnaire/questionnaireDgfag">Questionnaires DGFAG</a></li-->
				</ul>
        </nav>

    </div>
{literal}
<style>
#mainHeaderMenu nav ul li.active1 > a{
    background: #6a6260 !important;
}

.bouton16 {
	border: none!important;
    padding: 6px 10px 6px 12px;
    border-radius: 75%;
    border-bottom: 7px solid #dcbd72!important;
    font: bold 11px Arial!important;
    color: #555!important;
    background: #fff!important;
    box-shadow: 2px 2px 3px #999!important;
    border-top: 2px solid #ffffff!important;
}
</style>
{/literal}