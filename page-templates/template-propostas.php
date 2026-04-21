<?php
/**
 * Template Name: Propostas
 * Template Post Type: page
 *
 * @package sena
 */

get_header();

$propostas_query = sena_query_posts([
    'post_type'      => 'sena_proposta',
    'posts_per_page' => 12,
]);

while (have_posts()) :
    the_post();
?>
<main class="site-main section-space">
    <section class="container">
        <?php
        get_template_part('template-parts/sections/section', 'page-hero', [
            'title'    => get_the_title(),
            'subtitle' => get_the_excerpt() ?: 'Propostas claras, objetivas e orientadas ao impacto real para os profissionais do CREA-GO.',
        ]);
        ?>
        <div class="card-blur p-4 p-lg-5 mt-4" data-reveal>
            <div class="entry-content"><?php the_content(); ?></div>
        </div>
    </section>

    <section class="container mt-5">
        <div class="row g-4 mb-4">
            <div class="col-md-6 col-lg-3" data-reveal>
                <div class="topic-pill h-100">
                    <h3 class="h6">Valorização da Engenharia</h3>
                    <p class="small mb-0">Defesa profissional e geração de oportunidades.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-reveal>
                <div class="topic-pill h-100">
                    <h3 class="h6">Modernização do CREA</h3>
                    <p class="small mb-0">Digitalização, transparência e simplificação.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-reveal>
                <div class="topic-pill h-100">
                    <h3 class="h6">Fiscalização Inteligente</h3>
                    <p class="small mb-0">Tecnologia e eficiência para melhores resultados.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-reveal>
                <div class="topic-pill h-100">
                    <h3 class="h6">Apoio aos profissionais</h3>
                    <p class="small mb-0">Capacitação contínua e conexão com o mercado.</p>
                </div>
            </div>
        </div>

        <?php get_template_part('template-parts/loops/loop', 'propostas', ['query' => $propostas_query]); ?>
    </section>
</main>
<?php
endwhile;
wp_reset_postdata();

get_footer();
