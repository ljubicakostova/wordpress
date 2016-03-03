<?php
/**
 * cw-magazine functions and definitions
 *
 * @package cw-magazine
 */

wp_enqueue_script("jquery");


function cw_magazine_setup() {
    global $content_width;
    /**
     * Set the content width based on the theme's design and stylesheet.
     */

    if ( ! isset( $content_width ) )
        $content_width = 640; /* pixels */
	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on cw-magazine, use a find and replace
	 * to change 'cw-magazine' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'cw-magazine', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * Setup the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( 'cw_magazine_custom_background_args', array(
		'default-color' => 'fcfcfc',
		'default-image' => '',
	) ) );


    /* Post Thumbnails */
    add_theme_support( 'post-thumbnails' );

    /**
     * Implement the Custom Header feature.
     */
    require get_template_directory() . '/inc/custom-header.php';

    /**
     * Custom template tags for this theme.
     */
    require get_template_directory() . '/inc/template-tags.php';

    /**
     * Custom functions that act independently of the theme templates.
     */
    require get_template_directory() . '/inc/extras.php';

    /**
     * Customizer additions.
     */
    require get_template_directory() . '/inc/customizer.php';

    /**
     * Load Jetpack compatibility file.
     */
    require get_template_directory() . '/inc/jetpack.php';

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'main-menu-header' => __( 'Main Menu', 'cw-magazine' ),
		'top-menu-header' => __( 'Top Menu', 'cw-magazine' )
	) );

	add_editor_style( 'editor-style.css' );

}
add_action( 'after_setup_theme', 'cw_magazine_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function cw_magazine_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'cw-magazine' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title"><span>',
		'after_title'   => '</span></h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Ad Banner header', 'cw-magazine' ),
		'id'            => 'ad-banner',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer1', 'cw-magazine' ),
		'id'            => 'footer1',
		'before_widget' => '<div class="widget-footer footer1">',
		'after_widget'  => '</div><!-- .widget-footer --> ',
		'before_title'  => '<div class="footer-title">',
		'after_title'   => '</div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer2', 'cw-magazine' ),
		'id'            => 'footer2',
		'before_widget' => '<div class="widget-footer footer2">',
		'after_widget'  => '</div><!-- .widget-footer --> ',
		'before_title'  => '<div class="footer-title">',
		'after_title'   => '</div>'
	) );
	register_sidebar( array(
		'name'          => __( 'Footer3', 'cw-magazine' ),
		'id'            => 'footer3',
		'before_widget' => '<div class="widget-footer footer3">',
		'after_widget'  => '</div><!-- .widget-footer --> ',
		'before_title'  => '<div class="footer-title">',
		'after_title'   => '</div>'
	) );
	register_sidebar( array(
		'name'          => __( 'Footer4', 'cw-magazine' ),
		'id'            => 'footer4',
		'before_widget' => '<div class="widget-footer footer4">',
		'after_widget'  => '</div><!-- .widget-footer --> ',
		'before_title'  => '<div class="footer-title">',
		'after_title'   => '</div>'
	) );
}
add_action( 'widgets_init', 'cw_magazine_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function cw_magazine_scripts() {

	wp_enqueue_style( 'cw-magazine-style', get_stylesheet_uri() );

    wp_enqueue_style( 'cw-magazine-style-responsiveslides', get_template_directory_uri() . '/css/responsiveslides.css');


    wp_enqueue_script( 'cw-magazine-responsiveslides', get_template_directory_uri() . '/js/responsiveslides.min.js', array('jquery'), '', true );

    wp_enqueue_script( 'cw-magazine-tinynav', get_template_directory_uri() . '/js/tinynav.min.js', array('jquery'), '', true );

    wp_enqueue_script( 'cw-magazine-functions', get_template_directory_uri() . '/js/functions.js', array('jquery'), '20130806', true );

	wp_enqueue_script( 'cw-magazine-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20120206', true );

	wp_enqueue_script( 'cw-magazine-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array('jquery'), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'cw-magazine-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'cw_magazine_scripts' );

require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'cwp_megar_required_plugins' );
function cwp_megar_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin from the WordPress Plugin Repository
		array(
			'name' 		=> 'WP Product Review',
			'slug' 		=> 'wp-product-review',
			'required' 	=> false,
		),
	

	);

	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'cw-magazine';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> 'cw-magazine',         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', $theme_text_domain ),
			'menu_title'                       			=> __( 'Install Plugins', $theme_text_domain ),
			'installing'                       			=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', $theme_text_domain ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );

}
	
/* comments list */
function cw_magazine_comment($comment, $args, $depth) {

	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>">
			<div class="comment-author vcard">
            	<div class="avarat_comment">
					<?php echo get_avatar($comment,$size='48'); ?>
				</div>
                <div class="commentmeta_wrap">
				<?php printf(__('<p class="fn">%s</p> <span class="says">on</span>'), get_comment_author_link()) ?>
                <p class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s','cw-magazine'), get_comment_date(),  get_comment_time()) ?></a><span class="says"> <?php _e('says:','cw-magazine'); ?></span><?php edit_comment_link(__('(Edit)','cw-magazine'),'  ','') ?></p>
      			</div>
            </div>
      		<?php if ($comment->comment_approved == '0') : ?>
        		<em><?php _e('Your comment is awaiting moderation.','cw-magazine') ?></em>
         		<br />
      		<?php endif; ?>
			<div class="clear"></div>

      		<?php
			if (get_comment_type() == "comment") :
				comment_text();
			endif;
			?>

      		<div class="reply">
         	<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      		</div>
     	</div>
<?php
}


/* get slide */
function cw_magazine_slider(){

	/* link */

	if(get_theme_mod('cwp_slide_link1')):
		$cwp_slide_link1 = get_theme_mod('cwp_slide_link1');
	else:
		$cwp_slide_link1 = '#';
	endif;
	if(get_theme_mod('cwp_slide_link2')):
		$cwp_slide_link2 = get_theme_mod('cwp_slide_link2');
	else:
		$cwp_slide_link2 = '#';
	endif;
	if(get_theme_mod('cwp_slide_link3')):
		$cwp_slide_link3 = get_theme_mod('cwp_slide_link3');
	else:
		$cwp_slide_link3 = '#';
	endif;
	if(get_theme_mod('cwp_slide_link4')):
		$cwp_slide_link4 = get_theme_mod('cwp_slide_link4');
	else:
		$cwp_slide_link4 = '#';
	endif;

	/* title */

	if(get_theme_mod('cwp_slide_caption_title1')):
		$cwp_slide_caption_title1 = get_theme_mod('cwp_slide_caption_title1');
	else:
		$cwp_slide_caption_title1 = '';
	endif;
	if(get_theme_mod('cwp_slide_caption_title2')):
		$cwp_slide_caption_title2 = get_theme_mod('cwp_slide_caption_title2');
	else:
		$cwp_slide_caption_title2 = '';
	endif;
	if(get_theme_mod('cwp_slide_caption_title3')):
		$cwp_slide_caption_title3 = get_theme_mod('cwp_slide_caption_title3');
	else:
		$cwp_slide_caption_title3 = '';
	endif;
	if(get_theme_mod('cwp_slide_caption_title4')):
		$cwp_slide_caption_title4 = get_theme_mod('cwp_slide_caption_title4');
	else:
		$cwp_slide_caption_title4 = '';
	endif;

	/* text */
	if(get_theme_mod('cwp_slide_caption_text1')):
		$cwp_slide_caption_text1 = get_theme_mod('cwp_slide_caption_text1');
	else:
		$cwp_slide_caption_text1 = '';
	endif;
	if(get_theme_mod('cwp_slide_caption_text2')):
		$cwp_slide_caption_text2 = get_theme_mod('cwp_slide_caption_text2');
	else:
		$cwp_slide_caption_text2 = '';
	endif;
	if(get_theme_mod('cwp_slide_caption_text3')):
		$cwp_slide_caption_text3 = get_theme_mod('cwp_slide_caption_text3');
	else:
		$cwp_slide_caption_text3 = '';
	endif;
	if(get_theme_mod('cwp_slide_caption_text4')):
		$cwp_slide_caption_text4 = get_theme_mod('cwp_slide_caption_text4');
	else:
		$cwp_slide_caption_text4 = '';
	endif;

	echo '<div class="callbacks_container">';
		echo '<ul class="rslides" id="slider4">';

			if(get_theme_mod('cwp_slide_img1')):
				echo '<li>';
					echo '<a href="'.$cwp_slide_link1.'" title="'.$cwp_slide_caption_title1.'" >';
						echo '<img src="'.get_theme_mod('cwp_slide_img1').'" alt="'.$cwp_slide_caption_title1.'" />';

						if(($cwp_slide_caption_text1 != '') && ($cwp_slide_caption_title1 != '')):
							echo '<p class="caption">';
								echo '<span class="title-c">'.$cwp_slide_caption_title1.'</span>';
								echo '<span class="content-c">'.$cwp_slide_caption_text1.'</span>';
								echo '<br>';
								echo '<span class="btn-slider">'.__('Read more','cw-magazine').'</span>';
							echo '</p>';
						endif;
					echo '</a>';
				echo '</li>';
			endif;

			if(get_theme_mod('cwp_slide_img2')):
				echo '<li>';
					echo '<a href="'.$cwp_slide_link2.'" title="'.$cwp_slide_caption_title2.'" >';
						echo '<img src="'.get_theme_mod('cwp_slide_img2').'" alt="'.$cwp_slide_caption_title2.'" />';

						if(($cwp_slide_caption_text2 != '') && ($cwp_slide_caption_title2 != '')):
							echo '<p class="caption">';
								echo '<span class="title-c">'.$cwp_slide_caption_title2.'</span>';
								echo '<span class="content-c">'.$cwp_slide_caption_text2.'</span>';
								echo '<br>';
								echo '<span class="btn-slider">'.__('Read more','cw-magazine').'</span>';
							echo '</p>';
						endif;
					echo '</a>';
				echo '</li>';
			endif;

			if(get_theme_mod('cwp_slide_img3')):
				echo '<li>';
					echo '<a href="'.$cwp_slide_link3.'" title="'.$cwp_slide_caption_title3.'" >';
						echo '<img src="'.get_theme_mod('cwp_slide_img3').'" alt="'.$cwp_slide_caption_title3.'" />';

						if(($cwp_slide_caption_text3 != '') && ($cwp_slide_caption_title3 != '')):
							echo '<p class="caption">';
								echo '<span class="title-c">'.$cwp_slide_caption_title3.'</span>';
								echo '<span class="content-c">'.$cwp_slide_caption_text3.'</span>';
								echo '<br>';
								echo '<span class="btn-slider">'.__('Read more','cw-magazine').'</span>';
							echo '</p>';
						endif;
					echo '</a>';
				echo '</li>';
			endif;

			if(get_theme_mod('cwp_slide_img4')):
				echo '<li>';
					echo '<a href="'.$cwp_slide_link4.'" title="'.$cwp_slide_caption_title4.'" >';
						echo '<img src="'.get_theme_mod('cwp_slide_img4').'" alt="'.$cwp_slide_caption_title4.'" />';

						if(($cwp_slide_caption_text4 != '') && ($cwp_slide_caption_title4 != '')):
							echo '<p class="caption">';
								echo '<span class="title-c">'.$cwp_slide_caption_title4.'</span>';
								echo '<span class="content-c">'.$cwp_slide_caption_text4.'</span>';
								echo '<br>';
								echo '<span class="btn-slider">'.__('Read more','cw-magazine').'</span>';
							echo '</p>';
						endif;
					echo '</a>';
				echo '</li>';
			endif;

		echo '</ul>';
	echo '</div>';

}

function cw_magazine_show_posts($name_categ, $id_cat){

	if($name_categ):
        echo '<div class="half-page front-page-boxes customfp">';
			echo '<ul>';
				echo '<li class="title-categ"><span>'.$name_categ.'</span></li>';

				$args = array('showposts' => 5, 'cat' => $id_cat);
				$cw_query = new WP_Query( $args );

				if ( $cw_query->have_posts() ):
					while ( $cw_query->have_posts() ):
						$cw_query->the_post();

						echo '<li>';
							echo '<a href="'.get_permalink().'" title="'.get_the_title().'">';
								the_post_thumbnail(array(75,75), array('class' => 'alignleft'));
							echo '</a>';
							echo '<a href="'.get_permalink().'" title="'.get_the_title().'">';
								the_title();
							echo '</a>';
							echo '<p class=""> - '.the_time( get_option( 'time_format' ) ).' '.comments_number().'</p>';
						echo '</li>';

					endwhile;
				endif;
				/* Restore original Post Data */
				wp_reset_postdata();
			echo '</ul>';
        echo '</div>';
	else:
		$categories = get_categories();

		if(isset($categories) && !empty($categories)):
			echo '<div class="half-page front-page-boxes">';
				echo '<ul>';
					echo '<li class="title-categ"><span>'.$categories[0]->name.'</span></li>';

					$args = array('showposts' => 5, 'cat' => $categories[0]->cat_ID);
					$cw_query = new WP_Query( $args );

					if ( $cw_query->have_posts() ):
						while ( $cw_query->have_posts() ):
							$cw_query->the_post();

							echo '<li>';
								echo '<a href="'.get_permalink().'" title="'.get_the_title().'">';
									the_post_thumbnail(array(75,75), array('class' => 'alignleft'));
								echo '</a>';
								echo '<a href="'.get_permalink().'" title="'.get_the_title().'">';
									the_title();
								echo '</a>';
								echo '<p class=""> - '.the_time( get_option( 'time_format' ) ).' '.comments_number().'</p>';
							echo '</li>';

						endwhile;
					endif;
					/* Restore original Post Data */
					wp_reset_postdata();
				echo '</ul>';
			echo '</div>';
		endif;
	endif;

}

add_filter( 'the_title', 'cwp_no_title');
function cwp_no_title ($title) {
    if( $title == "" ){
        $title = "(No title)";
    }
    return $title;
}

/**************************/
/** custom color **********/
/**************************/

add_action('wp_print_scripts','cw_magazine_php_style');

function cw_magazine_php_style() {

	echo ' <style type="text/css">';
	
	$color_scheme = get_theme_mod('color_scheme','cw_magazine');
	
	if( !empty($color_scheme) ):
		
		if( $color_scheme == 'red_style' ):
			
			$header_color_1 = '#dd3333';
			$header_color_2 = '#6c1a1a';
			$header_color_3 = '#ddc3c3';
			$header_color_4 = '#ffffff';
			$header_color_5 = '#282828';
			$header_color_6 = '#ddcccc';
			$header_color_7 = '#ffffff';
			$header_color_8 = '#ddcccc';
			$header_color_9 = '#dd3333';
			$header_color_11 = '#ffffff';
			$header_color_12 = '#ddafaf';
			$footer_color_1 = '#6c1a1a';
			$footer_color_2 = '#ffffff';
			$footer_color_3 = '#dda1a1';
			$footer_color_4 = '#ffdddd';
			$footer_color_5 = '#ffffff';
			$site_color_1 = '#6c1a1a';
			$site_color_2 = '#ffffff';
			$site_color_3 = '#dd3333';
			$site_color_4 = '#6c1a1a';
			$site_color_5 = '#dd3333';	
			$site_color_6 = '#f2eee7';
			$site_bg_1 = get_template_directory_uri().'/images/bg-site_red.jpg';
		
		elseif( $color_scheme == 'fashion_style' ):
		
			$header_color_1 = '#e62750';
			$header_color_2 = '#ffbdcb';
			$header_color_3 = '#961934';
			$header_color_4 = '#e62750';
			$header_color_5 = '#ffbdcb';
			$header_color_6 = '#961934';
			$header_color_7 = '#e62750';
			$header_color_8 = '#961934';
			$header_color_9 = '#e62750';
			$header_color_11 = '#ffffff';
			$header_color_12 = '#e5a0ae';
			$footer_color_1 = '#e62750';
			$footer_color_2 = '#ffffff';
			$footer_color_3 = '#e5c7cd';
			$footer_color_4 = '#fff2f2';
			$footer_color_5 = '#ffffff';
			$site_color_1 = '#e62750';
			$site_color_2 = '#ffffff';
			$site_color_3 = '#e62750';
			$site_color_4 = '#f2dfe5';
			$site_color_5 = '#dd3333';
			$site_color_6 = '#e5d3d7';
			$site_bg_1 = get_template_directory_uri().'/images/bg-site_pink.jpg';

		elseif( $color_scheme == 'sports_blog' ):	

			$header_color_1 = '#32a546';
			$header_color_2 = '#282828';
			$header_color_3 = '#ceeacf';
			$header_color_4 = '#ffffff';
			$header_color_5 = '#282828';
			$header_color_6 = '#32a546';
			$header_color_7 = '#ffffff';
			$header_color_8 = '#32a546';
			$header_color_9 = '#ffffff';
			$header_color_11 = '#ffffff';
			$header_color_12 = '#ceeacf';
			$footer_color_1 = '#282828';
			$footer_color_2 = '#32a546';
			$footer_color_3 = '#ceeacf';
			$footer_color_4 = '#32a546';
			$footer_color_5 = '#ffffff';
			$site_color_1 = '#32a546';
			$site_color_2 = '#ffffff';
			$site_color_3 = '#32a546';
			$site_color_4 = '#32a546';
			$site_color_5 = '#dd3333';
			$site_color_6 = '#F9F9F9';
			$site_bg_1 = get_template_directory_uri().'/images/bg-site_green.jpg';		
		
		endif;
			
	endif;
	
	if( !isset($color_scheme) || (isset($color_scheme) && ($color_scheme == 'none')) ):
	
		if( get_theme_mod('footer_color_1') ):
			$footer_color_1 = get_theme_mod('footer_color_1');
		endif;

		if( get_theme_mod('site_color_3') ):
			$site_color_3 = get_theme_mod('site_color_3');
		endif;
		
		if(get_theme_mod('site_color_2')):
			$site_color_2 = get_theme_mod('site_color_2');
		endif;
		
		if(get_theme_mod('site_color_1')):
			$site_color_1 = get_theme_mod('site_color_1');
		endif;
		
		if(get_theme_mod('site_color_4')):
			$site_color_4 = get_theme_mod('site_color_4');
		endif;
		
		if(get_theme_mod('site_color_5')):
			$site_color_5 = get_theme_mod('site_color_5');
		endif;
		
		if(get_theme_mod('site_color_6')):
			$site_color_6 = get_theme_mod('site_color_6');
		endif;
		
		if(get_theme_mod('site_bg_1')):
			$site_bg_1 = get_theme_mod('site_bg_1');
		endif;
		
		if(get_theme_mod('header_color_1')):
			$header_color_1 = get_theme_mod('header_color_1');
		endif;
		
		if(get_theme_mod('header_color_11')):
			$header_color_11 = get_theme_mod('header_color_11');
		endif;
		
		if(get_theme_mod('header_color_12')):
			$header_color_12 = get_theme_mod('header_color_12');
		endif;
		
		if(get_theme_mod('header_color_2')):
			$header_color_2 = get_theme_mod('header_color_2');
		endif;
		
		if(get_theme_mod('header_color_3')):
			$header_color_3 = get_theme_mod('header_color_3');
		endif;
		
		if(get_theme_mod('header_color_4')):
			$header_color_4 = get_theme_mod('header_color_4');
		endif;
		
		if(get_theme_mod('header_color_5')):
			$header_color_5 = get_theme_mod('header_color_5');
		endif;
		
		if(get_theme_mod('header_color_6')):
			$header_color_6 = get_theme_mod('header_color_6');
		endif;
		
		if(get_theme_mod('header_color_7')):
			$header_color_7 = get_theme_mod('header_color_7');
		endif;
		
		if(get_theme_mod('header_color_8')):
			$header_color_8 = get_theme_mod('header_color_8');
		endif;
		
		if(get_theme_mod('header_color_9')):
			$header_color_9 = get_theme_mod('header_color_9');
		endif;
		
		if(get_theme_mod('footer_color_1')):
			$footer_color_1 = get_theme_mod('footer_color_1');
		endif;
		
		if(get_theme_mod('footer_color_2')):
			$footer_color_2 = get_theme_mod('footer_color_2');
		endif;
		
		if(get_theme_mod('footer_color_3')):
			$footer_color_3 = get_theme_mod('footer_color_3');
		endif;
		
		if(get_theme_mod('footer_color_4')):
			$footer_color_4 = get_theme_mod('footer_color_4');
		endif;
		
		if(get_theme_mod('footer_color_5')):
			$footer_color_5 = get_theme_mod('footer_color_5');
		endif;
		
	endif;
	
	/* header_color_1 */
	if( !empty($header_color_1) ):
		echo '.header-middle-wrap{ background-color: '.$header_color_1.'; }';
		echo '.callbacks_here a { background-color: '.$header_color_1.'; border: 3px solid '.$header_color_1.'; }';
		echo '.btn-slider { background: '.$header_color_1.'; }';
		echo '.callbacks_tabs li a:hover{ background-color: '.$header_color_1.'; }';
		echo 'input[type="submit"] { background-color: '.$header_color_1.'; }';
		echo '.read-more-btn{ background: '.$header_color_1.'; }';
	endif;	
	
	/* header_color_2 */
	if( !empty($header_color_2) ):
		echo '.main-menu, .main-menu .main-navigation ul ul{ background-color: '.$header_color_2.'; }';
		echo 'article .entry-content{ border-top-color: '.$header_color_2.'; }';
		echo '.pagination .current, .pagination a:hover{ background-color: '.$header_color_2.'; }';
		echo 'input[type="submit"]:hover { background-color: '.$header_color_2.'; }';
		echo '.widget ul li { color: #6c1a1a; } h1.entry-title a{ color: '.$header_color_2.'; }';
	endif;	
			
	/* header_color_3 */
	if( !empty($header_color_3) ):
		echo '.main-menu .main-navigation a{ color: '.$header_color_3.'; }';
	endif;		
			
	/* header_color_4 */
	if( !empty($header_color_4) ):
		echo '.main-menu .main-navigation li:hover > a, .main-menu .main-navigation ul ul a:hover{ color: '.$header_color_4.'; }';
	endif;	
			
	/* header_color_5 */
	if( !empty($header_color_5) ):
		echo '.header-top{ background: '.$header_color_5.'; }';
		echo '.header-top .main-navigation ul ul{ background-color: '.$header_color_5.'; }';
	endif;	
			
	/* header_color_6 */
	if( !empty($header_color_6) ):
		echo '.header-top .main-navigation a, .header-top .main-navigation .current_page_item a{ color: '.$header_color_6.'; }';
	endif;	
			
	/* header_color_7 */
	if( !empty($header_color_7) ):
		echo '.header-top .main-navigation ul ul a:hover, .header-top .main-navigation li:hover > a{ color: '.$header_color_7.'; }';
	endif;	
			
	/* header_color_8 */
	if( !empty($header_color_8) ):
		echo '.social-icons-header a span{ color: '.$header_color_8.'; }';
	endif;	
			
	/* header_color_9 */
	if( !empty($header_color_9) ):
		echo '.social-icons-header a span:hover{ color:'.$header_color_9.'; }';
	endif;	
			
	/* header_color_11 */
	if( !empty($header_color_11) ):
		echo '.logo a, .logo a:hover{ color: '.$header_color_11.'; }';
	endif;	
			
	/* header_color_12 */
	if( !empty($header_color_12) ):
		echo '.logo a span{ color: '.$header_color_12.'; }';
	endif;	
			
	/* footer_color_1 */
	if( !empty($footer_color_1) ):
		echo '.site-footer { background-color: '.$footer_color_1.'; }';
	endif;	
			
	/* footer_color_2 */
	if( !empty($footer_color_2) ):
		echo '.footer-title{ color: '.$footer_color_2.'; }';
		echo '.widget-footer ul li:before{ color: '.$footer_color_2.'; }';
	endif;	
			
	/* footer_color_3 */
	if( !empty($footer_color_3) ):
		echo '.widget-footer, .widget-footer li, .widget-footer ul li a, .copyright{ color: '.$footer_color_3.'; }';
	endif;	
			
	/* footer_color_4 */
	if( !empty($footer_color_4) ):
		echo '.site-footer .textwidget a, .copyright a, .copyright strong{ color: '.$footer_color_4.'; }';
	endif;	
			
	/* footer_color_5 */
	if( !empty($footer_color_5) ):
		echo '.widget-footer ul li a:hover, .site-footer .textwidget a:hover, .copyright a:hover{ color: '.$footer_color_5.'; }';
	endif;	
			
	/* site_color_1 */
	if( !empty($site_color_1) ):
		echo '.title-categ span, .widget-title span, .readmore{ background-color: '.$site_color_1.'; }';
		echo '.front-page-boxes ul li.title-categ, .widget-title{ border-color: '.$site_color_1.'; }';
		echo '.hp-slider-wrap { border-top-color: '.$site_color_1.'; }';
	endif;	
			
	/* site_color_2 */
	if( !empty($site_color_2) ):
		echo '.title-categ span, .title-categ span a, .title-categ span, .widget-title span, .readmore{ color: '.$site_color_2.' !important; }';
	endif;	
			
	/* site_color_3 */
	if( !empty($site_color_3) ):
		echo 'h1.entry-title, h1.page-title{ color: '.$site_color_3.'; }';
	endif;	
			
	/* site_color_4 */
	if( !empty($site_color_4) ):
		echo 'a { color: '.$site_color_4.'; }';
	endif;	
			
	/* site_color_5 */
	if( !empty($site_color_5) ):
		echo '.widget ul li a:hover, .entry-meta a:hover, .front-page-boxes ul li a:hover, a:hover { color: '.$site_color_5.'; }';
	endif;	
			
	/* site_color_6 */
	if( !empty($site_color_6) ):
		echo '.wrapper{ background-color: '.$site_color_6.'; }';
	endif;	
			
	/* site_bg_1 */
	if( !empty($site_bg_1) ):
		echo '.wrapper{ background-image: url('.$site_bg_1.'); }';
	endif;
	
	$select_template = get_theme_mod('select_template','sidebar_right');
	
	if( !empty($select_template) ):
		
		if( ($select_template == 'sidebar_right') || ($select_template == 'sidebar_left') ):
		
			$sidebar_width =  '34%';
			$content_width =  '63%'; 
		
			if( $select_template == 'sidebar_right' ):
				$sidebar_align =  'right';
				$content_align =  'left';
			elseif( $select_template == 'sidebar_left' ):
				$sidebar_align =  'left';
				$content_align =  'right';
			endif;
			
			echo '.template-page .content-area{ float: '.$content_align.'; width: '.$content_width.'; }';
			echo '.template-page .sidebar{ float: '.$sidebar_align.'; width: '.$sidebar_width.'; }';
			
		else:
			$content_align = 'left';
			$content_width = '98%';
			
			echo '.template-page .content-area{ float: '.$content_align.'; width: '.$content_width.'; }';
			echo '.template-page .sidebar{ display: none !important; }';
			
		endif;
		
	endif;
	
	
	echo '</style>';
}
