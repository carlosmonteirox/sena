<?php
/**
 * Theme assets.
 *
 * @package sena
 */

if (! defined('ABSPATH')) {
    exit;
}

function sena_enqueue_assets(): void
{
    $theme_version = wp_get_theme()->get('Version');
    $main_style_deps  = ['bootstrap', 'bootstrap-icons'];
    $main_script_deps = ['bootstrap'];
    $is_avatar_maker = is_page_template('page-templates/template-foto-perfil.php');

    wp_enqueue_style(
        'sena-google-fonts',
        'https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100..900;1,100..900&display=swap',
        [],
        null
    );

    wp_enqueue_style(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css',
        [],
        '5.3.3'
    );

    wp_enqueue_style(
        'bootstrap-icons',
        'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css',
        ['bootstrap'],
        '1.11.3'
    );

    if (is_front_page()) {
        wp_enqueue_style(
            'swiper',
            'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
            [],
            '11.2.6'
        );

        wp_enqueue_script(
            'swiper',
            'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
            [],
            '11.2.6',
            true
        );

        $main_style_deps[]  = 'swiper';
        $main_script_deps[] = 'swiper';
    }

    wp_enqueue_style(
        'sena-main',
        get_template_directory_uri() . '/assets/css/main.css',
        $main_style_deps,
        $theme_version
    );

    wp_enqueue_style('sena-style', get_stylesheet_uri(), ['sena-main'], $theme_version);

    if ($is_avatar_maker) {
        wp_enqueue_style(
            'sena-avatar-maker',
            get_template_directory_uri() . '/assets/css/avatar-maker.css',
            ['sena-main'],
            $theme_version
        );
    }

    wp_enqueue_script(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js',
        [],
        '5.3.3',
        true
    );

    wp_enqueue_script(
        'sena-main',
        get_template_directory_uri() . '/assets/js/main.js',
        $main_script_deps,
        $theme_version,
        true
    );

    wp_localize_script('sena-main', 'senaData', [
        'reduceMotion' => wp_is_mobile() ? true : false,
    ]);

    if ($is_avatar_maker) {
        wp_enqueue_script(
            'sena-avatar-maker',
            get_template_directory_uri() . '/assets/js/avatar-maker.js',
            [],
            $theme_version,
            true
        );

        wp_localize_script('sena-avatar-maker', 'senaAvatarMaker', [
            'overlayUrl' => get_template_directory_uri() . '/assets/img/avatar-frame.png',
            'fileName'   => sanitize_title(get_bloginfo('name') ?: 'sena') . '-foto-perfil.png',
        ]);
    }
}
add_action('wp_enqueue_scripts', 'sena_enqueue_assets');
