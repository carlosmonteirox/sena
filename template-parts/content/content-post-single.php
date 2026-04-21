<?php

/**
 * Single post content.
 *
 * @package sena
 */

if (! defined('ABSPATH')) {
    exit;
}
?>

<div class="line-design">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
</div>

<div class="container-fluid py-lg-5 py-4 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">

                <article <?php post_class('single-article'); ?> data-reveal>

                    <header class="mb-4">    
                        <p class="eyebrow mb-2"><?php echo esc_html(get_the_date('d/m/Y')); ?></p>
                        <h1 class="display-6 fw-600 mb-3"><?php the_title(); ?></h1>

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="single-article-thumb mb-4">
                                <?php the_post_thumbnail('large', ['class' => 'img-fluid rounded-3', 'loading' => 'lazy']); ?>
                            </div>
                        <?php endif; ?>
                    </header>

                    <div class="entry-content">
                        <?php
                        the_content();
                        wp_link_pages([
                            'before' => '<div class="page-links">' . esc_html__('Páginas:', 'sena'),
                            'after'  => '</div>',
                        ]);
                        ?>
                    </div>
                    
                </article>

            </div>
        </div>
    </div>
</div>
