<?php
/**
 * Propostas cards loop.
 *
 * @package sena
 */

if (! defined('ABSPATH')) {
    exit;
}

$query = $args['query'] ?? null;
$col_class = isset($args['col_class']) ? (string) $args['col_class'] : 'col-md-6 col-xl-4';
$empty_message = isset($args['empty_message']) ? (string) $args['empty_message'] : __('Nenhuma proposta publicada ainda.', 'sena');
$accent_colors = ['#fac607', '#00bef8', '#10af8f', '#004cb2'];
$use_custom_query = $query instanceof WP_Query;
$has_posts = $use_custom_query ? $query->have_posts() : have_posts();
$loop_index = 0;
?>

<div class="row g-4 proposal-list mb-5">
    <?php if ($has_posts) : ?>
        <?php while ($use_custom_query ? $query->have_posts() : have_posts()) : ?>
            <?php
            if ($use_custom_query) {
                $query->the_post();
            } else {
                the_post();
            }

            $terms = get_the_terms(get_the_ID(), 'proposta_tema');
            $term_name = (! empty($terms) && ! is_wp_error($terms)) ? $terms[0]->name : __('Proposta', 'sena');
            $accent = $accent_colors[$loop_index % count($accent_colors)];
            ?>
            <div class="<?php echo esc_attr($col_class); ?>" data-reveal>
                <article <?php post_class('proposal-card h-100'); ?> style="--proposal-accent: <?php echo esc_attr($accent); ?>;">
                    <a href="<?php the_permalink(); ?>" class="proposal-inner proposal-link h-100">
                        <div class="proposal-card-top">
                            <span class="proposal-icon"><i class="bi bi-file-earmark-text" aria-hidden="true"></i></span>
                            <span class="proposal-term fw-normal"><?php echo esc_html($term_name); ?></span>
                        </div>
                        <div>
                            <p class="proposal-kicker mb-2"><?php esc_html_e('Proposta', 'sena'); ?></p>
                            <h3 class="proposal-title"><?php the_title(); ?></h3>
                            <p class="proposal-text mb-0"><?php echo esc_html(get_the_excerpt() ?: wp_trim_words(get_the_content(), 24, '...')); ?></p>
                        </div>
                        <span class="proposal-cta small fw-normal"><?php esc_html_e('Ler proposta', 'sena'); ?> <i class="bi bi-arrow-right-short" aria-hidden="true"></i></span>
                    </a>
                </article>
            </div>
            <?php $loop_index++; ?>
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
?>
