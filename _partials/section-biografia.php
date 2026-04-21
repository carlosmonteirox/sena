<?php
/**
 * Home biografia section.
 *
 * @package sena
 */

if (! defined('ABSPATH')) {
    exit;
}
?>
<section id="biografia" class="section-space biografia-section" style="background: var(--sena-blue-700);">
    <div class="container-fluid">
        <div class="container position-relative z-3 py-5">
            <div class="row align-items-center justify-content-center gx-5">

                <div class="col-lg-4" data-reveal>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/moisaico.webp" alt="" class="img-fluid">
                </div>

                <div class="col-lg-6 py-md-5 py-4 m-0 text-white" data-reveal>
                    <p class="eyebrow mb-2">Biografia</p>
                    <h2 class="h1 display-4 fw-bold section-title text-info mb-3">MINHA HISTÓRIA</h2>

                    <p class="mb-3">
                        Ulysses Sena construiu sua trajetória com atuação consistente na engenharia, liderança institucional
                        e compromisso com a valorização dos profissionais do sistema CREA-GO.
                    </p>
                    <p class="mb-4">
                        A proposta é unir experiência prática, inovação e escuta ativa para entregar um conselho mais ágil,
                        transparente e próximo da realidade de quem atua no mercado.
                    </p>
                    <div class="bio-highlights">
                        <span class="bio-pill">Formação sólida</span>
                        <span class="bio-pill">Atuação no sistema CREA</span>
                        <span class="bio-pill">Compromisso com resultados</span>
                    </div>
                    <a class="btn btn-primary mt-4" href="<?php echo esc_url(home_url('/sobre-ulysses/')); ?>">Conheça a trajetória completa</a>
                </div>

            </div>
        </div>
    </div>
</section>
