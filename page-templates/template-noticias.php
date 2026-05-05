<?php
/**
 * Template Name: Notícias
 * Template Post Type: page
 *
 * @package sena
 */

get_header();

$paged = max(1, get_query_var('paged'), get_query_var('page'));
$news_query = sena_query_posts([
    'post_type'      => 'post',
    'posts_per_page' => 9,
    'paged'          => $paged,
]);

$page_title = __('Notícias', 'sena');
$page_subtitle = 'Artigos, posicionamentos e comunicados oficiais da campanha.';

if (have_posts()) {
    the_post();
    $page_title = get_the_title() ?: $page_title;
    $page_subtitle = get_the_excerpt() ?: $page_subtitle;
}
?>
<main class="site-main section-space">
    <section class="container section-news">
        <?php
        get_template_part('template-parts/sections/section', 'page-hero', [
            'title'    => $page_title,
            'subtitle' => $page_subtitle,
        ]);
        ?>

        <div class="mt-4">
            <?php
            get_template_part('template-parts/loops/loop', 'news-cards', [
                'query'         => $news_query,
                'empty_message' => 'Nenhuma notícia publicada ainda.',
            ]);
            ?>
        </div>

        <?php if ((int) $news_query->max_num_pages > 1) : ?>
            <nav class="my-4" aria-label="Paginação de notícias">
                <?php
                echo wp_kses_post(
                    paginate_links([
                        'total'   => (int) $news_query->max_num_pages,
                        'current' => $paged,
                        'type'    => 'list',
                    ])
                );
                ?>
            </nav>
        <?php endif; ?>
    </section>
</main>
<?php
get_footer();
