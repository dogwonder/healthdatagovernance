<header id="masthead" class="hdg-masthead" data-enabled="false">

    <div id="skiplink-container">
        <a href="#content" class="govuk-skip-link" data-module="govuk-skip-link"><?php esc_html_e( 'Skip to main content', 'hdg' ); ?></a>
    </div>

    <div class="hdg-masthead-container">

            <div class="hdg-masthead__logo">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                    <img class="logo" src="<?php echo get_template_directory_uri(); ?>/dist/images/logo.png" alt="<?php bloginfo( 'name' ); ?>">
                <span class="visually-hidden"><?php esc_html_e( 'Health Data Governance', 'hdg' ); ?></span>
                </a>
            </div><!-- .masthead__logo -->

            <nav id="site-navigation" class="main-navigation hdg-nav" aria-label="primary">

            <div x-data="{ open: false }"  @click.outside="open = false">
                <button @click="open = !open" class="nav-toggle" id="nav-toggle" aria-label="Show or hide Top Level Navigation" aria-controls="nav-primary" aria-expanded="false">
                    <span class="visually-hidden"><?php esc_html_e( 'Menu', 'hdg' ); ?></span>
                    <svg class="open" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z"/></svg>
                </button>
                <div class="hdg-sidebar" :class="{'hdg-translate-x-0': open, 'hdg-translate-x-full': !open}">

                <button @click="open = false" class="nav-close" aria-label="Close Sidebar">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Pro 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2024 Fonticons, Inc.--><path d="M326.6 166.6L349.3 144 304 98.7l-22.6 22.6L192 210.7l-89.4-89.4L80 98.7 34.7 144l22.6 22.6L146.7 256 57.4 345.4 34.7 368 80 413.3l22.6-22.6L192 301.3l89.4 89.4L304 413.3 349.3 368l-22.6-22.6L237.3 256l89.4-89.4z"/></svg>
                </button>
                   

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
            </div>


            </nav>

            
    </div><!--/container-->

</header>