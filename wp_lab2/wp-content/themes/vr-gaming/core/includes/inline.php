<?php

$vr_gaming_custom_css = '';

	/*---------------------------text-transform-------------------*/

	$vr_gaming_text_transform = get_theme_mod( 'menu_text_transform_vr_gaming','CAPITALISE');
    if($vr_gaming_text_transform == 'CAPITALISE'){

		$vr_gaming_custom_css .='#main-menu ul li a{';

			$vr_gaming_custom_css .='text-transform: capitalize;';

		$vr_gaming_custom_css .='}';

	}else if($vr_gaming_text_transform == 'UPPERCASE'){

		$vr_gaming_custom_css .='#main-menu ul li a{';

			$vr_gaming_custom_css .='text-transform: uppercase;';

		$vr_gaming_custom_css .='}';

	}else if($vr_gaming_text_transform == 'LOWERCASE'){

		$vr_gaming_custom_css .='#main-menu ul li a{';

			$vr_gaming_custom_css .='text-transform: lowercase;';

		$vr_gaming_custom_css .='}';
	}

		/*---------------------------menu-zoom-------------------*/

		$vr_gaming_menu_zoom = get_theme_mod( 'vr_gaming_menu_zoom','None');

    if($vr_gaming_menu_zoom == 'Zoomout'){

		$vr_gaming_custom_css .='#main-menu ul li a{';

			$vr_gaming_custom_css .='';

		$vr_gaming_custom_css .='}';

	}else if($vr_gaming_menu_zoom == 'Zoominn'){

		$vr_gaming_custom_css .='#main-menu ul li a:hover{';

			$vr_gaming_custom_css .='transition: all 0.3s ease-in-out !important; transform: scale(1.2) !important; color: var(--first-color);';

		$vr_gaming_custom_css .='}';
	}

	/*---------------------------Container Width-------------------*/

$vr_gaming_container_width = get_theme_mod('vr_gaming_container_width');

		$vr_gaming_custom_css .='body{';

			$vr_gaming_custom_css .='width: '.esc_attr($vr_gaming_container_width).'%; margin: auto';

		$vr_gaming_custom_css .='}';

		/*---------------------------Copyright Text alignment-------------------*/

	$vr_gaming_copyright_text_alignment = get_theme_mod( 'vr_gaming_copyright_text_alignment','LEFT-ALIGN');

	if($vr_gaming_copyright_text_alignment == 'LEFT-ALIGN'){

		$vr_gaming_custom_css .='.copy-text p{';

			$vr_gaming_custom_css .='text-align:left;';

		$vr_gaming_custom_css .='}';


	}else if($vr_gaming_copyright_text_alignment == 'CENTER-ALIGN'){

		$vr_gaming_custom_css .='.copy-text p{';

			$vr_gaming_custom_css .='text-align:center;';

		$vr_gaming_custom_css .='}';


	}else if($vr_gaming_copyright_text_alignment == 'RIGHT-ALIGN'){

		$vr_gaming_custom_css .='.copy-text p{';

			$vr_gaming_custom_css .='text-align:right;';

		$vr_gaming_custom_css .='}';

	}

	/*---------------------------related Product Settings-------------------*/

$vr_gaming_related_product_setting = get_theme_mod('vr_gaming_related_product_setting',true);

	if($vr_gaming_related_product_setting == false){

		$vr_gaming_custom_css .='.related.products, .related h2{';

			$vr_gaming_custom_css .='display: none;';

		$vr_gaming_custom_css .='}';
	}

		/*---------------------------Scroll to Top Alignment Settings-------------------*/

		$vr_gaming_scroll_top_position = get_theme_mod( 'vr_gaming_scroll_top_position','Right');

		if($vr_gaming_scroll_top_position == 'Right'){
	
			$vr_gaming_custom_css .='.scroll-up{';
	
				$vr_gaming_custom_css .='right: 20px;';
	
			$vr_gaming_custom_css .='}';
	
		}else if($vr_gaming_scroll_top_position == 'Left'){
	
			$vr_gaming_custom_css .='.scroll-up{';
	
				$vr_gaming_custom_css .='left: 20px;';
	
			$vr_gaming_custom_css .='}';
	
		}else if($vr_gaming_scroll_top_position == 'Center'){
	
			$vr_gaming_custom_css .='.scroll-up{';
	
				$vr_gaming_custom_css .='right: 50%;left: 50%;';
	
			$vr_gaming_custom_css .='}';
		}
	
			/*---------------------------Pagination Settings-------------------*/
	
	
	$vr_gaming_pagination_setting = get_theme_mod('vr_gaming_pagination_setting',true);
	
		if($vr_gaming_pagination_setting == false){
	
			$vr_gaming_custom_css .='.nav-links{';
	
				$vr_gaming_custom_css .='display: none;';
	
			$vr_gaming_custom_css .='}';
		}

	/*---------------------------woocommerce pagination alignment settings-------------------*/

	$vr_gaming_woocommerce_pagination_position = get_theme_mod( 'vr_gaming_woocommerce_pagination_position','Center');

	if($vr_gaming_woocommerce_pagination_position == 'Left'){

		$vr_gaming_custom_css .='.woocommerce nav.woocommerce-pagination{';

			$vr_gaming_custom_css .='text-align: left;';

		$vr_gaming_custom_css .='}';

	}else if($vr_gaming_woocommerce_pagination_position == 'Center'){

		$vr_gaming_custom_css .='.woocommerce nav.woocommerce-pagination{';

			$vr_gaming_custom_css .='text-align: center;';

		$vr_gaming_custom_css .='}';

	}else if($vr_gaming_woocommerce_pagination_position == 'Right'){

		$vr_gaming_custom_css .='.woocommerce nav.woocommerce-pagination{';

			$vr_gaming_custom_css .='text-align: right;';

		$vr_gaming_custom_css .='}';
	}

/*---------------------------Global Color-------------------*/

$vr_gaming_first_color = get_theme_mod('vr_gaming_first_color');

/*--- First Global Color ---*/

if ($vr_gaming_first_color) {
  $vr_gaming_custom_css .= ':root {';
  $vr_gaming_custom_css .= '--first-color: ' . esc_attr($vr_gaming_first_color) . ' !important;';
  $vr_gaming_custom_css .= '} ';
}
