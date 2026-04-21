<?php
/**
 * Template Name: Sobre Ulysses
 * Template Post Type: page
 *
 * @package sena
 */

get_header();

while (have_posts()) :
    the_post();
?>
<main class="site-main section-space">
    <section class="container">
        <?php
        get_template_part('template-parts/sections/section', 'page-hero', [
            'title'    => get_the_title(),
            'subtitle' => get_the_excerpt() ?: 'Biografia, formação e visão de gestão para um CREA-GO mais forte.',
        ]);
        ?>
        <div class="row g-4 mt-1">
            <div class="col-lg-7" data-reveal>
                <div class="card-blur p-4 p-lg-5 h-100">
                    <h2 class="h4 mb-3">Trajetória profissional</h2>
                    <div class="entry-content mb-4"><?php the_content(); ?></div>
                    <h3 class="h5 mb-3">Visão de gestão</h3>
                    <p class="mb-0 text-muted">Gestão transparente, digital e próxima dos profissionais, com decisões orientadas por dados e resultados concretos.</p>
                </div>
            </div>
            <div class="col-lg-5" data-reveal>
                <div class="about-photo card-blur p-3 h-100">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/ulysses-placeholder.svg'); ?>" alt="Ulysses Sena" class="img-fluid rounded-4" loading="lazy" width="560" height="700">
                </div>
            </div>
        </div>
    </section>

    <section class="container mt-5">
        <div class="card-blur p-4 p-lg-5" data-reveal>
            <p class="eyebrow mb-2">Linha do tempo</p>
            <h2 class="h3 mb-4">Formação e liderança no sistema CREA</h2>
            <div class="timeline timeline-light">
                <article class="timeline-item">
                    <span class="timeline-year">Formação</span>
                    <p class="mb-0">Base técnica sólida e compromisso com excelência profissional.</p>
                </article>
                <article class="timeline-item">
                    <span class="timeline-year">Experiência</span>
                    <p class="mb-0">Atuação em projetos e ambientes de alta responsabilidade técnica.</p>
                </article>
                <article class="timeline-item">
                    <span class="timeline-year">Sistema CREA</span>
                    <p class="mb-0">Participação ativa em pautas de valorização e modernização do conselho.</p>
                </article>
                <article class="timeline-item">
                    <span class="timeline-year">2026</span>
                    <p class="mb-0">Proposta de gestão com foco em eficiência, inovação e proximidade com a classe.</p>
                </article>
            </div>
        </div>
    </section>
</main>
<?php
endwhile;

get_footer();
