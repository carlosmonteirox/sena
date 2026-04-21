<?php
/**
 * Propostas cards loop.
 *
 * @package sena
 */

if (! defined('ABSPATH')) {
    exit;
}

$query = $args['query'] ?? null;

$fallback = [
    [
        'title'   => 'Valorização profissional',
        'text'    => 'Defesa da categoria e ampliação de oportunidades para engenheiros e profissionais técnicos.',
        'icon'    => 'bi bi-award',
        'url'     => home_url('/propostas/'),
    ],
    [
        'title'   => 'Fiscalização eficiente',
        'text'    => 'Ações inteligentes para fortalecer o exercício legal da profissão e proteger a sociedade.',
        'icon'    => 'bi bi-shield-check',
        'url'     => home_url('/propostas/'),
    ],
    [
        'title'   => 'Desburocratização do CREA',
        'text'    => 'Processos mais ágeis, transparentes e orientados por dados para reduzir entraves.',
        'icon'    => 'bi bi-diagram-3',
        'url'     => home_url('/propostas/'),
    ],
    [
        'title'   => 'Inovação tecnológica',
        'text'    => 'Digitalização de serviços e novas ferramentas para melhorar a experiência do profissional.',
        'icon'    => 'bi bi-cpu',
        'url'     => home_url('/propostas/'),
    ],
    [
        'title'   => 'Fortalecimento das entidades',
        'text'    => 'Integração regional com associações, sindicatos e lideranças da engenharia em Goiás.',
        'icon'    => 'bi bi-people',
        'url'     => home_url('/propostas/'),
    ],
];
?>

<div class="row g-4">
    <?php if ($query instanceof WP_Query && $query->have_posts()) : ?>
        <?php while ($query->have_posts()) : $query->the_post(); ?>
            <div class="col-md-6 col-xl-4" data-reveal>
                <article class="proposal-card h-100">
                    <a href="<?php the_permalink(); ?>" class="proposal-link">
                        <div class="proposal-inner h-100">
                            <span class="proposal-icon"><i class="bi bi-lightning-charge"></i></span>
                            <h3 class="h5 fw-semibold mt-3 mb-2"><?php the_title(); ?></h3>
                            <p class="text-muted mb-3"><?php echo esc_html(get_the_excerpt() ?: wp_trim_words(get_the_content(), 20, '...')); ?></p>
                            <span class="small">Ler proposta <i class="bi bi-arrow-right-short"></i></span>
                        </div>
                    </a>
                </article>
            </div>
        <?php endwhile; ?>
    <?php else : ?>
        <?php foreach ($fallback as $item) : ?>
            <div class="col-md-6 col-xl-4" data-reveal>
                <article class="proposal-card h-100">
                    <a href="<?php echo esc_url($item['url']); ?>" class="proposal-link">
                        <div class="proposal-inner h-100">
                            <span class="proposal-icon"><i class="<?php echo esc_attr($item['icon']); ?>"></i></span>
                            <h3 class="h5 fw-semibold mt-3 mb-2"><?php echo esc_html($item['title']); ?></h3>
                            <p class="text-muted mb-3"><?php echo esc_html($item['text']); ?></p>
                            <span class="small">Ver detalhes <i class="bi bi-arrow-right-short"></i></span>
                        </div>
                    </a>
                </article>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
