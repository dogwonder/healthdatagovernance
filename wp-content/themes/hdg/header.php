<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package sigur
 */
//Get version value from package.json
$versionData = wp_remote_get(get_template_directory_uri() . '/dist/version.json');
if (is_wp_error($versionData)) {
    $pkgVersion = '0.0.1';
} else {
    $versionContents = wp_remote_retrieve_body($versionData);
    $package = json_decode($versionContents, true);
    $pkgVersion = $package['version'] ?? '0.0.1';
}
?>
<!doctype html>
<html <?php language_attributes(); ?> >
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title><?php bloginfo( 'name' ); ?> &ndash; <?php is_front_page() ? bloginfo( 'description' ) : wp_title( '' ); ?></title>
<link rel="preconnect" href="<?php echo esc_url( site_url() ); ?>" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<link rel="profile" href="https://gmpg.org/xfn/11">
<script src="https://kit.fontawesome.com/39456e45bb.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/dist/css/main.css<?php echo wp_get_environment_type() !== "development"
    ? '?v=' . $pkgVersion
    : ""; ?>">
<?php wp_head(); ?>
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/dist/images/favicon.png" type="image/x-icon">
<meta name="apple-mobile-web-app-title" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
<meta name="mobile-web-app-capable" content="yes">
<meta name="theme-color" content="#3C3C3C">
<meta name="view-transition" content="same-origin" />
<link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/dist/images/fav/manifest.json">
<?php include(locate_template( 'template-parts/_organisms/meta-tags.php' )) ; ?>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-DYBBPRR3KE"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-DYBBPRR3KE');
</script>
</head>
<body <?php body_class( 'no-js govuk-frontend-supported' ); ?>>
<script>document.body.className = document.body.className.replace('no-js', 'js-enabled');</script>
<div id="page" class="hdg-wrapper">
	<?php include(locate_template( 'template-parts/_layout/masthead.php' )) ; ?>
	<main id="content" class="hdg-body">