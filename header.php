<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<title>PHOTOCREATIVA</title>
		<?php wp_head(); ?>
	</head>
    <body style="overflow-x:hidden;">
        <div id="carousel-example-generic" class="carousel slide carousel-fade" data-ride="carousel" style="width:100%">
            <!-- Indicators -->
            <ol class="carousel-indicators" style="display:none;">
                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active" style="width:100%"></li>
                  <li data-target="#carousel-example-generic" data-slide-to="1" style="width:100%"></li>
                  <li data-target="#carousel-example-generic" data-slide-to="2" style="width:100%"></li>
            </ol>   
            <div class="carousel-inner">
                  <?php
                   $class_active="active";
        
                   $args=array( 'post_type'=> 'sliders',  'post_status' => 'publish', 'posts_per_page' => 50 );
                  $my_query = new WP_Query($args);
                  if( $my_query->have_posts() ) {
                        while ($my_query->have_posts()) : $my_query->the_post(); ?>
                                   <div class="item <?php echo $class_active ;?>">
                                          <?php echo get_the_content(array('class' => 'prueba'));?>
                                    </div> <?php $class_active="";
                        endwhile;
                  } wp_reset_query(); ?>
            </div>
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
              <span class="fa fa-chevron-circle-left fa-3x" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
              <span class="fa fa-chevron-circle-right fa-3x" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
        </div>
            <nav class="navbar navbar-default" role="navigation">
              <div class="container">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                 <a class="navbar-brand" href="#"><img src="<?php echo get_bloginfo('template_directory');?>/img/logo phc.png" id="imgnavbar"></a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <?php 
                            wp_nav_menu(array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'nav navbar-nav navbar-right', 'walker' => new Bootstrap_Walker_Nav_Menu() ) );
                        ?>
                </div>	
              </div>
            </nav>
            <div class="row" id="submenu">
                <div class="container">
                    <div class="row">
                       <div class="col-md-6">
                          <div class="text-left smdentroleft">
                              <a href="https://www.facebook.com/photocreativa.net" target="new"><i class="fa fa-facebook fa-2x redsocial"></i></a>
                              <i class="fa fa-instagram fa-2x redsocial"></i> 
                              <i class="fa fa-twitter fa-2x redsocial"></i> 
                          </div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-right smdentroright">
                              Photo | Film | Studio | Design | Events
                            </div>
                        </div>
                    </div>
                </div>
             </div>