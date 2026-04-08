<?php
/**
 * Functiile de baza ale temei USM.
 */

function usm_theme_enqueue_assets() {
    wp_enqueue_style(
        'usm-theme-style',
        get_stylesheet_uri(),
        array(),
        wp_get_theme()->get('Version')
    );
}
add_action('wp_enqueue_scripts', 'usm_theme_enqueue_assets');

function usm_theme_register_sidebar() {
    register_sidebar(
        array(
            'name'          => 'Primary Sidebar',
            'id'            => 'primary-sidebar',
            'description'   => 'Sidebar principal pentru tema USM.',
            'before_widget' => '<section class="widget">',
            'after_widget'  => '</section>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        )
    );
}
add_action('widgets_init', 'usm_theme_register_sidebar');
