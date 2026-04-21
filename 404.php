<?php
/**
 * 404 template.
 *
 * @package sena
 */

get_header();
?>
<main class="site-main section-space d-flex align-items-center">
    <div class="container text-center">
        <p class="eyebrow mb-2">Erro 404</p>
        <h1 class="display-5 mb-3">Página não encontrada</h1>
        <p class="lead mb-4">O conteúdo que você procura pode ter sido movido. Use o menu para continuar navegando.</p>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">Voltar para a página inicial</a>
    </div>
</main>
<?php
get_footer();
