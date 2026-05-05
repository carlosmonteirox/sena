<?php
/**
 * Single proposta content.
 *
 * @package sena
 */

if (! defined('ABSPATH')) {
    exit;
}

$current_post_id = get_the_ID();
$proposal_terms = get_the_terms($current_post_id, 'proposta_tema');
$proposal_term_ids = [];
$related_propostas = [];
$related_ids = [];
$base_related_args = [
    'post_type'           => 'sena_proposta',
    'posts_per_page'      => 3,
    'post_status'         => 'publish',
    'post__not_in'        => [$current_post_id],
    'ignore_sticky_posts' => true,
    'no_found_rows'       => true,
    'orderby'             => [
        'menu_order' => 'ASC',
        'date'       => 'DESC',
    ],
];

if (! empty($proposal_terms) && ! is_wp_error($proposal_terms)) {
    $proposal_term_ids = wp_list_pluck($proposal_terms, 'term_id');

    $term_query = sena_query_posts(wp_parse_args([
        'tax_query' => [
            [
                'taxonomy' => 'proposta_tema',
                'field'    => 'term_id',
                'terms'    => array_map('absint', $proposal_term_ids),
            ],
        ],
    ], $base_related_args));

    while ($term_query->have_posts()) {
        $term_query->the_post();
        $related_propostas[] = get_post();
        $related_ids[] = get_the_ID();
    }

    wp_reset_postdata();
}

$remaining_related = 3 - count($related_propostas);

if ($remaining_related > 0) {
    $fallback_query = sena_query_posts(wp_parse_args([
        'posts_per_page' => $remaining_related,
        'post__not_in'   => array_merge([$current_post_id], $related_ids),
    ], $base_related_args));

    while ($fallback_query->have_posts()) {
        $fallback_query->the_post();
        $related_propostas[] = get_post();
    }

    wp_reset_postdata();
}

$archive_url = get_post_type_archive_link('sena_proposta') ?: home_url('/propostas/');
?>

<div class="line-design" style="height: 5px;">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
</div>

<div class="container-fluid py-lg-5 py-4 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">

                <article <?php post_class('single-article'); ?> data-reveal>
                    <header class="mb-4">
                        <?php
                        if (function_exists('sena_render_breadcrumb')) {
                            sena_render_breadcrumb(get_the_title());
                        }
                        ?>
                        <p class="eyebrow mb-2">Proposta</p>
                        <h1 class="display-6 fw-600 mb-2"><?php the_title(); ?></h1>

                        <?php if (! empty($proposal_terms) && ! is_wp_error($proposal_terms)) : ?>
                            <div class="single-proposta-terms mb-3">
                                <?php foreach ($proposal_terms as $term) : ?>
                                    <span><?php echo esc_html($term->name); ?></span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="single-article-thumb mb-4">
                                <?php the_post_thumbnail('large', ['class' => 'img-fluid rounded-3', 'loading' => 'lazy']); ?>
                            </div>
                        <?php endif; ?>
                    </header>

                    <div class="entry-content">
                        <?php
                        the_content();
                        wp_link_pages([
                            'before' => '<div class="page-links">' . esc_html__('Páginas:', 'sena'),
                            'after'  => '</div>',
                        ]);
                        ?>
                    </div>
                </article>

                <?php if (! empty($related_propostas)) : ?>
                    <section class="post-recirculation my-md-5 py-md-5 my-4 py-4" aria-labelledby="proposta-related-title" data-reveal>
                        <div class="post-recirculation-header">
                            <div>
                                <p class="eyebrow mb-2">Continue navegando</p>
                                <h2 class="h3 fw-700 mb-0" id="proposta-related-title">Outras propostas</h2>
                            </div>
                            <a class="post-recirculation-all fw-normal" href="<?php echo esc_url($archive_url); ?>">
                                Ver todas <i class="bi bi-arrow-right-short" aria-hidden="true"></i>
                            </a>
                        </div>

                        <div class="row g-3 g-lg-4">
                            <?php foreach ($related_propostas as $related_proposta) : ?>
                                <?php
                                $post = $related_proposta; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
                                setup_postdata($post);
                                $terms = get_the_terms(get_the_ID(), 'proposta_tema');
                                $term_name = (! empty($terms) && ! is_wp_error($terms)) ? $terms[0]->name : 'Proposta';
                                ?>
                                <div class="col-md-6 col-lg-4">
                                    <article <?php post_class('recirculation-card'); ?>>
                                        <a class="recirculation-card-image" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <?php the_post_thumbnail('sena-card', ['class' => 'img-fluid', 'loading' => 'lazy']); ?>
                                            <?php else : ?>
                                                <span class="recirculation-card-placeholder"><i class="bi bi-check2-circle" aria-hidden="true"></i></span>
                                            <?php endif; ?>
                                        </a>
                                        <div class="recirculation-card-body">
                                            <p class="recirculation-card-date fw-normal"><?php echo esc_html($term_name); ?></p>
                                            <h3 class="recirculation-card-title">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h3>
                                            <p class="recirculation-card-excerpt"><?php echo esc_html(get_the_excerpt() ?: wp_trim_words(get_the_content(), 18, '...')); ?></p>
                                            <a class="recirculation-card-link fw-normal" href="<?php the_permalink(); ?>">
                                                Ver proposta <i class="bi bi-arrow-right-short" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </article>
                                </div>
                            <?php endforeach; ?>
                            <?php wp_reset_postdata(); ?>
                        </div>
                    </section>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>
