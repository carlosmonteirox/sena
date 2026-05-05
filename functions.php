<?php
/**
 * Main theme bootstrap file.
 *
 * @package sena
 */

if (! defined('ABSPATH')) {
    exit;
}

$theme_include_files = [
    'admin.php',
    'setup.php',
    'assets.php',
    'helpers.php',
    'customizer.php',
    'cpt.php',
    'forms.php',
    'seo.php',
];

foreach ($theme_include_files as $file) {
    $path = get_template_directory() . '/inc/' . $file;

    if (file_exists($path)) {
        require_once $path;
    }
}
