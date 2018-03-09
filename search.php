<?php
/**
* Search Template
*
* @package dash
*/ ?>

<?php get_header(); ?>

<section id="content-main" role="main">

    <?php if ( have_posts() ) : ?>

        <header class="post-header">

            <h2 class="post-title">

                <?php printf( __( 'Search Results for: %s', '_dash' ), get_search_query() ); ?>

            </h2>

        </header>

        <?php while ( have_posts() ) : the_post(); ?>

            <?php get_template_part( 'template/entry' ); ?>

        <?php endwhile; ?>

        <div class="clearfix">&nbsp;</div>

    <?php else : ?>

    <article id="post-0" class="post no-results not-found">

        <header class="post-header">

            <h2 class="post-title">

                <?php _e( 'Nothing Found', '_dash' ); ?>

            </h2>

        </header>

        <section class="post-content">

            <p><?php _e( 'Sorry, nothing matched your search. Please try again.', '_dash' ); ?></p>

            <?php get_search_form(); ?>

        </section>

    </article>

    <?php endif; ?>

</section>

<?php get_footer(); ?>
