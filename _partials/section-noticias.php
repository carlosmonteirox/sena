<?php
/**
 * Home noticias section.
 *
 * @package sena
 */

if (! defined('ABSPATH')) {
    exit;
}

$news_query = sena_query_posts([
    'post_type'      => 'post',
    'posts_per_page' => 3,
]);
?>
<section class="section-space section-news py-md-5 py-4" id="noticias">
    <div class="container-fluid py-md-5 py-4">
        <div class="container position-relative z-3">

            <div class="d-flex flex-wrap justify-content-between align-items-end mb-4 gap-3" data-reveal>
                <div>
                    <h2 class="h1 display-4 fw-bold section-title mb-1" style="color: var(--sena-blue-700);">Blog</h2>
                    <p class="eyebrow mb-2">Fique por dentro dos principais assuntos</p>
                </div>
                <a class="btn btn-outline-primary" href="<?php echo esc_url(get_permalink(get_option('page_for_posts')) ?: home_url('/noticias/')); ?>">Acessar blog</a>
            </div>

            <div class="row gx-4">
                <?php if ($news_query->have_posts()) : ?>
                    <?php while ($news_query->have_posts()) : $news_query->the_post(); ?>
                        <div class="col-md-6 col-lg-4" data-reveal>
                            <?php get_template_part('template-parts/content/content', 'post-card'); ?>
                        </div>
                    <?php endwhile; ?>
                <?php else : ?>
                    <div class="col-12" data-reveal>
                        <div class="alert alert-secondary mb-0">Publique notícias no WordPress para preencher esta seção automaticamente.</div>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>
<?php wp_reset_postdata(); ?>