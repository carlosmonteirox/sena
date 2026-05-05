<?php
/**
 * Default posts loop.
 *
 * @package sena
 */

if (! defined('ABSPATH')) {
    exit;
}
?>
<?php if (have_posts()) : ?>
    <div class="row g-4">
        <?php while (have_posts()) : the_post(); ?>
            <div class="col-md-6" data-reveal>
                <?php get_template_part('template-parts/content/content', 'post-card'); ?>
            </div>
        <?php endwhile; ?>
    </div>

    <nav class="my-4" aria-label="Paginação">
        <?php
        the_posts_pagination([
            'mid_size'  => 1,
            'prev_text' => __('Anterior', 'sena'),
            'next_text' => __('Próximo', 'sena'),
        ]);
        ?>
    </nav>
<?php else : ?>
    <div class="alert alert-secondary mb-0" data-reveal><?php esc_html_e('Nenhum conteúdo encontrado no momento.', 'sena'); ?></div>
<?php endif; ?>
