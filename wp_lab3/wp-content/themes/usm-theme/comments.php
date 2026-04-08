<?php if (post_password_required()) : ?>
    <p>Aceasta postare este protejata cu parola.</p>
    <?php return; ?>
<?php endif; ?>

<section class="comments-area">
    <h3>Comentarii</h3>

    <?php if (have_comments()) : ?>
        <ol>
            <?php wp_list_comments(); ?>
        </ol>
    <?php else : ?>
        <p>Nu exista comentarii inca.</p>
    <?php endif; ?>

    <?php comment_form(); ?>
</section>
