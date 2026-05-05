<?php
/**
 * Front page template.
 *
 * @package sena
 */

get_header();

get_template_part('template-parts/sections/section', 'hero');
get_template_part('template-parts/sections/section', 'candidatos');
get_template_part('template-parts/sections/section', 'propostas');
get_template_part('template-parts/sections/section', 'biografia');
get_template_part('template-parts/sections/section', 'manifesto');
get_template_part('template-parts/sections/section', 'trajetoria');
get_template_part('template-parts/sections/section', 'apoio');
get_template_part('template-parts/sections/section', 'noticias');
get_template_part('template-parts/sections/section', 'whatsapp');
get_template_part('template-parts/sections/section', 'engaje');

get_footer();
