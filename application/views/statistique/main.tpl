{include_php file=$zCssJs}
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Statistiques {$oData.oType.0}&nbsp;{$oData.oType.1}</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item">Statistique</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								{$oData.zStatistique}
							</div>
						</div>

					</div>
				</div>
    		</div>
			<!-- /Page Content -->
			<link rel="stylesheet" href="{$zBasePath}assets/common/css/fullcalendar.min.css"/>
			<link rel="stylesheet" href="{$zBasePath}assets/css/statistique.css"/>
			<div id="calendar"></div>	
        </div>
		<!-- /Page Wrapper -->

	</div>
	<!-- /Main Wrapper -->

{include_php file=$zFooter}

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