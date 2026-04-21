<?php
/**
 * Theme setup.
 *
 * @package sena
 */

if (! defined('ABSPATH')) {
    exit;
}

function sena_theme_setup(): void
{
    load_theme_textdomain('sena', get_template_directory() . '/languages');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', [
        'height'      => 60,
        'width'       => 240,
        'flex-height' => true,
        'flex-width'  => true,
    ]);
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);

    register_nav_menus([
        'primary' => __('Menu Principal', 'sena'),
        'footer'  => __('Menu Rodapé', 'sena'),
    ]);

    add_image_size('sena-card', 720, 480, true);
    add_image_size('sena-hero', 1920, 1080, true);
}
add_action('after_setup_theme', 'sena_theme_setup');

function sena_widgets_init(): void
{
    register_sidebar([
        'name'          => __('Sidebar Principal', 'sena'),
        'id'            => 'primary-sidebar',
        'before_widget' => '<section class="widget-card mb-4">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="h6 mb-3">',
        'after_title'   => '</h3>',
    ]);
}
add_action('widgets_init', 'sena_widgets_init');
