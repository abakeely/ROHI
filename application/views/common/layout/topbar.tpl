<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" data-logobg="{if $user_theme && $user_theme->logobg}{$user_theme->logobg}{else}skin6{/if}">
            <a class="nav-toggler  d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
            <a class="navbar-brand" href="{base_url('/')}">
                <!-- Logo icon -->
                <b class="logo-icon">
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <img src="{base_url('/application/modules/evaluations/assets/images/rohi-logo.png')}" alt="homepage" class="dark-logo" />
                    <!-- Light Logo icon -->
                    <img src="{base_url('/application/modules/evaluations/assets/images/rohi-logo.png')}" alt="homepage" class="light-logo" />
                </b>
            </a>
            <a class="topbartoggler d-block d-md-none " href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
        </div>
        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="{if $user_theme && $user_theme->navbarbg}{$user_theme->navbarbg}{else}skin1{/if}">
            <ul class="navbar-nav float-left mr-auto">
                <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler " href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                <!-- user dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted  pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{$photo_agent}" alt="user" class="rounded-circle" width="31">
                        {$oData.oCandidat[0]->nom}  {$oData.oCandidat[0]->prenom}<br/>
                        <small>{$oData.oCandidat[0]->matricule}</small><br/>
                        <small>{$oData.oCandidat[0]->poste}</small>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                        <span class="with-arrow"><span class="bg-default"></span></span>
                        <!--div class="d-flex no-block align-items-center p-15 bg-primary text-white mb-2">
                            <div class=""><img src="{$photo_agent}" alt="user" class="img-circle" width="60"></div>
                            <div class="ml-2">
                                <h4 class="mb-0">{$oData.oCandidat[0]->nom}</h4>
                                <p class=" mb-0">{$oData.oCandidat[0]->prenom}</p>
                            </div>
                        </div-->
                        <a class="dropdown-item" href="{base_url('/cv2/mon_cv')}"><i class="ti-user mr-1 ml-1"></i> Mon CV</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{base_url('/user/change_password')}"><i class="fas fa-lock mr-1 ml-1"></i> Changer mot de passe</a>
                        <!--div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{base_url('/gcap/deconnexion')}"><i class="fa fa-power-off mr-1 ml-1"></i> Déconnexion</a-->
                        <!--div class="dropdown-divider"></div>
                        <div class="pl-4 p-10"><a href="javascript:void(0)" class="btn btn-sm btn-success btn-rounded">View Profile</a></div-->
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav float-right">
                <form form-account-switcher action="{base_url('/gcap/setSessionCompte')}" method="post">
                    <input type="hidden" name="iCompteId" value="">
                </form>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-none d-md-block">
                            {if $iSessionCompte == 1}Compte agent{else}{$current_account.compte_libelle}{/if}
                            <i class="fa fa-angle-down"></i>
                        </span>
                        <span class="d-none d-block d-sm-block"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right  animated bounceInDown" aria-labelledby="navbarDropdown2">
                        <a account-switcher data-hash="4be4a3909d3c56ab612f4a639210a7b11" class="dropdown-item" href="#"> Compte agent</a>
                        {foreach from=$oData.toComptes item=account}
                            <a account-switcher data-hash="{$account.compte_hash}" class="dropdown-item" href="#"> {$account.compte_libelle}</a>
                        {/foreach}
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbar_theme_changer" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-cog"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right  animated bounceInDown" aria-labelledby="navbar_theme_changer">
                        <div class="dropdown-item">
                            <h5 class="font-medium mb-2 mt-2">Logo</h5>
                            <ul class="theme-color">
                                <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin1"></a></li>
                                <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin2"></a></li>
                                <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin3"></a></li>
                                <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin4"></a></li>
                                <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin5"></a></li>
                                <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-logobg="skin6"></a></li>
                            </ul>
                        </div>
                        <div class="dropdown-item">
                            <h5 class="font-medium mb-2 mt-2">Barre de navigation</h5>
                            <ul class="theme-color">
                                <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin1"></a></li>
                                <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin2"></a></li>
                                <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin3"></a></li>
                                <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin4"></a></li>
                                <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin5"></a></li>
                                <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-navbarbg="skin6"></a></li>
                            </ul>
                        </div>
                        <div class="dropdown-item">
                            <h5 class="font-medium mb-2 mt-2">Menu gauche</h5>
                            <ul class="theme-color">
                                <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin1"></a></li>
                                <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin2"></a></li>
                                <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin3"></a></li>
                                <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin4"></a></li>
                                <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin5"></a></li>
                                <li class="theme-item"><a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin6"></a></li>
                            </ul>
                        </div>

                        <!--div class="dropdown-item">
                            <h5 class="font-medium mb-2 mt-2">Autres</h5>
                            <div class="custom-control custom-checkbox mt-2">
                                <input type="checkbox" class="custom-control-input" name="theme-view" id="theme-view">
                                <label class="custom-control-label" for="theme-view">Dark Theme</label>
                            </div>
                        </div-->
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>