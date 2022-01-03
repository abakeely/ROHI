<br><br>
<section style="padding-top:0px;padding-bottom:0px;">
	<style>
		div#carousel { 
		  perspective: 1100px; 
		  background: url('<?php echo base_url();?>assets/img/galery/fond.jpg') repeat;
		  padding-top: 12%; 
		  font-size:0; 
		  margin-bottom: 3rem; 
		  overflow: hidden; 
		}
		figure#spinner { 
			  transform-style: preserve-3d; 
			  height: 330px; /*hauteur fond*/
			  transform-origin: 50% 50% -500px; 
			  transition: 1s; 
		} 
		figure#spinner img { 
			 width: 40%; max-width: 425px; 
			 position: absolute; left: 30%;
			 transform-origin: 50% 50% -500px;
			 outline:1px solid transparent; 
			 }
			 figure#spinner img:nth-child(1) {
			 transform:rotateY(0deg); 
		}
		figure#spinner img:nth-child(2) { transform: rotateY(-45deg); }
			figure#spinner img:nth-child(3) { transform: rotateY(-90deg); }
			figure#spinner img:nth-child(4) { transform: rotateY(-135deg); }
			figure#spinner img:nth-child(5){ transform: rotateY(-180deg); }
			figure#spinner img:nth-child(6){ transform: rotateY(-225deg); }
			figure#spinner img:nth-child(7){ transform: rotateY(-270deg); }
			figure#spinner img:nth-child(8){ transform: rotateY(-315deg); }
			
		div#carousel ~ span { 
			color: #fff; 
			margin: 5%; 
			display: inline-block; 
			text-decoration: none; 
			font-size: 2rem; 
			transition: 0.6s color; 
			position: relative; 
			margin-top: -6rem; 
			border-bottom: none; 
			line-height: 0; }

		div#carousel ~ span:hover {
		color: #888; cursor: pointer; }
	</style>
	<div align="right">
		<a href="<?php echo base_url();?>documentation/planning/2017">
		<marquee SCROLLAMOUNT="4">
			<font size="5">
				<font face="Arial">
					<font color="red" face="Times New Roman"><b>RESTITUTION:</b></font>
						<font color="purple" face="Times New Roman">27 AVRIL 2017 à 10H - Porte 257</font>
							<font color="black" face="Times New Roman">Thème:  	&laquo; GESTION DU PATRIMOINE DE L'ETAT &raquo;</font>
								<font color="Teal" face="Times New Roman">présentée par</font>
								<font color="blue" face="Times New Roman">Messieurs ANDRIANANTOANDRO Harinjaka Valy</font>
								<font color="black" face="Times New Roman">et</font>
								<font color="blue" face="Times New Roman"> BITY Jean José</font>
									
										
				</font>
			</font>
		</marquee>
		<marquee SCROLLAMOUNT="4">
			<font size="5">
				<font face="Arial">
					<font color="red" face="Times New Roman"><b>RESTITUTION:</b></font>
						<font color="purple" face="Times New Roman">27 AVRIL 2017 à 11H - Porte 257</font>
							<font color="black" face="Times New Roman">Thème:  	&laquo; GRAPHIC AND WEB DESIGNING &raquo;</font>
								<font color="Teal" face="Times New Roman">présentée par</font>
								<font color="blue" face="Times New Roman">Monsieur RAHARISON Rado Freddy <font color="white" face="Times New Roman">RO Harinjaka Valy</font></font>
									<font color="white" face="Times New Roman">ete</font>
								<font color="white" face="Times New Roman"> BITY Jean José</font>	
										
				</font>
			</font>
		</marquee>
		</a>	
	</div> 
	<br/> <br/> 
	<div id="carousel" style="padding-top:3%;">
		<figure id="spinner">
			<?php for($i=1;$i<18;$i++){?>
			<img src="<?php echo base_url('assets/img/galery/'.$i.'.jpg')?>">
			<?php }?>
		</figure>
	</div>
	<span style="float:left;position: absolute; top: 67%;" class="ss-icon" onclick="changeSigne(false)">&lt;</span>
	<span style="float:right;position: absolute; top: 67%;right: 0;;" class="ss-icon" onclick="changeSigne(true)">&gt;</span>
	<script>
		setInterval("galleryspin()",5000);
		var angle = 0;
		
		var sign = true;
		
		function changeSigne(x){
			sign = x;
			galleryspin();
		}
		
		function galleryspin() {
			spinner = document.querySelector("#spinner");
			if (sign) { angle = angle + 45; } else { angle = angle - 45; }
			spinner.setAttribute("style","-webkit-transform: rotateY("+ angle +"deg); -moz-transform: rotateY("+ angle +"deg); transform: rotateY("+ angle +"deg);");
		}		
	</script>
</section>
	<style>
		.border_galery{
			border: solid;
			border-color: green;
		}
		.image_slide{
		height:524px!important
		}
		.carousel-caption {
		left: 54%;
		right: 181px;
		height:300px!important;
		z-index:0;
		bottom:0;
		animation-name: my_animation;
		animation-duration: 2s;
	}
	
	.carousel-control.right {
		background-image: none;
		width="47%";
	}
	
	.carousel-control.left {
		background-image: none;
	}
	
	</style>
<section class="no-padding" id="portfolio">
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
	<li data-target="#carousel-example-generic" data-slide-to="3"></li>
	<li data-target="#carousel-example-generic" data-slide-to="4"></li>
	<li data-target="#carousel-example-generic" data-slide-to="5"></li>
  </ol>

	<!-- Wrapper for slides -->
	
  <div class="carousel-inner" role="listbox">
    <div class="item active">
        <div class="container-fluid">
            <div class="row no-gutter popup-gallery">		
			<?php for($i=1;$i<7;$i++){?>
                <div class="col-md-2 border_galery">
                    <a href="<?php echo base_url('assets/img/galery/min/'.$i.'.jpg')?>" class="portfolio-box" >
                        <img src="<?php echo base_url('assets/img/galery/min/'.$i.'.jpg')?>" class="img-responsive" alt=""height="30">
                        <div class="portfolio-box-caption">
                        </div>
                    </a>
                </div>
            <?php }?> 
            </div>
        </div>
	</div>
	<div class="item">
		<div class="container-fluid">
            <div class="row no-gutter popup-gallery">		
			<?php for($i=7;$i<13;$i++){?>
                <div class="col-md-2 border_galery">
                    <a href="<?php echo base_url('assets/img/galery/min/'.$i.'.jpg')?>" class="portfolio-box">
                    <img src="<?php echo base_url('assets/img/galery/min/'.$i.'.jpg')?>" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                        </div>
                    </a>
                </div>
            <?php }?> 
            </div>
        </div>
	</div>
	<div class="item">
		<div class="container-fluid">
            <div class="row no-gutter popup-gallery">		
			<?php for($i=13;$i<19;$i++){?>
                <div class="col-md-2 border_galery">
                    <a href="<?php echo base_url('assets/img/galery/min/'.$i.'.jpg')?>" class="portfolio-box">
                    <img src="<?php echo base_url('assets/img/galery/min/'.$i.'.jpg')?>" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                        </div>
                    </a>
                </div>
            <?php }?> 
            </div>
        </div>
	</div>
	<div class="item">
		<div class="container-fluid">
            <div class="row no-gutter popup-gallery">		
			<?php for($i=19;$i<25;$i++){?>
                <div class="col-md-2 border_galery">
                    <a href="<?php echo base_url('assets/img/galery/min/'.$i.'.jpg')?>" class="portfolio-box">
                    <img src="<?php echo base_url('assets/img/galery/min/'.$i.'.jpg')?>" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                        </div>
                    </a>
                </div>
            <?php }?> 
            </div>
        </div>
	</div>
	<div class="item">
		<div class="container-fluid">
            <div class="row no-gutter popup-gallery">		
			<?php for($i=25;$i<31;$i++){?>
                <div class="col-md-2 border_galery">
                    <a href="<?php echo base_url('assets/img/galery/min/'.$i.'.jpg')?>" class="portfolio-box">
                    <img src="<?php echo base_url('assets/img/galery/min/'.$i.'.jpg')?>" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                        </div>
                    </a>
                </div>
            <?php }?> 
            </div>
        </div>
	</div>
	<div class="item">
		<div class="container-fluid">
            <div class="row no-gutter popup-gallery">		
			<?php for($i=31;$i<37;$i++){?>
                <div class="col-md-2 border_galery">
                    <a href="<?php echo base_url('assets/img/galery/min/'.$i.'.jpg')?>" class="portfolio-box">
                    <img src="<?php echo base_url('assets/img/galery/min/'.$i.'.jpg')?>" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                        </div>
                    </a>
                </div>
            <?php }?> 
            </div>
        </div>
	</div>
	<div class="item">
		<div class="container-fluid">
            <div class="row no-gutter popup-gallery">		
			<?php for($i=37;$i<43;$i++){?>
                <div class="col-md-2 border_galery">
                    <a href="<?php echo base_url('assets/img/galery/min/'.$i.'.jpg')?>" class="portfolio-box">
                    <img src="<?php echo base_url('assets/img/galery/min/'.$i.'.jpg')?>" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                        </div>
                    </a>
                </div>
            <?php }?> 
            </div>
        </div>
	</div>
	<div class="item">
		<div class="container-fluid">
            <div class="row no-gutter popup-gallery">		
			<?php for($i=43;$i<49;$i++){?>
                <div class="col-md-2 border_galery">
                    <a href="<?php echo base_url('assets/img/galery/min/'.$i.'.jpg')?>" class="portfolio-box">
                    <img src="<?php echo base_url('assets/img/galery/min/'.$i.'.jpg')?>" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                        </div>
                    </a>
                </div>
            <?php }?> 
            </div>
        </div>
	</div>
	<div class="item">
		<div class="container-fluid">
            <div class="row no-gutter popup-gallery">		
			<?php for($i=49;$i<55;$i++){?>
                <div class="col-md-2 border_galery">
                    <a href="<?php echo base_url('assets/img/galery/min/'.$i.'.jpg')?>" class="portfolio-box">
                    <img src="<?php echo base_url('assets/img/galery/min/'.$i.'.jpg')?>" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                        </div>
                    </a>
                </div>
            <?php }?> 
            </div>
        </div>
	</div>
	<div class="item">
		<div class="container-fluid">
            <div class="row no-gutter popup-gallery">		
			<?php for($i=55;$i<61;$i++){?>
                <div class="col-md-2 border_galery">
                    <a href="<?php echo base_url('assets/img/galery/min/'.$i.'.jpg')?>" class="portfolio-box">
                    <img src="<?php echo base_url('assets/img/galery/min/'.$i.'.jpg')?>" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                        </div>
                    </a>
                </div>
            <?php }?> 
            </div>
        </div>
	</div>
	<div class="item">
		<div class="container-fluid">
            <div class="row no-gutter popup-gallery">		
			<?php for($i=61;$i<67;$i++){?>
                <div class="col-md-2 border_galery">
                    <a href="<?php echo base_url('assets/img/galery/min/'.$i.'.jpg')?>" class="portfolio-box">
                    <img src="<?php echo base_url('assets/img/galery/min/'.$i.'.jpg')?>" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                        </div>
                    </a>
                </div>
            <?php }?> 
            </div>
        </div>
	</div>
	<div class="item">
		<div class="container-fluid">
            <div class="row no-gutter popup-gallery">		
			<?php for($i=67;$i<73;$i++){?>
                <div class="col-md-2 border_galery">
                    <a href="<?php echo base_url('assets/img/galery/min/'.$i.'.jpg')?>" class="portfolio-box">
                    <img src="<?php echo base_url('assets/img/galery/min/'.$i.'.jpg')?>" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                        </div>
                    </a>
                </div>
            <?php }?> 
            </div>
        </div>
	</div>
	<div class="item">
		<div class="container-fluid">
            <div class="row no-gutter popup-gallery">		
			<?php for($i=73;$i<79;$i++){?>
                <div class="col-md-2 border_galery">
                    <a href="<?php echo base_url('assets/img/galery/min/'.$i.'.jpg')?>" class="portfolio-box">
                    <img src="<?php echo base_url('assets/img/galery/min/'.$i.'.jpg')?>" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                        </div>
                    </a>
                </div>
            <?php }?> 
            </div>
        </div>
	</div>
</div>
<!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
    </section>