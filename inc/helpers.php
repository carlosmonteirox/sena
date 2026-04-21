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
    $phone   = preg_replace('/\D+/', '', (string) get_theme_mod('sena_whatsapp_number', '5562999999999'));
    $message = rawurlencode((string) get_theme_mod('sena_whatsapp_message', 'Olá! Quero saber mais sobre o movimento.'));

    return sprintf('https://wa.me/%s?text=%s', $phone, $message);
}

function sena_page_intro_title(?string $fallback = null): string
{
    if (is_singular()) {
        $title = get_the_title();
        return $title ? $title : ($fallback ?: '');
    }

    return $fallback ?: '';
}

function sena_query_posts(array $args): WP_Query
{
    $defaults = [
        'post_status'         => 'publish',
        'ignore_sticky_posts' => true,
    ];

    return new WP_Query(wp_parse_args($args, $defaults));
}
