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
        'quote'  => 'Tô fechado com o Ulysses. É o único que realmente conhece o CREA por dentro e sabe o que precisa mudar.',
        'author' => 'Advogado - Goiânia',
        'image'  => '/assets/img/depo/homem-01.jpg',
    ],
    [
        'quote'  => 'A gente precisa de alguém que já viveu a engenharia na prática. Ulysses representa isso.',
        'author' => 'Eng. Mecânico - Anápolis',
        'image'  => '/assets/img/depo/homem-02.jpg',
    ],
    [
        'quote'  => 'Não dá mais pra pagar anuidade e não ter retorno. Com o Ulysses, vejo uma mudança de verdade.',
        'author' => 'Eng. Eletricista - Aparecida de Goiânia',
        'image'  => '/assets/img/depo/homem-03.jpg',
    ],
    [
        'quote'  => 'Ele sabe como funciona obra, gestão e o CREA. Pra mim, é o mais preparado.',
        'author' => 'Eng. Civil - Rio Verde',
        'image'  => '/assets/img/depo/homem-04.jpg',
    ],
    [
        'quote'  => 'Ulysses tem visão e experiência. É o tipo de liderança que a engenharia precisa agora.',
        'author' => 'Eng. de Produção - Catalão',
        'image'  => '/assets/img/depo/homem-05.jpg',
    ],
    [
        'quote'  => 'Tô fechada com o Ulysses. Ele pensa no profissional e não só na estrutura do CREA.',
        'author' => 'Eng. Agrônoma - Jataí',
        'image'  => '/assets/img/depo/mulher-01.jpg',
    ],
    [
        'quote'  => 'Finalmente alguém falando de valorização de verdade. A gente precisa disso.',
        'author' => 'Eng. Ambiental - Goiânia',
        'image'  => '/assets/img/depo/mulher-02.jpg',
    ],
    [
        'quote'  => 'Ele traz propostas que fazem sentido pra quem está no dia a dia da engenharia.',
        'author' => 'Eng. Civil - Luziânia',
        'image'  => '/assets/img/depo/mulher-03.jpg',
    ],
    [
        'quote'  => 'O CREA precisa mudar, e o Ulysses é quem tem coragem e preparo pra isso.',
        'author' => 'Eng. de Segurança - Anápolis',
        'image'  => '/assets/img/depo/mulher-04.jpg',
    ],
    [
        'quote'  => 'Eu quero um CREA mais próximo e mais justo. Por isso, tô com o Ulysses.',
        'author' => 'Arquiteta e Urbanista - Aparecida de Goiânia',
        'image'  => '/assets/img/depo/mulher-05.jpg',
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
                    <article class="quote-card">
                        <p class="quote-text mb-3">"<?php echo esc_html($item['quote']); ?>"</p>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-1 me-2 d-none">
                                <img src="<?php echo get_template_directory_uri(); ?><?php echo esc_html($item['image']); ?>" class="rounded-circle" width="30" height="30">
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
