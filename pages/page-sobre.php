<?php
/**
 * Template Name: Sobre o Ulysses Sena
 *
 * @package sena
 */

if (! defined('ABSPATH')) {
    exit;
}

get_header();

$hero_image = get_template_directory_uri() . '/assets/img/ulysses-sena-sobre.webp';

$highlights = [
    [
        'number' => '01',
        'title'  => 'Experiência real',
        'text'   => 'Uma trajetória construída com trabalho, gestão e compromisso com o desenvolvimento de Goiás.',
        'icon'   => 'bi bi-briefcase',
        'accent' => '#004cb2',
    ],
    [
        'number' => '02',
        'title'  => 'Visão de futuro',
        'text'   => 'Defende um CREA mais moderno, digital, eficiente e próximo da realidade dos profissionais.',
        'icon'   => 'bi bi-lightning-charge',
        'accent' => '#00bef8',
    ],
    [
        'number' => '03',
        'title'  => 'Valorização profissional',
        'text'   => 'Acredita que o conselho precisa entregar retorno, proteção e oportunidades para quem está na linha de frente.',
        'icon'   => 'bi bi-award',
        'accent' => '#fac607',
    ],
];

$pillars = [
    'Gestão com responsabilidade',
    'Presença no interior',
    'Combate aos leigos',
    'CREA mais digital',
    'Benefícios reais',
    'Profissional valorizado',
];
?>

<main id="primary" class="site-main sobre-page">

    <section class="sobre-hero section-space py-md-5 py-4">
        <div class="container py-md-5 py-4">
            <div class="row align-items-center g-4 g-lg-5">

                <div class="col-lg-6" data-reveal>
                    <p class="eyebrow mb-2">Sobre o Ulysses Sena</p>

                    <h1 class="display-4 fw-bold mb-4" style="color: var(--sena-blue-700);">
                        Liderança, coragem e compromisso com a engenharia goiana.
                    </h1>

                    <p class="lead mb-4">
                        Ulysses Sena representa uma nova visão para o CREA-GO: mais presença, menos burocracia,
                        valorização profissional e uma gestão preparada para transformar o conselho em uma ferramenta
                        real de apoio aos profissionais.
                    </p>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="<?php echo esc_url(home_url('/propostas/')); ?>" class="btn btn-primary">
                            Conheça as propostas
                        </a>

                        <a href="#trajetoria" class="btn btn-outline-primary">
                            Ver trajetória
                        </a>
                    </div>
                </div>

                <div class="col-lg-6" data-reveal>
                    <div class="sobre-hero-card">
                        <img src="<?php echo esc_url($hero_image); ?>" alt="Ulysses Sena">
                        <div class="sobre-hero-overlay">
                            <p class="proposal-kicker mb-2">Um novo CREA para Goiás</p>
                            <h2>Engenharia forte. Profissionais valorizados.</h2>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="sobre-intro py-md-5 py-4" id="trajetoria">
        <div class="container">
            <div class="row g-4 align-items-start">

                <div class="col-lg-5" data-reveal>
                    <p class="eyebrow mb-2">Trajetória</p>
                    <h2 class="h1 fw-bold mb-3" style="color: var(--sena-blue-700);">
                        Uma história ligada ao trabalho, à gestão e ao desenvolvimento.
                    </h2>
                </div>

                <div class="col-lg-7" data-reveal>
                    <div class="sobre-text-card">
                        <p>
                            Ulysses Sena construiu sua trajetória com atuação próxima das pessoas, visão estratégica
                            e compromisso com resultados. Sua candidatura nasce da necessidade de aproximar o CREA-GO
                            dos profissionais, modernizar processos e fortalecer a engenharia, a agronomia e as
                            geociências em todo o estado.
                        </p>

                        <p>
                            A proposta é clara: fazer do conselho uma instituição mais eficiente, mais presente e mais
                            útil para quem trabalha, gera emprego, executa projetos e ajuda Goiás a crescer.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="sobre-highlights py-md-5 py-4">
        <div class="container">
            <div class="proposal-grid">

                <?php foreach ($highlights as $item) : ?>
                    <article class="proposal-card" style="--proposal-accent: <?php echo esc_attr($item['accent']); ?>;" data-reveal>
                        <div class="proposal-inner">
                            <div class="proposal-card-top">
                                <span class="proposal-icon">
                                    <i class="<?php echo esc_attr($item['icon']); ?>"></i>
                                </span>
                                <span class="proposal-number"><?php echo esc_html($item['number']); ?></span>
                            </div>

                            <div>
                                <p class="proposal-kicker mb-2">Compromisso</p>
                                <h3 class="proposal-title"><?php echo esc_html($item['title']); ?></h3>
                                <p class="proposal-text mb-0"><?php echo esc_html($item['text']); ?></p>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>

            </div>
        </div>
    </section>

    <section class="sobre-manifesto py-md-5 py-4" style="background: var(--sena-blue-700);">
        <div class="container-fluid">
            <div class="container">
                <div class="sobre-manifesto-card text-white" data-reveal>
                    <div>
                        <p class="proposal-kicker mb-2">Manifesto</p>
                        <h2>O CREA precisa ser mais do que uma obrigação. <span class="text-info">Precisa ser apoio, defesa e valorização.</span></h2>
                    </div>

                    <p>
                        O profissional não pode ser lembrado apenas na hora da cobrança. O conselho precisa estar presente,
                        ouvir a categoria, defender o exercício legal da profissão e devolver valor por meio de serviços,
                        benefícios, tecnologia e oportunidades.
                    </p>
                </div>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();