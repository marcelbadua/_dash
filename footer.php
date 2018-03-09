<?php
/**
* Footer Template
*
* @package dash
*/ ?>

		</main>

		<footer id="site-footer" role="contentinfo">

        <?php if (is_active_sidebar('widget-footer')): ?>

        	<aside id="footer-widget" role="complementary">

       				<?php dynamic_sidebar('widget-footer'); ?>

        	</aside>

        <?php endif; ?>



		    <div id="copyright">
        	<?php printf('&copy; %1$s <a href="%2$s" title="%3$s">%3$s</a> - %4$s', date( "Y" ), home_url() ,get_bloginfo( 'name' ), get_bloginfo( 'description' )); ?>

          <a class="rss" href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS'); ?>">RSS</a>

		    </div>


		</footer>

	</div>

<?php wp_footer(); ?>

</body>

</html>
