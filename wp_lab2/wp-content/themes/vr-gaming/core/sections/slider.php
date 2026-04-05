<?php if ( get_theme_mod('vr_gaming_blog_box_enable',false) ) : ?>

<?php $vr_gaming_args = array(
  'post_type' => 'post',
  'post_status' => 'publish',
  'category_name' =>  get_theme_mod('vr_gaming_blog_slide_category'),
  'posts_per_page' => get_theme_mod('vr_gaming_blog_slide_number'),
); ?>

<div class="container-fluid">
  <div class="slider pt-3">
    <div class="owl-carousel">
      <?php $vr_gaming_arr_posts = new WP_Query( $vr_gaming_args );
      if ( $vr_gaming_arr_posts->have_posts() ) :
        while ( $vr_gaming_arr_posts->have_posts() ) :
          $vr_gaming_arr_posts->the_post();
          ?>
          <div class="blog_box_inner wow fadeInRight">
            <?php
              if ( has_post_thumbnail() ) { ?>
                <?php the_post_thumbnail(); ?>
              <?php } else { ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/slider1.png'; ?>">
            <?php } ?>
            <div class="blog_inner_content">
              <h3><?php the_title(); ?></h3>
              <p><?php echo wp_trim_words(get_the_content(), 15); ?></p>
              <p class="slider-button mt-5">
                <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php esc_html_e('Shop Now','vr-gaming'); ?></a>
              </p>
            </div>
          </div>
        <?php
      endwhile;
      wp_reset_postdata();
      endif; ?>
    </div>
  </div>
</div>

<?php endif; ?>