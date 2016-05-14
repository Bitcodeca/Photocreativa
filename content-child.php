<?php get_header(); ?>
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
<?php $a=$_GET['a']; ?>
<div id="gallery">
    <div class="album" data-jgallery-album-title="<?php echo $a; ?>">
		<?php $args=array( 'post_type'=> 'design', 'post_status' => 'publish', 'posts_per_page' => 100, 'order' => 'ASC', 'tax_query' => array( array(  'taxonomy' => 'albums', 'field' => 'id', 'terms' => array($a) ) ) );
        $my_query = new WP_Query($args);
        while( $my_query->have_posts() ) { $my_query->the_post(); ?>
                <?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );?>
                <a href="<?php echo $url; ?>"><?php echo get_the_content();?></a>
        <?php  wp_reset_query(); } ?>
    </div>
</div>
<?php get_footer(); ?>