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
    'posts_per_page' => -1,
    'orderby'        => 'ID',
    'order'          => 'ASC',
]);

$proposta_terms = get_terms([
    'taxonomy'   => 'proposta_tema',
    'hide_empty' => false,
]);

while (have_posts()) :
    the_post();
?>
<main class="site-main section-space">
    <section class="container proposta-section">
        <?php
        get_template_part('template-parts/sections/section', 'page-hero', [
            'title'    => get_the_title(),
            'subtitle' => get_the_excerpt() ?: 'Propostas claras, objetivas e orientadas ao impacto real para os profissionais do CREA-GO.',
        ]);
        ?>

        <?php if (trim(get_the_content()) !== '') : ?>
            <div class="card-blur p-4 p-lg-5 mt-4" data-reveal>
                <div class="entry-content"><?php the_content(); ?></div>
            </div>
        <?php endif; ?>
    </section>

    <section class="container proposta-section mt-5">
        <?php if (! is_wp_error($proposta_terms) && ! empty($proposta_terms)) : ?>
            <div class="row g-4 mb-4">
                <?php foreach ($proposta_terms as $term) : ?>
                    <div class="col-md-6 col-lg-3" data-reveal>
                        <div class="topic-pill h-100">
                            <h3 class="h6"><?php echo esc_html($term->name); ?></h3>
                            <p class="small mb-0">
                                <?php
                                printf(
                                    esc_html(_n('%s proposta cadastrada', '%s propostas cadastradas', (int) $term->count, 'sena')),
                                    esc_html(number_format_i18n((int) $term->count))
                                );
                                ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="d-flex flex-wrap align-items-end justify-content-between gap-3 mb-4" data-reveal>
            <div>
                <p class="eyebrow mb-2">Compromissos cadastrados</p>
                <h2 class="h3 fw-700 mb-0">Todas as propostas</h2>
            </div>
        </div>

        <?php
        get_template_part('template-parts/loops/loop', 'propostas', [
            'query'         => $propostas_query,
            'empty_message' => 'Nenhuma proposta cadastrada ainda.',
        ]);
        ?>
    </section>
</main>
<?php
endwhile;

get_footer();
