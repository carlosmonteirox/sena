<?php
/**
 * Single proposta content.
 *
 * @package sena
 */

if (! defined('ABSPATH')) {
    exit;
}
?>
<article <?php post_class('single-article'); ?> data-reveal>
    <header class="mb-4">
        <p class="eyebrow mb-2">Proposta</p>
        <h1 class="display-6 mb-3"><?php the_title(); ?></h1>
        <?php
        $terms = get_the_terms(get_the_ID(), 'proposta_tema');
        if (! empty($terms) && ! is_wp_error($terms)) {
            echo '<p class="mb-0 text-muted">Tema: ' . esc_html($terms[0]->name) . '</p>';
        }
        ?>
    </header>
    <div class="card-blur p-4 p-lg-5 entry-content">
        <?php the_content(); ?>
    </div>
</article>
