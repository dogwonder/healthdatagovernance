<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package sigur
 */

?>
	</main><!-- #content -->
	<?php include(locate_template( 'template-parts/_layout/colophon.php')); ?><!-- #colophon -->
</div><!-- #page -->
<?php include(locate_template( 'template-parts/_molecules/sprite.php' )); ?>
<?php wp_footer(); ?>
<script type="module" src="<?php echo get_template_directory_uri(); ?>/dist/js/app.min.js"></script>
<script type="module">
  if (!window._govukFrontendInitialized) {
    import('<?php echo get_template_directory_uri(); ?>/dist/js/govuk-frontend-5.6.0.min.js')
      .then(({ initAll }) => {
        initAll();
        window._govukFrontendInitialized = true;
      })
      .catch(error => {
        console.error('Error loading govuk-frontend:', error);
      });
  }
</script>
<script>
  if ('serviceWorker' in navigator) {
	window.addEventListener('load', function() {
	  navigator.serviceWorker.register('/sw.js').then(function(registration) {
		// Successfully registered the Service Worker
		console.log('Service Worker registration successful with scope: ', registration.scope);
	  }).catch(function(err) {
		// Failed to register the Service Worker
		console.log('Service Worker registration failed: ', err);
	  });
	});
  }
</script>
</body>
</html>