<?php
/**
 * Home hero section.
 *
 * @package sena
 */

if (! defined('ABSPATH')) {
    exit;
}
?>

<section class="hero-section d-flex align-items-center" id="inicio">
    <div class="container-fluid">
        <div class="container position-relative z-3">
            <div class="row align-items-center justify-content-between g-5">

                <div class="col-lg-6 py-md-5 py-4 hero-txt">
                    <p class="eyebrow text-primary mb-3" data-reveal>Ulysses Sena • Candidato à Presidência do CREA-GO 2026</p>
                    <h1 class="hero-title text-primary mb-4" data-reveal>
                        Engenharia forte.<br>
                        Profissionais valorizados.<br>
                        <span class="fw-style text-secondary">Um novo CREA para Goiás.</span>
                    </h1>
                    <p class="hero-subtitle text-dark mb-4" data-reveal>
                        Conheça as ações que vão transformar e aproximar a classe.
                    </p>
                    <div class="d-flex flex-wrap gap-3" data-reveal>
                        <a class="btn btn-primary" href="<?php echo esc_url(home_url('/propostas/')); ?>">Conheça as propostas</a>
                        <a class="btn btn-light" href="#engaje">Participe do movimento</a>
                    </div>
                </div>

                <div class="col-lg-6 hero-img">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/ulysses-sena.webp" alt="" class="img-fluid">
                </div>
                
            </div>
        </div>
    </div>
</section>
