<?php
/*
Plugin Name: WP Blog and Widget
Plugin URL: http://www.wponlinesupport.com/
Description: Display Blog on your website.
Version: 1.2
Author: WP Online Support
Author URI: http://www.wponlinesupport.com/
Contributors: WP Online Support
*/
/*
 * Register CPT blog_post
 *
 */
// Initialization function
add_action('init', 'wpbaw_blog_init');
function wpbaw_blog_init() {
  // Create new News custom post type
    $wpbaw_blog_labels = array(
    'name'                 => _x('Blog', 'post type general name'),
    'singular_name'        => _x('Blog', 'post type singular name'),
    'add_new'              => _x('Add Blog', 'blog_post'),
    'add_new_item'         => __('Add New Blog'),
    'edit_item'            => __('Edit Blog'),
    'new_item'             => __('New Blog'),
    'view_item'            => __('View Blog'),
    'search_items'         => __('Search Blog'),
    'not_found'            =>  __('No Blog Items found'),
    'not_found_in_trash'   => __('No Blog Items found in Trash'), 
    '_builtin'             =>  false, 
    'parent_item_colon'    => '',
    'menu_name'            => 'Blog'
  );
  $wpbaw_blog_args = array(
    'labels'              => $wpbaw_blog_labels,
    'public'              => true,
    'publicly_queryable'  => true,
    'exclude_from_search' => false,
    'show_ui'             => true,
    'show_in_menu'        => true, 
    'query_var'           => true,
    'rewrite'             => array( 
							'slug' => 'blog_post',
							'with_front' => false
							),
    'capability_type'     => 'post',
    'has_archive'         => true,
    'hierarchical'        => false,
    'menu_position'       => 5,
	'menu_icon'   => 'dashicons-feedback',
    'supports'            => array('title','editor','thumbnail','excerpt','comments'),
    'taxonomies'          => array('post_tag')
  );
  register_post_type('blog_post',$wpbaw_blog_args);
}
/* Register Taxonomy */
add_action( 'init', 'wpbaw_blog_taxonomies');
function wpbaw_blog_taxonomies() {
    $labels = array(
        'name'              => _x( 'Category', 'taxonomy general name' ),
        'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Category' ),
        'all_items'         => __( 'All Category' ),
        'parent_item'       => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category:' ),
        'edit_item'         => __( 'Edit Category' ),
        'update_item'       => __( 'Update Category' ),
        'add_new_item'      => __( 'Add New Category' ),
        'new_item_name'     => __( 'New Category Name' ),
        'menu_name'         => __( 'Blog Category' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'blog-category' ),
    );

    register_taxonomy( 'blog-category', array( 'blog_post' ), $args );
}

function wpbaw_blog_rewrite_flush() {  
		wpbaw_blog_init();  
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'wpbaw_blog_rewrite_flush' );
add_action( 'wp_enqueue_scripts','wpbaw_blog_css_script' );
    function wpbaw_blog_css_script() {
        wp_enqueue_style( 'cssblog',  plugin_dir_url( __FILE__ ). 'css/styleblog.css' );        
    }
class wpbaw_Blog_Widget extends WP_Widget {

    function wpbaw_Blog_Widget() {

        $widget_ops = array('classname' => 'SP_Blog_Widget', 'description' => __('Displayed Latest Blog post  in a sidebar', 'news_cpt') );
        $control_ops = array( 'width' => 350, 'height' => 450, 'id_base' => 'sp_blog_widget' );
        $this->WP_Widget( 'sp_blog_widget', __('Latest Blog Widget', 'blog_cpt'), $widget_ops, $control_ops );
    }

    function form($instance) {
        $defaults = array(
        'limit'             => 5,
        'title'             => '',
        "date"              => "false", 
        'show_category'     => "false",
        'category'          => 0,
        );

        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $num_items = isset($instance['num_items']) ? absint($instance['num_items']) : 5;
    ?>
      <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
      <p><label for="<?php echo $this->get_field_id('num_items'); ?>">Number of Items: <input class="widefat" id="<?php echo $this->get_field_id('num_items'); ?>" name="<?php echo $this->get_field_name('num_items'); ?>" type="text" value="<?php echo attribute_escape($num_items); ?>" /></label></p>
            <p>
            <input id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" type="checkbox"<?php checked( $instance['date'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'date' ); ?>"><?php _e( 'Display Date', 'blog' ); ?></label>
        </p>
        <p>
            <input id="<?php echo $this->get_field_id( 'show_category' ); ?>" name="<?php echo $this->get_field_name( 'show_category' ); ?>" type="checkbox"<?php checked( $instance['show_category'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_category' ); ?>"><?php _e( 'Display Category', 'blog' ); ?></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category:', 'blog' ); ?></label>
            <?php
                $dropdown_args = array( 'taxonomy' => 'blog-category', 'class' => 'widefat', 'show_option_all' => __( 'All', 'blog' ), 'id' => $this->get_field_id( 'category' ), 'name' => $this->get_field_name( 'category' ), 'selected' => $instance['category'] );
                wp_dropdown_categories( $dropdown_args );
            ?>
        </p>
    <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['num_items'] = $new_instance['num_items'];
        $instance['date'] = (bool) esc_attr( $new_instance['date'] );
        $instance['show_category'] = (bool) esc_attr( $new_instance['show_category'] );
        $instance['category']      = intval( $new_instance['category'] ); 
        return $instance;
    }
    function widget($news_args, $instance) {
        extract($news_args, EXTR_SKIP);

        $current_post_name = get_query_var('name');

        $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
        $num_items = empty($instance['num_items']) ? '5' : apply_filters('widget_title', $instance['num_items']);
        if ( isset( $instance['date'] ) && ( 1 == $instance['date'] ) ) { $date = "true"; } else { $date = "false"; }
        if ( isset( $instance['show_category'] ) && ( 1 == $instance['show_category'] ) ) { $show_category = "true"; } else { $show_category = "false"; }
        if ( isset( $instance['category'] ) && is_numeric( $instance['category'] ) ) $category = intval( $instance['category'] );
        $postcount = 0;

        echo $before_widget;

?>
             <h4 class="widget-title"><?php echo $title ?></h4>
            <!--visual-columns-->
            <?php if($date == "false" && $show_category == "false"){ 
                $no_p = "no_p";
                }?>
            <div class="recent-news-items <?php echo $no_p?>">
                <ul>
            <?php // setup the query
            $news_args = array( 'suppress_filters' => true,
                           'posts_per_page' => $num_items,
                           'post_type' => 'blog_post',
                           'order' => 'DESC'
                         );

            if($category != 0){
                $news_args['tax_query'] = array( array( 'taxonomy' => 'blog-category', 'field' => 'id', 'terms' => $category) );
            }
            $cust_loop = new WP_Query($news_args);
             $post_count = $cust_loop->post_count;
          $count = 0;
            if ($cust_loop->have_posts()) : while ($cust_loop->have_posts()) : $cust_loop->the_post(); $postcount++;
                    $count++;
               $terms = get_the_terms( $post->ID, 'blog-category' );
                    $news_links = array();
                    if($terms){

                    foreach ( $terms as $term ) {
                        $term_link = get_term_link( $term );
                        $news_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
                    }
                }
                    $cate_name = join( ", ", $news_links );
                    ?>
                    <li class="news_li">
                       <h6> <a class="post-title" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h6>
                        <?php echo ($date == "true")? '<p>'.get_the_date('j, M y') : "" ;?>
                        <?php echo ($date == "true" && $show_category == "true" && $cate_name != '') ? " , " : "";?>
                        <?php echo ($show_category == 'true' && $cate_name != '') ? $cate_name.'</p>' : ""?>
                    </li>
            <?php endwhile;
            endif;
             wp_reset_query(); ?>

                </ul>
            </div>
<?php
        echo $after_widget;
    }
}

/* Register the widget */
function wpbaw_blog_widget_load_widgets() {
    register_widget( 'wpbaw_Blog_Widget' );
}

/* Load the widget */
add_action( 'widgets_init', 'wpbaw_blog_widget_load_widgets' );

/* Page short code [blog limit="10"] */

function get_wpbaw_blog( $atts, $content = null ){
            // setup the query
            extract(shortcode_atts(array(
		"limit" => '',	
		"category" => '',
		"grid" => '',
        "show_date" => '',
        "show_category_name" => '',
        "show_content" => '',
		"show_full_content" => '',
        "content_words_limit" => '',
	), $atts));
	// Define limit
	if( $limit ) { 
		$posts_per_page = $limit; 
	} else {
		$posts_per_page = '-1';
	}
	if( $category ) { 
		$cat = $category; 
	} else {
		$cat = '';
	}
	 if( $show_date ) { 
        $showDate = $show_date; 
    } else {
        $showDate = 'true';
    }
	if( $grid ) { 
		$gridcol = $grid; 
	} else {
		$gridcol = '0';
	}
	if( $show_category_name ) { 
        $showCategory = $show_category_name; 
    } else {
        $showCategory = 'true';
    }
    if( $show_content ) { 
        $showContent = $show_content; 
    } else {
        $showContent = 'true';
    }
	 if( $show_full_content ) { 
        $showFullContent = $show_full_content; 
    } else {
        $showFullContent = 'false';
    }
	 if( $content_words_limit ) { 
        $words_limit = $content_words_limit; 
    } else {
        $words_limit = '20';
    }
	ob_start();
	
	global $paged;
		if(is_home() || is_front_page()) {
			  $paged = get_query_var('page');
		} else {
			 $paged = get_query_var('paged');
		}
	
	$post_type 		= 'blog_post';
	$orderby 		= 'post_date';
	$order 			= 'DESC';
				 
        $args = array ( 
            'post_type'      => $post_type, 
            'orderby'        => $orderby, 
            'order'          => $order,
            'posts_per_page' => $posts_per_page,   
            'paged'          => $paged,
            );
            if($cat != ""){
                $args['tax_query'] = array( array( 'taxonomy' => 'blog-category', 'field' => 'id', 'terms' => $cat) );
            }        
        $query = new WP_Query($args);
      $post_count = $query->post_count;
          $count = 0;
             if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
             $count++;
               $terms = get_the_terms( $post->ID, 'blog-category' );
                    $news_links = array();
                    if($terms){

                    foreach ( $terms as $term ) {
                        $term_link = get_term_link( $term );
                        $news_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
                    }
                }
                    $cate_name = join( ", ", $news_links );
                $css_class="team";
                if ( ( is_numeric( $grid ) && ( $grid > 0 ) && ( 0 == ($count - 1) % $grid ) ) || 1 == $count ) { $css_class .= ' first'; }
                if ( ( is_numeric( $grid ) && ( $grid > 0 ) && ( 0 == $count % $grid ) ) || $post_count == $count ) { $css_class .= ' last'; }
                if($showDate == 'true'){ $date_class = "has-date";}else{$date_class = "has-no-date";}
                ?>
			
            	<div id="post-<?php the_ID(); ?>" class="blog type-blog <?php echo (has_post_thumbnail()) ? "has-thumb" : "no-thumb";?> blog-col-<?php echo $gridcol.' '.$css_class.' '.$date_class; ?>">
					
					<?php
						// Post thumbnail.
						if ( has_post_thumbnail())  { ?>
                        <div class="blog-thumb">
                        <?php
                            if($gridcol == '1'){?>
						 <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('url'); ?></a>
						<?php } else if($gridcol > '2') { ?>
							<div class="grid-blog-thumb">	
						 <a href="<?php the_permalink(); ?>">	<?php the_post_thumbnail('medium'); ?></a>
							</div>
					<?php } else if($gridcol == '0') { ?>
					<div class="grid-blog-thumb">							
						 <a href="<?php the_permalink(); ?>">	<?php the_post_thumbnail('medium'); ?></a>
							</div>
					<?php	} else { ?>
					<div class="grid-blog-thumb">	
							 <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('large'); ?></a>
							</div>
					<?php } ?>
                    </div>
                    <?php }?>
					
					<div class="blog-content">
					<?php if($gridcol == '1') {
                    if($showDate == 'true'){ ?>
						<div class="date-post">					
						<h2><span><?php echo get_the_date('j'); ?></span></h2>
						<p><?php echo get_the_date('M y'); ?></p>
						</div>
                         <?php }?>
					<?php } else { ?>
						<div class="grid-date-post">
						<?php echo ($showDate == "true")? get_the_date('j, M y') : "" ;?>
                        <?php echo ($showDate == "true" && $showCategory == "true" && $cate_name != '') ? " , " : "";?>
                        <?php echo ($showCategory == 'true' && $cate_name != '') ? $cate_name : ""?>
						</div>
					<?php } ?>
					<div class="post-content-text">
					
						<?php the_title( sprintf( '<h4 class="blog-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );	?>
					    
						<?php if($showCategory == 'true' && $gridcol == '1'){ ?>
						<div class="blog-cat">
                            <?php echo $cate_name; ?>
							</div>
                       <?php }?>
                     <?php if($showContent == 'true'){?>   
					<div class="blog-content-excerpt">
					<?php  if($showFullContent == "false" ) { 
					$excerpt = get_the_content();?>
                    <p class="blog-short-content"><?php echo blog_limit_words($excerpt,$words_limit); ?>...</p>
                   
                        <a href="<?php the_permalink(); ?>" class="more-link">Read More</a>	
						<?php } else { 
							the_content();
						 } ?>
					</div><!-- .entry-content -->
                    <?php }?>
					</div>
				</div>
</div><!-- #post-## -->			  
          <?php  endwhile;
            endif; ?>
			<div class="blog_pagination">				 	
<div class="button-news-p"><?php next_posts_link( ' Next >>', $query->max_num_pages ); ?></div>
<div class="button-news-n"><?php previous_posts_link( '<< Previous' ); ?> </div>
</div>	
			<?php
             wp_reset_query(); 
				
		return ob_get_clean();			             
	}
add_shortcode('blog','get_wpbaw_blog');	

/* Home short code [recent_blog_post limit="10"] */

function get_wpbaw_homeblog( $atts, $content = null ){
            // setup the query
            extract(shortcode_atts(array(
		"limit" => '',	
		"category" => '',
		"grid" => '',
        "show_date" => '',
        "show_category_name" => '',
        "show_content" => '',
        "content_words_limit" => '',
	), $atts));
	// Define limit
	if( $limit ) { 
		$posts_per_page = $limit; 
	} else {
		$posts_per_page = '-1';
	}
	if( $category ) { 
		$cat = $category; 
	} else {
		$cat = '';
	}
	if( $grid ) { 
		$gridcol = $grid; 
	} else {
		$gridcol = '0';
	}
    if( $show_date ) { 
        $showDate = $show_date; 
    } else {
        $showDate = 'true';
    }
	if( $show_category_name ) { 
        $showCategory = $show_category_name; 
    } else {
        $showCategory = 'true';
    }
    if( $show_content ) { 
        $showContent = $show_content; 
    } else {
        $showContent = 'true';
    }
	 if( $content_words_limit ) { 
        $words_limit = $content_words_limit; 
    } else {
        $words_limit = '20';
    }
	ob_start();
	
	$post_type 		= 'blog_post';
	$orderby 		= 'post_date';
	$order 			= 'DESC';
				 
		
        $args = array ( 
            'post_type'      => $post_type, 
            'orderby'        => $orderby, 
            'order'          => $order,
            'posts_per_page' => $posts_per_page,   
            'paged'          => $paged,
            ); 
            if($cat != ""){
                $args['tax_query'] = array( array( 'taxonomy' => 'blog-category', 'field' => 'id', 'terms' => $cat) );
            }      
        $query = new WP_Query($args);
      $post_count = $query->post_count;
          $count = 0;
             if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
             $count++;
               $terms = get_the_terms( $post->ID, 'blog-category' );
                    $news_links = array();
                    if($terms){

                    foreach ( $terms as $term ) {
                        $term_link = get_term_link( $term );
                        $news_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
                    }
                }
                    $cate_name = join( ", ", $news_links );
                $css_class="team";
                if ( ( is_numeric( $grid ) && ( $grid > 0 ) && ( 0 == ($count - 1) % $grid ) ) || 1 == $count ) { $css_class .= ' first'; }
                if ( ( is_numeric( $grid ) && ( $grid > 0 ) && ( 0 == $count % $grid ) ) || $post_count == $count ) { $css_class .= ' last'; }
                if($showDate == 'true'){ $date_class = "has-date";}else{$date_class = "has-no-date";}
                ?>
			
            	<div id="post-<?php the_ID(); ?>" class="blog type-blog <?php echo (has_post_thumbnail()) ? "has-thumb" : "no-thumb";?> blog-col-<?php echo $gridcol.' '.$css_class.' '.$date_class; ?>">
					
					<?php
						// Post thumbnail.
						if ( has_post_thumbnail())  {?>
                        <div class="blog-thumb">
                        <?php 
                            if($gridcol == '1'){?>
						 <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('url'); ?></a>
						<?php } else if($gridcol > '2') { ?>
							<div class="grid-blog-thumb">	
						 <a href="<?php the_permalink(); ?>">	<?php the_post_thumbnail('medium'); ?></a>
							</div>
					<?php } else if($gridcol == '0') { ?>
					<div class="grid-blog-thumb">							
						 <a href="<?php the_permalink(); ?>">	<?php the_post_thumbnail('medium'); ?></a>
							</div>
					<?php	} else { ?>
					<div class="grid-blog-thumb">	
							 <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('large'); ?></a>
							</div>
					<?php } ?>
                    </div>
                    <?php }?>
					
					<div class="blog-content">
					<?php if($gridcol == '1') { 
                        if($showDate == 'true'){?>
						<div class="date-post">					
						<h2><span><?php echo get_the_date('j'); ?></span></h2>
						<p><?php echo get_the_date('M y'); ?></p>
						</div>
                         <?php }?>
					<?php } else { ?>
						<div class="grid-date-post">
						<?php echo ($showDate == "true")? get_the_date('j, M y') : "" ;?>
                        <?php echo ($showDate == "true" && $showCategory == "true" && $cate_name != '') ? " , " : "";?>
                        <?php echo ($showCategory == 'true' && $cate_name != '') ? $cate_name : ""?>
						</div>
					<?php } ?>
					<div class="post-content-text">
						<?php the_title( sprintf( '<h4 class="blog-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );	?>
					    
						<?php if($showCategory == 'true' && $gridcol == '1'){ ?>
						<div class="blog-cat">
                            <?php echo $cate_name; ?>
							</div>
                       <?php }?>
                     <?php if($showContent == 'true'){?>   
					<div class="blog-content-excerpt">
					<?php $excerpt = get_the_excerpt();?>
                    <p class="blog-short-content"><?php echo blog_limit_words($excerpt,$words_limit); ?>...</p>
                   
                        <a href="<?php the_permalink(); ?>" class="more-link">Read More</a>	
					</div><!-- .entry-content -->
                    <?php }?>
					</div>
				</div>
</div><!-- #post-## -->			  
          <?php  endwhile;
            endif; ?>
			
			<?php
             wp_reset_query(); 
				
		return ob_get_clean();			             
	}
add_shortcode('recent_blog_post','get_wpbaw_homeblog');


function blog_limit_words($string, $word_limit)
{
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}	

function spblog_display_tags( $query ) {
    if( is_tag() && $query->is_main_query() ) {       
       $post_types = array( 'post', 'blog_post' );
        $query->set( 'post_type', $post_types );
    }
}
add_filter( 'pre_get_posts', 'spblog_display_tags' );	


// Manage Category Shortcode Columns

add_filter("manage_blog-category_custom_column", 'blog_category_columns', 10, 3);
add_filter("manage_edit-blog-category_columns", 'blog_category_manage_columns'); 
function blog_category_manage_columns($theme_columns) {
    $new_columns = array(
            'cb' => '<input type="checkbox" />',
            'name' => __('Name'),
            'blog_shortcode' => __( 'Blog Category Shortcode', 'blog' ),
            'slug' => __('Slug'),
            'posts' => __('Posts')
			);
    return $new_columns;
}

function blog_category_columns($out, $column_name, $theme_id) {
    $theme = get_term($theme_id, 'blog-category');
    switch ($column_name) {      

        case 'title':
            echo get_the_title();
        break;
        case 'blog_shortcode':        

             echo '[blog category="' . $theme_id. '"]';
			  echo '[recent_blog_post category="' . $theme_id. '"]';
        break;

        default:
            break;
    }
    return $out;   

}