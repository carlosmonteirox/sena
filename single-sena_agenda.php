<?php
/**
 * Single agenda event template.
 *
 * @package sena
 */

get_header();
?>
<main class="site-main section-space">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <?php
                while (have_posts()) :
                    the_post();
                    get_template_part('template-parts/content/content', 'sena-agenda');
                endwhile;
                ?>
            </div>
        </div>
    </div>
</main>
<?php
get_footer();
