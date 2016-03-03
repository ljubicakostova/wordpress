<?php
/*
	Template Name: Custom page template with slider
*/
?>
<?php get_header(); ?>

	<div class="hp-slider-wrap">
   		<?php cw_magazine_slider(); ?>
	</div>
    
	<div id="content" class="content-area" role="main">
		<?php
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post(); 
					the_content();
				} 
			} 
		?>
	</div><!-- .content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>