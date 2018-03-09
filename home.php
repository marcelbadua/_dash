<?php
/**
* Home Template
*
* @package dash
*/ ?>

<?php get_header(); ?>

<section id="content-main" role="main">

    <header class="post-header">

        <h1 class="post-title">

            <?php echo get_the_title( get_option('page_for_posts', true) ); ?>

        </h1>

    </header>

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <?php get_template_part( 'template/entry' ); ?>

    <?php endwhile; endif; ?>

</section>

<?php get_footer(); ?>
