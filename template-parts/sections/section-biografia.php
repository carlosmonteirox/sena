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
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/ulysses-sena-historia.webp" alt="" class="img-fluid rounded-4">
                </div>

                <div class="col-lg-6 py-md-5 py-4 m-0 text-white" data-reveal>
                    <p class="eyebrow mb-2">Biografia</p>
                    <h2 class="h1 display-4 fw-bold section-title text-info mb-3">MINHA HISTÓRIA</h2>

                    <p class="mb-3">
                        Ulysses Sena é Engenheiro Civil formado pela PUC-GO, com especialização em pavimentação e segurança do trabalho. Atua há mais de uma década em obras, gestão pública e no setor privado, com experiência em grandes projetos de infraestrutura.
                    </p>
                    <p class="mb-3">
                        Também possui atuação dentro do CREA-GO, onde foi Conselheiro, Assessor Institucional e Chefe de Gabinete, conhecendo de perto os desafios do sistema e dos profissionais.
                    </p>
                    <p class="mb-3">
                        Sua proposta é unir experiência prática, visão de gestão e conhecimento institucional para construir um CREA mais ágil, transparente e conectado à realidade de quem atua no mercado.
                    </p>
                    <a class="btn btn-primary mt-3" href="<?php echo esc_url(home_url('/sobre-ulysses/')); ?>">
                        Conheça a trajetória completa
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>
