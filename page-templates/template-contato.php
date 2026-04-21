<?php
/**
 * Template Name: Contato
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
            'subtitle' => get_the_excerpt() ?: 'Entre em contato pelos canais oficiais da campanha.',
        ]);
        ?>
        <div class="row g-4 mt-1">
            <div class="col-lg-5" data-reveal>
                <div class="card-blur p-4 p-lg-5 h-100">
                    <h2 class="h5 mb-3">Canais de atendimento</h2>
                    <ul class="list-unstyled contact-list mb-4">
                        <li><i class="bi bi-whatsapp"></i> <a href="<?php echo esc_url(sena_whatsapp_link()); ?>" target="_blank" rel="noopener noreferrer">WhatsApp oficial</a></li>
                        <li><i class="bi bi-instagram"></i> <a href="https://instagram.com" target="_blank" rel="noopener noreferrer">Instagram</a></li>
                        <li><i class="bi bi-linkedin"></i> <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer">LinkedIn</a></li>
                        <li><i class="bi bi-envelope"></i> <?php echo esc_html(get_option('admin_email')); ?></li>
                    </ul>
                    <p class="text-muted mb-0">Os formulários do site podem ser integrados com CRM, Mailchimp e automações de e-mail.</p>
                </div>
            </div>
            <div class="col-lg-7" data-reveal>
                <div class="card-blur p-4 p-lg-5">
                    <?php sena_render_form_feedback(); ?>
                    <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" class="row g-3">
                        <input type="hidden" name="action" value="sena_submit_form">
                        <input type="hidden" name="form_type" value="contato">
                        <?php wp_nonce_field('sena_submit_form', 'sena_form_nonce'); ?>

                        <div class="col-md-6">
                            <label class="form-label" for="contatoNome">Nome</label>
                            <input class="form-control" type="text" id="contatoNome" name="nome" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="contatoEmail">E-mail</label>
                            <input class="form-control" type="email" id="contatoEmail" name="email" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="contatoTelefone">Telefone</label>
                            <input class="form-control" type="text" id="contatoTelefone" name="telefone">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="contatoCidade">Cidade</label>
                            <input class="form-control" type="text" id="contatoCidade" name="cidade">
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="contatoMensagem">Mensagem</label>
                            <textarea class="form-control" id="contatoMensagem" name="mensagem" rows="5"></textarea>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary btn-glow" type="submit">Enviar mensagem</button>
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
