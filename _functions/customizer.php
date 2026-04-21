<?php
/**
 * Theme customizer settings.
 *
 * @package sena
 */

if (! defined('ABSPATH')) {
    exit;
}

function sena_customize_register(WP_Customize_Manager $wp_customize): void
{
    $wp_customize->add_section('sena_campaign_settings', [
        'title'       => __('Configurações da Campanha', 'sena'),
        'priority'    => 30,
        'description' => __('Defina canais e integrações básicas do site.', 'sena'),
    ]);

    $wp_customize->add_setting('sena_whatsapp_number', [
        'default'           => '5562999999999',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('sena_whatsapp_number', [
        'label'   => __('Número do WhatsApp (com DDI)', 'sena'),
        'section' => 'sena_campaign_settings',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('sena_whatsapp_message', [
        'default'           => 'Olá! Quero saber mais sobre o movimento.',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('sena_whatsapp_message', [
        'label'   => __('Mensagem padrão do WhatsApp', 'sena'),
        'section' => 'sena_campaign_settings',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('sena_analytics_id', [
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('sena_analytics_id', [
        'label'       => __('Google Analytics ID (GA4)', 'sena'),
        'description' => __('Exemplo: G-XXXXXXXXXX', 'sena'),
        'section'     => 'sena_campaign_settings',
        'type'        => 'text',
    ]);
}
add_action('customize_register', 'sena_customize_register');

function sena_output_analytics_script(): void
{
    $analytics_id = trim((string) get_theme_mod('sena_analytics_id', ''));

    if ($analytics_id === '' || is_admin()) {
        return;
    }
    ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr($analytics_id); ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '<?php echo esc_js($analytics_id); ?>');
    </script>
    <?php
}
add_action('wp_head', 'sena_output_analytics_script', 20);
