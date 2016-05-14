<?php get_header();?>
<section id="film">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
					 <?php
                         $class_active="active";
        
                         $args=array(
                              'post_type'=> 'film',
                              'post_status' => 'publish',
                              'posts_per_page' => 100
                         
                             );
                        $my_query = new WP_Query($args);
                        if( $my_query->have_posts() ) {
                          while ($my_query->have_posts()) : $my_query->the_post(); ?>
                          <br>
                            	<h2><?php the_title(); ?></h2>
                            <div class="video">
                                 <?php echo get_the_content();?>
                            </div><br> <?php endwhile; }  wp_reset_query(); ?>
                            
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>