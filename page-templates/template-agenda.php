<?php
/**
 * Template Name: Agenda
 * Template Post Type: page
 *
 * @package sena
 */

get_header();

$agenda_query = sena_query_posts([
    'post_type'      => 'sena_agenda',
    'posts_per_page' => 10,
    'orderby'        => 'date',
    'order'          => 'DESC',
]);

while (have_posts()) :
    the_post();
?>
<main class="site-main section-space">
    <section class="container">
        <?php
        get_template_part('template-parts/sections/section', 'page-hero', [
            'title'    => get_the_title(),
            'subtitle' => get_the_excerpt() ?: 'Calendário de encontros, eventos e visitas em todo o estado de Goiás.',
        ]);
        ?>
        <div class="row g-4 mt-1">
            <div class="col-lg-8">
                <?php get_template_part('template-parts/loops/loop', 'agenda', ['query' => $agenda_query]); ?>
            </div>
            <div class="col-lg-4" data-reveal>
                <div class="card-blur p-4 h-100">
                    <h2 class="h5 mb-3">Mapa interativo de Goiás</h2>
                    <p class="text-muted mb-3">Espaço preparado para incorporar mapa com cidades e eventos regionais.</p>
                    <div class="map-placeholder d-flex align-items-center justify-content-center rounded-4">
                        <span class="small text-muted">Embed do mapa</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php
endwhile;
wp_reset_postdata();

get_footer();
