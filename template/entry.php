<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<header class="post-header">

	<?php
	if ( is_singular() ) {
		echo '<h1 class="post-title">';
		the_title();
		echo '</h1>';
	} else {
		echo '<h2 class="post-title"><a href="' . get_the_permalink() .'" title="' . the_title_attribute(array( 'before' => 'Permalink to: ', 'after' => '', 'echo' => false )) .'" rel="bookmark">';
		the_title();
		echo '</a></h2>';
	} ?>
	<?php if ( !is_page() && !is_search() ) get_template_part( 'template/entry', 'meta' ); ?>

	</header>

	<?php get_template_part( 'template/entry', ( is_archive() || is_search() || is_home() ? 'summary' : 'content' ) ); ?>

	<?php if ( !is_page() && !is_search() ) get_template_part( 'template/entry-footer' ); ?>

</article>