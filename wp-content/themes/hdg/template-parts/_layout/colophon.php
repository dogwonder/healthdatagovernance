<footer class="hdg-footer">

	<div class="hdg-footer__inner">   

		<div class="hdg-footer__section">

				<div class="hdg-footer__about">
					<img class="logo" src="<?php echo get_template_directory_uri(); ?>/dist/images/logo.svg" alt="Health Data Governance logo" class="hdg-footer__logo">
					<p><?php 
					
					printf(
						esc_html__('This website is managed by Transform Health, who has been convening efforts to advocate for this agenda. Visit the %s page to view more information about all contributors.', 'hdg'),
						'<a href="/acknowledgements">' . esc_html__('acknowledgements', 'hdg') . '</a>'
					); ?>
					</p>
				</div>
			
				<div class="hdg-footer__links">
				<?php
				if ( has_nav_menu( 'footer-links' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'footer-links',
							'menu_id'        => 'footer-nav',
							'menu_class'     => 'hdg-footer__list',
							'container'      => false,
						)
					);	
				}
				?>
				</div>

			</div>
			<div class="hdg-footer__section">
			
				<div class="hdg-footer__social">
					<p class="visually-hidden"><?php esc_html_e( 'Connect', 'hdg' ); ?></p>
					<?php get_template_part( 'template-parts/_molecules/social-links' ); ?>
				</div>

		</div>

		<div class="hdg-footer__section hdg-footer__legal">
			<?php
			if ( has_nav_menu( 'legal' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'legal',
						'menu_id'        => 'legal-nav',
						'menu_class'     => 'hdg-footer__list hdg-footer__inline-list',
						'container'      => false,
					)
				);
			}
			?>
			<span class="hdg-footer__copyright">© Health Data Governance, <?php echo date( 'Y' ); ?></span>
		</div>

	</div>

</footer>