<footer class="hdg-footer">

	<div class="hdg-footer__inner">   

		<div class="hdg-footer__section">

				<div class="hdg-footer__about">
					<a href="https://transformhealthcoalition.org" target="_blank"><img class="logo" src="<?php echo get_template_directory_uri(); ?>/dist/images/TH-Logo+Tag-Fill-01.png" alt="<?php esc_html_e( 'Transform Health', 'hdg' ); ?>" width="96" height="77"></img></a>
					<p><?php 
					// printf(
					// 	esc_html__('This website is managed by Transform Health, who has been convening efforts to advocate for this agenda. Visit the %s page to view more information about all contributors.', 'hdg'),
					// 	'<a href="/acknowledgements">' . esc_html__('acknowledgements', 'hdg') . '</a>'
					// ); 
					?>
					<?php esc_html_e( 'This website is managed by Transform Health, a global coalition of organisations that work to harness the potential of digital technology and the use of data to achieve universal health coverage (UHC) by 2030. Transform Health has been convening efforts at national, regional and global levels to advocate for and support more robust health data governance.', 'hdg' ); ?>
					</p>
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