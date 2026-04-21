<?php
/**
 * Post card template.
 *
 * @package sena
 */

if (! defined('ABSPATH')) {
    exit;
}
?>
<article <?php post_class('news-card border-0 h-100'); ?>>
    <a class="news-card-image" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
        <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('sena-card', ['class' => 'img-fluid', 'loading' => 'lazy']); ?>
        <?php else : ?>
            <span class="news-card-placeholder"><i class="bi bi-newspaper"></i></span>
        <?php endif; ?>
    </a>
    <div class="p-3 p-md-4 p-lg-5">
        <p class="small text-muted mb-2 d-none"><?php echo esc_html(get_the_date('d/m/Y')); ?></p>
        <h3 class="h5 fw-bold mb-2">
            <a class="text-dark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>
        <p class="text-muted mb-3"><?php echo esc_html(get_the_excerpt() ?: wp_trim_words(get_the_content(), 20, '...')); ?></p>
        <a class="text-info" href="<?php the_permalink(); ?>">Saiba mais</a>
    </div>
</article>
