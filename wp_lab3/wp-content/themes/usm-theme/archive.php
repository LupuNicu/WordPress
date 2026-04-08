<?php get_header(); ?>

<h2 class="archive-title"><?php the_archive_title(); ?></h2>
<?php the_archive_description('<div>', '</div>'); ?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <article class="post-card">
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <p><?php echo esc_html(get_the_date()); ?></p>
            <?php the_excerpt(); ?>
        </article>
    <?php endwhile; ?>

    <?php the_posts_pagination(); ?>
<?php else : ?>
    <p>Nu exista postari in aceasta arhiva.</p>
<?php endif; ?>

<?php get_footer(); ?>
