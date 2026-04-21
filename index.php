<?php
/**
 * Main template fallback.
 *
 * @package sena
 */

get_header();
?>
<main class="site-main py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <?php get_template_part('template-parts/loops/loop', 'posts'); ?>
            </div>
        </div>
    </div>
</main>
<?php
get_footer();
