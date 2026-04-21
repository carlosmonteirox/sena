<?php
/**
 * Home timeline section.
 *
 * @package sena
 */

if (! defined('ABSPATH')) {
    exit;
}

$timeline = [
    ['periodo' => '2001', 'titulo' => 'Formação acadêmica', 'descricao' => 'Início da trajetória técnica com foco em excelência profissional e compromisso público.'],
    ['periodo' => '2008', 'titulo' => 'Atuação profissional', 'descricao' => 'Consolidação da atuação no setor e liderança em equipes multidisciplinares.'],
    ['periodo' => '2016', 'titulo' => 'Conquistas institucionais', 'descricao' => 'Participação ativa em iniciativas de modernização e valorização da engenharia.'],
    ['periodo' => '2026', 'titulo' => 'Liderança para o CREA-GO', 'descricao' => 'Proposta de gestão conectada às demandas reais dos profissionais.'],
];
?>
<section id="trajetoria" class="section-space section-gradient py-md-5 py-4">
    <div class="container-fluid py-md-5 py-4">
        <div class="container position-relative z-3">
            <div class="row g-5 align-items-start">

                <div class="col-lg-4" data-reveal>
                    <p class="eyebrow text-info mb-2">Trajetória</p>
                    <h2 class="h1 display-4 fw-bold section-title mb-3" style="color: var(--bs-white);">Experiência que vira resultado</h2>
                    <p class="text-light opacity-75 mb-0">Uma história construída com atuação técnica, visão estratégica e proximidade com os profissionais.</p>
                </div>

                <div class="col-lg-8">
                    <div class="timeline">
                        <div class="row">
                            <?php foreach ($timeline as $item) : ?>
                                <div class="col-md-6">

                                    <article class="timeline-item rounded-4 p-md-4 p-3 mb-4" data-reveal>
                                        <span class="timeline-year"><?php echo esc_html($item['periodo']); ?></span>
                                        <h3 class="h5 mb-2 text-light"><?php echo esc_html($item['titulo']); ?></h3>
                                        <p class="mb-0 text-light opacity-75"><?php echo esc_html($item['descricao']); ?></p>
                                    </article>

                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<div class="line-design">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
</div>