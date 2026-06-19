<?php
function nsad_enqueue_assets() {
    // Google Fonts
    wp_enqueue_style(
        'nsad-fonts',
        'https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&family=Hind:wght@300;400;500;600&display=swap',
        [],
        null
    );

    // Variables CSS (couleurs, espacements)
    wp_enqueue_style(
        'nsad-variables',
        get_template_directory_uri() . '/variables.css',
        ['nsad-fonts'],
        '1.0'
    );

    // CSS commun à toutes les pages
    wp_enqueue_style(
        'nsad-common',
        get_template_directory_uri() . '/nsad-common.css',
        ['nsad-variables'],
        '1.0'
    );
}
add_action('wp_enqueue_scripts', 'nsad_enqueue_assets');

// Support des fonctionnalités WordPress de base
function nsad_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'gallery', 'caption']);
    add_theme_support('custom-logo');
    add_theme_support('elementor');
}
add_action('after_setup_theme', 'nsad_theme_setup');
