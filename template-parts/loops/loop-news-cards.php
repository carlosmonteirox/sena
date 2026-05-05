<?php
/**
 * News cards loop shared by home and blog listing pages.
 *
 * @package sena
 */

if (! defined('ABSPATH')) {
    exit;
}

$query = $args['query'] ?? null;
$col_class = isset($args['col_class']) ? (string) $args['col_class'] : 'col-md-6 col-lg-4';
$empty_message = isset($args['empty_message']) ? (string) $args['empty_message'] : __('Nenhuma notícia publicada ainda.', 'sena');

$use_custom_query = $query instanceof WP_Query;
$has_posts = $use_custom_query ? $query->have_posts() : have_posts();
?>
<div class="row gx-4">
    <?php if ($has_posts) : ?>
        <?php while ($use_custom_query ? $query->have_posts() : have_posts()) : ?>
            <?php
            if ($use_custom_query) {
                $query->the_post();
            } else {
                the_post();
            }
            ?>
            <div class="<?php echo esc_attr($col_class); ?>" data-reveal>
                <?php get_template_part('template-parts/content/content', 'post-card'); ?>
            </div>
        <?php endwhile; ?>
    <?php else : ?>
        <div class="col-12" data-reveal>
            <div class="alert alert-primary border-0 rounded-3 mb-0"><?php echo esc_html($empty_message); ?></div>
        </div>
    <?php endif; ?>
</div>
<?php
if ($use_custom_query) {
    wp_reset_postdata();
}

