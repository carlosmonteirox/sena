<?php
/**
 * Template Name: Apoie o Movimento
 * Template Post Type: page
 *
 * @package sena
 */

get_header();

while (have_posts()) :
    the_post();
?>
<main class="site-main section-space">
    <section class="container">
        <?php
        get_template_part('template-parts/sections/section', 'page-hero', [
            'title'    => get_the_title(),
            'subtitle' => get_the_excerpt() ?: 'Cadastre-se para apoiar, participar da campanha e integrar grupos regionais.',
        ]);
        ?>
        <div class="row g-4 mt-1">
            <div class="col-lg-5" data-reveal>
                <div class="card-blur p-4 p-lg-5 h-100">
                    <h2 class="h5 mb-3">Como participar</h2>
                    <ul class="list-check list-unstyled mb-0">
                        <li><i class="bi bi-check2-circle"></i> Participar da campanha</li>
                        <li><i class="bi bi-check2-circle"></i> Receber atualizações</li>
                        <li><i class="bi bi-check2-circle"></i> Integrar grupos regionais</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-7" data-reveal>
                <div class="card-blur p-4 p-lg-5">
                    <?php sena_render_form_feedback(); ?>
                    <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" class="row g-3">
                        <input type="hidden" name="action" value="sena_submit_form">
                        <input type="hidden" name="form_type" value="apoie-movimento">
                        <?php wp_nonce_field('sena_submit_form', 'sena_form_nonce'); ?>

                        <div class="col-md-6">
                            <label class="form-label" for="apoieNome">Nome</label>
                            <input class="form-control" type="text" id="apoieNome" name="nome" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="apoieProfissao">Profissão</label>
                            <input class="form-control" type="text" id="apoieProfissao" name="profissao" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="apoieCidade">Cidade</label>
                            <input class="form-control" type="text" id="apoieCidade" name="cidade">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="apoieArea">Área de atuação</label>
                            <input class="form-control" type="text" id="apoieArea" name="area">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="apoieTelefone">Telefone</label>
                            <input class="form-control" type="text" id="apoieTelefone" name="telefone">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="apoieEmail">E-mail</label>
                            <input class="form-control" type="email" id="apoieEmail" name="email" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="apoieInteresse">Interesse</label>
                            <select class="form-select" id="apoieInteresse" name="interesse">
                                <option value="Participar da campanha">Participar da campanha</option>
                                <option value="Receber atualizações">Receber atualizações</option>
                                <option value="Integrar grupos regionais">Integrar grupos regionais</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary btn-glow" type="submit">Enviar cadastro</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
<?php
endwhile;

get_footer();
