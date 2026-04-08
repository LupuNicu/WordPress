<?php get_header(); ?>

<h2>Ultimele 5 postari</h2>

<?php
$latest_posts = new WP_Query(
    array(
        'posts_per_page' => 5,
        'post_status'    => 'publish',
    )
);
?>

<?php if ($latest_posts->have_posts()) : ?>
    <?php while ($latest_posts->have_posts()) : $latest_posts->the_post(); ?>
        <article class="post-card">
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <p>
                Publicat la <?php echo esc_html(get_the_date()); ?> de
                <?php the_author_posts_link(); ?>
            </p>
            <?php the_excerpt(); ?>
        </article>
    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
<?php else : ?>
    <p>Nu exista postari momentan.</p>
<?php endif; ?>

<?php get_footer(); ?>
