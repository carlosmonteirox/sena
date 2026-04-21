<?php
/**
 * Public forms handling.
 *
 * @package sena
 */

if (! defined('ABSPATH')) {
    exit;
}

add_action('admin_post_nopriv_sena_submit_form', 'sena_handle_public_form');
add_action('admin_post_sena_submit_form', 'sena_handle_public_form');

function sena_handle_public_form(): void
{
    $referer = wp_get_referer() ?: home_url('/');

    if (! isset($_POST['sena_form_nonce']) || ! wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['sena_form_nonce'])), 'sena_submit_form')) {
        sena_redirect_with_status($referer, 'error');
    }

    $form_type = isset($_POST['form_type']) ? sanitize_text_field(wp_unslash($_POST['form_type'])) : 'geral';

    $payload = [
        'Nome'            => isset($_POST['nome']) ? sanitize_text_field(wp_unslash($_POST['nome'])) : '',
        'Profissão'       => isset($_POST['profissao']) ? sanitize_text_field(wp_unslash($_POST['profissao'])) : '',
        'Cidade'          => isset($_POST['cidade']) ? sanitize_text_field(wp_unslash($_POST['cidade'])) : '',
        'Área de atuação' => isset($_POST['area']) ? sanitize_text_field(wp_unslash($_POST['area'])) : '',
        'Telefone'        => isset($_POST['telefone']) ? sanitize_text_field(wp_unslash($_POST['telefone'])) : '',
        'E-mail'          => isset($_POST['email']) ? sanitize_email(wp_unslash($_POST['email'])) : '',
        'Mensagem'        => isset($_POST['mensagem']) ? sanitize_textarea_field(wp_unslash($_POST['mensagem'])) : '',
        'Interesse'       => isset($_POST['interesse']) ? sanitize_text_field(wp_unslash($_POST['interesse'])) : '',
    ];

    if (empty($payload['Nome']) || empty($payload['E-mail'])) {
        sena_redirect_with_status($referer, 'invalid');
    }

    $subject = sprintf('[Site Ulysses Sena] Novo contato (%s)', $form_type);
    $message = "Novo envio do site:\n\n";

    foreach ($payload as $label => $value) {
        if (! empty($value)) {
            $message .= sprintf("%s: %s\n", $label, $value);
        }
    }

    $headers = ['Content-Type: text/plain; charset=UTF-8'];
    $sent    = wp_mail(get_option('admin_email'), $subject, $message, $headers);

    sena_redirect_with_status($referer, $sent ? 'success' : 'error');
}

function sena_redirect_with_status(string $url, string $status): void
{
    $target = add_query_arg('form_status', $status, $url);
    wp_safe_redirect($target);
    exit;
}

function sena_render_form_feedback(): void
{
    if (! isset($_GET['form_status'])) {
        return;
    }

    $status = sanitize_text_field(wp_unslash($_GET['form_status']));

    $messages = [
        'success' => ['success', 'Mensagem enviada com sucesso. Em breve entraremos em contato.'],
        'invalid' => ['warning', 'Preencha ao menos nome e e-mail para continuar.'],
        'error'   => ['danger', 'Não foi possível enviar agora. Tente novamente em instantes.'],
    ];

    if (! isset($messages[$status])) {
        return;
    }

    [$type, $text] = $messages[$status];
    printf('<div class="alert alert-%1$s mb-4" role="alert">%2$s</div>', esc_attr($type), esc_html($text));
}
