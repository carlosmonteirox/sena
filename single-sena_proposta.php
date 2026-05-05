<?php
/**
 * Single proposta template.
 *
 * @package sena
 */

get_header();
?>
<main class="site-main section-space">
    <?php
    while (have_posts()) :
        the_post();
        get_template_part('template-parts/content/content', 'sena-proposta');
    endwhile;
    ?>
</main>
<?php
get_footer();
