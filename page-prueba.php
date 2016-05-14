<?php get_header(); ?>
<?php if (is_page()) {   //  displaying a child page ?>
    <script type="text/javascript">
        jQuery("li.current-page-ancestor").addClass('current-menu-item');
    </script>
<?php } ?>
<script type="text/javascript">
jQuery( function() {
    jQuery( '#gallery' ).jGallery({
		"transition":"scaleDown_moveFromRight",
        "transitionCols":"1",
        "transitionRows":"1",
        "thumbnailsPosition":"bottom",
        "thumbType":"image",
        "backgroundColor":"FFFFFF",
        "textColor":"000000",
        "mode":"standard"});
} );
</script>
<?php 
$a=$_GET['a'];
echo $a;
$terms = get_terms('category');
 if ( !empty( $terms ) && !is_wp_error( $terms ) ){ $x=1; foreach ( $terms as $term ) { $categoria[$x]=$term->name; $x++; } }
 $total=$x; ?>
<div id="gallery">
    <?php $x=1; $class_active="active";
	 $args=array( 'post_type'=> 'album',
		  'post_status' => 'publish',
		  'posts_per_page' => 500,
		  'order' => 'ASC' );
	$my_query = new WP_Query($args);
	if( $my_query->have_posts() ) { 		
	while($x<$total){ ?> 
    <div class="album" data-jgallery-album-title=<?php echo $categoria[$x] ?>>
    <?php  while ($my_query->have_posts()) : $my_query->the_post();
			  $categories = get_the_category();
			  if ( $categories[0]->name == $categoria[$x] ) { 
			  $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );?>
					  <a href="<?php echo $url; ?>"><?php the_post_thumbnail( 'full', array('class' => '')); ?></a>
			  <?php } endwhile; $x++; ?>
                  
    </div>
    <?php } wp_reset_query(); } ?>
</div>
fadsfadsfs
<?php get_footer(); ?>