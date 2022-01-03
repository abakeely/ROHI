{include_php file=$zCssJs}
{include_php file=$zHeader}
<div id="container">
	<div id="breadcrumb"><a href="{$zBasePath}">Accueil</a> <span>&gt;</span> Statistique <span></div>
	
    <section id="content">
        {include_php file=$zLeft}	
        <div id="ContentBloc">
			
			<h2>Liste de tous les agents</h2>
			<div class="contenuePage">	
				
				<div class="statistic_tree">
					<div class="statistic_menu"></div>
					<ul>
					{foreach from=$oTreeStat item=oTree}
						<li class="parent_li">
							<span>
								<i class="ace-icon la la-chevron-right"></i>
								{$oTree.zLibele} : {if $oTree.iNbr}{$oTree.iNbr}{else}0{/if}
							</span>
							<ul>
							{foreach from=$oTree.oDir item=oDir}
								<li {if $oTree.oSer[$oDir.id]}class="parent_li" {else} class="get_MF getDir_MF" data-mf="{$oDir.id}"{/if}>
									<span title="{$oDir.sigle_direction}">
										<i class="ace-icon la la-chevron-right"></i>
										{$oDir.libele} : {if $oTree.oTreeDir[$oDir.id]}{$oTree.oTreeDir[$oDir.id]}{else}0{/if}
									</span>
									{if $oTree.oSer[$oDir.id]}
										<ul>
										{assign var=iDir value=$oDir.id}
										{foreach from=$oTree.oSer[$iDir] item=oSer}
										{assign var=iSer value=$oSer.id}
											<li {if $oTree.oDiv[$iSer]}class="parent_li" {else} class="get_MF getSer_MF" data-mf="{$oSer.id}"{/if}>
												<span title="{$oSer.sigle_service}">
													<i class="ace-icon la la-chevron-right"></i>
													{$oSer.libele} : {if $oTree.oTreeSer[$iSer]}{$oTree.oTreeSer[$iSer]}{else}0{/if}
												</span>
												{if $oTree.oDiv[$iSer]}
													<ul>
													{foreach from=$oTree.oDiv[$iSer] item=oDiv}
													{assign var=iDiv value=$oDiv.id}
														<li {if $oTree.oTreeDiv[$iDiv]}data-mf="{$oDiv.id}" class="get_MF getDiv_MF"{/if}>
															<span>
																{if $oTree.oTreeDiv[$iDiv]}<i class="ace-icon la la-chevron-right"></i>{/if}
																{$oDiv.libele} : {if $oTree.oTreeDiv[$iDiv]}{$oTree.oTreeDiv[$iDiv]}{else}0{/if}
															</span>
														</li>
													{/foreach}
													</ul>
												{/if}
											</li>
										{/foreach}
										</ul>
									{/if}
								</li>
							{/foreach}
							</ul>
						</li>
					{/foreach}
					</ul>
				</div>
			</div>
		
		</div>
		<link rel="stylesheet" href="{$zBasePath}assets/common/css/fullcalendar.min.css"/>
		<link rel="stylesheet" href="{$zBasePath}assets/css/statistique.css"/>
		<div id="calendar"></div>
    </section>

    <section id="rightContent" class="clearfix">
		{include_php file=$zRight}
	</section>
	{literal}
		<script>
		
			$(document).ready(function () {
				$('.statistic_tree').on('click', 'li.parent_li > span', function (e) {
					var __this = $(this);
					var children = $(this).parent('li.parent_li').children('ul');
					children.slideToggle(500,function(){
						if (children.is(':visible')) {
							console.log('if');
							__this.children('i')
								.addClass('fa-chevron-down')
								.removeClass('fa-chevron-right');
						} else {
							console.log('else');
							__this.children('i')
								.addClass('fa-chevron-right')
								.removeClass('fa-chevron-down');
						}
					});
					e.stopPropagation();
				});
				$('ul').on('click', 'li.getSer_MF', function(e){
					e.preventDefault();
					var id= $(this).data('mf');
					var _this = $(this);
					$.ajax({
						url: "{/literal}{$zBasePath}{literal}statistique/getMF",
						method: "POST",
						data: {
							type: 1,
							id: id
						},
						success: function(data, textStatus, jqXHR) {
							if (data) {
								_this.removeClass('getSer_MF');
								_this.addClass('parent_li');
								_this.append(data);
								_this.removeClass('get_MF');
							}
						},
						async: false
					});
					
				});
				$('ul').on('click', 'li.getDiv_MF', function(e){
					e.preventDefault();
					var id= $(this).data('mf');
					var _this = $(this);
					$.ajax({
						url: "{/literal}{$zBasePath}{literal}statistique/getMF",
						method: "POST",
						data: {
							type: 2,
							id: id
						},
						success: function(data, textStatus, jqXHR) {
							if (data) {
								
								_this.removeClass('getDiv_MF');
								_this.addClass('parent_li');
								_this.append(data);
								_this.removeClass('get_MF');
							}
						},
						async: false
					})
				});
			});
		</script>
	{/literal}
    {include_php file=$zFooter}
</div>
</body>
</html>