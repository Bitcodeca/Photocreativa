<?php get_header();?>
<section id="portfolio">
	<div class="container">
            <div class="text-right portfolio">
                <a class="filter active" data-filter="*">ALL.</a>
                <a class="filter" data-filter=".wedding">WEDDING.</a>
                <a class="filter" data-filter=".session">SESSION.</a>
                <a class="filter" data-filter=".fashion">FASHION</a>
             </div>
             <section id="inner">
                    <div class="pager-list">
                    </div>
                    <div id="Container" class="design">
                            <div class="galleryWrap" id="resultado">
                            	<div class="container">
									<?php $args=array( 'post_type'=> 'design', 'post_status' => 'publish', 'posts_per_page' => 100,  'tax_query' => array( array(  'taxonomy' => 'covers', 'field' => 'id', 'terms' => array('12') ) ) );
                                    $my_query = new WP_Query($args);
                                    if( $my_query->have_posts() ) {
                                      while ($my_query->have_posts()) : $my_query->the_post(); 
                                            $terms = get_the_terms( $post->ID, 'albums' ); foreach($terms as $term) { $album=$term->name; }	
                                            $category = get_the_category(); $categoria = $category[0]->cat_name;?>
                                            <div class="col-md-12 mix <?php echo $categoria; ?>">
                                                <br> <?php $terms = get_the_terms( $post->ID , 'albums' );
                                                if($terms) { foreach( $terms as $term ) { $y= $term->term_id; } } ?>
                                                <h2><?php the_title(); ?></h2>
                                                <a href="index.php/?p=96&a=<?php echo $y; ?>"><?php echo get_the_content();?></a>
                                            </div><br>
                                        <?php endwhile; 
                                      }  wp_reset_query(); ?>
                                 </div>
                            </div>
                      </div>
              </section>
	</div>
</section>      
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
var buttonFilter = {
  $filters: null,
  $reset: null,
  groups: [],
  outputArray: [],
  outputString: '',
  init: function(){
    var self = this; 
    self.$filters = $('#Filters');
    self.$reset = $('#Reset');
    self.$container2 = $('#Container');
    self.$filters.find('fieldset').each(function(){
      var $this = $(this);
      self.groups.push({
        $buttons: $this.find('.filter'),
        $dropdown: $this.find('select'),
        active: ''
      });
    });
    self.bindHandlers();
  },
  
  
  bindHandlers: function(){
    var self = this;
    
    // Handle filter clicks
    
    self.$filters.on('click', '.filter', function(e){
      e.preventDefault();
      
      var $button = $(this);
      
      // If the button is active, remove the active class, else make active and deactivate others.
      
      $button.hasClass('active') ?
        $button.removeClass('active') :
        $button.addClass('active').siblings('.filter').removeClass('active');
      
      self.parseFilters();
    });
    
    // Handle dropdown change
    
    self.$filters.on('change', function(){
      self.parseFilters();           
    });
    
    // Handle reset click
    
    self.$reset.on('click', function(e){
      e.preventDefault();
      
      self.$filters.find('.filter').removeClass('active');
      self.$filters.find('.show-all').addClass('active');
      self.$filters.find('select').val('');
      
      self.parseFilters();
    });
  },
  
  // The parseFilters method checks which filters are active in each group:
  
  parseFilters: function(){
    var self = this;
 
    // loop through each filter group and grap the active filter from each one.
    
    for(var i = 0, group; group = self.groups[i]; i++){
      group.active = group.$buttons.length ? 
        group.$buttons.filter('.active').attr('data-filter') || '' :
        group.$dropdown.val();
    }
    
    self.concatenate();
  },
  
  // The "concatenate" method will crawl through each group, concatenating filters as desired:
  
  concatenate: function(){
    var self = this;
    
    self.outputString = ''; // Reset output string
    
    for(var i = 0, group; group = self.groups[i]; i++){
      self.outputString += group.active;
    }
    
    // If the output string is empty, show all rather than none:
    
    !self.outputString.length && (self.outputString = 'all'); 
    
    console.log(self.outputString); 
    
    // ^ we can check the console here to take a look at the filter string that is produced
    
    // Send the output string to MixItUp via the 'filter' method:
    
	  if(self.$container2.mixItUp('isLoaded')){
    	self.$container2.mixItUp('filter', self.outputString);
	  }
  }
};
  
// On document ready, initialise our code.

jQuery(function(){

  // Initialize buttonFilter code
      
  buttonFilter.init();


jQuery('#Container').mixItUp({
	animation: {
		duration: 360,
		effects: 'fade',
		easing: 'cubic-bezier(0.175, 0.885, 0.32, 1.275)'
	},
	pagination: {
		limit: 9,
		loop: true,
		prevButtonHTML: '<a class="fa fa-chevron-circle-left fa-3x" aria-hidden="true"></a>',
		nextButtonHTML: '<a class="fa fa-chevron-circle-right fa-3x" aria-hidden="true"></a>'
	}
});
});

</script>
<?php get_footer(); ?>