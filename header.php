<?php
/**
* Header Template
*
* @package dash
*/ ?>

<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>

    <meta charset="<?php bloginfo( 'charset' ); ?>" />

    <meta name="viewport" content="width=device-width" />

    <title><?php wp_title( ' | ', true, 'right' ); ?></title>

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

    <div id="site-wrap" class="hfeed">

        <header id="site-header" role="banner">

                <div id="header-brand">
                    <?php
                    if ( has_custom_logo() ) :
                        the_custom_logo();
                    else : ?>
                        <a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( get_bloginfo( 'name' ), '_dash' ); ?>" rel="home">
                            <?php echo sprintf('<h1 class="site-title">%s</h1>', bloginfo( 'name' ) ); ?>
                        </a>
                    <?php endif; ?>
                </div>

                <?php if (is_active_sidebar('widget-header')): ?>

                    <aside id="header-widget" role="complementary">

                        <?php dynamic_sidebar('widget-header'); ?>

                    </aside>

                <?php endif; ?>

                <?php
                    $args = array(
                        'theme_location' => 'menu-main',
                        'menu' => '',
                        'container' => 'nav',
                        'container_class' => '',
                        'container_id' => 'header-menu',
                        'menu_class' => '',
                        'menu_id' => '',
                        'echo' => true,
                        'fallback_cb' => 'wp_page_menu',
                        'before' => '',
                        'after' => '',
                        'link_before' => '',
                        'link_after' => '',
                        'items_wrap' => '<ul id="%1$s" class="menu %2$s">%3$s</ul>',
                        'depth' => 2,
                        'walker' => ''
                    );
                    wp_nav_menu( $args );
                ?>
        </header>

        <main id="site-content">
