<?php
/**
 * Single agenda content.
 *
 * @package sena
 */

if (! defined('ABSPATH')) {
    exit;
}
?>
<article <?php post_class('single-article'); ?> data-reveal>
    <header class="mb-4">
        <p class="eyebrow mb-2">Agenda</p>
        <h1 class="display-6 mb-3"><?php the_title(); ?></h1>
        <p class="text-muted mb-0"><?php echo esc_html(get_the_date('d/m/Y')); ?></p>
    </header>
    <div class="card-blur p-4 p-lg-5 entry-content">
        <?php the_content(); ?>
    </div>
</article>
