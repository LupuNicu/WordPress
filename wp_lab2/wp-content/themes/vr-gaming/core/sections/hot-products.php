<?php if ( get_theme_mod('vr_gaming_products_section_enable', true) == true ) : ?>

<div id="hot_products" class="py-5">
	<div class="container">
    <?php if ( get_theme_mod('vr_gaming_products_short_heading') ) : ?>
      <h4 class="text-center short-heading"><?php echo esc_html(get_theme_mod('vr_gaming_products_short_heading'));?></h4>
    <?php endif; ?>
    <?php if ( get_theme_mod('vr_gaming_products_main_heading') ) : ?>
		  <h3 class="text-center pb-4"><?php echo esc_html(get_theme_mod('vr_gaming_products_main_heading'));?></h3>
    <?php endif; ?>
    <div class="row">
      <?php
        $vr_gaming_product_data = get_theme_mod('vr_gaming_products_category');
        if ( class_exists( 'WooCommerce' ) ) {
          $vr_gaming_args = array(
          'post_type' => 'product',
          'posts_per_page' => get_theme_mod('vr_gaming_products_per_page'),
          'product_cat' => $vr_gaming_product_data,
          'order' => 'ASC'
        );
        $loop = new WP_Query( $vr_gaming_args );
        while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
      	  <div class="col-lg-3 col-md-6 col-sm-6 wow zoomIn">
            <div class="product-details mb-4">
              <div class="product-image">
                <figure>
                  <?php if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); else echo '<img src="'.esc_url(wc_placeholder_img_src()).'" />'; ?>
                </figure>
                <div class="cart-button">
                  <span class="icon" href="<?php if(function_exists('wc_get_cart_url')){ echo esc_url(wc_get_cart_url()); } ?>"><span class="button1"><?php if( $product->is_type( 'simple' ) ) { woocommerce_template_loop_add_to_cart(  $loop->post, $product );} ?></span></span>
                </div>
              </div>
              <h4 class="product-text"><a href="<?php echo esc_url(get_permalink( $loop->post->ID )); ?>"><?php the_title(); ?></a></h4>
              <div class="price-review">
                <p class="mb-0 <?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>"><?php echo $product->get_price_html(); ?></p>
                <?php if( $product->is_type( 'simple' ) ){ woocommerce_template_loop_rating( $loop->post, $product ); } ?>
              </div>
            </div>
          </div>
        <?php endwhile; wp_reset_postdata(); ?>
      <?php } ?>
	  </div>
	</div>
</div>

<?php endif; ?>