<?php
$site_description           = esc_attr( get_bloginfo( 'description', 'display' ) );
$hdg_meta['title']       = 'Health Data Governance - ' . $post->post_title ?? '';
$hdg_meta['description'] = strip_shortcodes( wp_trim_words( get_post_field( 'post_content', $post ), 20 ) );
$hdg_meta['description'] = rtrim( str_replace( '&hellip;', '', $hdg_meta['description'] ), '' );
if ( has_post_thumbnail() ) {
	$image                = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'hdg-social-image' );
    if ( $image && ! is_wp_error( $image ) ) {
	    $hdg_meta['image'] = $image[0];
    }
}
if ( ! is_single() || empty( $hdg_meta['image'] ) ) {
	$hdg_meta['image'] = get_template_directory_uri() . '/dist/images/og/og-image.png';
}
if ( ! is_single() && ! is_page() || empty( $hdg_meta['title'] ) ) {
	$hdg_meta['title'] = strip_shortcodes( esc_attr( get_bloginfo( 'name' ) ) );
}
if ( ! is_single() && ! is_page() || empty( $hdg_meta['description'] ) ) {
	$hdg_meta['description'] = strip_shortcodes( esc_attr( get_bloginfo( 'description' ) ) );
}
if ( is_search() || is_404() ) {
	$hdg_meta['url'] = esc_url( site_url() );
} else {
	$hdg_meta['url'] = esc_url( get_the_permalink( $post->ID ) );
}
?>
<meta name="description" content="<?php echo esc_attr( $hdg_meta['description'] ); ?>">
<meta property="og:title" content="<?php echo esc_attr( $hdg_meta['title'] ); ?>">
<meta property="og:description" content="<?php echo esc_attr( $hdg_meta['description'] ); ?>">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image" content="<?php echo $hdg_meta['image']; ?>">
<meta property="og:url" content="<?php echo $hdg_meta['url']; ?>">