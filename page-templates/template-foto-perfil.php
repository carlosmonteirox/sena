<?php
/**
 * Template Name: Foto de Perfil
 * Template Post Type: page
 *
 * @package sena
 */

if (! defined('ABSPATH')) {
    exit;
}

get_header();

while (have_posts()) :
    the_post();
    $page_title = get_the_title() ?: __('Foto de Perfil', 'sena');
    $subtitle = get_the_excerpt() ?: __('Escolha uma foto, ajuste o enquadramento e baixe a imagem pronta para usar nas redes sociais.', 'sena');
    ?>
    <main id="primary" class="site-main avatar-maker-page">
        <section class="avatar-maker-section py-4 py-lg-5">
            <div class="container">
                <header class="avatar-maker-header mb-4" data-reveal>
                    <?php
                    if (function_exists('sena_render_breadcrumb')) {
                        sena_render_breadcrumb($page_title);
                    }
                    ?>

                    <h1 class="display-6 fw-600 mb-2"><?php echo esc_html($page_title); ?></h1>
                    <p class="text-muted mb-0"><?php echo esc_html($subtitle); ?></p>
                </header>

                <div class="avatar-maker" data-avatar-maker data-reveal>
                    <div class="avatar-maker-preview-panel">
                        <div class="avatar-canvas-wrap">
                            <canvas
                                class="avatar-canvas"
                                data-avatar-canvas
                                width="1080"
                                height="1080"
                                role="img"
                                aria-label="<?php esc_attr_e('Prévia da montagem em formato quadrado', 'sena'); ?>"
                            ></canvas>

                            <video
                                class="avatar-camera"
                                data-avatar-camera
                                autoplay
                                muted
                                playsinline
                                hidden
                            ></video>
                        </div>

                        <div class="avatar-camera-actions" data-camera-actions hidden>
                            <button class="btn btn-primary" type="button" data-capture-photo>
                                <i class="bi bi-camera-fill me-1"></i>
                                <?php esc_html_e('Capturar', 'sena'); ?>
                            </button>
                            <button class="btn btn-outline-dark" type="button" data-close-camera>
                                <i class="bi bi-x-lg me-1"></i>
                                <?php esc_html_e('Fechar câmera', 'sena'); ?>
                            </button>
                        </div>
                    </div>

                    <aside class="avatar-maker-controls" aria-label="<?php esc_attr_e('Controles da montagem', 'sena'); ?>">
                        <div class="avatar-actions-grid">
                            <input
                                class="visually-hidden"
                                data-avatar-input
                                id="avatarPhotoInput"
                                type="file"
                                accept="image/*"
                            >

                            <label class="btn btn-primary" for="avatarPhotoInput">
                                <i class="bi bi-image me-1"></i>
                                <?php esc_html_e('Escolher foto', 'sena'); ?>
                            </label>

                            <button class="btn btn-outline-primary" type="button" data-open-camera>
                                <i class="bi bi-camera me-1"></i>
                                <?php esc_html_e('Abrir câmera', 'sena'); ?>
                            </button>
                        </div>

                        <div class="avatar-control-group">
                            <label class="form-label" for="avatarZoom"><?php esc_html_e('Zoom', 'sena'); ?></label>
                            <input
                                class="form-range"
                                data-avatar-zoom
                                id="avatarZoom"
                                type="range"
                                min="1"
                                max="3"
                                step="0.01"
                                value="1"
                                disabled
                            >
                        </div>

                        <div class="avatar-actions-grid">
                            <button class="btn btn-outline-dark" type="button" data-reset-frame disabled>
                                <i class="bi bi-crosshair me-1"></i>
                                <?php esc_html_e('Centralizar', 'sena'); ?>
                            </button>

                            <button class="btn btn-success" type="button" data-download-avatar disabled>
                                <i class="bi bi-download me-1"></i>
                                <?php esc_html_e('Baixar montagem', 'sena'); ?>
                            </button>
                        </div>

                        <p class="avatar-status mb-0" data-avatar-status role="status" aria-live="polite">
                            <?php esc_html_e('Nenhuma foto selecionada.', 'sena'); ?>
                        </p>
                    </aside>
                </div>
            </div>
        </section>
    </main>
    <?php
endwhile;

get_footer();
