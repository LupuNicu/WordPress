<?php get_header(); ?>

<div class="feature-header">
  <div class="feature-post-thumbnail">
    <div class="slider-alternate">
      <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/banner.png'; ?>">
    </div>
    <div class="header-area">
      <h1 class="post-title feature-header-title"><?php echo(esc_html_e('404 Page','vr-gaming')); ?></h1>
      <?php if ( get_theme_mod('vr_gaming_breadcrumb_enable',true) ) : ?>
        <div class="bread_crumb text-center">
          <?php vr_gaming_breadcrumb();  ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
<div id="content">
	<div class="container">
		<div class="not-found py-5 text-center">
			<h1><?php echo esc_html(get_theme_mod('vr_gaming_404_page_title',__('404 Not Found','vr-gaming')));?></h1>
			<p class="text-404"><?php echo esc_html(get_theme_mod('vr_gaming_404_page_content',__('Sorry, no posts matched your criteria.','vr-gaming')));?></p>
			<?php get_search_form(); ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>