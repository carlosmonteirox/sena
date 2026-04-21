<?php
/**
 * Archive template for agenda.
 *
 * @package sena
 */

get_header();
?>
<main class="site-main section-space">
    <section class="container">
        <?php
        get_template_part('template-parts/sections/section', 'page-hero', [
            'title'    => 'Agenda',
            'subtitle' => 'Acompanhe encontros, eventos, visitas e debates da campanha em Goiás.',
        ]);
        ?>
        <div class="mt-4">
            <?php get_template_part('template-parts/loops/loop', 'agenda', ['query' => $wp_query]); ?>
        </div>
    </section>
</main>
<?php
get_footer();
