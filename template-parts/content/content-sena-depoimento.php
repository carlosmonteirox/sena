<?php
/**
 * Single depoimento content.
 *
 * @package sena
 */

if (! defined('ABSPATH')) {
    exit;
}
?>
<article <?php post_class('single-article text-center'); ?> data-reveal>
    <?php
    if (function_exists('sena_render_breadcrumb')) {
        sena_render_breadcrumb(get_the_title());
    }
    ?>
    <p class="eyebrow mb-2">Depoimento</p>
    <h1 class="h3 mb-4"><?php the_title(); ?></h1>
    <blockquote class="quote-card">
        <p class="quote-text mb-0">"<?php echo esc_html(get_the_excerpt() ?: wp_trim_words(get_the_content(), 30, '...')); ?>"</p>
    </blockquote>
</article>
