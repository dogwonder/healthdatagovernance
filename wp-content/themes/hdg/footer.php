<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package hdg
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
<?php /* ?>
<div class="gradient-bg" data-gradient>
      <svg xmlns="http://www.w3.org/2000/svg">
        <defs>
          <filter id="goo">
            <feGaussianBlur in="SourceGraphic" stdDeviation="20" result="blur" />
            <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -8" result="goo" />
            <feBlend in="SourceGraphic" in2="goo" />
            <feMerge>
                <feMergeNode in="goo" />
                <feMergeNode in="SourceGraphic" />
            </feMerge>
          </filter>
        </defs>
      </svg>
      <div class="gradients-container">
        <div class="g1"></div>
        <div class="g2"></div>
        <div class="g3"></div>
        <div class="g4"></div>
        <div class="g5"></div>
        <div class="interactive"></div>
      </div>
</div>
<?php */ ?>
</body>
</html>