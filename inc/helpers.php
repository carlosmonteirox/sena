<?php
/**
 * Helper functions.
 *
 * @package sena
 */

if (! defined('ABSPATH')) {
    exit;
}

function sena_fallback_menu(): void
{
    echo '<ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center gap-lg-2">';
    echo '<li class="nav-item"><a class="nav-link" href="' . esc_url(home_url('/')) . '">Início</a></li>';
    echo '<li class="nav-item"><a class="nav-link" href="' . esc_url(home_url('/sobre-ulysses/')) . '">Sobre</a></li>';
    echo '<li class="nav-item"><a class="nav-link" href="' . esc_url(home_url('/propostas/')) . '">Propostas</a></li>';
    echo '<li class="nav-item"><a class="nav-link" href="' . esc_url(home_url('/agenda/')) . '">Agenda</a></li>';
    echo '<li class="nav-item"><a class="nav-link" href="' . esc_url(home_url('/contato/')) . '">Contato</a></li>';
    echo '</ul>';
}

function sena_fallback_footer_menu(): void
{
    echo '<ul class="footer-menu list-unstyled mb-0">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">Início</a></li>';
    echo '<li><a href="' . esc_url(home_url('/sobre-ulysses/')) . '">Sobre Ulysses</a></li>';
    echo '<li><a href="' . esc_url(home_url('/propostas/')) . '">Propostas</a></li>';
    echo '<li><a href="' . esc_url(home_url('/agenda/')) . '">Agenda</a></li>';
    echo '<li><a href="' . esc_url(home_url('/noticias/')) . '">Notícias</a></li>';
    echo '<li><a href="' . esc_url(home_url('/apoie-o-movimento/')) . '">Apoie o Movimento</a></li>';
    echo '<li><a href="' . esc_url(home_url('/contato/')) . '">Contato</a></li>';
    echo '</ul>';
}

function sena_whatsapp_link(): string
{
    // $phone   = preg_replace('/\D+/', '', (string) get_theme_mod('sena_whatsapp_number', '5562999999999'));
    // $message = rawurlencode((string) get_theme_mod('sena_whatsapp_message', 'Olá! Quero saber mais sobre o movimento.'));
    // return sprintf('https://wa.me/%s?text=%s', $phone, $message);
    
    return 'https://chat.whatsapp.com/Bq6t7wB3J7cCi3ZHdNztsB?mode=gi_t';
}

function sena_page_intro_title(?string $fallback = null): string
{
    if (is_singular()) {
        $title = get_the_title();
        return $title ? $title : ($fallback ?: '');
    }

    return $fallback ?: '';
}

function sena_get_breadcrumb_items(?string $current_label = null): array
{
    if (is_front_page()) {
        return [];
    }

    $items = [
        [
            'label' => __('Início', 'sena'),
            'url'   => home_url('/'),
        ],
    ];

    $current_label = $current_label ? wp_strip_all_tags($current_label) : '';

    if (is_home()) {
        $posts_page_id = (int) get_option('page_for_posts');
        $items[] = [
            'label' => $posts_page_id ? get_the_title($posts_page_id) : ($current_label ?: __('Notícias', 'sena')),
            'url'   => '',
        ];

        return $items;
    }

    if (is_page()) {
        $page_id = get_queried_object_id();

        foreach (array_reverse(get_post_ancestors($page_id)) as $ancestor_id) {
            $items[] = [
                'label' => get_the_title($ancestor_id),
                'url'   => get_permalink($ancestor_id),
            ];
        }

        $items[] = [
            'label' => $current_label ?: get_the_title($page_id),
            'url'   => '',
        ];

        return $items;
    }

    if (is_singular('post')) {
        $posts_page_id = (int) get_option('page_for_posts');

        if ($posts_page_id) {
            $items[] = [
                'label' => get_the_title($posts_page_id),
                'url'   => get_permalink($posts_page_id),
            ];
        }

        $items[] = [
            'label' => $current_label ?: get_the_title(),
            'url'   => '',
        ];

        return $items;
    }

    if (is_singular()) {
        $post_type = get_post_type();
        $post_type_object = $post_type ? get_post_type_object($post_type) : null;

        if ($post_type_object && $post_type_object->has_archive) {
            $items[] = [
                'label' => $post_type_object->labels->name,
                'url'   => get_post_type_archive_link($post_type) ?: '',
            ];
        }

        $items[] = [
            'label' => $current_label ?: get_the_title(),
            'url'   => '',
        ];

        return $items;
    }

    if (is_category() || is_tag() || is_tax()) {
        $term = get_queried_object();

        if ($term instanceof WP_Term && is_taxonomy_hierarchical($term->taxonomy)) {
            foreach (array_reverse(get_ancestors($term->term_id, $term->taxonomy, 'taxonomy')) as $ancestor_id) {
                $ancestor = get_term($ancestor_id, $term->taxonomy);

                if ($ancestor instanceof WP_Term && ! is_wp_error($ancestor)) {
                    $ancestor_link = get_term_link($ancestor);

                    $items[] = [
                        'label' => $ancestor->name,
                        'url'   => is_wp_error($ancestor_link) ? '' : $ancestor_link,
                    ];
                }
            }
        }

        $items[] = [
            'label' => $current_label ?: single_term_title('', false),
            'url'   => '',
        ];

        return $items;
    }

    if (is_post_type_archive()) {
        $items[] = [
            'label' => $current_label ?: post_type_archive_title('', false),
            'url'   => '',
        ];

        return $items;
    }

    if (is_archive()) {
        $items[] = [
            'label' => $current_label ?: get_the_archive_title(),
            'url'   => '',
        ];

        return $items;
    }

    if (is_search()) {
        $items[] = [
            'label' => sprintf(__('Busca por "%s"', 'sena'), get_search_query()),
            'url'   => '',
        ];

        return $items;
    }

    if (is_404()) {
        $items[] = [
            'label' => __('Página não encontrada', 'sena'),
            'url'   => '',
        ];

        return $items;
    }

    if ($current_label !== '') {
        $items[] = [
            'label' => $current_label,
            'url'   => '',
        ];
    }

    return $items;
}

function sena_render_breadcrumb(?string $current_label = null, string $class = 'mb-3'): void
{
    $items = sena_get_breadcrumb_items($current_label);

    if (count($items) <= 1) {
        return;
    }
    ?>
    <nav class="site-breadcrumb <?php echo esc_attr($class); ?>" aria-label="<?php esc_attr_e('Breadcrumb', 'sena'); ?>">
        <ol class="site-breadcrumb-list">
            <?php foreach ($items as $index => $item) : ?>
                <?php $is_current = $index === array_key_last($items); ?>
                <li class="site-breadcrumb-item" <?php echo $is_current ? 'aria-current="page"' : ''; ?>>
                    <?php if (! $is_current && ! empty($item['url'])) : ?>
                        <a href="<?php echo esc_url($item['url']); ?>"><?php echo esc_html($item['label']); ?></a>
                    <?php else : ?>
                        <span><?php echo esc_html($item['label']); ?></span>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ol>
    </nav>
    <?php
}

function sena_query_posts(array $args): WP_Query
{
    $defaults = [
        'post_status'         => 'publish',
        'ignore_sticky_posts' => true,
    ];

    return new WP_Query(wp_parse_args($args, $defaults));
}
