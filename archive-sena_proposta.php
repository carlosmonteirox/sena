<?php
/**
 * Archive template for propostas.
 *
 * @package sena
 */

get_header();
?>
<main class="site-main section-space">
    <section class="container">
        <?php
        get_template_part('template-parts/sections/section', 'page-hero', [
            'title'    => 'Propostas',
            'subtitle' => 'Conheça os compromissos da campanha para modernizar o CREA-GO e valorizar os profissionais.',
        ]);
        ?>
        <div class="mt-4">
            <?php get_template_part('template-parts/loops/loop', 'propostas', ['query' => $wp_query]); ?>
        </div>
    </section>
</main>
<?php
get_footer();
