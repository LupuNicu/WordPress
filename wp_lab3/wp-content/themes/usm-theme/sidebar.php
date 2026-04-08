<aside class="sidebar">
    <h3>Bara laterala</h3>
    <p>Acesta este un sidebar simplu pentru laborator.</p>

    <?php if (is_active_sidebar('primary-sidebar')) : ?>
        <?php dynamic_sidebar('primary-sidebar'); ?>
    <?php else : ?>
        <ul>
            <li><a href="<?php echo esc_url(home_url('/')); ?>">Acasa</a></li>
            <li><a href="<?php echo esc_url(home_url('/about')); ?>">Despre</a></li>
        </ul>
    <?php endif; ?>
</aside>
