<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package cw-magazine
 */
get_header(); ?>

	<?php if(get_theme_mod('cwp_slide_img1')) { ?>
	<div class="hp-slider-wrap">
   		<?php cw_magazine_slider(); ?>
	</div>
	<?php } ?>
	<div id="content" class="content-area" role="main">

		<?php while ( have_posts() ) : the_post(); 
		
			/* Include the Post-Format-specific template for the content.
			 * If you want to overload this in a child theme then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 */
			get_template_part( 'content', get_post_format() );
			
			endwhile; ?>
			

			        <div class="navigation">

						<?php
							$big = 999999999; // need an unlikely integer
							echo paginate_links( array(
								'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
								'format' => '?paged=%#%',
								'current' => max( 1, get_query_var('paged') ),
								'total' => $wp_query->max_num_pages
							) );

						?>
					</div> <!-- end navigation -->

	</div><!-- .content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>


