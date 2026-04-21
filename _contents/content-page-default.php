<?php
/**
 * Default page content.
 *
 * @package sena
 */

if (! defined('ABSPATH')) {
    exit;
}
?>
<article <?php post_class('page-content'); ?>>
    <?php
    get_template_part('template-parts/sections/section', 'page-hero', [
        'title'    => get_the_title(),
        'subtitle' => get_the_excerpt(),
    ]);
    ?>

    <div class="p-4 p-lg-5 mt-4">
        <div class="entry-content">
            <?php the_content(); ?>
        </div>
    </div>
</article>