<?php
/**
 * Blog index template.
 *
 * @package sena
 */

get_header();
?>
<main class="site-main section-space">
    <section class="container section-news">
        <?php
        get_template_part('template-parts/sections/section', 'page-hero', [
            'title'    => 'Notícias e Atualizações',
            'subtitle' => 'Agenda, posicionamentos e participação em eventos para fortalecer o diálogo com os profissionais.',
        ]);
        ?>
        <div class="mt-4">
            <?php get_template_part('template-parts/loops/loop', 'news-cards'); ?>
        </div>
        <nav class="mt-4" aria-label="Paginação de notícias" data-reveal>
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
