<?php

/**
 * Single post content.
 *
 * @package sena
 */

if (! defined('ABSPATH')) {
    exit;
}

$current_post_id = get_the_ID();
$recirculation_posts = [];
$recirculation_ids = [];
$category_ids = wp_get_post_categories($current_post_id, ['fields' => 'ids']);
$base_recirculation_args = [
    'post_type'           => 'post',
    'posts_per_page'      => 3,
    'post_status'         => 'publish',
    'post__not_in'        => [$current_post_id],
    'ignore_sticky_posts' => true,
    'no_found_rows'       => true,
];

if (! empty($category_ids)) {
    $category_query = sena_query_posts(wp_parse_args([
        'category__in' => array_map('absint', $category_ids),
    ], $base_recirculation_args));

    while ($category_query->have_posts()) {
        $category_query->the_post();
        $recirculation_posts[] = get_post();
        $recirculation_ids[] = get_the_ID();
    }

    wp_reset_postdata();
}

$remaining_recirculation_posts = 3 - count($recirculation_posts);

if ($remaining_recirculation_posts > 0) {
    $fallback_query = sena_query_posts(wp_parse_args([
        'posts_per_page' => $remaining_recirculation_posts,
        'post__not_in'   => array_merge([$current_post_id], $recirculation_ids),
    ], $base_recirculation_args));

    while ($fallback_query->have_posts()) {
        $fallback_query->the_post();
        $recirculation_posts[] = get_post();
    }

    wp_reset_postdata();
}

$posts_page_id = (int) get_option('page_for_posts');
$posts_page_url = $posts_page_id ? get_permalink($posts_page_id) : home_url('/noticias/');

if (! $posts_page_url) {
    $posts_page_url = home_url('/noticias/');
}
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
                        <h1 class="display-6 fw-600 mb-2"><?php the_title(); ?></h1>
                        <div class="eyebrow text-muted mb-2" style="font-size: 12px;"><?php echo esc_html(get_the_date('d/m/Y')); ?></div>

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

                <?php if (! empty($recirculation_posts)) : ?>
                    <section class="post-recirculation my-md-5 py-md-5 my-4 py-4" aria-labelledby="post-recirculation-title" data-reveal>
                        <div class="post-recirculation-header">
                            <div>
                                <p class="eyebrow mb-2">Continue navegando</p>
                                <h2 class="h3 fw-700 mb-0" id="post-recirculation-title">Mais conteúdos para você</h2>
                            </div>
                            <a class="post-recirculation-all fw-normal" href="<?php echo esc_url($posts_page_url); ?>">
                                Ver todas <i class="bi bi-arrow-right-short" aria-hidden="true"></i>
                            </a>
                        </div>

                        <div class="row g-3 g-lg-4">
                            <?php foreach ($recirculation_posts as $recirculation_post) : ?>
                                <?php
                                $post = $recirculation_post; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
                                setup_postdata($post);
                                ?>
                                <div class="col-md-6 col-lg-4">
                                    <article <?php post_class('recirculation-card'); ?>>
                                        <a class="recirculation-card-image" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <?php the_post_thumbnail('sena-card', ['class' => 'img-fluid', 'loading' => 'lazy']); ?>
                                            <?php else : ?>
                                                <span class="recirculation-card-placeholder"><i class="bi bi-newspaper" aria-hidden="true"></i></span>
                                            <?php endif; ?>
                                        </a>
                                        <div class="recirculation-card-body">
                                            <p class="recirculation-card-date fw-normal d-none"><?php echo esc_html(get_the_date('d/m/Y')); ?></p>
                                            <h3 class="recirculation-card-title">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h3>
                                            <p class="recirculation-card-excerpt"><?php echo esc_html(get_the_excerpt() ?: wp_trim_words(get_the_content(), 18, '...')); ?></p>
                                            <a class="recirculation-card-link fw-normal" href="<?php the_permalink(); ?>">
                                                Continuar lendo <i class="bi bi-arrow-right-short" aria-hidden="true"></i>
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
