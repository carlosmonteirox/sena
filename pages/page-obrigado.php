<?php
/**
 * Template Name: Obrigado - Movimento
 *
 * @package sena
 */

if (! defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="primary" class="site-main obrigado-page">

    <section class="obrigado-section py-md-5 py-4">
        <div class="container py-md-5 py-4">
            <div class="obrigado-card" data-reveal>

                <i class="bi bi-check2-circle display-6 text-info"></i>

                <p class="eyebrow mb-2">Cadastro confirmado</p>

                <h1>
                    Parabéns, agora você faz parte da mudança.
                </h1>

                <p class="obrigado-text">
                    Seu cadastro foi realizado com sucesso. A partir de agora, você faz parte do movimento por um novo CREA-GO:
                    mais moderno, mais presente e mais comprometido com a valorização dos profissionais.
                </p>

                <div class="obrigado-highlight">
                    Engenharia forte. Profissionais valorizados. <span>Um novo CREA para Goiás.</span>
                </div>

                <div class="obrigado-actions">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                        Voltar para o início
                    </a>

                    <a href="<?php echo esc_url(home_url('/propostas/')); ?>" class="btn btn-outline-primary">
                        Conhecer as propostas
                    </a>
                </div>

            </div>
        </div>
    </section>

</main>

<?php
get_footer();