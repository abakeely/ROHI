<style>
	#citations blockquote:nth-child(2) {
    animation-delay: 30s;
}
</style>
<div class="row">
	<div align="right">
		<a href="<?php echo base_url();?>documentation/restitution/2017" class="btn btn-success">RETOUR</a>
	</div>
 <div class="col-lg-6">
 <center>
  <div id="large" class="view">
	<div id="large" class="view">
		<video id="largeVideo" height="463" width="583" controls="true" poster="videoposter.jpg" webkit-playsinline="true" 
		autoplay="no"  loop="yes" width="700" height="500" muted="true" data-weborama-videoplayer="true" preload="metadata" autobuffer="false" 
		style="position: center; left: 0px; top: 0px; z-index: 200;" title="Double clic pour plein écran">
		
			<source type="video/webm" src="<?php echo base_url('assets/img/restitution/video/'.$restitution->restitution_url_video);?>" ></source>
		</video>
		<div class="clickArea"></div>
	</div>
  </div>
 </center>

 </div>
 <br><br>
<div class="col-lg-6">
<div id="citations">
    <blockquote class="citation"  >
	<img  height="350px" src="<?php echo base_url();?>assets/img/sary_resti/slide_restitution/20/Diapositive1.png"  height="720" width="580">
	</blockquote>
	<blockquote class="citation">
	<img class="" height="350px" src="<?php echo base_url();?>assets/img/sary_resti/slide_restitution/20/Diapositive2.png"  height="720" width="580">
	<cite></cite>
	</blockquote>
	<blockquote class="citation">
	<img class="" height="350px" src="<?php echo base_url();?>assets/img/sary_resti/slide_restitution/20/Diapositive3.png"  height="720" width="580">
  	</blockquote>
    <blockquote class="citation">
	<img class="" height="350px" src="<?php echo base_url();?>assets/img/sary_resti/slide_restitution/20/Diapositive4.png"  height="720" width="580">
	</blockquote>
	<blockquote class="citation"> 
	<img class="" height="350px" src="<?php echo base_url();?>assets/img/sary_resti/slide_restitution/20/Diapositive5.png"  height="720" width="580">
	</blockquote>
	<blockquote class="citation"> 
	<img class="" height="350px" src="<?php echo base_url();?>assets/img/sary_resti/slide_restitution/20/Diapositive6.png"  height="720" width="580">
	</blockquote>
	<blockquote class="citation"> 
	<img class="" height="350px" src="<?php echo base_url();?>assets/img/sary_resti/slide_restitution/20/Diapositive7.png"  height="720" width="580">
	</blockquote>
	<blockquote class="citation"> 
	<img class="" height="350px" src="<?php echo base_url();?>assets/img/sary_resti/slide_restitution/20/Diapositive8.png"  height="720" width="580">
	</blockquote>
	<blockquote class="citation"> 
	<img class="" height="350px" src="<?php echo base_url();?>assets/img/sary_resti/slide_restitution/20/Diapositive9.png"  height="720" width="580">
	</blockquote>
	<blockquote class="citation"> 
	<img class="" height="350px" src="<?php echo base_url();?>assets/img/sary_resti/slide_restitution/20/Diapositive10.png"  height="720" width="580">
	</blockquote>
	<blockquote class="citation"> 
	<img class="" height="350px" src="<?php echo base_url();?>assets/img/sary_resti/slide_restitution/20/Diapositive11.png"  height="720" width="580">
	</blockquote>
	<blockquote class="citation"> 
	<img class="" height="350px" src="<?php echo base_url();?>assets/img/sary_resti/slide_restitution/20/Diapositive12.png"  height="720" width="580">
	</blockquote>
	<blockquote class="citation"> 
	<img class="" height="350px" src="<?php echo base_url();?>assets/img/sary_resti/slide_restitution/20/Diapositive13.png"  height="720" width="580">
	</blockquote>
	<blockquote class="citation"> 
	<img class="" height="350px" src="<?php echo base_url();?>assets/img/sary_resti/slide_restitution/20/Diapositive14.png"  height="720" width="580">
	</blockquote>
	
	
</div>

</div>
</div>	
	
<script>
	$( document ).ready(function() {
	$('#citations .citation:gt(0)').hide();
	setInterval(
		function(){
			$("#citations > :first-child").fadeOut(1000, function() {
				$(this).next('.citation').fadeIn(1000).end().appendTo('#citations')
			});
		}, 6000
	);
	 
	});
</script>
