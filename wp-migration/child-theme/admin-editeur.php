<?php
/**
 * NSAD — Simplification de l'interface WordPress pour les éditeurs non-techniques
 * Fichier à inclure dans functions.php via : require_once 'admin-editeur.php';
 *
 * Ce fichier :
 * 1. Masque les menus inutiles pour les éditeurs
 * 2. Ajoute des messages d'aide en français
 * 3. Définit le rôle "Éditeur NSAD" avec les bonnes permissions
 * 4. Ajoute un tableau de bord simplifié
 */

// ─────────────────────────────────────────────────────────────────────────────
// 1. MASQUER LES MENUS INUTILES POUR LES ÉDITEURS
//    Les administrateurs voient tout — seuls les éditeurs sont filtrés
// ─────────────────────────────────────────────────────────────────────────────

add_action('admin_menu', function() {
    if (current_user_can('administrator')) return; // Admins voient tout

    // Menus à masquer pour les éditeurs
    $menus_a_masquer = [
        'tools.php',               // Outils
        'options-general.php',     // Réglages généraux
        'plugins.php',             // Extensions
        'themes.php',              // Apparence (thèmes)
        'users.php',               // Utilisateurs
        'edit-comments.php',       // Commentaires
        'upload.php',              // Médiathèque (accessible via les pages)
    ];

    foreach ($menus_a_masquer as $menu) {
        remove_menu_page($menu);
    }

    // Sous-menus Apparence à masquer
    remove_submenu_page('themes.php', 'themes.php');
    remove_submenu_page('themes.php', 'widgets.php');
    remove_submenu_page('themes.php', 'customize.php');
}, 999);

// ─────────────────────────────────────────────────────────────────────────────
// 2. TABLEAU DE BORD SIMPLIFIÉ
//    Remplace le tableau de bord WordPress par une interface claire
// ─────────────────────────────────────────────────────────────────────────────

add_action('wp_dashboard_setup', function() {
    // Supprimer tous les widgets par défaut
    global $wp_meta_boxes;
    $wp_meta_boxes['dashboard'] = [];

    // Ajouter notre widget d'accueil simplifié
    wp_add_dashboard_widget(
        'nsad_bienvenue',
        '👋 Bienvenue sur le site NSAD',
        'nsad_dashboard_widget_bienvenue'
    );

    wp_add_dashboard_widget(
        'nsad_raccourcis',
        '⚡ Accès rapides',
        'nsad_dashboard_widget_raccourcis'
    );
});

function nsad_dashboard_widget_bienvenue() {
    $user = wp_get_current_user();
    ?>
    <p style="font-size:16px; line-height:1.7; color:#344852;">
        Bonjour <strong><?php echo esc_html($user->display_name); ?></strong> ! 👋
    </p>
    <p style="line-height:1.7; color:#637D88;">
        Depuis cette interface, vous pouvez modifier les pages du site, ajouter des actualités et gérer les témoignages — sans aucune connaissance technique.
    </p>
    <div style="background:#EAF3F8; border-left:4px solid #2E6A8A; padding:14px 18px; border-radius:8px; margin-top:12px;">
        <strong style="color:#2E6A8A;">💡 Astuce :</strong>
        <span style="color:#344852;"> Pour modifier une page, cliquez sur <strong>Pages</strong> dans le menu gauche, puis sur <strong>Modifier avec Elementor</strong>.</span>
    </div>
    <p style="margin-top:14px;">
        <a href="<?php echo admin_url('upload/guide-editeur.pdf'); ?>" style="color:#2E6A8A; font-weight:600;">
            📖 Consulter le guide complet
        </a>
    </p>
    <?php
}

function nsad_dashboard_widget_raccourcis() {
    $raccourcis = [
        [
            'label' => '📝 Modifier la page d\'accueil',
            'url'   => admin_url('post.php?post=' . nsad_get_page_id('accueil') . '&action=elementor'),
            'color' => '#2E6A8A',
        ],
        [
            'label' => '📰 Ajouter une actualité',
            'url'   => admin_url('post-new.php?post_type=nsad_actualite'),
            'color' => '#70E8C6',
        ],
        [
            'label' => '💬 Ajouter un témoignage',
            'url'   => admin_url('post-new.php?post_type=nsad_temoignage'),
            'color' => '#7DA2FA',
        ],
        [
            'label' => '📋 Voir toutes les pages',
            'url'   => admin_url('edit.php?post_type=page'),
            'color' => '#FF8A75',
        ],
        [
            'label' => '🌐 Voir le site',
            'url'   => home_url('/'),
            'color' => '#637D88',
            'target' => '_blank',
        ],
    ];
    ?>
    <div style="display:flex; flex-direction:column; gap:10px;">
        <?php foreach ($raccourcis as $r) : ?>
            <a href="<?php echo esc_url($r['url']); ?>"
               <?php if (!empty($r['target'])) echo 'target="' . esc_attr($r['target']) . '"'; ?>
               style="display:block; background:<?php echo esc_attr($r['color']); ?>; color:#fff; padding:12px 18px; border-radius:10px; text-decoration:none; font-weight:600; font-size:14px; transition:opacity .2s;"
               onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">
                <?php echo esc_html($r['label']); ?>
            </a>
        <?php endforeach; ?>
    </div>
    <?php
}

// Utilitaire : récupérer l'ID d'une page par son slug
function nsad_get_page_id($slug) {
    $page = get_page_by_path($slug);
    return $page ? $page->ID : 0;
}

// ─────────────────────────────────────────────────────────────────────────────
// 3. MESSAGES D'AIDE CONTEXTUELS
//    Affiche des conseils sur les pages d'administration
// ─────────────────────────────────────────────────────────────────────────────

add_action('admin_notices', function() {
    $screen = get_current_screen();
    if (!$screen) return;

    // Message sur la liste des pages
    if ($screen->id === 'edit-page') {
        echo '<div class="notice notice-info" style="border-left-color:#2E6A8A;">
            <p>💡 <strong>Pour modifier une page :</strong> cliquez sur <strong>Modifier avec Elementor</strong> (pas sur "Modifier rapide").</p>
        </div>';
    }

    // Message sur la liste des actualités
    if ($screen->id === 'edit-nsad_actualite') {
        echo '<div class="notice notice-info" style="border-left-color:#70E8C6;">
            <p>💡 <strong>Actualités :</strong> Cliquez sur <strong>Ajouter une actualité</strong> pour rédiger un nouvel article. Il apparaîtra automatiquement sur la page "Nos Actualités".</p>
        </div>';
    }
});

// ─────────────────────────────────────────────────────────────────────────────
// 4. RENOMMER LES MENUS EN FRANÇAIS CLAIR
// ─────────────────────────────────────────────────────────────────────────────

add_action('admin_menu', function() {
    global $menu, $submenu;

    // Renommer "Pages" en quelque chose de plus clair
    if (isset($submenu['edit.php?post_type=page'])) {
        // Les noms sont déjà bons en français avec WP en français
    }
}, 1000);

// ─────────────────────────────────────────────────────────────────────────────
// 5. STYLE DE L'ADMIN — Rendre l'interface plus accueillante
// ─────────────────────────────────────────────────────────────────────────────

add_action('admin_head', function() {
    ?>
    <style>
        /* Couleurs NSAD dans l'admin */
        #wpadminbar { background: #0F2F3E !important; }
        #adminmenu .wp-has-current-submenu .wp-submenu-head,
        #adminmenu .current { background: #2E6A8A !important; }
        .wp-core-ui .button-primary {
            background: #2E6A8A !important;
            border-color: #1E4F68 !important;
        }
        .wp-core-ui .button-primary:hover { background: #1E4F68 !important; }

        /* Améliorer la lisibilité */
        #wpbody { font-size: 14px; }
        .wp-list-table .column-title .row-actions { opacity: 1 !important; }

        /* Masquer les colonnes inutiles dans la liste des pages */
        .column-date, .column-author { display: none; }

        /* Rendre le bouton Elementor plus visible */
        .row-actions .elementor { font-weight: 700; color: #2E6A8A !important; }
    </style>
    <?php
});

// ─────────────────────────────────────────────────────────────────────────────
// 6. RÔLE ÉDITEUR NSAD — Permissions adaptées
//    Créer ce rôle une seule fois en activant le thème
// ─────────────────────────────────────────────────────────────────────────────

register_activation_hook(__FILE__, 'nsad_create_editeur_role');

function nsad_create_editeur_role() {
    // Rôle basé sur "editor" avec accès à Elementor
    $editor_caps = get_role('editor')->capabilities;

    add_role('nsad_editeur', 'Éditeur NSAD', array_merge($editor_caps, [
        'edit_posts'                => true,
        'edit_pages'                => true,
        'publish_posts'             => true,
        'publish_pages'             => true,
        'upload_files'              => true,
        'edit_others_posts'         => true,
        'edit_others_pages'         => true,
        'manage_categories'         => true,
        // Elementor
        'elementor'                 => true,
        // Pas d'accès aux réglages, plugins, thèmes
        'manage_options'            => false,
        'install_plugins'           => false,
        'activate_plugins'          => false,
        'switch_themes'             => false,
        'edit_theme_options'        => false,
    ]));
}
