<?php
/**
 * Archive template for propostas.
 *
 * @package sena
 */

get_header();
?>
<main class="site-main section-space">
    <section class="container proposta-section">
        <?php
        get_template_part('template-parts/sections/section', 'page-hero', [
            'title'    => 'Propostas',
            'subtitle' => 'Conheça os compromissos da campanha para modernizar o CREA-GO e valorizar os profissionais.',
        ]);
        ?>
        <div class="mt-4">
            <?php get_template_part('template-parts/loops/loop', 'propostas', ['query' => $wp_query]); ?>
        </div>
        <nav class="mt-4" aria-label="Paginação de propostas" data-reveal>
            <?php
            the_posts_pagination([
                'mid_size'  => 1,
                'prev_text' => __('Anterior', 'sena'),
                'next_text' => __('Próximo', 'sena'),
            ]);
            ?>
        </nav>
    </section>
</main>
<?php
get_footer();
