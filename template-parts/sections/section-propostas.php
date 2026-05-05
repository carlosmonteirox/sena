<?php
/**
 * Home propostas section.
 *
 * @package sena
 */

if (! defined('ABSPATH')) {
    exit;
}

$propostas = [
    [
        'kicker'      => 'Anuidade Zero',
        'title'       => 'Anuidade Zero: menos custo, mais valorização',
        'description' => 'Cashback, benefícios reais e um CREA que devolve valor ao profissional.',
        'icon'        => 'bi bi-cash-coin',
        'accent'      => '#fac607',
        'class'       => 'proposal-card--hero',
    ],
    [
        'kicker'      => 'Valorização do profissional habilitado',
        'title'       => 'Chega de leigos na engenharia',
        'description' => 'Fiscalização em todo o estado para proteger quem é habilitado.',
        'icon'        => 'bi bi-shield-check',
        'accent'      => '#00bef8',
        'class'       => 'proposal-card--standard',
    ],
    [
        'kicker'      => 'Presença no interior',
        'title'       => 'Um CREA presente em todo o estado',
        'description' => 'Gabinete itinerante e atendimento real nos municípios.',
        'icon'        => 'bi bi-geo-alt',
        'accent'      => '#10af8f',
        'class'       => 'proposal-card--standard',
    ],
    [
        'kicker'      => 'Menos burocracia',
        'title'       => 'Menos burocracia, mais produtividade',
        'description' => 'Processos ágeis e um CREA que respeita o seu tempo.',
        'icon'        => 'bi bi-speedometer2',
        'accent'      => '#004cb2',
        'class'       => 'proposal-card--standard',
    ],
    [
        'kicker'      => 'CREA Digital',
        'title'       => 'Tudo na palma da sua mão',
        'description' => 'App moderno para resolver tudo com rapidez e praticidade.',
        'icon'        => 'bi bi-phone',
        'accent'      => '#00bef8',
        'class'       => 'proposal-card--standard',
    ],
    [
        'kicker'      => 'Benefícios reais',
        'title'       => 'Benefícios que fazem diferença',
        'description' => 'Cursos gratuitos, convênios e vantagens para o profissional.',
        'icon'        => 'bi bi-gift',
        'accent'      => '#fac607',
        'class'       => 'proposal-card--small',
    ],
    [
        'kicker'      => 'Mais participação',
        'title'       => 'Um CREA que ouve você',
        'description' => 'Plenárias regionais e mais voz para os profissionais.',
        'icon'        => 'bi bi-chat-dots',
        'accent'      => '#10af8f',
        'class'       => 'proposal-card--small',
    ],
];

$proposal_images = [
    [
        'image'       => get_template_directory_uri() . '/assets/img/proposta-1.webp',
        'alt'         => 'Mosaico visual da campanha',
        'kicker'      => 'Projeto de valorização',
        'title'       => 'Mais retorno para quem constrói o futuro',
        'description' => 'Uma gestão focada em presença, eficiência e benefícios reais.',
        'class'       => 'proposal-image-card--tall',
    ],
    [
        'image'       => get_template_directory_uri() . '/assets/img/proposta-2.webp',
        'alt'         => 'Ulysses Sena em atividade profissional',
        'kicker'      => 'Compromisso em campo',
        'title'       => 'Decisões próximas da realidade do profissional',
        'description' => 'Escuta ativa, interiorização e ações práticas em todo o estado.',
        'class'       => 'proposal-image-card--wide',
    ],
];
?>
<section class="section-space proposta-section py-md-3 py-4" id="propostas">
    <div class="container-fluid py-md-5 py-4">

        <div class="container position-relative z-3 mb-3">
            <div class="d-flex flex-wrap justify-content-between align-items-end mb-4 gap-3" data-reveal>
                <div>
                    <p class="eyebrow mb-2">Compromissos com impacto direto na classe</p>
                    <h2 class="h1 display-4 fw-bold section-title mb-3" style="color: var(--sena-blue-700);">Propostas Principais</h2>
                </div>
                <!-- <a class="btn btn-outline-primary" href="<?php echo esc_url(home_url('/propostas/')); ?>">Ver página completa</a> -->
            </div>
        </div>

        <div class="container">
            <div class="proposal-grid">
                <?php foreach ($propostas as $index => $proposta) : ?>
                    <article class="proposal-card <?php echo esc_attr($proposta['class']); ?>" style="--proposal-accent: <?php echo esc_attr($proposta['accent']); ?>;" data-reveal>
                        <div class="proposal-inner">
                            <div class="proposal-card-top">
                                <span class="proposal-icon"><i class="<?php echo esc_attr($proposta['icon']); ?>"></i></span>
                                <span class="proposal-number"><?php echo esc_html(str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT)); ?></span>
                            </div>
                            <p class="proposal-kicker mb-2"><?php echo esc_html($proposta['kicker']); ?></p>
                            <h3 class="proposal-title"><?php echo esc_html($proposta['title']); ?></h3>
                            <p class="proposal-text mb-0"><?php echo esc_html($proposta['description']); ?></p>
                        </div>
                    </article>

                    <?php if (1 === $index) : ?>
                        <article class="proposal-image-card <?php echo esc_attr($proposal_images[0]['class']); ?>" data-reveal>
                            <img src="<?php echo esc_url($proposal_images[0]['image']); ?>" alt="<?php echo esc_attr($proposal_images[0]['alt']); ?>">
                            <div class="proposal-image-content">
                                <p class="proposal-kicker mb-2"><?php echo esc_html($proposal_images[0]['kicker']); ?></p>
                                <h3 class="proposal-title"><?php echo esc_html($proposal_images[0]['title']); ?></h3>
                                <p class="proposal-text mb-0"><?php echo esc_html($proposal_images[0]['description']); ?></p>
                            </div>
                        </article>
                    <?php endif; ?>

                    <?php if (4 === $index) : ?>
                        <article class="proposal-image-card <?php echo esc_attr($proposal_images[1]['class']); ?>" data-reveal>
                            <img src="<?php echo esc_url($proposal_images[1]['image']); ?>" alt="<?php echo esc_attr($proposal_images[1]['alt']); ?>">
                            <div class="proposal-image-content">
                                <p class="proposal-kicker mb-2"><?php echo esc_html($proposal_images[1]['kicker']); ?></p>
                                <h3 class="proposal-title"><?php echo esc_html($proposal_images[1]['title']); ?></h3>
                                <p class="proposal-text mb-0"><?php echo esc_html($proposal_images[1]['description']); ?></p>
                            </div>
                        </article>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</section>
