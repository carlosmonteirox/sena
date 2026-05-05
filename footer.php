<?php
/**
 * Theme footer.
 *
 * @package sena
 */

if (! defined('ABSPATH')) {
    exit;
}
?>
</div>

<div class="line-design">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
</div>

<footer class="site-footer bg-white py-5">
    <div class="container">
        <div class="row gx-md-5 align-items-start">

          <div class="col-lg-4">
              <h2 class="h1 display-6 fw-bold mb-3" style="color: var(--sena-blue-700);">Bora conversar?</h2>
              <p>Entre em nosso grupo de WhatsApp <a class="text-decoration-underline text-info" href="<?php echo esc_url(sena_whatsapp_link()); ?>" target="_blank" rel="noopener noreferrer">clicando aqui.</a></p>
          </div>

          <div class="col-lg-6">
              <h2 class="h1 display-6 fw-bold mb-3" style="color: var(--sena-blue-700);">Me siga nas redes sociais</h2>
              <div>
                <a href="https://www.instagram.com/eng.ulysses.sena/" 
                  target="_blank" 
                  rel="me"
                  class="btn btn-light bg-transparent border-0 p-2">
                  <i class="bi bi-instagram h4"></i>
                </a>
                <a href="https://www.facebook.com/ulysses.sena.001" 
                  target="_blank" 
                  rel="me"
                  class="btn btn-light bg-transparent border-0 p-2">
                  <i class="bi bi-facebook h4"></i>
                </a>
              </div>
          </div>

          <div class="col-lg-2">
            <?php
              wp_nav_menu([
                  'theme_location' => 'footer',
                  'container'      => false,
                  'menu_class'     => 'footer-menu list-unstyled mb-0',
                  'fallback_cb'    => 'sena_fallback_footer_menu',
                  'depth'          => 1,
              ]);
            ?>
          </div>
        </div>

        <hr class="my-4 border-light border-opacity-25">

        <div class="text-center">
          <p class="small mb-0">&copy; <?php echo esc_html(date_i18n('Y')); ?> Ulysses Sena. Todos os direitos reservados.</p>
        </div>
    </div>
</footer>

<div id="scroll-progress">
  <span></span>
</div>

<button id="scrollTopBtn" aria-label="Voltar ao topo">
  <span class="bi bi-arrow-up"></span>
</button>

<?php wp_footer(); ?>

</body>
</html>
