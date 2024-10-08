<footer class="sigur-footer">

	<div class="sigur-container">   

		<div class="sigur-footer__section">
			
				<div class="sigur-footer__links">
				<?php
				if ( has_nav_menu( 'footer-links' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'footer-links',
							'menu_id'        => 'footer-nav',
							'menu_class'     => 'sigur-footer__list',
							'container'      => false,
						)
					);	
				}
				?>
				</div>
			
				<div class="sigur-footer__social">
					<p class="visually-hidden"><?php esc_html_e( 'Connect', 'sigur' ); ?></p>
					<?php get_template_part( 'template-parts/_molecules/social-links' ); ?>
				</div>

		</div>

		<div class="sigur-footer__section sigur-footer__legal">
			<?php
			if ( has_nav_menu( 'legal' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'legal',
						'menu_id'        => 'legal-nav',
						'menu_class'     => 'sigur-footer__list sigur-footer__inline-list',
						'container'      => false,
					)
				);
			}
			?>
			<span class="sigur-footer__copyright">©  Sigur Rós, <?php echo date( 'Y' ); ?></span>
		</div>

	</div>

</footer>