<?php
/**
 * Home apoio section.
 *
 * @package sena
 */

if (! defined('ABSPATH')) {
    exit;
}

$apoio_query = sena_query_posts([
    'post_type'      => 'sena_depoimento',
    'posts_per_page' => -1,
]);
?>
<section class="section-space section-apoio py-md-5 py-4 hero-section" id="apoio">
    <div class="container-fluid pt-md-5 pt-4">
        <div class="container position-relative z-3">
            <div class="d-flex flex-wrap justify-content-between align-items-end mb-4 gap-3" data-reveal>
                <div>
                    <p class="eyebrow mb-2">Apoio da Classe</p>
                    <h2 class="h1 display-4 fw-bold section-title mb-1" style="color: var(--sena-blue-700);">Profissionais que acreditam em um novo ciclo</h2>
                </div>
            </div>
        </div>
    </div>
    <?php get_template_part('template-parts/loops/loop', 'depoimentos', ['query' => $apoio_query]); ?>
</section>
<?php wp_reset_postdata(); ?>
