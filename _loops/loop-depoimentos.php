<?php
/**
 * Depoimentos loop.
 *
 * @package sena
 */

if (! defined('ABSPATH')) {
    exit;
}

$query = $args['query'] ?? null;

$fallback = [
    [
        'quote'  => 'Precisamos de uma gestão técnica e próxima da realidade de quem está no campo e na obra.',
        'author' => 'Eng. Civil - Goiânia',
    ],
    [
        'quote'  => 'A proposta de inovação e desburocratização é o caminho para fortalecer nossa profissão.',
        'author' => 'Eng. Agrônoma - Rio Verde',
    ],
    [
        'quote'  => 'Uma liderança com visão estratégica para conectar o CREA às demandas atuais da engenharia.',
        'author' => 'Tecnólogo - Anápolis',
    ],
    [
        'quote'  => 'As propostas apresentam soluções práticas para valorizar quem está na linha de frente da engenharia.',
        'author' => 'Eng. de Segurança - Aparecida de Goiânia',
    ],
    [
        'quote'  => 'Queremos um conselho mais ágil, moderno e comprometido com o desenvolvimento de Goiás.',
        'author' => 'Arquiteta e Urbanista - Luziânia',
    ],
    [
        'quote'  => 'É hora de fortalecer a formação continuada e aproximar o CREA dos profissionais do interior.',
        'author' => 'Eng. Ambiental - Catalão',
    ],
];

$depoimentos = [];

if ($query instanceof WP_Query && $query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
        $depoimentos[] = [
            'quote'  => get_the_excerpt() ?: wp_trim_words(get_the_content(), 22, '...'),
            'author' => get_the_title(),
        ];
    }
} else {
    $depoimentos = $fallback;
}

$prepare_slides = static function (array $items, int $minimum = 6): array {
    if (empty($items)) {
        return [];
    }

    $prepared = $items;
    while (count($prepared) < $minimum) {
        $prepared = array_merge($prepared, $items);
    }

    return $prepared;
};

$slides = $prepare_slides($depoimentos, 6);
?>
<div class="apoio-carousel" data-reveal>
    <div class="swiper apoio-swiper" data-apoio-swiper>
        <div class="swiper-wrapper">
            <?php foreach ($slides as $item) : ?>
                <div class="swiper-slide">
                    <article class="quote-card h-100">
                        <p class="quote-text mb-3">"<?php echo esc_html($item['quote']); ?>"</p>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-1 me-2">
                                <img src="https://preview.keenthemes.com/metronic8/demo1/assets/media/avatars/300-12.jpg" class="rounded-circle" width="30" height="30">
                            </div>
                            <div class="w-100">
                                <p class="quote-author mb-0"><?php echo esc_html($item['author']); ?></p>
                            </div>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
