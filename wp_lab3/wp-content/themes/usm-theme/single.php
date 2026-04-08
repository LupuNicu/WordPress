<?php get_header(); ?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <article>
            <h2 class="single-title"><?php the_title(); ?></h2>
            <p>
                Publicat la <?php echo esc_html(get_the_date()); ?> |
                Autor: <?php the_author_posts_link(); ?>
            </p>
            <?php the_content(); ?>
        </article>

        <?php comments_template(); ?>
    <?php endwhile; ?>
<?php else : ?>
    <p>Postarea nu a fost gasita.</p>
<?php endif; ?>

<?php get_footer(); ?>
