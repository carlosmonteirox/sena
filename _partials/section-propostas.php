<?php
/**
 * Home propostas section.
 *
 * @package sena
 */

if (! defined('ABSPATH')) {
    exit;
}

$propostas_query = sena_query_posts([
    'post_type'      => 'sena_proposta',
    'posts_per_page' => 6,
]);
?>
<section class="section-space proposta-section py-md-5 py-4" id="propostas">
    <div class="container-fluid py-md-5 py-4">

        <div class="container position-relative z-3 mb-3">
            <div class="d-flex flex-wrap justify-content-between align-items-end mb-4 gap-3" data-reveal>
                <div>
                    <p class="eyebrow mb-2">Compromissos com impacto direto na classe</p>
                    <h2 class="h1 display-4 fw-bold section-title mb-3" style="color: var(--sena-blue-700);">Propostas Principais</h2>
                </div>
                <a class="btn btn-outline-primary" href="<?php echo esc_url(home_url('/propostas/')); ?>">Ver página completa</a>
            </div>
        </div>

        <div class="container">
            <?php get_template_part('template-parts/loops/loop', 'propostas', ['query' => $propostas_query]); ?>
        </div>

    </div>
</section>
<?php wp_reset_postdata(); ?>
