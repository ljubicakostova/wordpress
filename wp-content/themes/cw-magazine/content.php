<?php
/**
 * @package cw-magazine
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
        <h1 class="entry-title">
            <a href="<?php the_permalink(); ?>" rel="bookmark">
            <?php the_title(); ?>
            </a>
        </h1>
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
        <div class="entry-content-right">
    		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">

                   <?php
                       if  ( has_post_thumbnail() ) {
                            the_post_thumbnail( array(140,140), array('class' => 'alignright'));
                        } else {
					?>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/no-featured-image.png" width="140" height="140" class="alignleft wp-post-image" alt="<?php the_title(); ?>" />
					<?php
                        }
                	?>
           	</a>
        	<a href="<?php the_permalink(); ?>" class="read-more-btn"><?php _e('Read more','cw-magazine'); ?></a>
        </div>
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark">
            <?php the_title(); ?>
        </a></h1>
		<?php the_excerpt(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'cw-magazine' ),
				'after'  => '</div>',
			) );
		?>
		<?php if ( 'post' == get_post_type() ) : ?>
				<div class="entry-meta">
                    <span class="author-link"><?php the_author_posts_link() ?></span>
                    <a href="<?php echo get_permalink(get_the_ID()); ?> " class="comments-number"><?php comments_number() ?></a>
                    <span class="post-time"><?php echo get_the_date().' '; the_time( get_option( 'time_format' ) ); ?></span>
			</div><!-- .entry-meta -->
		<?php endif; ?>

	</div><!-- .entry-content -->
	<?php endif; ?>
</article><!-- #post-## -->
