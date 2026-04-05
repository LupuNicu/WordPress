<h2 class="entry-title"><?php echo esc_html(get_theme_mod('vr_gaming_no_results_page_title',__('Nothing Found','vr-gaming')));?></h2>

<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
	<p><?php printf( esc_html__( 'Ready to publish your first post? Get started here.', 'vr-gaming' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
	<?php elseif ( is_search() ) : ?>
	<p><?php echo esc_html(get_theme_mod('vr_gaming_no_results_page_content',__('Sorry, but nothing matched your search terms. Please try again with some different keywords.','vr-gaming')));?></p><br />
		<?php get_search_form(); ?>
	<?php else : ?>
	<p><?php esc_html_e( 'Dont worry&hellip it happens to the best of us.', 'vr-gaming' ); ?></p><br />
	<div class="more-btn">
		<a href="<?php echo esc_url(home_url() ); ?>"><?php esc_html_e( 'Back to Home Page', 'vr-gaming' ); ?><span class="screen-reader-text"><?php esc_html_e( 'Back to Home Page','vr-gaming' );?></span></a>
	</div>
<?php endif; ?>