<?php
/**
 * Agenda cards loop.
 *
 * @package sena
 */

if (! defined('ABSPATH')) {
    exit;
}

$query = $args['query'] ?? null;
?>
<div class="row g-4">
    <?php if ($query instanceof WP_Query && $query->have_posts()) : ?>
        <?php while ($query->have_posts()) : $query->the_post(); ?>
            <div class="col-md-6" data-reveal>
                <article class="event-card h-100">
                    <p class="event-date mb-2"><?php echo esc_html(get_the_date('d M Y')); ?></p>
                    <h3 class="h5 mb-2"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <p class="text-muted mb-0"><?php echo esc_html(get_the_excerpt() ?: wp_trim_words(get_the_content(), 20, '...')); ?></p>
                </article>
            </div>
        <?php endwhile; ?>
    <?php else : ?>
        <?php
        $fallback_events = [
            ['date' => 'Abr 2026', 'title' => 'Encontro com lideranças de Goiânia', 'text' => 'Diálogo sobre modernização do CREA e valorização profissional.'],
            ['date' => 'Mai 2026', 'title' => 'Debate regional em Anápolis', 'text' => 'Ações para fortalecer fiscalização inteligente e eficiência técnica.'],
            ['date' => 'Jun 2026', 'title' => 'Visita técnica no sudoeste goiano', 'text' => 'Escuta ativa das demandas dos profissionais da região.'],
            ['date' => 'Jul 2026', 'title' => 'Agenda setorial com entidades', 'text' => 'Integração institucional com foco em oportunidades e capacitação.'],
        ];
        ?>
        <?php foreach ($fallback_events as $event) : ?>
            <div class="col-md-6" data-reveal>
                <article class="event-card h-100">
                    <p class="event-date mb-2"><?php echo esc_html($event['date']); ?></p>
                    <h3 class="h5 mb-2"><?php echo esc_html($event['title']); ?></h3>
                    <p class="text-muted mb-0"><?php echo esc_html($event['text']); ?></p>
                </article>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
