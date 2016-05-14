<?php get_header();?>
<section id="portfolio">
<div class="container">
                    <div class="pager-list"></div>
            <div class="text-right portfolio">
                <a class="filter active" data-filter="*">ALL.</a>
                <?php $terms = get_terms('category');
		 		if ( !empty( $terms ) && !is_wp_error( $terms ) ){
					foreach ( $terms as $term ) { 
						echo '<a class="filter active" data-filter=".'.$term->name.'">'.$term->name.'.</a>'; 
					}
				}?>
             </div>
            <section id="inner">
                    <div id="Container">
                            <div class="galleryWrap" id="resultado">
        			<?php $x=1; $args = array('order'=> 'ASC', 'numberposts' => 1000 , 'orderby' => 'post_date', 'page_name' =>'PHOTOGRAPHY', 'posts_per_page'   => 100); $postslist = get_posts( $args );
                               foreach ($postslist as $post) :  setup_postdata($post); $category = get_the_category(); $categoria = $category[0]->cat_name; $current=get_the_ID(); $posttags = get_the_tags();
									foreach($posttags as $tag) { $tam=$tag->name; 
										if($tam==6){$tam2=10;$tam3=10;}elseif($tam==5){$tam2=8;$tam3=8;}elseif($tam==4){$tam2=7;$tam3=7;}elseif($tam==3){$tam2=5;$tam3=5;}elseif($tam==1){$tam2=2;$tam3=2;}elseif($tam==2){$tam2=4;$tam3=4;}else{$tam2=12;$tam3=12;} } ?>
                                 <div class="col-md-<?php echo $tam; ?> col-sm-<?php echo $tam3; ?> col-xs-<?php echo $tam2; ?> mix <?php echo $categoria; ?> fancybox" data-my-order="<?php echo $x; $x++; ?>">
                                                <div class="imgph">
                                                    <a href="#img<?php echo $current; ?>">
														<?php echo get_the_content('', array('class' => 'img-responsive imgheight')); ?>
                                                    </a>
                                                </div>
                                            </div>
                                            <a href="#_" class="lightbox" id="img<?php echo $current; ?>">
                                                <?php the_post_thumbnail('', array('class' => 'img-responsive imgzoom')); ?>
                                            </a>
                            <?php endforeach; ?>
                         	</div> 	
                      </div>
              </section>
			</div>
</section>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
// To keep our code clean and modular, all custom functionality will be contained inside a single object literal called "buttonFilter".
var buttonFilter = {
  
  // Declare any variables we will need as properties of the object
  
  $filters: null,
  $reset: null,
  groups: [],
  outputArray: [],
  outputString: '',
  
  // The "init" method will run on document ready and cache any jQuery objects we will need.
  
  init: function(){
    var self = this; // As a best practice, in each method we will asign "this" to the variable "self" so that it remains scope-agnostic. We will use it to refer to the parent "buttonFilter" object so that we can share methods and properties between all parts of the object.
    
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
  
  // The "bindHandlers" method will listen for whenever a button is clicked. 
  
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
		effects: 'fade translateZ(-10deg)',
		duration: 200
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