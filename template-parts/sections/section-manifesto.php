<?php
/**
 * Home manifesto section.
 *
 * @package sena
 */

if (! defined('ABSPATH')) {
    exit;
}
?>
<section id="manifesto" class="section-space py-md-5 py-4 d-none">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/capa-manifesto.webp" alt="" class="capa-manifesto">

    <div class="container-fluid py-md-5 py-4">

        <div class="container position-relative z-3">
            <div class="row align-items-center gx-5">
                <div class="col-lg-12 text-center" data-reveal>
                    <!-- <p class="eyebrow mb-2">Manifesto</p> -->
                    <h2 class="h1 display-4 fw-bold section-title mb-3" style="color: var(--sena-blue-700);">
                        Um CREA que fortalece quem constrói Goiás
                    </h2>
                </div>
            </div>
        </div>

        <div class="container position-relative z-3 my-lg-5 my-4">
            <div class="row align-items-center g-4">
                <div class="col-lg-12" data-reveal>

                    <div class="card border-0 rounded-4 overflow-hidden" style="background: var(--sena-blue-700);">
                        <div id="carouselManifesto" class="carousel slide">
                            <div class="carousel-inner">
                                <div class="carousel-item active">

                                    <div class="row align-items-center justify-content-center mb-5">
                                        <div class="col-md-10">
                                            <div class="ratio ratio-16x9">
                                                <iframe src="https://www.youtube.com/embed/?rel=0" title="YouTube video" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselManifesto" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselManifesto" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="container position-relative z-3">
            <div class="row align-items-center gx-5">
                <div class="col-lg-12 text-center" data-reveal>
                    <p class="text-muted mb-3">
                        Nossa visão é reposicionar o CREA-GO como referência nacional em eficiência, inovação e valorização profissional.
                        O propósito é simples: reduzir barreiras, ampliar oportunidades e aproximar o conselho da realidade dos engenheiros,
                        agrônomos e tecnólogos. O compromisso é com transparência, escuta ativa e entrega concreta para todos os profissionais do sistema.
                    </p>
                </div>
            </div>
        </div>

    </div>
</section>
