<?php
/**
 * NSAD Child Theme — functions.php
 * Thème enfant Hello Elementor pour SSIAD NSAD Nantes
 * Design System v2.0
 */

// Interface simplifiée pour les éditeurs non-techniques
require_once get_stylesheet_directory() . '/admin-editeur.php';

// ─────────────────────────────────────────────────────────────────────────────
// 1. CHARGEMENT DES STYLES ET SCRIPTS
// ─────────────────────────────────────────────────────────────────────────────

add_action('wp_enqueue_scripts', function() {

    // Thème parent Hello Elementor
    wp_enqueue_style(
        'hello-elementor',
        get_template_directory_uri() . '/style.css',
        [], wp_get_theme('hello-elementor')->get('Version')
    );

    // Thème enfant NSAD
    wp_enqueue_style(
        'nsad-child',
        get_stylesheet_uri(),
        ['hello-elementor'],
        wp_get_theme()->get('Version')
    );

    // Google Fonts — Poppins + Hind (hébergées localement via OMGF si disponible)
    if (!class_exists('OMGF')) {
        wp_enqueue_style(
            'nsad-fonts',
            'https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Hind:wght@400;500;600&display=swap',
            [],
            null
        );
    }

    // Script UX : transitions de pages, skeleton loaders, focus polyfill
    wp_enqueue_script(
        'nsad-ux',
        get_stylesheet_directory_uri() . '/assets/nsad-ux.js',
        [],
        '1.0.0',
        true // Charger en pied de page
    );

    // Bouton flottant téléphone (mobile)
    wp_enqueue_script(
        'nsad-floating-call',
        get_stylesheet_directory_uri() . '/assets/nsad-floating-call.js',
        ['nsad-ux'],
        '1.0.0',
        true
    );

});

// ─────────────────────────────────────────────────────────────────────────────
// 2. BOUTON FLOTTANT TÉLÉPHONE — Injection dans le footer
// ─────────────────────────────────────────────────────────────────────────────

add_action('wp_footer', function() {
    ?>
    <a href="tel:0240354343" class="nsad-floating-call" aria-label="Appeler le SSIAD NSAD">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1-9.4 0-17-7.6-17-17 0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.3 0 .7-.2 1L6.6 10.8z" fill="currentColor"/>
        </svg>
        02 40 35 43 43
    </a>
    <?php
});

// ─────────────────────────────────────────────────────────────────────────────
// 3. SCHEMA.ORG — MedicalBusiness sur toutes les pages
// ─────────────────────────────────────────────────────────────────────────────

add_action('wp_head', function() {
    $schema = [
        '@context'    => 'https://schema.org',
        '@type'       => 'MedicalBusiness',
        'name'        => 'SSIAD NSAD — Nantes Soins à Domicile',
        'description' => 'Service de Soins Infirmiers À Domicile agréé ARS à Nantes. Soins infirmiers, aide-soignante, nursing et accompagnement pour personnes âgées et handicapées.',
        'url'         => home_url('/'),
        'telephone'   => '+33240354343',
        'email'       => 'contact@ssiadnsaid.fr',
        'address'     => [
            '@type'           => 'PostalAddress',
            'streetAddress'   => '',
            'addressLocality' => 'Nantes',
            'postalCode'      => '44000',
            'addressCountry'  => 'FR',
        ],
        'areaServed'  => [
            ['@type' => 'City', 'name' => 'Nantes'],
            ['@type' => 'City', 'name' => 'Centre-ville de Nantes'],
            ['@type' => 'City', 'name' => 'Île de Nantes'],
        ],
        'openingHoursSpecification' => [
            [
                '@type'     => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday'],
                'opens'     => '08:00',
                'closes'    => '18:00',
            ]
        ],
        'medicalSpecialty' => 'Nursing',
        'isAcceptingNewPatients' => true,
    ];
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
});

// ─────────────────────────────────────────────────────────────────────────────
// 4. SÉCURITÉ — Headers HTTP
// ─────────────────────────────────────────────────────────────────────────────

add_action('send_headers', function() {
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    // CSP basique — affiner selon les plugins utilisés
    // header("Content-Security-Policy: default-src 'self'; ...");
});

// ─────────────────────────────────────────────────────────────────────────────
// 5. NETTOYAGE — Supprimer les balises inutiles du <head>
// ─────────────────────────────────────────────────────────────────────────────

remove_action('wp_head', 'wp_generator');                    // Version WP
remove_action('wp_head', 'wlwmanifest_link');               // Windows Live Writer
remove_action('wp_head', 'rsd_link');                       // RSD
remove_action('wp_head', 'wp_shortlink_wp_head');           // Short links
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head'); // Liens prev/next

// ─────────────────────────────────────────────────────────────────────────────
// 6. CUSTOM POST TYPES — Actualités & Témoignages
// ─────────────────────────────────────────────────────────────────────────────

add_action('init', function() {

    // Actualités
    register_post_type('nsad_actualite', [
        'label'         => 'Actualités',
        'labels'        => [
            'name'          => 'Actualités',
            'singular_name' => 'Actualité',
            'add_new_item'  => 'Ajouter une actualité',
            'edit_item'     => 'Modifier l\'actualité',
        ],
        'public'        => true,
        'has_archive'   => true,
        'rewrite'       => ['slug' => 'nos-actualites'],
        'supports'      => ['title', 'editor', 'thumbnail', 'excerpt'],
        'show_in_rest'  => true, // Activer l'éditeur Gutenberg
        'menu_icon'     => 'dashicons-megaphone',
    ]);

    // Témoignages
    register_post_type('nsad_temoignage', [
        'label'         => 'Témoignages',
        'labels'        => [
            'name'          => 'Témoignages',
            'singular_name' => 'Témoignage',
            'add_new_item'  => 'Ajouter un témoignage',
        ],
        'public'        => false,
        'show_ui'       => true,
        'supports'      => ['title', 'editor'],
        'menu_icon'     => 'dashicons-format-quote',
    ]);

});

// ─────────────────────────────────────────────────────────────────────────────
// 7. SUPPORT DU THÈME
// ─────────────────────────────────────────────────────────────────────────────

add_action('after_setup_theme', function() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'gallery', 'caption']);
    add_theme_support('responsive-embeds');

    // Taille d'image personnalisée pour les cartes quartiers
    add_image_size('nsad-quartier-card', 600, 400, true);
    add_image_size('nsad-hero', 1200, 700, true);
});
