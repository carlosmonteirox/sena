<?php

/**
 * Theme header.
 *
 * @package sena
 */

if (! defined('ABSPATH')) {
  exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>

  <style>
    .pagination .page-numbers {
      min-width: 44px !important;
      height: 44px !important;
      padding: 12px !important;
      margin-right: 5px !important;
      border-radius: 15px !important;
      font-weight: 500 !important;
      font-size: 14px !important;
    }
  </style>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <header class="site-header sticky-top" id="siteHeader">
    <nav class="navbar navbar-expand-lg py-3">
      <div class="container-fluid">
        <div class="container">
          <div class="w-100 d-flex align-items-center justify-content-between">

            <div class="d-flex gap-3">
              <a class="navbar-brand me-3" href="<?php echo esc_url(home_url('/')); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-ulysses.webp" alt="Logo" height="44">
              </a>
            </div>

            <div class="d-flex gap-3">
              <div class="collapse navbar-collapse" id="mainMenu">
                <?php
                wp_nav_menu([
                  'theme_location' => 'primary',
                  'container'      => false,
                  'menu_class'     => 'navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center gap-lg-3',
                  'fallback_cb'    => 'sena_fallback_menu',
                  'depth'          => 2,
                ]);
                ?>
              </div>
            </div>

            <div class="d-flex gap-3">
              <a class="btn btn-whatsapp d-lg-inline-block d-md-none d-none" 
                href="<?php echo esc_url(sena_whatsapp_link()); ?>" 
                target="_blank" 
                rel="noopener noreferrer">
                <i class="bi bi-whatsapp me-1"></i>
                Canal WhatsApp
              </a>

              <div class="d-flex gap-1">
                <a href="#" 
                  target="_blank" 
                  class="btn btn-light bg-transparent border-0 btn-icon d-lg-none d-md-inline-block d-inline-block">
                  <i class="bi bi-whatsapp"></i>
                </a>
                <a href="https://www.instagram.com/eng.ulysses.sena/" 
                  target="_blank" 
                  rel="me"
                  class="btn btn-light bg-transparent border-0 btn-icon d-md-inline-block d-none">
                  <i class="bi bi-instagram"></i>
                </a>
                <a href="https://www.facebook.com/ulysses.sena.001" 
                  target="_blank" 
                  rel="me"
                  class="btn btn-light bg-transparent border-0 btn-icon d-md-inline-block d-none">
                  <i class="bi bi-facebook"></i>
                </a>
              </div>

              <button class="navbar-toggler btn btn-light bg-transparent border-0 btn-icon" 
                type="button" 
                data-bs-toggle="collapse" 
                data-bs-target="#mainMenu" 
                aria-controls="mainMenu" aria-expanded="false" aria-label="<?php esc_attr_e('Abrir menu', 'sena'); ?>">
                <span class="navbar-toggler-icon"></span>
              </button>
            </div>

          </div>
        </div>
      </div>
    </nav>
  </header>

  <div class="site-shell">
