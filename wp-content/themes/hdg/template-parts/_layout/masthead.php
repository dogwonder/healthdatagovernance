<header id="masthead" class="hdg-masthead" data-enabled="false">

    <div id="skiplink-container">
        <a href="#content" class="govuk-skip-link" data-module="govuk-skip-link"><?php esc_html_e( 'Skip to main content', 'hdg' ); ?></a>
    </div>

    <div class="hdg-masthead-container">

            <div class="hdg-masthead__logo">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="Go to the homepage for <?php bloginfo( 'name' ); ?>">
                <?php get_template_part( 'template-parts/_atoms/logo' ); ?>
                <span class="visually-hidden"><?php esc_html_e( 'Health Data Governance', 'hdg' ); ?></span>
                </a>
            </div><!-- .masthead__logo -->

            <nav id="site-navigation" class="main-navigation hdg-nav" aria-label="primary">

                <button class="nav-toggle" id="nav-toggle" aria-label="Show or hide Top Level Navigation" aria-controls="nav-primary" aria-expanded="false">
                    <svg class="open" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M0 80c0-8.8 7.2-16 16-16l416 0c8.8 0 16 7.2 16 16s-7.2 16-16 16L16 96C7.2 96 0 88.8 0 80zM0 240c0-8.8 7.2-16 16-16l416 0c8.8 0 16 7.2 16 16s-7.2 16-16 16L16 256c-8.8 0-16-7.2-16-16zM448 400c0 8.8-7.2 16-16 16L16 416c-8.8 0-16-7.2-16-16s7.2-16 16-16l416 0c8.8 0 16 7.2 16 16z"/></svg>
                    <svg class="close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M340.8 32l40.1 0L212 256 380.9 480l-40.1 0L192 282.6 43.2 480 3.1 480 172 256 3.1 32l40.1 0L192 229.4 340.8 32z"/></svg>
                    <span class="visually-hidden"><?php esc_html_e( 'Menu', 'hdg' ); ?></span>
                </button>

                <div class="hdg-nav__wrapper">

                <?php
                if ( has_nav_menu( 'primary' ) ) {
                    wp_nav_menu(
                        array(
                            'theme_location' => 'primary',
                            'menu_id'        => 'nav-primary',
                            'menu_class'     => 'hdg-menu',
                            'container'      => false,
                        )
                    );
                }
                ?>
                
                </div>
                
            </nav>

            
    </div><!--/container-->

</header>