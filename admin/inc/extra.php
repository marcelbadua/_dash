<?php 
/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 */
function _dash_wp_title( $title, $sep ) {
    global $page, $paged;

    if ( is_feed() )
        return $title;

    // Add the blog name
    $title .= get_bloginfo( 'name' );

    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        $title .= " $sep $site_description";

    // Add a page number if necessary:
    if ( $paged >= 2 || $page >= 2 )
        $title .= " $sep " . sprintf( __( 'Page %s', '_dash' ), max( $paged, $page ) );

    return $title;
}
add_filter( 'wp_title', '_dash_wp_title', 10, 2 );

function my_login_logo() { ?>
    <style type="text/css">

        .login h1 a {
            background-image: url(<?php echo wp_get_attachment_url( get_theme_mod( 'custom_logo' ) ); ?>)!important;
            padding-bottom: 30px!important;;
            margin: 0!important;;
            background-size: contain!important;;
            width: 100%!important;;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
