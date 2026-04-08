<?php get_header(); ?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <article>
            <h2 class="page-title"><?php the_title(); ?></h2>
            <?php the_content(); ?>
        </article>

        <?php comments_template(); ?>
    <?php endwhile; ?>
<?php else : ?>
    <p>Pagina nu a fost gasita.</p>
<?php endif; ?>

<?php get_footer(); ?>
