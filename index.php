<?php
/**
* Index Template
*
* @package dash
*/ ?>

<?php get_header(); ?>

<section id="content-main" role="main">

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    	<?php get_template_part( 'template/entry' ); ?>

    <?php endwhile; endif; ?>

    <?php _dash_pagination(); ?>

</section>

<?php get_footer(); ?>
