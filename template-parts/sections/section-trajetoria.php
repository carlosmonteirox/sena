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
    ['periodo' => '2013', 
        'titulo' => 'Base técnica sólida', 
        'descricao' => 'Engenheiro Civil pela PUC-GO, com especialização e compromisso com a engenharia de verdade.'
    ],
    ['periodo' => '2013 - 2026', 
        'titulo' => 'Vivência de quem faz', 
        'descricao' => 'Atuação em obras, gestão pública e setor privado, com liderança e entrega de resultados.'
    ],
    ['periodo' => '2019', 
        'titulo' => 'Conhece por dentro', 
        'descricao' => 'Conselheiro, Assessor e Chefe de Gabinete, com experiência direta no funcionamento do CREA.'
    ],
    ['periodo' => '2026', 
        'titulo' => 'Preparado para transformar', 
        'descricao' => 'Uma gestão moderna, com menos burocracia e mais valorização do profissional.'
    ],
];
?>
<section id="trajetoria" class="section-space section-gradient py-md-5 py-4" style="background: #062c72;">
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
                                <div class="col-md-6 mb-4">

                                    <article class="timeline-item rounded-4 p-md-4 p-3 h-100" data-reveal>
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