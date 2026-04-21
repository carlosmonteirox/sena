<?php
/**
 * Default page template.
 *
 * @package sena
 */

get_header();
?>
<main class="site-main section-space">

    <div class="line-design">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>

    <div class="container-fluid">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <?php
                    while (have_posts()) :
                        the_post();
                        get_template_part('template-parts/content/content', 'page-default');
                    endwhile;
                    ?>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
get_footer();
