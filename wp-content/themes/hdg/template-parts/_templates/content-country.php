<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hdg
 */
$report = get_field('report') ?? '';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'hdg-post stack' ); ?> itemscope itemtype="http://schema.org/BlogPosting">

	<div class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="wp-block-post-title" itemprop="headline">', '</h1>' );
		else :
			the_title( '<h2 class="wp-block-post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif; ?>

	</div><!-- .entry-header -->
    <div class="entry-content">
        <div class="stack">
            <p>
                <?php
                echo 'Source:  ';
                $tags_list = get_the_tags();
                if ($tags_list) {
                    foreach($tags_list as $tag) {
                    echo $tag->name . ' '; 
                    }
                }
                ?>
            </p>
            <?php the_content(); ?>	
            <p><a class="hdg-button" href="<?php echo $report; ?>" target="_blank">Download the full report</a></p>
        </div>
    </div>


	
</article><!-- #post-<?php the_ID(); ?> -->
