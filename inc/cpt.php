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
        'supports'     => ['title', 'editor', 'excerpt', 'thumbnail', 'revisions'],
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
