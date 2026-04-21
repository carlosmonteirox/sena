<?php
/**
 * Basic SEO improvements.
 *
 * @package sena
 */

if (! defined('ABSPATH')) {
    exit;
}

function sena_print_meta_description(): void
{
    if (is_admin()) {
        return;
    }

    $default = 'Ulysses Sena - liderança, inovação e valorização profissional para um novo CREA em Goiás.';

    if (is_singular()) {
        $excerpt = wp_strip_all_tags(get_the_excerpt());
        $desc    = $excerpt ?: $default;
    } else {
        $desc = $default;
    }

    echo '<meta name="description" content="' . esc_attr(wp_trim_words($desc, 30, '...')) . '">' . "\n";
    echo '<meta name="keywords" content="CREA Goiás, engenharia em Goiás, profissionais do CREA, futuro do CREA">' . "\n";
}
add_action('wp_head', 'sena_print_meta_description', 1);

function sena_add_pingback_header(): void
{
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('wp_head', 'sena_add_pingback_header');
