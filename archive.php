<?php
/**
* Archive Template
*
* @package dash
*/ ?>

<?php get_header(); ?>

<section id="content-main" role="main">

    <header class="post-header">
        <h1 class="post-title">
        <?php
            if ( is_day() ) {
                printf( __( 'Daily Archives: %s', '_dash' ), get_the_time( get_option( 'date_format' ) ) );
            } elseif ( is_month() ) {
                printf( __( 'Monthly Archives: %s', '_dash' ), get_the_time( 'F Y' ) );
            } elseif ( is_year() ) {
                printf( __( 'Yearly Archives: %s', '_dash' ), get_the_time( 'Y' ) );
            } else {
                _e( 'Archives', '_dash' );
            }
        ?>
        </h1>

    </header>

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <?php get_template_part( 'template/entry' ); ?>

    <?php endwhile; endif; ?>


</section>

<?php get_footer(); ?>
