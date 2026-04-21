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
    'setup.php',
    'assets.php',
    'helpers.php',
    'customizer.php',
    'cpt.php',
    'forms.php',
    'seo.php',
];

foreach ($theme_include_files as $file) {
    $candidates = [
        'inc/' . $file,
        '_functions/' . $file, // Backward compatibility during refactor.
    ];

    foreach ($candidates as $candidate) {
        $path = get_template_directory() . '/' . $candidate;
        if (file_exists($path)) {
            require_once $path;
            break;
        }
    }
}
