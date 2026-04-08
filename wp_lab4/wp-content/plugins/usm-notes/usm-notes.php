<?php
/**
 * Plugin Name: USM Notes
 * Description: Plugin educational pentru notite cu prioritati si data de reamintire.
 * Version: 1.0.0
 * Author: USM Student
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'USM_NOTES_POST_TYPE', 'usm_note' );
define( 'USM_NOTES_TAXONOMY', 'usm_priority' );
define( 'USM_NOTES_DUE_META', '_usm_due_date' );
define( 'USM_NOTES_ERROR_TRANSIENT', 'usm_notes_due_error_' );

/**
 * Inregistreaza CPT-ul Notes.
 */
function usm_notes_register_post_type() {
	$labels = array(
		'name'                  => 'Notite',
		'singular_name'         => 'Notita',
		'menu_name'             => 'Notite',
		'name_admin_bar'        => 'Notita',
		'add_new'               => 'Adauga Notita',
		'add_new_item'          => 'Adauga notita noua',
		'new_item'              => 'Notita noua',
		'edit_item'             => 'Editeaza notita',
		'view_item'             => 'Vezi notita',
		'all_items'             => 'Toate notitele',
		'search_items'          => 'Cauta notite',
		'not_found'             => 'Nu au fost gasite notite.',
		'not_found_in_trash'    => 'Nu au fost gasite notite in cos.',
		'featured_image'        => 'Imagine reprezentativa',
		'set_featured_image'    => 'Seteaza imaginea reprezentativa',
		'remove_featured_image' => 'Sterge imaginea reprezentativa',
		'use_featured_image'    => 'Foloseste ca imagine reprezentativa',
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'has_archive'        => true,
		'menu_icon'          => 'dashicons-welcome-write-blog',
		'show_in_rest'       => true,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail' ),
		'rewrite'            => array( 'slug' => 'notite' ),
	);

	register_post_type( USM_NOTES_POST_TYPE, $args );
}
add_action( 'init', 'usm_notes_register_post_type' );

/**
 * Inregistreaza taxonomia Priority.
 */
function usm_notes_register_taxonomy() {
	$labels = array(
		'name'              => 'Prioritati',
		'singular_name'     => 'Prioritate',
		'search_items'      => 'Cauta prioritati',
		'all_items'         => 'Toate prioritatile',
		'parent_item'       => 'Prioritate parinte',
		'parent_item_colon' => 'Prioritate parinte:',
		'edit_item'         => 'Editeaza prioritatea',
		'update_item'       => 'Actualizeaza prioritatea',
		'add_new_item'      => 'Adauga prioritate noua',
		'new_item_name'     => 'Nume prioritate noua',
		'menu_name'         => 'Prioritate',
	);

	$args = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_admin_column' => true,
		'show_in_rest'      => true,
		'rewrite'           => array( 'slug' => 'prioritate' ),
	);

	register_taxonomy( USM_NOTES_TAXONOMY, array( USM_NOTES_POST_TYPE ), $args );
}
add_action( 'init', 'usm_notes_register_taxonomy' );

/**
 * Creeaza termenii impliciti pentru prioritati.
 */
function usm_notes_activate_plugin() {
	usm_notes_register_post_type();
	usm_notes_register_taxonomy();
	flush_rewrite_rules();

	$default_terms = array( 'high', 'medium', 'low' );
	foreach ( $default_terms as $term_slug ) {
		if ( ! term_exists( $term_slug, USM_NOTES_TAXONOMY ) ) {
			wp_insert_term(
				ucfirst( $term_slug ),
				USM_NOTES_TAXONOMY,
				array(
					'slug' => $term_slug,
				)
			);
		}
	}
}
register_activation_hook( __FILE__, 'usm_notes_activate_plugin' );

/**
 * Curata rewrite rules la dezactivare.
 */
function usm_notes_deactivate_plugin() {
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'usm_notes_deactivate_plugin' );

/**
 * Adauga metabox pentru due date.
 */
function usm_notes_add_due_date_metabox() {
	add_meta_box(
		'usm_notes_due_date',
		'Due Date',
		'usm_notes_render_due_date_metabox',
		USM_NOTES_POST_TYPE,
		'side',
		'high'
	);
}
add_action( 'add_meta_boxes', 'usm_notes_add_due_date_metabox' );

/**
 * Afiseaza campul datei de reamintire.
 *
 * @param WP_Post $post Postarea curenta.
 */
function usm_notes_render_due_date_metabox( $post ) {
	wp_nonce_field( 'usm_notes_save_due_date', 'usm_notes_due_date_nonce' );
	$due_date = get_post_meta( $post->ID, USM_NOTES_DUE_META, true );
	?>
	<p>
		<label for="usm_notes_due_date_field"><strong>Data de reamintire</strong></label>
	</p>
	<input
		type="date"
		id="usm_notes_due_date_field"
		name="usm_notes_due_date_field"
		value="<?php echo esc_attr( $due_date ); ?>"
		required
	/>
	<p style="margin-top:8px;">
		<small>Data este obligatorie si nu poate fi in trecut.</small>
	</p>
	<?php
}

/**
 * Salveaza due date la salvarea postarii.
 *
 * @param int $post_id ID-ul postarii.
 */
function usm_notes_save_due_date_meta( $post_id ) {
	if ( ! isset( $_POST['usm_notes_due_date_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['usm_notes_due_date_nonce'] ) ), 'usm_notes_save_due_date' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( USM_NOTES_POST_TYPE !== get_post_type( $post_id ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$raw_due_date = isset( $_POST['usm_notes_due_date_field'] ) ? sanitize_text_field( wp_unslash( $_POST['usm_notes_due_date_field'] ) ) : '';
	$is_valid     = (bool) preg_match( '/^\d{4}-\d{2}-\d{2}$/', $raw_due_date );
	$today        = gmdate( 'Y-m-d' );

	if ( ! $is_valid || $raw_due_date < $today ) {
		set_transient( USM_NOTES_ERROR_TRANSIENT . get_current_user_id(), 'Data introdusa este invalida. Data este obligatorie si nu poate fi in trecut.', 60 );
		delete_post_meta( $post_id, USM_NOTES_DUE_META );
		return;
	}

	update_post_meta( $post_id, USM_NOTES_DUE_META, $raw_due_date );
}
add_action( 'save_post', 'usm_notes_save_due_date_meta' );

/**
 * Adauga query arg pentru mesajul de eroare in redirect.
 *
 * @param string $location URL redirect.
 * @return string
 */
function usm_notes_maybe_add_error_query_arg( $location ) {
	$error = get_transient( USM_NOTES_ERROR_TRANSIENT . get_current_user_id() );
	if ( ! $error ) {
		return $location;
	}

	return add_query_arg( 'usm_notes_due_error', '1', $location );
}
add_filter( 'redirect_post_location', 'usm_notes_maybe_add_error_query_arg' );

/**
 * Afiseaza erorile de validare in admin.
 */
function usm_notes_show_admin_notices() {
	if ( ! isset( $_GET['usm_notes_due_error'] ) ) {
		return;
	}

	$error = get_transient( USM_NOTES_ERROR_TRANSIENT . get_current_user_id() );
	if ( ! $error ) {
		return;
	}

	delete_transient( USM_NOTES_ERROR_TRANSIENT . get_current_user_id() );
	?>
	<div class="notice notice-error is-dismissible">
		<p><?php echo esc_html( $error ); ?></p>
	</div>
	<?php
}
add_action( 'admin_notices', 'usm_notes_show_admin_notices' );

/**
 * Adauga coloana Due Date in lista admin.
 *
 * @param array $columns Coloanele existente.
 * @return array
 */
function usm_notes_admin_columns( $columns ) {
	$new_columns = array();

	foreach ( $columns as $key => $label ) {
		$new_columns[ $key ] = $label;
		if ( 'title' === $key ) {
			$new_columns['usm_due_date'] = 'Due Date';
		}
	}

	return $new_columns;
}
add_filter( 'manage_' . USM_NOTES_POST_TYPE . '_posts_columns', 'usm_notes_admin_columns' );

/**
 * Populeaza valoarea coloanei Due Date.
 *
 * @param string $column Numele coloanei.
 * @param int    $post_id ID-ul postarii.
 */
function usm_notes_admin_column_content( $column, $post_id ) {
	if ( 'usm_due_date' !== $column ) {
		return;
	}

	$due_date = get_post_meta( $post_id, USM_NOTES_DUE_META, true );
	echo $due_date ? esc_html( $due_date ) : '—';
}
add_action( 'manage_' . USM_NOTES_POST_TYPE . '_posts_custom_column', 'usm_notes_admin_column_content', 10, 2 );

/**
 * Permite sortarea dupa Due Date in admin.
 *
 * @param array $columns Coloane sortabile.
 * @return array
 */
function usm_notes_sortable_admin_columns( $columns ) {
	$columns['usm_due_date'] = 'usm_due_date';
	return $columns;
}
add_filter( 'manage_edit-' . USM_NOTES_POST_TYPE . '_sortable_columns', 'usm_notes_sortable_admin_columns' );

/**
 * Ajusteaza query-ul pentru sortarea dupa due date.
 *
 * @param WP_Query $query Query-ul principal.
 */
function usm_notes_sort_by_due_date( $query ) {
	if ( ! is_admin() || ! $query->is_main_query() ) {
		return;
	}

	if ( USM_NOTES_POST_TYPE !== $query->get( 'post_type' ) ) {
		return;
	}

	if ( 'usm_due_date' !== $query->get( 'orderby' ) ) {
		return;
	}

	$query->set( 'meta_key', USM_NOTES_DUE_META );
	$query->set( 'orderby', 'meta_value' );
}
add_action( 'pre_get_posts', 'usm_notes_sort_by_due_date' );

/**
 * Inregistreaza stilurile pentru shortcode.
 */
function usm_notes_register_styles() {
	wp_register_style( 'usm-notes-style', false, array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'usm_notes_register_styles' );

/**
 * Returneaza HTML pentru shortcode-ul [usm_notes].
 *
 * @param array $atts Atribute shortcode.
 * @return string
 */
function usm_notes_shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
			'priority'    => '',
			'before_date' => '',
		),
		$atts,
		'usm_notes'
	);

	$priority    = sanitize_title( $atts['priority'] );
	$before_date = sanitize_text_field( $atts['before_date'] );

	$args = array(
		'post_type'      => USM_NOTES_POST_TYPE,
		'post_status'    => 'publish',
		'posts_per_page' => -1,
	);

	if ( ! empty( $priority ) ) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => USM_NOTES_TAXONOMY,
				'field'    => 'slug',
				'terms'    => $priority,
			),
		);
	}

	if ( ! empty( $before_date ) && preg_match( '/^\d{4}-\d{2}-\d{2}$/', $before_date ) ) {
		$args['meta_query'] = array(
			array(
				'key'     => USM_NOTES_DUE_META,
				'value'   => $before_date,
				'compare' => '<=',
				'type'    => 'DATE',
			),
		);
	}

	$query = new WP_Query( $args );

	wp_enqueue_style( 'usm-notes-style' );
	wp_add_inline_style(
		'usm-notes-style',
		'.usm-notes-list{list-style:none;padding:0;margin:0}.usm-notes-item{border:1px solid #ddd;border-radius:8px;padding:14px;margin:0 0 12px;background:#fafafa}.usm-notes-title{margin:0 0 8px;font-size:1.1rem}.usm-notes-meta{font-size:.9rem;color:#555}'
	);

	ob_start();

	if ( ! $query->have_posts() ) {
		echo '<p>Nu exista notite cu parametrii specificati</p>';
		return ob_get_clean();
	}

	echo '<ul class="usm-notes-list">';
	while ( $query->have_posts() ) {
		$query->the_post();

		$due_date = get_post_meta( get_the_ID(), USM_NOTES_DUE_META, true );
		$terms    = get_the_terms( get_the_ID(), USM_NOTES_TAXONOMY );
		$priority_label = 'Fara prioritate';

		if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
			$priority_label = $terms[0]->name;
		}

		echo '<li class="usm-notes-item">';
		echo '<h3 class="usm-notes-title">' . esc_html( get_the_title() ) . '</h3>';
		echo '<div>' . wp_kses_post( wpautop( get_the_content() ) ) . '</div>';
		echo '<p class="usm-notes-meta"><strong>Prioritate:</strong> ' . esc_html( $priority_label ) . ' | <strong>Due Date:</strong> ' . esc_html( $due_date ? $due_date : '-' ) . '</p>';
		echo '</li>';
	}
	echo '</ul>';

	wp_reset_postdata();

	return ob_get_clean();
}
add_shortcode( 'usm_notes', 'usm_notes_shortcode' );
