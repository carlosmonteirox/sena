<?php
/**
 * Archive template.
 *
 * @package sena
 */

get_header();
?>
<main class="site-main section-space">
    <section class="container">
        <?php
        get_template_part('template-parts/sections/section', 'page-hero', [
            'title'    => get_the_archive_title(),
            'subtitle' => get_the_archive_description() ?: 'Acompanhe os conteúdos e atualizações da campanha.',
        ]);
        ?>
        <div class="row g-4 mt-1">
            <div class="col-lg-8">
                <?php get_template_part('template-parts/loops/loop', 'posts'); ?>
            </div>
            <aside class="col-lg-4">
                <?php get_sidebar(); ?>
            </aside>
        </div>
    </section>
</main>
<?php
get_footer();
