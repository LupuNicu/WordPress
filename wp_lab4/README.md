# Lucrarea de laborator nr. 4. Dezvoltarea unui plugin pentru WordPress

## Scopul lucrarii

Sa invat modelul extensibil de date al WordPress prin dezvoltarea unui plugin educational care include:
- Custom Post Type (CPT)
- taxonomie personalizata
- metadate cu metabox in admin
- shortcode pentru afisarea datelor pe frontend

Plugin realizat: **USM Notes**.

---

## Pasul 1. Pregatirea mediului

A fost utilizata instalarea locala WordPress din folderul `wp_lab4`.

In `wp-config.php` a fost activat modul de depanare:

```php
define( 'WP_DEBUG', true );
```

---

## Pasul 2. Crearea fisierului principal al pluginului

In `wp-content/plugins/` a fost creat directorul:

- `usm-notes`

In acest director a fost creat fisierul principal:

- `usm-notes.php`

Au fost adaugate metadatele pluginului:

```php
/**
 * Plugin Name: USM Notes
 * Description: Plugin educational pentru notite cu prioritati si data de reamintire.
 * Version: 1.0.0
 * Author: USM Student
 */
```

Pluginul a fost activat in panoul de administrare.

![Activarea pluginului](image/activarea%20pluginului.png)
![Plugin activat](image/plugin%20activat.png)

---

## Pasul 3. Inregistrarea Custom Post Type (CPT)

A fost implementat CPT-ul `Notite` prin `register_post_type()`:
- public
- arhiva activa (`has_archive`)
- suport pentru `title`, `editor`, `author`, `thumbnail`
- icon in admin
- labels pentru UX

```php
function usm_notes_register_post_type() {
	$labels = array(
		'name'               => 'Notite',
		'singular_name'      => 'Notita',
		'menu_name'          => 'Notite',
		'add_new'            => 'Adauga Notita',
		'add_new_item'       => 'Adauga notita noua',
		'edit_item'          => 'Editeaza notita',
		'all_items'          => 'Toate notitele',
		'not_found'          => 'Nu au fost gasite notite.',
	);

	$args = array(
		'labels'       => $labels,
		'public'       => true,
		'has_archive'  => true,
		'menu_icon'    => 'dashicons-welcome-write-blog',
		'show_in_rest' => true,
		'supports'     => array( 'title', 'editor', 'author', 'thumbnail' ),
		'rewrite'      => array( 'slug' => 'notite' ),
	);

	register_post_type( USM_NOTES_POST_TYPE, $args );
}
add_action( 'init', 'usm_notes_register_post_type' );
```

---

## Pasul 4. Inregistrarea taxonomiei personalizate

A fost implementata taxonomia `Prioritate` prin `register_taxonomy()`, legata de CPT-ul `Notite`:
- ierarhica
- publica
- coloana in admin
- labels pentru utilizare facila

```php
function usm_notes_register_taxonomy() {
	$labels = array(
		'name'          => 'Prioritati',
		'singular_name' => 'Prioritate',
		'menu_name'     => 'Prioritate',
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
```

La activarea pluginului se creeaza automat termenii:
- `high`
- `medium`
- `low`

---

## Pasul 5. Metabox pentru data de reamintire

In editorul CPT-ului a fost adaugat metabox-ul `Due Date` cu `input type="date"`:

```php
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
```

Salvarea metadatei include:
- verificare nonce
- verificare drepturi utilizator
- validare format data (`YYYY-MM-DD`)
- validare ca data sa nu fie in trecut
- mesaj de eroare in admin cand validarea esueaza

```php
function usm_notes_save_due_date_meta( $post_id ) {
	if ( ! isset( $_POST['usm_notes_due_date_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['usm_notes_due_date_nonce'] ) ), 'usm_notes_save_due_date' ) ) {
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
```

Data de reamintire este afisata si in lista posturilor CPT in admin (`Due Date` column).

![Pagina WordPress fara notite](image/pagina%20wordpress%20fara%20notite.png)
![Pagina WordPress cu 5 notite](image/pagina%20wordpress%20cu%205%20notite.png)

---

## Pasul 6. Shortcode pentru afisarea notitelor

A fost implementat shortcode-ul:

```text
[usm_notes priority="X" before_date="YYYY-MM-DD"]
```

Comportament:
- fara parametri: afiseaza toate notitele
- cu `priority`: filtreaza dupa taxonomia `Prioritate`
- cu `before_date`: filtreaza dupa due date (`<=`)
- daca nu exista rezultate: afiseaza mesajul `Nu exista notite cu parametrii specificati`

```php
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

	// ... randarea listei ...
}
add_shortcode( 'usm_notes', 'usm_notes_shortcode' );
```

---

## Pasul 7. Testarea pluginului

Au fost create 5 notite cu prioritati si due date diferite.

A fost creata pagina `All Notes` si adaugate shortcode-urile:

```text
[usm_notes]
[usm_notes priority="high"]
[usm_notes before_date="2026-04-30"]
```

Rezultatul este afisat corect pe frontend.

![Crearea paginii All Notes](image/crearea%20paginii%20all%20notes.png)
![Pagina All Notes](image/pagina%20all%20notes.png)

---

## Structura fisierelor realizate

`wp_lab4/wp-content/plugins/usm-notes/`

- `usm-notes.php`

`wp_lab4/`

- `README.md`
- `image/activarea pluginului.png`
- `image/crearea paginii all notes.png`
- `image/pagina all notes.png`
- `image/pagina wordpress cu 5 notite.png`
- `image/pagina wordpress fara notite.png`
- `image/plugin activat.png`

---

## Codul sursa complet (plugin)

Fisier: `wp-content/plugins/usm-notes/usm-notes.php`

```php
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
		'labels'       => $labels,
		'public'       => true,
		'has_archive'  => true,
		'menu_icon'    => 'dashicons-welcome-write-blog',
		'show_in_rest' => true,
		'supports'     => array( 'title', 'editor', 'author', 'thumbnail' ),
		'rewrite'      => array( 'slug' => 'notite' ),
	);

	register_post_type( USM_NOTES_POST_TYPE, $args );
}
add_action( 'init', 'usm_notes_register_post_type' );

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

function usm_notes_activate_plugin() {
	usm_notes_register_post_type();
	usm_notes_register_taxonomy();
	flush_rewrite_rules();

	$default_terms = array( 'high', 'medium', 'low' );
	foreach ( $default_terms as $term_slug ) {
		if ( ! term_exists( $term_slug, USM_NOTES_TAXONOMY ) ) {
			wp_insert_term( ucfirst( $term_slug ), USM_NOTES_TAXONOMY, array( 'slug' => $term_slug ) );
		}
	}
}
register_activation_hook( __FILE__, 'usm_notes_activate_plugin' );

function usm_notes_deactivate_plugin() {
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'usm_notes_deactivate_plugin' );

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

function usm_notes_render_due_date_metabox( $post ) {
	wp_nonce_field( 'usm_notes_save_due_date', 'usm_notes_due_date_nonce' );
	$due_date = get_post_meta( $post->ID, USM_NOTES_DUE_META, true );
	?>
	<p>
		<label for="usm_notes_due_date_field"><strong>Data de reamintire</strong></label>
	</p>
	<input type="date" id="usm_notes_due_date_field" name="usm_notes_due_date_field" value="<?php echo esc_attr( $due_date ); ?>" required />
	<p style="margin-top:8px;"><small>Data este obligatorie si nu poate fi in trecut.</small></p>
	<?php
}

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

function usm_notes_maybe_add_error_query_arg( $location ) {
	$error = get_transient( USM_NOTES_ERROR_TRANSIENT . get_current_user_id() );
	if ( ! $error ) {
		return $location;
	}
	return add_query_arg( 'usm_notes_due_error', '1', $location );
}
add_filter( 'redirect_post_location', 'usm_notes_maybe_add_error_query_arg' );

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
	<div class="notice notice-error is-dismissible"><p><?php echo esc_html( $error ); ?></p></div>
	<?php
}
add_action( 'admin_notices', 'usm_notes_show_admin_notices' );

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

function usm_notes_admin_column_content( $column, $post_id ) {
	if ( 'usm_due_date' !== $column ) {
		return;
	}
	$due_date = get_post_meta( $post_id, USM_NOTES_DUE_META, true );
	echo $due_date ? esc_html( $due_date ) : '—';
}
add_action( 'manage_' . USM_NOTES_POST_TYPE . '_posts_custom_column', 'usm_notes_admin_column_content', 10, 2 );

function usm_notes_sortable_admin_columns( $columns ) {
	$columns['usm_due_date'] = 'usm_due_date';
	return $columns;
}
add_filter( 'manage_edit-' . USM_NOTES_POST_TYPE . '_sortable_columns', 'usm_notes_sortable_admin_columns' );

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

function usm_notes_register_styles() {
	wp_register_style( 'usm-notes-style', false, array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'usm_notes_register_styles' );

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

		$due_date       = get_post_meta( get_the_ID(), USM_NOTES_DUE_META, true );
		$terms          = get_the_terms( get_the_ID(), USM_NOTES_TAXONOMY );
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
```

---

## Intrebari de control

### 1. Care este diferenta esentiala dintre taxonomie personalizata si metacamp?

- **Taxonomia** este pentru clasificare comuna intre mai multe postari (ex: `High/Medium/Low`) si este potrivita pentru filtrare/arhive.
- **Metacampul** este o valoare specifica fiecarei postari (ex: `Due Date`) si este potrivit pentru date unice pe element.

### 2. De ce este necesar nonce la salvarea metacampurilor?

Nonce-ul previne cereri neautorizate (CSRF). Fara verificare nonce, un atacator poate trimite request-uri in numele unui utilizator autentificat si poate modifica datele.

### 3. Parametri importanti din `register_post_type()` si `register_taxonomy()` pentru frontend si UX

Exemple relevante:
- `public` - controleaza vizibilitatea in frontend si admin.
- `has_archive` - creeaza pagina de arhiva pentru CPT.
- `supports` - defineste campurile disponibile in editor.
- `labels` - imbunatateste claritatea UX in panoul admin.
- `hierarchical` - comportament tip categorii (util in organizare).
- `show_admin_column` - afisare rapida in lista de postari.
- `rewrite` - URL-uri curate si predictibile.

---

## Concluzie

In cadrul lucrarii a fost dezvoltat pluginul educational **USM Notes**, care implementeaza complet cerintele laboratorului: CPT, taxonomie, metabox cu validare si securizare prin nonce, afisare in admin, shortcode cu filtre, stilizare frontend si testare functionala cu date reale.
