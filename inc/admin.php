<?php

/* STYLES NO ADMIN */
function custom_login_styles()
{
  wp_enqueue_style('custom-login-css', get_template_directory_uri() . '/assets/admin/login-style.css');
}
add_action('login_enqueue_scripts', 'custom_login_styles');


// Função para adicionar estilos CSS ao painel de administração do WordPress
function custom_admin_styles()
{
  if (is_admin()) {
    wp_enqueue_style('custom-admin-css', get_template_directory_uri() . '/assets/admin/admin-style.css');
  }
}
add_action('admin_enqueue_scripts', 'custom_admin_styles');

// Enfileira os scripts necessários para a biblioteca de mídia
function enqueue_media_uploader()
{
  wp_enqueue_media();
  // wp_enqueue_script('my-admin-js', get_template_directory_uri() . '/assets/admin/admin-script.js', array('jquery'), null, true);
}
add_action('admin_enqueue_scripts', 'enqueue_media_uploader');
