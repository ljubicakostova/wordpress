<?php
/**
 * The Template for displaying all single posts.
 *
 * @package cw-magazine
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>
			<div class="navigation">			
				<div class="alignleft">				
					<?php previous_post_link('%link', '&lsaquo; Previous post', TRUE); ?> 			
				</div><!-- .alignleft -->			
				<div class="alignright">				
					<?php next_post_link('%link', 'Next post &rsaquo;', TRUE); ?>  			
				</div><!-- .alignright -->		
			</div> <!-- end navigation --> 

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() )
					comments_template();
			?>

		<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>