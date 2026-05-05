<?php
/**
 * Reusable page hero section.
 *
 * @package sena
 */

if (! defined('ABSPATH')) {
    exit;
}

$title = isset($args['title']) ? (string) $args['title'] : '';
$subtitle = isset($args['subtitle']) ? (string) $args['subtitle'] : '';
?>
<header class="page-hero py-lg-4 py-4" data-reveal>
    <?php
    if (function_exists('sena_render_breadcrumb')) {
        sena_render_breadcrumb($title);
    }
    ?>

    <?php if ($title !== '') : ?>
        <h1 class="display-6 fw-500 mb-0"><?php echo esc_html($title); ?></h1>
    <?php endif; ?>

    <?php if ($subtitle !== '') : ?>
        <p class="text-muted mb-0 mt-3"><?php echo esc_html($subtitle); ?></p>
    <?php endif; ?>
</header>
