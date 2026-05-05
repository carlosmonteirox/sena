<?php
/**
 * Home engagement section.
 *
 * @package sena
 */

if (! defined('ABSPATH')) {
    exit;
}
?>
<section class="section-space section-engage py-md-5 py-4" id="engaje">
    <div class="container position-relative z-3">
        <div class="row g-4 align-items-stretch">

            <div class="col-lg-5" data-reveal>
                <p class="eyebrow mb-2">Engaje</p>
                <h2 class="h1 display-4 fw-bold section-title mb-3" style="color: var(--sena-blue-700);">Participe do movimento</h2>
                <p class="text-muted mb-4">Cadastre-se para apoiar a campanha, receber novidades e integrar ações regionais.</p>
                <ul class="list-check list-unstyled mb-0">
                    <li><i class="bi bi-check2-circle"></i> Quero apoiar</li>
                    <li><i class="bi bi-check2-circle"></i> Quero participar</li>
                    <li><i class="bi bi-check2-circle"></i> Quero receber novidades</li>
                </ul>
            </div>

            <div class="col-lg-7" data-reveal>
                <div class="card-blur p-4 p-lg-5">
                    <?php echo do_shortcode('[fluentform id="1"]'); ?>
                </div>
            </div>

        </div>
    </div>
</section>