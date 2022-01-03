{include_php file=$zCssJs}
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">LISTES AGENTS CONNECTES A SAD</h3>
								<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
								<li class="breadcrumb-item"><a href="{$zBasePath}">Archives et Documentations</a></li>
								<li class="breadcrumb-item">Tableau de Bord</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<div class="">
									<table>
										<div align="right">
											<a href="{$zBasePath}documentation/infprat/sad/inf-prat" class="btn">Menu</a>
										</div>
										<div>
											<br>
											<section class="main">
												<ul class="ch-grid">
												<!-- 1e -->
													<li>
														<div class="ch-item">	
															<a href="{$zBasePath}tableau_bord/consultation_surplace/sad/consult-place" title="CONSULTATION SUR PLACE">
																<div class="ch-info_1">
																	<br><br>
																</div>
															</a>
															<a href="{$zBasePath}documentation/ouvrage/sad/divers-ouvrages" title="CONSULTATION SUR PLACE">
																<div class="ch-thumb ch-img-1"></div>
															</a>
														</div>
														<br><br><br><br>
															<a href="{$zBasePath}documentation/ouvrage/sad/reglement-sad" class="btn">Consultation sur place</a>	
														<br><br>
													</li>
												<!-- 2e -->
													<li>
														<div class="ch-item">
															<a href="{$zBasePath}tableau_bord/conexion_cybernet/sad/connexion-cybernet" title="CONNEXION INTERNET">
																<div class="ch-info_2">
																	<br><br>						
																</div>
															</a>
															<a href="{$zBasePath}tableau_bord/conexion_cybernet/sad/connexion-cybernet" title="CONNEXION INTERNET">
																<div class="ch-thumb ch-img-2"></div>
															</a>
														</div>
														<br><br><br><br>
															<a href="{$zBasePath}tableau_bord/conexion_cybernet/sad/connexion-cybernet" class="btn">Connexion Internet</a>	
														<br><br>
												</li>
												<!-- 3e -->
													<li>
														<div class="ch-item">
															<a href="{$zBasePath}tableau_bord/couv_connect_sad/sad/agent-connecte-sad" title="AGENT CONNECTE A SAD">
																<div class="ch-info_3">
																<br><br>
																</div>
															</a>
															<a href="{$zBasePath}tableau_bord/couv_connect_sad/sad/agent-connecte-sad" title="AGENT CONNECTE A SAD">
																<div class="ch-thumb ch-img-3"></div>
															</a>
														</div>
														<br><br><br><br>
															<a href="{$zBasePath}tableau_bord/couv_connect_sad/sad/agent-connecte-sad" class="btn">Agent connecté à SAD</a>
														<br><br>
													</li>
												<!-- 4e -->
													<li>
														<div class="ch-item">
															<a href="{$zBasePath}tableau_bord/couv_bilan/sad/statistique" title="STATISTIQUES">
																<div class="ch-info_4">
																	<br><br>
																</div>
															</a>
															<a href="{$zBasePath}tableau_bord/couv_bilan/sad/statistique" title="STATISTIQUES">
																<div class="ch-thumb ch-img-4"></div>
															</a>
														</div>
														<br><br><br><br>
															<a href="{$zBasePath}tableau_bord/couv_bilan/sad/statistique" class="btn">Statistiques</a>
														<br><br>
													</li>
												</ul>
												<br>
											</section>
										</div>
									</table>
									{$oData.zPagination}
								</div>
								<div id="calendar"></div>
							</div>
						</div>

					</div>
				</div>
			</div>
			<!-- /Page Content -->
					
		</div>
		<!-- /Page Wrapper -->

	</div>
	<!-- /Main Wrapper -->

{include_php file=$zFooter}

{literal}
<style>
button {
	padding: 20px 80px;
	background-color: #F5EEC9;
	border-radius: 20px;
	border: 1px solid white! important;
}
.ch-grid {
	margin: 20px 0 0 0;
	padding: 0;
	list-style: none;
	display: block;
	overflow: hidden;
	text-align: center;
	width: 100%;
}

.ch-grid:after,
.ch-item:before {
	content: '';
    display: table;
}

.ch-grid:after {
	clear: both;
}

.ch-grid li {
	width: 220px;
	height: 220px;
	display: inline-block;
	margin: 20px;
}

.ch-item {
	width: 100%;
	height: 100%;
	border-radius: 50%;
	position: relative;
	cursor: default;
	box-shadow: 0 1px 3px rgba(0,0,0,0.2);
}

.ch-thumb {
	width: 100%;
	height: 100%;
	border-radius: 50%;
	overflow: hidden;
	position: absolute;
	box-shadow: inset 0 0 0 15px rgba(255,255,255, 0.5);
	
	-webkit-transform-origin: 95% 40%;
	-moz-transform-origin: 95% 40%;
	-o-transform-origin: 95% 40%;
	-ms-transform-origin: 95% 40%;
	transform-origin: 95% 40%;
	
	-webkit-transition: all 0.3s ease-in-out;
	-moz-transition: all 0.3s ease-in-out;
	-o-transition: all 0.3s ease-in-out;
	-ms-transition: all 0.3s ease-in-out;
	transition: all 0.3s ease-in-out;
}

.ch-thumb:after {
	content: '';
	width: 8px;
	height: 8px;
	position: absolute;
	border-radius: 50%;
	top: 40%;
	left: 95%;
	margin: -4px 0 0 -4px;
	background: rgb(14,14,14);
	background: -moz-radial-gradient(center, ellipse cover, rgba(14,14,14,1) 0%, rgba(125,126,125,1) 100%);
	background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%,rgba(14,14,14,1)), color-stop(100%,rgba(125,126,125,1)));
	background: -webkit-radial-gradient(center, ellipse cover, rgba(14,14,14,1) 0%,rgba(125,126,125,1) 100%);
	background: -o-radial-gradient(center, ellipse cover, rgba(14,14,14,1) 0%,rgba(125,126,125,1) 100%);
	background: -ms-radial-gradient(center, ellipse cover, rgba(14,14,14,1) 0%,rgba(125,126,125,1) 100%);
	background: radial-gradient(ellipse at center, rgba(14,14,14,1) 0%,rgba(125,126,125,1) 100%);
	box-shadow: 0 0 1px rgba(255,255,255,0.9);
}

.ch-img-1 { 
		
	background-image: url({/literal}{$zBasePath}{literal}/assets/img/img_sad/tableau_bord/csp_f.png);
	z-index: 12;
}

.ch-img-2 { 
	background-image: url({/literal}{$zBasePath}{literal}/assets/img/img_sad/tableau_bord/ccn_f.png);
	z-index: 11;
}

.ch-img-3 { 
	background-image: url({/literal}{$zBasePath}{literal}/assets/img/img_sad/tableau_bord/acs_f.png);
	z-index: 10;
}
.ch-img-4 { 
	background-image: url({/literal}{$zBasePath}{literal}/assets/img/img_sad/tableau_bord/st_f.png);
	z-index: 9;
}

.ch-img-5 { 
	background-image: url({/literal}{$zBasePath}{literal}/assets/img/img_sad/tableau_bord/service_f.png);
	z-index: 9;
}
.ch-info_1 {
	position: absolute;
	width: 100%;
	height: 100%;
	border-radius: 50%;
	overflow: hidden;
	background: url({/literal}{$zBasePath}{literal}/assets/img/img_sad/tableau_bord/csp_d.png);
	box-shadow: inset 0 0 0 5px rgba(0,0,0,0.05);
}
.ch-info_2 {
	position: absolute;
	width: 100%;
	height: 100%;
	border-radius: 50%;
	overflow: hidden;
	background: url({/literal}{$zBasePath}{literal}/assets/img/img_sad/tableau_bord/ccn_d.png);
	box-shadow: inset 0 0 0 5px rgba(0,0,0,0.05);
}
.ch-info_3 {
	position: absolute;
	width: 100%;
	height: 100%;
	border-radius: 50%;
	overflow: hidden;
	background: url({/literal}{$zBasePath}{literal}/assets/img/img_sad/tableau_bord/acs_d.png);
	box-shadow: inset 0 0 0 5px rgba(0,0,0,0.05);
}
.ch-info_4 {
	position: absolute;
	width: 100%;
	height: 100%;
	border-radius: 50%;
	overflow: hidden;
	background: url({/literal}{$zBasePath}{literal}/assets/img/img_sad/tableau_bord/st_d.png);
	box-shadow: inset 0 0 0 5px rgba(0,0,0,0.05);
}
.ch-info_5 {
	position: absolute;
	width: 100%;
	height: 100%;
	border-radius: 50%;
	overflow: hidden;
	background: url({/literal}{$zBasePath}{literal}/assets/img/img_sad/tableau_bord/service_d.png);
	box-shadow: inset 0 0 0 5px rgba(0,0,0,0.05);
}

.ch-info p a {
	display: block;
	color: #333;
	width: 80px;
	height: 80px;
	background: rgba(255,255,255,0.3);
	border-radius: 50%;
	color: #fff;
	font-style: normal;
	font-weight: 700;
	text-transform: uppercase;
	font-size: 9px;
	letter-spacing: 1px;
	padding-top: 24px;
	margin: 7px auto 0;
	font-family: 'Open Sans', Arial, sans-serif;
	opacity: 0;
	
	-webkit-transition: 
		-webkit-transform 0.3s ease-in-out 0.2s,
		opacity 0.3s ease-in-out 0.2s,
		background 0.2s linear 0s;
	-moz-transition: 
		-moz-transform 0.3s ease-in-out 0.2s,
		opacity 0.3s ease-in-out 0.2s,
		background 0.2s linear 0s;
	-o-transition: 
		-o-transform 0.3s ease-in-out 0.2s,
		opacity 0.3s ease-in-out 0.2s,
		background 0.2s linear 0s;
	-ms-transition: 
		-ms-transform 0.3s ease-in-out 0.2s,
		opacity 0.3s ease-in-out 0.2s,
		background 0.2s linear 0s;
	transition: 
		transform 0.3s ease-in-out 0.2s,
		opacity 0.3s ease-in-out 0.2s,
		background 0.2s linear 0s;
		
	-webkit-transform: translateX(60px) rotate(90deg);
	-moz-transform: translateX(60px) rotate(90deg);
	-o-transform: translateX(60px) rotate(90deg);
	-ms-transform: translateX(60px) rotate(90deg);
	transform: translateX(60px) rotate(90deg);
		
	-webkit-backface-visibility: hidden;
}

.ch-info p a:hover {
	background: rgba(255,255,255,0.5);
}
.ch-item:hover .ch-thumb {
	box-shadow: inset 0 0 0 15px rgba(255,255,255, 0.5), 0 1px 3px rgba(0,0,0,0.2);
	-webkit-transform: rotate(-110deg);
	-moz-transform: rotate(-110deg);
	-o-transform: rotate(-110deg);
	-ms-transform: rotate(-110deg);
	transform: rotate(-110deg);
}
.ch-item:hover .ch-info p a{
	opacity: 1;
	-webkit-transform: translateX(0px) rotate(0deg);
	-moz-transform: translateX(0px) rotate(0deg);
	-o-transform: translateX(0px) rotate(0deg);
	-ms-transform: translateX(0px) rotate(0deg);
	transform: translateX(0px) rotate(0deg);
}
</style>
{/literal}

{literal}
<script>
;window.Modernizr=function(a,b,c){function z(a){j.cssText=a}function A(a,b){return z(m.join(a+";")+(b||""))}function B(a,b){return typeof a===b}function C(a,b){return!!~(""+a).indexOf(b)}function D(a,b){for(var d in a)if(j[a[d]]!==c)return b=="pfx"?a[d]:!0;return!1}function E(a,b,d){for(var e in a){var f=b[a[e]];if(f!==c)return d===!1?a[e]:B(f,"function")?f.bind(d||b):f}return!1}function F(a,b,c){var d=a.charAt(0).toUpperCase()+a.substr(1),e=(a+" "+o.join(d+" ")+d).split(" ");return B(b,"string")||B(b,"undefined")?D(e,b):(e=(a+" "+p.join(d+" ")+d).split(" "),E(e,b,c))}var d="2.5.3",e={},f=!0,g=b.documentElement,h="modernizr",i=b.createElement(h),j=i.style,k,l={}.toString,m=" -webkit- -moz- -o- -ms- ".split(" "),n="Webkit Moz O ms",o=n.split(" "),p=n.toLowerCase().split(" "),q={},r={},s={},t=[],u=t.slice,v,w=function(a,c,d,e){var f,i,j,k=b.createElement("div"),l=b.body,m=l?l:b.createElement("body");if(parseInt(d,10))while(d--)j=b.createElement("div"),j.id=e?e[d]:h+(d+1),k.appendChild(j);return f=["&#173;","<style>",a,"</style>"].join(""),k.id=h,(l?k:m).innerHTML+=f,m.appendChild(k),l||(m.style.background="",g.appendChild(m)),i=c(k,a),l?k.parentNode.removeChild(k):m.parentNode.removeChild(m),!!i},x={}.hasOwnProperty,y;!B(x,"undefined")&&!B(x.call,"undefined")?y=function(a,b){return x.call(a,b)}:y=function(a,b){return b in a&&B(a.constructor.prototype[b],"undefined")},Function.prototype.bind||(Function.prototype.bind=function(b){var c=this;if(typeof c!="function")throw new TypeError;var d=u.call(arguments,1),e=function(){if(this instanceof e){var a=function(){};a.prototype=c.prototype;var f=new a,g=c.apply(f,d.concat(u.call(arguments)));return Object(g)===g?g:f}return c.apply(b,d.concat(u.call(arguments)))};return e});var G=function(a,c){var d=a.join(""),f=c.length;w(d,function(a,c){var d=b.styleSheets[b.styleSheets.length-1],g=d?d.cssRules&&d.cssRules[0]?d.cssRules[0].cssText:d.cssText||"":"",h=a.childNodes,i={};while(f--)i[h[f].id]=h[f];e.csstransforms3d=(i.csstransforms3d&&i.csstransforms3d.offsetLeft)===9&&i.csstransforms3d.offsetHeight===3},f,c)}([,["@media (",m.join("transform-3d),("),h,")","{#csstransforms3d{left:9px;position:absolute;height:3px;}}"].join("")],[,"csstransforms3d"]);q.cssanimations=function(){return F("animationName")},q.csstransforms=function(){return!!F("transform")},q.csstransforms3d=function(){var a=!!F("perspective");return a&&"webkitPerspective"in g.style&&(a=e.csstransforms3d),a},q.csstransitions=function(){return F("transition")};for(var H in q)y(q,H)&&(v=H.toLowerCase(),e[v]=q[H](),t.push((e[v]?"":"no-")+v));return z(""),i=k=null,function(a,b){function g(a,b){var c=a.createElement("p"),d=a.getElementsByTagName("head")[0]||a.documentElement;return c.innerHTML="x<style>"+b+"</style>",d.insertBefore(c.lastChild,d.firstChild)}function h(){var a=k.elements;return typeof a=="string"?a.split(" "):a}function i(a){var b={},c=a.createElement,e=a.createDocumentFragment,f=e();a.createElement=function(a){var e=(b[a]||(b[a]=c(a))).cloneNode();return k.shivMethods&&e.canHaveChildren&&!d.test(a)?f.appendChild(e):e},a.createDocumentFragment=Function("h,f","return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&("+h().join().replace(/\w+/g,function(a){return b[a]=c(a),f.createElement(a),'c("'+a+'")'})+");return n}")(k,f)}function j(a){var b;return a.documentShived?a:(k.shivCSS&&!e&&(b=!!g(a,"article,aside,details,figcaption,figure,footer,header,hgroup,nav,section{display:block}audio{display:none}canvas,video{display:inline-block;*display:inline;*zoom:1}[hidden]{display:none}audio[controls]{display:inline-block;*display:inline;*zoom:1}mark{background:#FF0;color:#000}")),f||(b=!i(a)),b&&(a.documentShived=b),a)}var c=a.html5||{},d=/^<|^(?:button|form|map|select|textarea)$/i,e,f;(function(){var a=b.createElement("a");a.innerHTML="<xyz></xyz>",e="hidden"in a,f=a.childNodes.length==1||function(){try{b.createElement("a")}catch(a){return!0}var c=b.createDocumentFragment();return typeof c.cloneNode=="undefined"||typeof c.createDocumentFragment=="undefined"||typeof c.createElement=="undefined"}()})();var k={elements:c.elements||"abbr article aside audio bdi canvas data datalist details figcaption figure footer header hgroup mark meter nav output progress section summary time video",shivCSS:c.shivCSS!==!1,shivMethods:c.shivMethods!==!1,type:"default",shivDocument:j};a.html5=k,j(b)}(this,b),e._version=d,e._prefixes=m,e._domPrefixes=p,e._cssomPrefixes=o,e.testProp=function(a){return D([a])},e.testAllProps=F,e.testStyles=w,g.className=g.className.replace(/(^|\s)no-js(\s|$)/,"$1$2")+(f?" js "+t.join(" "):""),e}(this,this.document);
</script>
{/literal}