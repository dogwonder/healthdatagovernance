<?php
$site_description           = esc_attr( get_bloginfo( 'description', 'display' ) );
$sigur_meta['title']       = 'Sigur Rós - ' . $post->post_title ?? '';
$sigur_meta['description'] = strip_shortcodes( wp_trim_words( get_post_field( 'post_content', $post ), 20 ) );
$sigur_meta['description'] = rtrim( str_replace( '&hellip;', '', $sigur_meta['description'] ), '' );
if ( has_post_thumbnail() ) {
	$image                = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'sigur-social-image' );
    if ( $image && ! is_wp_error( $image ) ) {
	    $sigur_meta['image'] = $image[0];
    }
}
if ( ! is_single() || empty( $sigur_meta['image'] ) ) {
	$sigur_meta['image'] = get_template_directory_uri() . '/dist/images/og/og-image.png';
}
if ( ! is_single() && ! is_page() || empty( $sigur_meta['title'] ) ) {
	$sigur_meta['title'] = strip_shortcodes( esc_attr( get_bloginfo( 'name' ) ) );
}
if ( ! is_single() && ! is_page() || empty( $sigur_meta['description'] ) ) {
	$sigur_meta['description'] = strip_shortcodes( esc_attr( get_bloginfo( 'description' ) ) );
}
if ( is_search() || is_404() ) {
	$sigur_meta['url'] = esc_url( site_url() );
} else {
	$sigur_meta['url'] = esc_url( get_the_permalink( $post->ID ) );
}
?>
<meta name="description" content="<?php echo esc_attr( $sigur_meta['description'] ); ?>">
<meta property="og:title" content="<?php echo esc_attr( $sigur_meta['title'] ); ?>">
<meta property="og:description" content="<?php echo esc_attr( $sigur_meta['description'] ); ?>">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image" content="<?php echo $sigur_meta['image']; ?>">
<meta property="og:url" content="<?php echo $sigur_meta['url']; ?>">