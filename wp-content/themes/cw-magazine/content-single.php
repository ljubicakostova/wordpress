<?php
/**
 * @package cw-magazine
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title">
            <?php the_title(); ?>
        </h1>
		<div class="entry-meta post-entry-meta">
			<?php
				echo '<span class="posted-on">'.__('Posted on','cw-magazine');
				?>
					<a href="<?php echo get_month_link( get_the_time('Y'), get_the_time('m') ); ?>" title="<?php the_time( get_option( 'time_format' ) ); ?>" class="blog-box-date"><?php echo get_the_date().' '; the_time( get_option( 'time_format' ) ); ?></a>
				<?php
				echo '</span>';
				echo '<span class="byline"> '.__('by','cw-magazine'). ' </span><span class="author vcard"><a href="'.get_author_posts_url( get_the_author_meta( 'ID' )).'" >'.get_the_author().'</a></span>';
			?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->
	<div class="entry-content">
        <?php
			
			the_content();
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'cw-magazine' ),
				'after'  => '</div>',
			) );
		?>

	<footer class="entry-meta">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', 'cw-magazine' ) );
			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ', ', 'cw-magazine' ) );
			if ( ! cw_magazine_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'cw-magazine' );
				} else {
					$meta_text = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'cw-magazine' );
				}
			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'cw-magazine' );
				} else {
					$meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'cw-magazine' );
				}
			} // end check for categories on this blog
			printf(
				$category_list,
				$tag_list,
				the_title_attribute( 'echo=0' )
			);
		?>
		<p><?php the_tags(); ?></p>
	</footer><!-- .entry-meta -->

    </div><!-- .entry-content -->
</article><!-- #post-## -->