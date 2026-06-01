<?php
/**
 * Custom post types and taxonomies.
 *
 * @package sena
 */

if (! defined('ABSPATH')) {
    exit;
}

function sena_register_campaign_cpts(): void
{
    register_post_type('sena_proposta', [
        'labels' => [
            'name'          => __('Propostas', 'sena'),
            'singular_name' => __('Proposta', 'sena'),
        ],
        'public'       => true,
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-yes-alt',
        'supports'     => ['title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'page-attributes'],
        'has_archive'  => true,
        'rewrite'      => ['slug' => 'propostas'],
    ]);

    register_taxonomy('proposta_tema', ['sena_proposta'], [
        'labels' => [
            'name'          => __('Temas das Propostas', 'sena'),
            'singular_name' => __('Tema', 'sena'),
        ],
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite'      => ['slug' => 'tema-proposta'],
    ]);

    register_post_type('sena_agenda', [
        'labels' => [
            'name'          => __('Agenda', 'sena'),
            'singular_name' => __('Evento', 'sena'),
        ],
        'public'       => true,
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-calendar-alt',
        'supports'     => ['title', 'editor', 'excerpt', 'thumbnail', 'revisions'],
        'has_archive'  => true,
        'rewrite'      => ['slug' => 'agenda'],
    ]);

    register_post_type('sena_depoimento', [
        'labels' => [
            'name'          => __('Depoimentos', 'sena'),
            'singular_name' => __('Depoimento', 'sena'),
        ],
        'public'       => true,
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-testimonial',
        'supports'     => ['title', 'editor', 'excerpt', 'thumbnail', 'revisions'],
        'has_archive'  => false,
        'rewrite'      => ['slug' => 'depoimentos'],
    ]);
}
add_action('init', 'sena_register_campaign_cpts');

function sena_order_propostas_listing(WP_Query $query): void
{
    if (! $query->is_main_query()) {
        return;
    }

    if (is_admin()) {
        if ('sena_proposta' !== $query->get('post_type') || $query->get('orderby')) {
            return;
        }
    } elseif (! $query->is_post_type_archive('sena_proposta')) {
        return;
    }

    $query->set('orderby', [
        'menu_order' => 'ASC',
        'ID'         => 'ASC',
    ]);
}
add_action('pre_get_posts', 'sena_order_propostas_listing');

function sena_add_proposta_order_column(array $columns): array
{
    $order_column = [
        'menu_order' => __('Ordem', 'sena'),
    ];
    $title_position = array_search('title', array_keys($columns), true);

    if (false === $title_position) {
        return array_merge($columns, $order_column);
    }

    $insert_position = $title_position + 1;

    return array_slice($columns, 0, $insert_position, true)
        + $order_column
        + array_slice($columns, $insert_position, null, true);
}
add_filter('manage_sena_proposta_posts_columns', 'sena_add_proposta_order_column');

function sena_render_proposta_order_column(string $column_name, int $post_id): void
{
    if ('menu_order' !== $column_name) {
        return;
    }

    echo esc_html((string) get_post_field('menu_order', $post_id));
}
add_action('manage_sena_proposta_posts_custom_column', 'sena_render_proposta_order_column', 10, 2);

function sena_make_proposta_order_column_sortable(array $columns): array
{
    $columns['menu_order'] = 'menu_order';

    return $columns;
}
add_filter('manage_edit-sena_proposta_sortable_columns', 'sena_make_proposta_order_column_sortable');

function sena_add_default_proposta_terms(): void
{
    $terms = [
        'Valorização da Engenharia',
        'Modernização do CREA',
        'Fiscalização Inteligente',
        'Apoio aos Profissionais',
    ];

    foreach ($terms as $term_name) {
        if (! term_exists($term_name, 'proposta_tema')) {
            wp_insert_term($term_name, 'proposta_tema');
        }
    }
}

function sena_after_switch_theme_tasks(): void
{
    sena_register_campaign_cpts();
    sena_add_default_proposta_terms();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'sena_after_switch_theme_tasks');
