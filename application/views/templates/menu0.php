<div class="nav-collapse">
                                       <ul class="megamenu skyblue" style="text-align: right;">
                                       		<!-- MENU Accueil -->
											<?php  if($role=='chef'){?>
											<li class="grid"><a class="color2 text_menu" href="#">COMPTE RESPONSABLE DU PERSONNELS</a>
												<div class="megapanel">
													<div class="row">
														<div class="col1">
														<div class="h_nav">
														<br/>
														<br/>
														<img src="<?php echo base_url();?>assets/img/logo.png" alt="" width="200px" height="100px" align="center"/>
														</div>
														</div>
														<div class="col1">
															<!--<h4><b>LISTES AGENTS DU MFB</b></h4>
															-->							
														</div>
														<div class="col1">
															<div class="h_nav">
																<h4><b>LISTES PAR DIRECTION</b></h4>
																<ul>
																	<li><a  href="<?php echo base_url();?>cv/list_cv">Agent par Direction</a><br></li>
																	<li><a  href="<?php echo base_url();?>">Fiche d'Evaluation</a><br></li>
																	
																</ul>	
															</div>							
														</div>
														<div class="col1">
															<div class="h_nav">
																<h4><b>MOUVEMENT</b></h4>
																<ul>
																	<li><a  href="<?php echo base_url();?>cv/mouvement">Historique des mouvements</a><br></li>
																	<li><a  href="<?php echo base_url();?>cv/histo_info_admin">Historique des Informations Admin</a><br></li>
																	<a href="<?php echo base_url();?>assets/pdf/FICHE_ROHI.pdf">Télécharger la "Fiche ROHI"</a>
																</ul>	
															</div>							
														</div>
													</div>
													
								    			</div>
											</li>
											<?php }?>
                                       		<!-- MENU Mon CV -->
											<li><a class="color2 text_menu" href="<?php echo base_url();?>cv/mon_cv">Mon CV</a></li>
											
											<!-- MENU RECENSEMENT -->
											<//?php  if($role=='admin' || $role=='chef'){?> <!-- LE MENU RECENSEMENT EST DESTINE AUX ADMIN ET CHEFS -->
											<?php  if($role=='admin'){?>
											<li class="grid"><a class="color2 text_menu" href="#">RECENSEMENT</a>
												<div class="megapanel">
													<div class="row">
														<div class="col1">
														<div class="h_nav">
														<br/>
														<br/>
														<img src="<?php echo base_url();?>assets/img/logo.png" alt="" width="200px" height="100px" align="center"/>
														</div>
														</div>
														<div class="col1">
															<div class="h_nav">
																<h4><b>Listes</b></h4>
																<ul>
																	<!--<li><a  href="<//?php echo base_url();?>cv/list_cv">Agent du MFB</a><br></li>-->
																	<li><a  href="<?php echo base_url();?>cv/list_cv_per_dep">Agent du MFB</a><br></li>
																	<li><a  href="<?php echo base_url();?>cv/list_invalide">Agent du MFB &agrave; Valider</a><br></li>
																	
																</ul>	
															</div>							
														</div>
														
														<div class="col1">
															<div class="h_nav">
																<h4><b>Visualisation</b></h4>
																<ul>
																	<li><a  href="<?php echo base_url();?>statistique/statistic_main">Statistique</a><br></li>
																	<li><a  href="<?php echo base_url();?>cv/mouvement">Mouvement</a><br></li>
																</ul>	
															</div>						
														</div>
														<?php if($role=='admin') {?>
														<div class="col1">
															<div class="h_nav">
																<h4><b>User</b></h4>
																<ul>
																	<li><a  href="<?php echo base_url();?>user/list_user_connected">Agent connect&eacute;</a><br></li>
																	<li><a  href="<?php echo base_url();?>user/list_user_no_cv">Compte sans CV</a><br></li>
																</ul>	
															</div>
														</div>
														<?php }?>
														<div>
														<?php if($role=='admin') {?>
														<div class="col1">
															<div class="h_nav">
																<h4><b>Modification</b></h4>
																<ul>
																	<li><a  href="<?php echo base_url();?>user/respers">Compte Responsable du Personnel</a><br></li>
																	<li><a  href="<?php echo base_url();?>user/list_respers">Liste des Responsable du Personnel</a><br></li>
																</ul>	
															</div>
														</div>
														<?php }?>
													</div>
													<div class="row">
														<div class="col2"></div>
														<div class="col1"></div>
														<div class="col1"></div>
														<div class="col1"></div>
														<div class="col1"></div>
													</div>
								    			</div>
											</li>
											<?php }?>
											
												
												<!-- MENU GCAP-->
												<li class="grid"><a class="color2 text_menu" href="<?php echo base_url();?>gcap/module">GCAP</a>
												<!-- MENU SONDAGE -->
												<li class="grid"><a class="color2 text_menu" href="<?php echo base_url();?>enquete/new_enquete">Sondage</a>
												
												<!-- <//?php if($role=='chef' || $role=='admin') {?>
												 <div class="megapanel">
													<div class="row">
														<div class="col1">
														<div class="h_nav">
														<br/>
														<img src="<//?php echo base_url();?>assets/img/logo.png" alt="" width="200px" height="100px" align="center"/>
														</div>
														</div>
														
														<div class="col1">
															<div class="h_nav">
																<h4>visualiser</h4>
																<ul>
																	<li><a href="admin_enquete_dep.php">Par departement</a><br></li>
																	<li><a href="admin_enquete_reg.php">Par region</a><br></li>
																	<li><a href="admin_enquete_cat.php">Par Cat&eacute;gorie</a></li>
																</ul>	
															</div>							
														</div>
													</div>
								    			</div>	
								    			<//?php } ?>
								    		   </li>-->
											   <!--<li><a class="color1 text_menu" href="<//?php echo base_url();?>">A PROPOS</a></li>-->
											   <!--<li><a class="color1 text_menu" href="<//?php echo base_url();?>user/deconnexion">Deconnexion</a></li>-->
										 </ul> 
                                    </div>