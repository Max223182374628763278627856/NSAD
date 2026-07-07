<?php

// ── Shortcode : grille d'articles ovales (design carte photo+mint) ───
add_shortcode('nsad_articles_grid', function ($atts) {
    $atts     = shortcode_atts(['per_page' => 3], $atts);
    $per_page = intval($atts['per_page']);
    $paged    = max(1, intval($_GET['blog_page'] ?? 1));

    $query = new WP_Query([
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => $per_page,
        'paged'          => $paged,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ]);

    if (!$query->have_posts()) return '';

    $total_pages = $query->max_num_pages;
    $base_url    = get_permalink(get_the_ID());

    ob_start(); ?>
    <style>
    .nsad-blog-wrap{padding:20px 48px 60px;max-width:1200px;margin:0 auto}
    .nsad-oval-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:40px;justify-items:center}
    .nsad-oval-card{text-decoration:none;display:flex;flex-direction:column;align-items:center;width:100%;max-width:320px;transition:transform .25s,filter .25s}
    .nsad-oval-card:hover{transform:translateY(-8px);filter:drop-shadow(0 16px 32px rgba(60,105,127,.18))}
    .nsad-oval-inner{width:100%;border-radius:999px;overflow:hidden;display:flex;flex-direction:column}
    .nsad-oval-photo{width:100%;aspect-ratio:1/1;flex-shrink:0;background:#d0e8e0}
    .nsad-oval-photo img{width:100%;height:100%;object-fit:cover;display:block}
    .nsad-oval-photo-placeholder{width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#b8ddd6,#8ccfc4);font-size:48px}
    .nsad-oval-body{background:#cceae2;padding:28px 36px 44px;text-align:center;flex:1}
    .nsad-oval-body h3{font-family:'Poppins',sans-serif;font-size:1rem;font-weight:600;color:#1a3a48;line-height:1.45;margin-bottom:20px}
    .nsad-oval-btn{display:inline-block;border:2px solid #2a4a58;color:#2a4a58;padding:10px 28px;border-radius:999px;font-family:'Poppins',sans-serif;font-size:13px;font-weight:600;transition:background .2s,color .2s}
    .nsad-oval-card:hover .nsad-oval-btn{background:#2a4a58;color:#fff}
    .nsad-blog-pagination{display:flex;justify-content:center;align-items:center;gap:8px;margin-top:48px;font-family:'Poppins',sans-serif}
    .nsad-blog-pagination a,.nsad-blog-pagination span{width:36px;height:36px;display:flex;align-items:center;justify-content:center;border-radius:50%;font-size:14px;font-weight:600;text-decoration:none;color:#3C697F;border:2px solid transparent;transition:all .2s}
    .nsad-blog-pagination a:hover{border-color:#3C697F}
    .nsad-blog-pagination .nsad-pg-current{background:#3C697F;color:#fff;border-color:#3C697F}
    @media(max-width:900px){.nsad-oval-grid{grid-template-columns:repeat(2,1fr)}.nsad-blog-wrap{padding:20px 24px 48px}}
    @media(max-width:560px){.nsad-oval-grid{grid-template-columns:1fr}}
    </style>
    <div class="nsad-blog-wrap">
        <div class="nsad-oval-grid">
        <?php while ($query->have_posts()): $query->the_post();
            $thumb = get_the_post_thumbnail_url(get_the_ID(), 'large');
        ?>
            <a href="<?php the_permalink(); ?>" class="nsad-oval-card">
                <div class="nsad-oval-inner">
                    <div class="nsad-oval-photo">
                        <?php if ($thumb): ?>
                            <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>">
                        <?php else: ?>
                            <div class="nsad-oval-photo-placeholder">🏥</div>
                        <?php endif; ?>
                    </div>
                    <div class="nsad-oval-body">
                        <h3><?php the_title(); ?></h3>
                        <span class="nsad-oval-btn">Lire l'article</span>
                    </div>
                </div>
            </a>
        <?php endwhile; wp_reset_postdata(); ?>
        </div>

        <?php if ($total_pages > 1): ?>
        <div class="nsad-blog-pagination">
            <?php for ($p = 1; $p <= $total_pages; $p++):
                $url = add_query_arg('blog_page', $p, $base_url);
                if ($p === $paged): ?>
                    <span class="nsad-pg-current"><?php echo $p; ?></span>
                <?php else: ?>
                    <a href="<?php echo esc_url($url); ?>"><?php echo $p; ?></a>
                <?php endif;
            endfor; ?>
        </div>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
});

// ── Styles & Fonts ────────────────────────────────────────────────────
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('nsad-parent', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('nsad-theme',  get_stylesheet_uri(), ['nsad-parent']);
    wp_enqueue_style('nsad-fonts',
        'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Hind:wght@300;400;500;600&display=swap',
        [], null
    );
    wp_enqueue_style('nsad-common', get_stylesheet_directory_uri() . '/nsad-common.css', ['nsad-theme'], '1.2');
});

add_theme_support('title-tag');
add_theme_support('post-thumbnails');

// ═══════════════════════════════════════════════════════════════════════
// HEADER
// ═══════════════════════════════════════════════════════════════════════
add_action('elementor/page_templates/canvas/before_content', function () {
    $logo_url = wp_get_attachment_url(34);
    ?>
    <style>
    /* CSS Variables globales */
    :root {
        --nsad-primary: #2E6A8A;
        --nsad-mint:    #70E8C6;
        --nsad-coral:   #FF8A75;
        --nsad-text:    #344852;
        --nsad-ink:     #122432;
    }
    /* Hover uniquement (ne peut pas être inline) */
    #nsad-hdr a.nsad-nav-link:hover,
    #nsad-hdr li.current-menu-item a.nsad-nav-link { color: #2E6A8A !important; font-weight: 700 !important; }
    #nsad-hdr a.nsad-nav-link:hover::after,
    #nsad-hdr li.current-menu-item a.nsad-nav-link::after { transform: scaleX(1) !important; }
    #nsad-hdr .nsad-btn-contact:hover { background: #e87a67 !important; transform: translateY(-1px); }
    #nsad-hdr .nsad-btn-phone:hover   { background: #2E6A8A !important; color: #fff !important; border-color: #2E6A8A !important; }
    /* Underline animé sur les liens nav */
    #nsad-hdr a.nsad-nav-link::after {
        content: ''; position: absolute; bottom: 0; left: 0; right: 0;
        height: 1.5px; background: #70E8C6;
        transform: scaleX(0); transition: transform 250ms ease; transform-origin: left;
    }
    /* Scroll shrink */
    #nsad-hdr.nsad-scrolled { height: 68px !important; }
    #nsad-hdr.nsad-scrolled .nsad-logo-img { height: 50px !important; }
    /* Body offset */
    body { padding-top: 100px !important; }
    /* Mobile */
    @media (max-width: 900px) {
        #nsad-hdr { height: 72px !important; padding: 0 20px !important; }
        #nsad-hdr .nsad-nav-wrap  { display: none !important; }
        #nsad-hdr .nsad-btn-phone { display: none !important; }
        #nsad-hdr .nsad-logo-img  { height: 50px !important; }
        body { padding-top: 72px !important; }
    }
    </style>

    <script>
    (function(){
        var h = document.getElementById('nsad-hdr');
        if (!h) return;
        function tick(){ h.classList.toggle('nsad-scrolled', window.scrollY > 60); }
        window.addEventListener('scroll', tick, {passive:true});
        tick();
    })();
    </script>

    <?php
    $home = esc_url(home_url('/'));
    $contact_url = esc_url(home_url('/nous-contacter'));
    $logo_src = esc_url($logo_url);
    ?>

    <!-- NSAD Header — inline styles pour layout infaillible -->
    <div id="nsad-hdr"
         role="banner"
         style="position:fixed;top:0;left:0;right:0;width:100%;z-index:9999;
                display:flex;flex-direction:row;align-items:center;flex-wrap:nowrap;
                height:100px;padding:0 48px;box-sizing:border-box;
                background:rgba(255,255,255,0.97);
                box-shadow:0 2px 24px rgba(46,106,138,0.10);
                font-family:'Poppins',sans-serif;
                transition:height .3s ease,box-shadow .3s ease;">

        <!-- Logo -->
        <div style="flex:0 0 auto;display:flex;align-items:center;margin-right:40px;">
            <a href="<?php echo esc_url(home_url('/accueil/')); ?>" style="display:inline-flex;align-items:center;text-decoration:none;">
                <img class="nsad-logo-img"
                     src="<?php echo $logo_src; ?>"
                     alt="Logo Nantes Aides et Soins à Domicile"
                     style="height:140px;width:auto;display:block;transition:height .3s ease;">
            </a>
        </div>

        <!-- Navigation -->
        <div class="nsad-nav-wrap"
             style="flex:1 1 0;display:flex;justify-content:center;align-items:center;min-width:0;overflow:hidden;">
            <?php
            wp_nav_menu([
                'menu'        => 'menu-principal',
                'container'   => false,
                'items_wrap'  => '<ul id="%1$s" style="list-style:none;margin:0;padding:0;display:flex;flex-direction:row;flex-wrap:nowrap;gap:28px;align-items:center;">%3$s</ul>',
                'link_before' => '',
                'link_after'  => '',
                'walker'      => new class extends Walker_Nav_Menu {
                    public function start_el(&$output, $data_object, $depth = 0, $args = null, $current_object_id = 0) {
                        $item = $data_object;
                        $url  = $item->url ?: '#';
                        $title = esc_html($item->title);
                        $active = in_array('current-menu-item', $item->classes) ? 'current-menu-item' : '';
                        $output .= '<li class="' . $active . '" style="display:flex;align-items:center;margin:0;padding:0;">'
                            . '<a class="nsad-nav-link" href="' . esc_url($url) . '" '
                            . 'style="display:inline-block;text-decoration:none;color:#344852;font-size:14px;font-weight:500;white-space:nowrap;position:relative;padding-bottom:3px;transition:color .2s;">'
                            . $title . '</a></li>';
                    }
                },
            ]);
            ?>
        </div>

        <!-- CTAs -->
        <div style="flex:0 0 auto;display:flex;align-items:center;gap:12px;margin-left:24px;white-space:nowrap;">
            <a class="nsad-btn-contact"
               href="<?php echo $contact_url; ?>"
               style="display:inline-flex;align-items:center;min-height:44px;
                      background:#FF8A75;color:#122432;
                      padding:12px 22px;border-radius:9999px;
                      text-decoration:none;font-size:14px;font-weight:700;
                      border:none;cursor:pointer;
                      box-shadow:0 4px 14px rgba(255,138,117,0.4);
                      transition:background .25s,transform .2s;">
                Nous contacter
            </a>
            <a class="nsad-btn-phone"
               href="tel:0240354343"
               style="display:inline-flex;align-items:center;min-height:44px;
                      color:#2E6A8A;font-size:14px;font-weight:700;
                      text-decoration:none;white-space:nowrap;
                      border:2px solid rgba(46,106,138,0.3);border-radius:9999px;
                      padding:10px 18px;
                      transition:all .2s;">
                02 40 35 43 43
            </a>
            <!-- Hamburger mobile — visible via nsad-common.css @media 960px -->
            <button class="nav-hamburger" id="nsad-hamburger" aria-label="Ouvrir le menu" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>
        </div>

    </div><!-- /#nsad-hdr -->

    <!-- Menu mobile -->
    <?php
    $h2 = home_url('/');
    ?>
    <nav class="nav-mobile" id="nsad-mobile-nav" aria-label="Navigation mobile">
        <a href="<?php echo esc_url($h2); ?>">Accueil</a>
        <a href="<?php echo esc_url($h2 . 'nos-quartiers'); ?>">Nos Quartiers</a>
        <a href="<?php echo esc_url($h2 . 'nos-services'); ?>">Nos Services</a>
        <a href="<?php echo esc_url($h2 . 'nos-actualites'); ?>">Nos Actualités</a>
        <a href="<?php echo esc_url($h2 . 'qui-sommes-nous'); ?>">L'Association</a>
        <a href="<?php echo esc_url($h2 . 'recrutement'); ?>">Recrutement</a>
        <a class="nav-mobile-cta" href="<?php echo esc_url($h2 . 'nous-contacter'); ?>">Nous contacter</a>
    </nav>
    <script>
    (function(){
        var btn = document.getElementById('nsad-hamburger');
        var nav = document.getElementById('nsad-mobile-nav');
        if (!btn || !nav) return;
        btn.addEventListener('click', function(){
            var open = nav.classList.toggle('open');
            btn.classList.toggle('open', open);
            btn.setAttribute('aria-expanded', open ? 'true' : 'false');
            btn.setAttribute('aria-label', open ? 'Fermer le menu' : 'Ouvrir le menu');
        });
        // Fermer sur clic hors menu
        document.addEventListener('click', function(e){
            if (!btn.contains(e.target) && !nav.contains(e.target)) {
                nav.classList.remove('open');
                btn.classList.remove('open');
                btn.setAttribute('aria-expanded', 'false');
                btn.setAttribute('aria-label', 'Ouvrir le menu');
            }
        });
    })();
    </script>
    <?php
}, 1);


// ═══════════════════════════════════════════════════════════════════════
// FOOTER
// ═══════════════════════════════════════════════════════════════════════
add_action('elementor/page_templates/canvas/after_content', function () {
    ?>
    <style>
    /* ── NSAD Footer — miroir exact du repo GitHub ── */
    .nsad-ft {
        background: #0F2F3E;
        color: rgba(255,255,255,0.55);
        font-family: 'Hind', sans-serif;
        font-size: 13.5px;
    }
    .ft-inner  { max-width: 1140px; margin: 0 auto; padding: 0 24px; }
    .ft-grid   {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1.4fr;
        gap: 48px;
        padding: 56px 0 48px;
    }
    /* Colonne marque */
    .ft-brand h2 {
        font-family: 'Poppins', sans-serif;
        font-size: 1.05rem; font-weight: 700;
        color: #fff; margin: 0 0 10px;
    }
    .ft-brand p { opacity: .6; margin-bottom: 8px; }
    .ft-brand address {
        font-style: normal; font-size: 13px;
        color: rgba(255,255,255,0.45); line-height: 1.8; margin-bottom: 18px;
    }
    .ft-brand address a { color: rgba(255,255,255,0.45); text-decoration: none; }
    .ft-brand address a:hover { color: #8FF0D2; }
    /* Réseaux sociaux */
    .ft-social { display: flex; gap: 8px; }
    .ft-social-link {
        width: 32px; height: 32px; background: rgba(255,255,255,0.07);
        border-radius: 6px; display: flex; align-items: center; justify-content: center;
        font-size: 11px; font-weight: 700;
        color: rgba(255,255,255,0.55) !important; text-decoration: none !important;
        transition: background 0.2s, color 0.2s;
    }
    .ft-social-link:hover { background: #3C697F; color: #8FF0D2 !important; }
    /* Colonnes liens */
    .ft-col h3 {
        font-family: 'Poppins', sans-serif;
        font-size: 10px; font-weight: 700;
        color: #8FF0D2; text-transform: uppercase; letter-spacing: 2px;
        margin: 0 0 14px; padding-bottom: 8px;
        border-bottom: 1px solid rgba(143,240,210,0.18);
    }
    .ft-col h3.ft-h3-mt { margin-top: 24px; }
    .ft-col ul { list-style: none; margin: 0; padding: 0; display: flex; flex-direction: column; gap: 7px; }
    .ft-col ul li a {
        color: rgba(255,255,255,0.55); text-decoration: none;
        font-size: 13.5px; transition: color 0.18s;
    }
    .ft-col ul li a:hover { color: #fff; }
    .ft-col ul li a.ft-all {
        color: #8FF0D2 !important; font-weight: 600; font-size: 12.5px;
        margin-top: 3px; display: inline-block;
    }
    .ft-col ul li a.ft-all:hover { color: #fff !important; }
    /* Barre info rapide */
    .ft-bar {
        background: rgba(255,255,255,0.04);
        border-top: 1px solid rgba(255,255,255,0.06);
        padding: 12px 0;
    }
    .ft-bar-inner {
        max-width: 1140px; margin: 0 auto; padding: 0 24px;
        display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;
    }
    .ft-bar-items { display: flex; gap: 24px; flex-wrap: wrap; align-items: center; }
    .ft-bar-item { font-size: 12.5px; color: rgba(255,255,255,0.45); display: flex; align-items: center; gap: 6px; }
    .ft-phone {
        color: #fff; font-family: 'Poppins', sans-serif;
        font-weight: 700; font-size: 15px; text-decoration: none;
        background: #3C697F; padding: 8px 18px; border-radius: 9999px;
        transition: background 0.2s;
    }
    .ft-phone:hover { background: #2E6A8A; }
    /* Pied de page bas */
    .ft-bottom {
        border-top: 1px solid rgba(255,255,255,0.07);
        padding: 20px 0;
        display: flex; align-items: center; justify-content: space-between;
        flex-wrap: wrap; gap: 10px;
        font-size: 12px; color: rgba(255,255,255,0.3);
    }
    .ft-bottom a { color: rgba(255,255,255,0.3); text-decoration: none; }
    .ft-bottom a:hover { color: rgba(255,255,255,0.6); }
    /* Responsive */
    @media (max-width: 960px) {
        .ft-grid { grid-template-columns: 1fr 1fr; gap: 32px; }
        .ft-bar-items { gap: 16px; }
    }
    @media (max-width: 580px) {
        .ft-grid { grid-template-columns: 1fr; gap: 28px; }
        .ft-bar-inner { flex-direction: column; align-items: flex-start; }
        .ft-bar-items { gap: 10px; flex-direction: column; }
        .ft-bottom { flex-direction: column; align-items: flex-start; }
    }
    </style>

    <?php
    $h = home_url('/');
    ?>

    <!-- Barre info rapide -->
    <div class="ft-bar">
        <div class="ft-bar-inner">
            <div class="ft-bar-items">
                <span class="ft-bar-item">
                    <svg width="13" height="13" viewBox="0 0 13 13" fill="none" aria-hidden="true"><path d="M6.5 1C4.57 1 3 2.57 3 4.5c0 3 3.5 7.5 3.5 7.5S10 7.5 10 4.5C10 2.57 8.43 1 6.5 1z" fill="rgba(255,255,255,0.7)"/><circle cx="6.5" cy="4.5" r="1.3" fill="#3C697F"/></svg>
                    6 rue Bel Air – 44000 Nantes
                </span>
                <span class="ft-bar-item">
                    <svg width="13" height="13" viewBox="0 0 13 13" fill="none" aria-hidden="true"><circle cx="6.5" cy="6.5" r="5" stroke="rgba(255,255,255,0.7)" stroke-width="1.3"/><path d="M6.5 3.5v3l1.8 1.3" stroke="rgba(255,255,255,0.7)" stroke-width="1.3" stroke-linecap="round"/></svg>
                    Lun.–Ven. 7h45–12h30 &amp; 14h–17h30
                </span>
                <span class="ft-bar-item">
                    <svg width="13" height="13" viewBox="0 0 13 13" fill="none" aria-hidden="true"><circle cx="6.5" cy="6.5" r="4.5" stroke="rgba(255,255,255,0.7)" stroke-width="1.3"/><path d="M4.5 8.5L6.5 6.5L8.5 8.5M8.5 4.5L6.5 6.5L4.5 4.5" stroke="#70E8C6" stroke-width="1.1" stroke-linecap="round"/></svg>
                    Interventions 7j/7
                </span>
            </div>
        </div>
    </div>

    <footer id="nsad-footer" class="nsad-ft" role="contentinfo">
        <div class="ft-inner">
            <div class="ft-grid">

                <!-- Colonne 1 : Marque -->
                <div class="ft-brand">
                    <h2>Nantes Aides et Soins à Domicile</h2>
                    <p>Association à but non lucratif<br>Partenaire du CHU de Nantes.</p>
                    <address>
                        6 rue Bel Air – 44000 Nantes<br>
                        <a href="tel:0240354343">02 40 35 43 43</a>&nbsp;·&nbsp;<a href="mailto:contact@ssiadnsaid.fr">contact@ssiadnsaid.fr</a><br>
                        Lun.–Ven. 7h45–12h30 &amp; 14h–17h30 · Interventions 7j/7
                    </address>
                    <div class="ft-social">
                        <a class="ft-social-link" href="https://www.linkedin.com/company/nantes-soins-a-domicile" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">in</a>
                        <a class="ft-social-link" href="https://www.facebook.com/nantessoinsadomicile" target="_blank" rel="noopener noreferrer" aria-label="Facebook">f</a>
                        <a class="ft-social-link" href="https://www.youtube.com/@nantessoinsadomicile" target="_blank" rel="noopener noreferrer" aria-label="YouTube">▶</a>
                    </div>
                    <nav class="ft-quicknav" style="margin-top:16px;display:flex;flex-wrap:wrap;gap:5px 16px;">
                        <a href="<?php echo esc_url($h . 'accueil'); ?>" style="color:rgba(255,255,255,0.5);font-size:12.5px;text-decoration:none;transition:color .18s;" onmouseover="this.style.color='#8FF0D2'" onmouseout="this.style.color='rgba(255,255,255,0.5)'">Accueil</a>
                        <a href="<?php echo esc_url($h . 'faq'); ?>" style="color:rgba(255,255,255,0.5);font-size:12.5px;text-decoration:none;transition:color .18s;" onmouseover="this.style.color='#8FF0D2'" onmouseout="this.style.color='rgba(255,255,255,0.5)'">FAQ</a>
                        <a href="<?php echo esc_url($h . 'nos-actualites'); ?>" style="color:rgba(255,255,255,0.5);font-size:12.5px;text-decoration:none;transition:color .18s;" onmouseover="this.style.color='#8FF0D2'" onmouseout="this.style.color='rgba(255,255,255,0.5)'">Actualités</a>
                    </nav>
                </div>

                <!-- Colonne 2 : Nos Quartiers -->
                <div class="ft-col">
                    <h3>Nos Quartiers</h3>
                    <ul>
                        <li><a href="<?php echo esc_url($h . 'quartier-centre-ville'); ?>">Centre-ville</a></li>
                        <li><a href="<?php echo esc_url($h . 'quartier-ile-de-nantes'); ?>">Île de Nantes</a></li>
                        <li><a href="<?php echo esc_url($h . 'quartier-bellevue-chantenay'); ?>">Bellevue-Chantenay</a></li>
                        <li><a href="<?php echo esc_url($h . 'quartier-dervallieres-zola'); ?>">Dervallières-Zola</a></li>
                        <li><a href="<?php echo esc_url($h . 'quartier-hauts-paves-saint-felix'); ?>">Hauts-Pavés</a></li>
                        <li><a href="<?php echo esc_url($h . 'quartier-breil-barbiere'); ?>">Breil-Barbière</a></li>
                        <li><a href="<?php echo esc_url($h . 'quartier-malakoff-saint-donatien'); ?>">Malakoff</a></li>
                        <li><a href="<?php echo esc_url($h . 'quartier-nantes-nord'); ?>">Nantes Nord</a></li>
                        <li><a href="<?php echo esc_url($h . 'quartier-nantes-sud'); ?>">Nantes Sud</a></li>
                        <li><a class="ft-all" href="<?php echo esc_url($h . 'nos-quartiers'); ?>">Tous les quartiers →</a></li>
                    </ul>
                </div>

                <!-- Colonne 3 : Nos Services -->
                <div class="ft-col">
                    <h3>Nos Services</h3>
                    <ul>
                        <li><a href="<?php echo esc_url($h . 'soins-infirmiers-nantes'); ?>">Soins infirmiers</a></li>
                        <li><a href="<?php echo esc_url($h . 'soin-hygiene-domicile-nantes'); ?>">Soins d'hygiène</a></li>
                        <li><a href="<?php echo esc_url($h . 'nursing-aide-soignant-nantes'); ?>">Aide-soignant(e)</a></li>
                        <li><a href="<?php echo esc_url($h . 'accompagnement-fin-de-vie-nantes'); ?>">Fin de vie</a></li>
                        <li><a href="<?php echo esc_url($h . 'aide-a-domicile-nantes'); ?>">Aide à domicile</a></li>
                        <li><a href="<?php echo esc_url($h . 'nutrition-repas-domicile-nantes'); ?>">Nutrition &amp; repas</a></li>
                        <li><a href="<?php echo esc_url($h . 'mobilite-vie-sociale-nantes'); ?>">Mobilité &amp; lien social</a></li>
                        <li><a href="<?php echo esc_url($h . 'dossiers-apa-pch-nantes'); ?>">APA / PCH</a></li>
                        <li><a href="<?php echo esc_url($h . 'lien-famille-corps-medical-nantes'); ?>">Famille &amp; médecin</a></li>
                        <li><a class="ft-all" href="<?php echo esc_url($h . 'nos-services'); ?>">Tous les services →</a></li>
                    </ul>
                </div>

                <!-- Colonne 4 : Actualités + Association -->
                <div class="ft-col">
                    <h3>Nos Actualités</h3>
                    <ul>
                        <li><a href="<?php echo esc_url($h . 'comprendre-alzheimer-parkinson-nantes'); ?>">Alzheimer &amp; Parkinson</a></li>
                        <li><a href="<?php echo esc_url($h . 'guide-aidant-nantais'); ?>">Guide de l'aidant nantais</a></li>
                        <li><a href="<?php echo esc_url($h . 'soin-domicile-vs-ehpad'); ?>">Soins à domicile vs EHPAD</a></li>
                        <li><a href="<?php echo esc_url($h . 'qui-beneficie-ssiad'); ?>">Qui bénéficie du SSIAD ?</a></li>
                        <li><a href="<?php echo esc_url($h . 'mag-expert'); ?>">Le Mag Expert</a></li>
                        <li><a class="ft-all" href="<?php echo esc_url($h . 'nos-actualites'); ?>">Tous les articles →</a></li>
                    </ul>
                    <h3 class="ft-h3-mt">L'Association</h3>
                    <ul>
                        <li><a href="<?php echo esc_url($h . 'qui-sommes-nous'); ?>">Qui sommes-nous ?</a></li>
                        <li><a href="<?php echo esc_url($h . 'nos-valeurs-engagements'); ?>">Nos valeurs</a></li>
                        <li><a href="<?php echo esc_url($h . 'nos-partenaires'); ?>">Nos partenaires</a></li>
                        <li><a href="<?php echo esc_url($h . 'recrutement'); ?>">Recrutement</a></li>
                        <li><a href="<?php echo esc_url($h . 'nous-contacter'); ?>">Contact</a></li>
                    </ul>
                </div>

            </div><!-- /.ft-grid -->

            <div class="ft-bottom">
                <span>© 2026 Nantes Aides et Soins à Domicile – Nantes (44000)</span>
                <span>
                    <a href="<?php echo esc_url($h . 'mentions-legales'); ?>">Mentions légales</a>
                </span>
            </div>
        </div><!-- /.ft-inner -->
    </footer>

    <!-- Bouton d'appel flottant — présent sur toutes les pages -->
    <a href="tel:0240354343" class="nsad-floating-call" aria-label="Appeler Nantes Aides et Soins à Domicile">
        <span class="fc-icon">📞</span>
        <span class="fc-label">02&nbsp;40&nbsp;35&nbsp;43&nbsp;43</span>
    </a>
    <?php
}, 99);

// ═══════════════════════════════════════════════════════════════════════
// MAILLAGE — CSS cards (wp_head, universel : pages Elementor + single posts)
// ═══════════════════════════════════════════════════════════════════════
add_action('wp_head', function() {
    if (!is_singular()) return;
    ?>
    <style id="nsad-cards-css">
    .nsad-rs{background:#f4f9fb;padding:50px 24px 40px;font-family:'Hind',sans-serif;}
    .nsad-rs-inner{max-width:1100px;margin:0 auto;}
    .nsad-rs-heading{font-family:'Poppins',sans-serif;font-size:1.35rem;font-weight:700;color:#3C697F;margin:0 0 36px;line-height:1.3;}
    .nsad-rs-group{margin-bottom:32px;}
    .nsad-rs-group-label{font-family:'Poppins',sans-serif;font-size:0.72rem;font-weight:700;color:#3C697F;text-transform:uppercase;letter-spacing:2px;margin:0 0 13px;display:flex;align-items:center;gap:8px;}
    .nsad-rs-group-label::before{content:'';display:inline-block;width:3px;height:14px;background:#8FF0D2;border-radius:2px;flex-shrink:0;}
    .nsad-rs-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(210px,1fr));gap:14px;}
    .nsad-rs-grid--sm{grid-template-columns:repeat(auto-fill,minmax(165px,1fr));}
    .nsad-card{display:flex;align-items:center;justify-content:space-between;background:#ffffff;border-radius:8px;border-top:5px solid transparent;padding:16px 18px 14px;text-decoration:none;gap:10px;box-shadow:0 2px 10px rgba(60,105,127,.07);transition:transform .22s ease,box-shadow .22s ease;min-height:64px;}
    .nsad-card:hover{transform:translateY(-5px);box-shadow:0 10px 26px rgba(60,105,127,.15);text-decoration:none;}
    .nsad-card--mint   {border-top-color:#8FF0D2;}
    .nsad-card--coral  {border-top-color:#FF9E8E;}
    .nsad-card--primary{border-top-color:#3C697F;}
    .nsad-card--article{border-top-color:#c8dce8;background:#f8fbfd;}
    .nsad-card-text{font-family:'Poppins',sans-serif;font-size:1rem;font-weight:600;color:#3C697F;line-height:1.35;flex:1;}
    .nsad-card--article .nsad-card-text{font-family:'Hind',sans-serif;font-size:1rem;font-weight:500;color:#344852;}
    .nsad-card--primary .nsad-card-text{color:#1a2d36;}
    .nsad-card-arrow{font-size:1.1rem;color:#8FF0D2;flex-shrink:0;transition:transform .2s ease;}
    .nsad-card--coral   .nsad-card-arrow{color:#FF9E8E;}
    .nsad-card--primary .nsad-card-arrow{color:#3C697F;}
    .nsad-card--article .nsad-card-arrow{color:#c8dce8;}
    .nsad-card:hover .nsad-card-arrow{transform:translateX(4px);}
    .nsad-rs-cta{background:#ffffff;border-left:4px solid #8FF0D2;border-radius:0 8px 8px 0;padding:13px 20px;font-family:'Hind',sans-serif;font-size:1rem;line-height:1.8;box-shadow:0 1px 5px rgba(60,105,127,.06);margin-top:8px;}
    .nsad-rs-cta strong{font-family:'Poppins',sans-serif;color:#1a2d36;}
    .nsad-rs-cta a{color:#3C697F;text-decoration:none;font-weight:500;}
    .nsad-rs-cta a:hover{text-decoration:underline;}
    @media(max-width:600px){.nsad-rs{padding:36px 16px 28px;}.nsad-rs-grid,.nsad-rs-grid--sm{grid-template-columns:1fr;}.nsad-rs-heading{font-size:1.15rem;}}
    @media(min-width:601px) and (max-width:960px){.nsad-rs-grid{grid-template-columns:repeat(2,1fr);}.nsad-rs-grid--sm{grid-template-columns:repeat(2,1fr);}}
    </style>
    <?php
}, 50);

// ═══════════════════════════════════════════════════════════════════════
// MAILLAGE — Single posts (articles de blog) via the_content filter
// ═══════════════════════════════════════════════════════════════════════
add_filter('the_content', function($content) {
    if (!is_single() || !in_the_loop() || !is_main_query() || get_post_type() !== 'post') {
        return $content;
    }

    $h = home_url('/');
    $services = [
        'Soins infirmiers'  => ['slug'=>'soins-infirmiers-nantes',         'color'=>'mint'],
        "Soins d'hygiène"   => ['slug'=>'soin-hygiene-domicile-nantes',    'color'=>'mint'],
        'Aide-soignant(e)'  => ['slug'=>'nursing-aide-soignant-nantes',    'color'=>'mint'],
        'Fin de vie'        => ['slug'=>'accompagnement-fin-de-vie-nantes','color'=>'mint'],
        'Aide à domicile'   => ['slug'=>'aide-a-domicile-nantes',          'color'=>'coral'],
        'Nutrition & repas' => ['slug'=>'nutrition-repas-domicile-nantes', 'color'=>'coral'],
        'Mobilité sociale'  => ['slug'=>'mobilite-vie-sociale-nantes',     'color'=>'coral'],
        'Dossiers APA/PCH'  => ['slug'=>'dossiers-apa-pch-nantes',        'color'=>'coral'],
        'Famille & médecin' => ['slug'=>'lien-famille-corps-medical-nantes','color'=>'mint'],
    ];

    ob_start();
    echo '<section class="nsad-rs" aria-label="Ressources et accompagnement">';
    echo '<div class="nsad-rs-inner">';
    echo '<h3 class="nsad-rs-heading">Nos services à domicile à Nantes</h3>';
    echo '<div class="nsad-rs-group"><p class="nsad-rs-group-label">Services disponibles</p><div class="nsad-rs-grid">';
    foreach ($services as $label => $svc) {
        echo '<a class="nsad-card nsad-card--' . $svc['color'] . '" href="' . esc_url($h . $svc['slug']) . '">'
           . '<span class="nsad-card-text">' . esc_html($label) . '</span>'
           . '<span class="nsad-card-arrow" aria-hidden="true">→</span>'
           . '</a>';
    }
    echo '</div></div>';
    echo '<div class="nsad-rs-cta"><strong>En savoir plus :</strong> '
       . '<a href="' . esc_url($h . 'nous-contacter') . '">Nous contacter</a> · '
       . '<a href="' . esc_url($h . 'dossiers-apa-pch-nantes') . '">Aides APA/PCH</a> · '
       . '<a href="' . esc_url($h . 'recrutement') . '">Recrutement</a> · '
       . '<a href="' . esc_url($h . 'mag-expert') . '">Mag Expert</a></div>';
    echo '</div></section>';
    $cards_html = ob_get_clean();

    return $content . $cards_html;
}, 20);

// ═══════════════════════════════════════════════════════════════════════
// MAILLAGE INTERNE — Blocs contextuels injectés dans pages Elementor
// Priority 20 = avant le footer (99), après le contenu Elementor
// ═══════════════════════════════════════════════════════════════════════
add_action('elementor/page_templates/canvas/after_content', function() {
    $post_id = get_the_ID();
    if (!$post_id) return;
    $slug = get_post_field('post_name', $post_id);
    $h    = home_url('/');

    $quartiers = [
        'Centre-ville'        => 'quartier-centre-ville',
        'Île de Nantes'       => 'quartier-ile-de-nantes',
        'Bellevue-Chantenay'  => 'quartier-bellevue-chantenay',
        'Dervallières-Zola'   => 'quartier-dervallieres-zola',
        'Hauts-Pavés'         => 'quartier-hauts-paves-saint-felix',
        'Breil-Barbière'      => 'quartier-breil-barbiere',
        'Malakoff'            => 'quartier-malakoff-saint-donatien',
        'Nantes Nord'         => 'quartier-nantes-nord',
        'Nantes Sud'          => 'quartier-nantes-sud',
    ];

    $services = [
        'Soins infirmiers'      => 'soins-infirmiers-nantes',
        "Soins d'hygiène"       => 'soin-hygiene-domicile-nantes',
        'Aide-soignant(e)'      => 'nursing-aide-soignant-nantes',
        'Fin de vie'            => 'accompagnement-fin-de-vie-nantes',
        'Aide à domicile'       => 'aide-a-domicile-nantes',
        'Nutrition & repas'     => 'nutrition-repas-domicile-nantes',
        'Mobilité sociale'      => 'mobilite-vie-sociale-nantes',
        'Dossiers APA/PCH'      => 'dossiers-apa-pch-nantes',
        'Famille & médecin'     => 'lien-famille-corps-medical-nantes',
    ];

    $cocon = [
        'soins-infirmiers-nantes'          => ['soin-hygiene-domicile-nantes','nursing-aide-soignant-nantes','accompagnement-fin-de-vie-nantes'],
        'soin-hygiene-domicile-nantes'     => ['soins-infirmiers-nantes','nursing-aide-soignant-nantes','accompagnement-fin-de-vie-nantes'],
        'nursing-aide-soignant-nantes'     => ['soins-infirmiers-nantes','soin-hygiene-domicile-nantes','lien-famille-corps-medical-nantes'],
        'accompagnement-fin-de-vie-nantes' => ['soins-infirmiers-nantes','soin-hygiene-domicile-nantes','lien-famille-corps-medical-nantes'],
        'aide-a-domicile-nantes'           => ['nutrition-repas-domicile-nantes','mobilite-vie-sociale-nantes','dossiers-apa-pch-nantes'],
        'nutrition-repas-domicile-nantes'  => ['aide-a-domicile-nantes','mobilite-vie-sociale-nantes','dossiers-apa-pch-nantes'],
        'mobilite-vie-sociale-nantes'      => ['aide-a-domicile-nantes','nutrition-repas-domicile-nantes','dossiers-apa-pch-nantes'],
        'dossiers-apa-pch-nantes'          => ['lien-famille-corps-medical-nantes','soins-infirmiers-nantes','aide-a-domicile-nantes'],
        'lien-famille-corps-medical-nantes'=> ['soins-infirmiers-nantes','accompagnement-fin-de-vie-nantes','dossiers-apa-pch-nantes'],
    ];

    // Articles Mag Expert recommandés par service
    $service_articles = [
        'soins-infirmiers-nantes'          => ['Qui bénéficie du SSIAD ?'=>'qui-beneficie-ssiad', 'Travailler en SSIAD'=>'travailler-en-ssiad'],
        'soin-hygiene-domicile-nantes'     => ['Comment s\'organise une tournée'=>'tournee-aide-soignant', 'Le rôle des aides-soignants'=>'role-aide-soignant-ssiad'],
        'nursing-aide-soignant-nantes'     => ['Le rôle des aides-soignants'=>'role-aide-soignant-ssiad', 'Différence aide-soignante / auxiliaire de vie'=>'difference-aide-soignante-auxiliaire-vie'],
        'accompagnement-fin-de-vie-nantes' => ['Soins à domicile vs EHPAD'=>'soin-domicile-vs-ehpad', 'Comprendre Alzheimer & Parkinson'=>'comprendre-alzheimer-parkinson-nantes'],
        'aide-a-domicile-nantes'           => ['Quelle différence aide à domicile / aide à la personne ?'=>'difference-aide-domicile-aide-personne', 'Soins à domicile vs EHPAD'=>'soin-domicile-vs-ehpad'],
        'nutrition-repas-domicile-nantes'  => ['Guide de l\'aidant nantais'=>'guide-aidant-nantais', 'Comprendre Alzheimer & Parkinson'=>'comprendre-alzheimer-parkinson-nantes'],
        'mobilite-vie-sociale-nantes'      => ['Guide de l\'aidant nantais'=>'guide-aidant-nantais', 'Soins à domicile vs EHPAD'=>'soin-domicile-vs-ehpad'],
        'dossiers-apa-pch-nantes'          => ['Guide de l\'aidant nantais'=>'guide-aidant-nantais', 'Quelle différence aide à domicile / aide à la personne ?'=>'difference-aide-domicile-aide-personne'],
        'lien-famille-corps-medical-nantes'=> ['Guide de l\'aidant nantais'=>'guide-aidant-nantais', 'Comprendre Alzheimer & Parkinson'=>'comprendre-alzheimer-parkinson-nantes'],
    ];

    $service_slugs  = array_values($services);
    $quartier_slugs = array_values($quartiers);

    // ── Helpers locaux ────────────────────────────────────────────────
    // Détermine la couleur de bordure d'un slug service
    $svc_color = function(string $s) : string {
        static $coral = ['aide-a-domicile-nantes','nutrition-repas-domicile-nantes',
                         'mobilite-vie-sociale-nantes','dossiers-apa-pch-nantes'];
        return in_array($s, $coral, true) ? 'coral' : 'mint';
    };

    // Rendu d'une carte
    $card = function(string $label, string $url, string $color = 'mint') {
        echo '<a class="nsad-card nsad-card--' . $color . '" href="' . esc_url($url) . '">'
           . '<span class="nsad-card-text">' . esc_html($label) . '</span>'
           . '<span class="nsad-card-arrow" aria-hidden="true">→</span>'
           . '</a>';
    };

    // Ouvre un groupe
    $group_open = function(string $label, string $extra_class = '') {
        echo '<div class="nsad-rs-group">'
           . '<p class="nsad-rs-group-label">' . esc_html($label) . '</p>'
           . '<div class="nsad-rs-grid' . ($extra_class ? ' ' . $extra_class : '') . '">';
    };
    $group_close = function() { echo '</div></div>'; };

    // Ouvre / ferme la section
    $section_open = function(string $title) {
        echo '<section class="nsad-rs" aria-label="Ressources et accompagnement">'
           . '<div class="nsad-rs-inner">'
           . '<h3 class="nsad-rs-heading">' . esc_html($title) . '</h3>';
    };
    $section_close = function() { echo '</div></section>'; };

    // ── Pages services ────────────────────────────────────────────────
    if (in_array($slug, $service_slugs)) {
        $section_open('Pour aller plus loin dans votre accompagnement');

        // Groupe 1 : cocon — services complémentaires
        $related = $cocon[$slug] ?? [];
        if ($related) {
            $group_open('Services complémentaires');
            foreach ($services as $label => $s) {
                if (in_array($s, $related, true)) $card($label, $h.$s, $svc_color($s));
            }
            $group_close();
        }

        // Groupe 2 : quartiers d'intervention
        $group_open('Nous intervenons dans votre quartier', 'nsad-rs-grid--sm');
        foreach ($quartiers as $label => $qs) $card($label, $h.$qs, 'primary');
        $card('Tous les quartiers →', $h.'nos-quartiers', 'primary');
        $group_close();

        // Groupe 3 : Lire aussi — Mag Expert
        $lire_aussi = $service_articles[$slug] ?? [];
        if ($lire_aussi) {
            $group_open('À lire également — Mag Expert', 'nsad-rs-grid--sm');
            foreach ($lire_aussi as $art_label => $art_slug_val) $card($art_label, home_url('/'.$art_slug_val.'/'), 'article');
            $group_close();
        }

        echo '<div class="nsad-rs-cta"><strong>Besoin d\'aide ?</strong> '
           . '<a href="' . esc_url($h.'nous-contacter') . '">Contactez-nous</a> · '
           . '<a href="' . esc_url($h.'dossiers-apa-pch-nantes') . '">Aides financières APA/PCH</a> · '
           . '<a href="' . esc_url($h.'nos-services') . '">Tous nos services</a></div>';

        $section_close();

    // ── Pages quartiers ───────────────────────────────────────────────
    } elseif (in_array($slug, $quartier_slugs)) {
        $section_open('Tout ce que nous faisons pour vous');

        // Groupe 1 : tous les services (mint/coral selon type)
        $group_open('Nos services à domicile');
        foreach ($services as $label => $s) $card($label, $h.$s, $svc_color($s));
        $card('Tous les services →', $h.'nos-services', 'mint');
        $group_close();

        // Groupe 2 : autres quartiers
        $group_open('Nos autres quartiers d\'intervention', 'nsad-rs-grid--sm');
        foreach ($quartiers as $label => $qs) {
            if ($qs !== $slug) $card($label, $h.$qs, 'primary');
        }
        $card('Voir tous →', $h.'nos-quartiers', 'primary');
        $group_close();

        echo '<div class="nsad-rs-cta"><strong>Ressources utiles :</strong> '
           . '<a href="' . esc_url($h.'guide-aidant-nantais') . '">Guide de l\'aidant nantais</a> · '
           . '<a href="' . esc_url($h.'dossiers-apa-pch-nantes') . '">Aides APA/PCH</a> · '
           . '<a href="' . esc_url($h.'comprendre-alzheimer-parkinson-nantes') . '">Alzheimer &amp; Parkinson</a> · '
           . '<a href="' . esc_url($h.'nous-contacter') . '">Nous contacter</a></div>';

        $section_close();

    // ── Hub nos-services ──────────────────────────────────────────────
    } elseif ($slug === 'nos-services') {
        $section_open('Tous nos services à domicile');
        $group_open('Choisissez votre service');
        foreach ($services as $label => $s) $card($label, $h.$s, $svc_color($s));
        $group_close();
        echo '<div class="nsad-rs-cta"><strong>Nos quartiers :</strong> ';
        $ql = [];
        foreach ($quartiers as $label => $qs) $ql[] = '<a href="' . esc_url($h.$qs) . '">' . esc_html($label) . '</a>';
        echo implode(' · ', $ql) . ' · <a href="' . esc_url($h.'nos-quartiers') . '">Voir la carte</a></div>';
        $section_close();

    // ── Hub nos-quartiers ─────────────────────────────────────────────
    } elseif ($slug === 'nos-quartiers') {
        $section_open('Nos quartiers d\'intervention à Nantes');
        $group_open('Choisissez votre quartier', 'nsad-rs-grid--sm');
        foreach ($quartiers as $label => $qs) $card($label, $h.$qs, 'primary');
        $group_close();
        echo '<div class="nsad-rs-cta"><strong>Nos services :</strong> ';
        $sl = [];
        foreach ($services as $label => $s) $sl[] = '<a href="' . esc_url($h.$s) . '">' . esc_html($label) . '</a>';
        echo implode(' · ', $sl) . ' · <a href="' . esc_url($h.'nos-services') . '">Tous nos services</a></div>';
        $section_close();

    // ── Hubs mag / actualités ─────────────────────────────────────────
    } elseif (in_array($slug, ['mag-expert','nos-actualites'])) {
        $section_open('Explorer le Mag Expert');
        $arts = get_posts(['post_type'=>'post','post_status'=>'publish','posts_per_page'=>8,'orderby'=>'date','order'=>'DESC']);
        $group_open('Articles récents');
        foreach ($arts as $a) $card(mb_substr($a->post_title, 0, 55), get_permalink($a->ID), 'article');
        $group_close();
        echo '<div class="nsad-rs-cta"><strong>Nos services :</strong> '
           . '<a href="' . esc_url($h.'soins-infirmiers-nantes') . '">Soins infirmiers</a> · '
           . '<a href="' . esc_url($h.'aide-a-domicile-nantes') . '">Aide à domicile</a> · '
           . '<a href="' . esc_url($h.'dossiers-apa-pch-nantes') . '">APA/PCH</a> · '
           . '<a href="' . esc_url($h.'nos-services') . '">Tous nos services</a></div>';
        $section_close();

    // ── Pages association ─────────────────────────────────────────────
    } elseif (in_array($slug, ['qui-sommes-nous','nos-valeurs-engagements','nos-partenaires'])) {
        $section_open('Découvrir nos services et nous rejoindre');
        $group_open('Nos principaux services');
        foreach (['Soins infirmiers'=>'soins-infirmiers-nantes','Aide à domicile'=>'aide-a-domicile-nantes',
                  'Aide-soignant(e)'=>'nursing-aide-soignant-nantes','Dossiers APA/PCH'=>'dossiers-apa-pch-nantes'] as $l => $s) {
            $card($l, $h.$s, $svc_color($s));
        }
        $card('Tous nos services →', $h.'nos-services', 'mint');
        $group_close();
        echo '<div class="nsad-rs-cta">'
           . '<a href="' . esc_url($h.'recrutement') . '">Recrutement</a> · '
           . '<a href="' . esc_url($h.'nous-contacter') . '">Nous contacter</a> · '
           . '<a href="' . esc_url($h.'faq') . '">FAQ</a></div>';
        $section_close();

    // ── Recrutement ───────────────────────────────────────────────────
    } elseif ($slug === 'recrutement') {
        $section_open('Articles pour préparer votre candidature');
        $recrutement_articles_list = [
            'Travailler en SSIAD'             => 'travailler-en-ssiad',
            'Devenir aide-soignant(e)'        => 'devenir-aide-soignant',
            'Métiers du social et du soin'    => 'metiers-social-soin',
            'Comment s\'organise une tournée' => 'tournee-aide-soignant',
            '7 raisons de devenir aide-soignant' => 'raisons-pourquoi-devenir-aide-soignant',
            'Le guide Loire-Atlantique'       => 'travailler-soin-domicile-loire-atlantique',
            'VAE aide-soignant'               => 'vae-aide-soignant',
            'Réussir le concours'             => 'reussir-concours-aide-soignant',
            'Les 11 compétences clés'         => 'onze-competences-aide-soignant',
        ];
        $group_open('Articles Mag Expert');
        foreach ($recrutement_articles_list as $label => $art_slug_val) {
            $card($label, home_url('/'.$art_slug_val.'/'), 'article');
        }
        $group_close();
        echo '<div class="nsad-rs-cta"><strong>L\'association :</strong> '
           . '<a href="' . esc_url($h.'qui-sommes-nous') . '">Qui sommes-nous</a> · '
           . '<a href="' . esc_url($h.'nos-valeurs-engagements') . '">Nos valeurs</a> · '
           . '<a href="' . esc_url($h.'nous-contacter') . '">Nous contacter</a></div>';
        $section_close();

    // ── FAQ ───────────────────────────────────────────────────────────
    } elseif ($slug === 'faq') {
        $section_open('Ressources utiles');
        $group_open('Nos services');
        foreach (['Soins infirmiers'=>'soins-infirmiers-nantes','Aide à domicile'=>'aide-a-domicile-nantes',
                  'Dossiers APA/PCH'=>'dossiers-apa-pch-nantes','Guide de l\'aidant'=>'guide-aidant-nantais'] as $l => $s) {
            $card($l, $h.$s, $svc_color($s));
        }
        $card('Nous contacter', $h.'nous-contacter', 'primary');
        $group_close();
        $section_close();

    // ── Contact ───────────────────────────────────────────────────────
    } elseif ($slug === 'nous-contacter') {
        $section_open('Nos services à votre disposition');
        $group_open('Services disponibles');
        foreach ($services as $label => $s) $card($label, $h.$s, $svc_color($s));
        $group_close();
        echo '<div class="nsad-rs-cta">'
           . '<a href="' . esc_url($h.'nos-quartiers') . '">Nos quartiers</a> · '
           . '<a href="' . esc_url($h.'faq') . '">FAQ</a> · '
           . '<a href="' . esc_url($h.'guide-aidant-nantais') . '">Guide de l\'aidant</a></div>';
        $section_close();

    // ── Accueil ───────────────────────────────────────────────────────
    } elseif (in_array($slug, ['accueil',''], true) || is_front_page()) {
        $section_open('Nos services et nos quartiers d\'intervention');

        $group_open('Nos services à domicile');
        foreach ($services as $label => $s) $card($label, $h.$s, $svc_color($s));
        $group_close();

        $group_open('Nos quartiers d\'intervention à Nantes', 'nsad-rs-grid--sm');
        foreach ($quartiers as $label => $qs) $card($label, $h.$qs, 'primary');
        $group_close();

        $section_close();
    }

}, 20);

// ═══════════════════════════════════════════════════════════════════════
// SCHEMA.ORG JSON-LD — sortie depuis meta/options sauvegardées
// Les données sont générées par nsad-inject-schema.php et stockées en DB.
// Fallback dynamique si la meta n'existe pas encore.
// ═══════════════════════════════════════════════════════════════════════
add_action('wp_head', function() {
    $h    = home_url('/');
    $base = rtrim($h, '/');
    $flag = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT;

    $svc_slugs = ['soins-infirmiers-nantes','soin-hygiene-domicile-nantes','nursing-aide-soignant-nantes',
                  'accompagnement-fin-de-vie-nantes','aide-a-domicile-nantes','nutrition-repas-domicile-nantes',
                  'mobilite-vie-sociale-nantes','dossiers-apa-pch-nantes','lien-famille-corps-medical-nantes'];
    $qrt_slugs = ['quartier-centre-ville','quartier-ile-de-nantes','quartier-bellevue-chantenay',
                  'quartier-dervallieres-zola','quartier-hauts-paves-saint-felix','quartier-breil-barbiere',
                  'quartier-malakoff-saint-donatien','quartier-nantes-nord','quartier-nantes-sud'];
    $assoc_slugs = ['qui-sommes-nous','nos-valeurs-engagements','nos-partenaires','recrutement'];

    // ── 1. MedicalBusiness + WebSite ─────────────────────────────────
    // Lecture depuis l'option sauvegardée par nsad-inject-schema.php
    $saved_home = get_option('nsad_schema_home', []);
    if (!empty($saved_home['medical'])) {
        echo '<script type="application/ld+json">' . $saved_home['medical'] . '</script>' . "\n";
        if (!empty($saved_home['website'])) {
            echo '<script type="application/ld+json">' . $saved_home['website'] . '</script>' . "\n";
        }
    } else {
        // Fallback dynamique (avant première exécution de nsad-inject-schema.php)
        $org_fb = [
            '@context' => 'https://schema.org', '@type' => 'MedicalBusiness',
            '@id' => $base.'/#organisation', 'name' => 'Nantes Aides et Soins à Domicile',
            'url' => $base, 'telephone' => '+33240354343',
            'address' => ['@type'=>'PostalAddress','streetAddress'=>'6 rue Bel Air',
                          'addressLocality'=>'Nantes','postalCode'=>'44000','addressCountry'=>'FR'],
            'areaServed' => ['@type'=>'City','name'=>'Nantes'],
            'medicalSpecialty' => 'Nursing',
        ];
        echo '<script type="application/ld+json">' . wp_json_encode($org_fb, $flag) . '</script>' . "\n";
    }

    // ── 2. BreadcrumbList ─────────────────────────────────────────────
    $obj  = get_queried_object();
    $slug = $obj ? get_post_field('post_name', $obj->ID) : '';
    $crumbs = [['@type'=>'ListItem','position'=>1,'name'=>'Accueil','item'=>$h.'accueil/']];

    if ($slug && $slug !== 'accueil' && !is_front_page()) {
        if (in_array($slug, $svc_slugs)) {
            $crumbs[] = ['@type'=>'ListItem','position'=>2,'name'=>'Nos Services','item'=>$h.'nos-services/'];
            $crumbs[] = ['@type'=>'ListItem','position'=>3,'name'=>get_the_title($obj->ID),'item'=>get_permalink($obj->ID)];
        } elseif (in_array($slug, $qrt_slugs)) {
            $crumbs[] = ['@type'=>'ListItem','position'=>2,'name'=>'Nos Quartiers','item'=>$h.'nos-quartiers/'];
            $crumbs[] = ['@type'=>'ListItem','position'=>3,'name'=>get_the_title($obj->ID),'item'=>get_permalink($obj->ID)];
        } elseif (isset($obj->post_type) && $obj->post_type === 'post') {
            $crumbs[] = ['@type'=>'ListItem','position'=>2,'name'=>'Mag Expert','item'=>$h.'mag-expert/'];
            $crumbs[] = ['@type'=>'ListItem','position'=>3,'name'=>get_the_title($obj->ID),'item'=>get_permalink($obj->ID)];
        } elseif (in_array($slug, $assoc_slugs)) {
            $crumbs[] = ['@type'=>'ListItem','position'=>2,'name'=>"L'Association",'item'=>$h.'qui-sommes-nous/'];
            if ($slug !== 'qui-sommes-nous') {
                $crumbs[] = ['@type'=>'ListItem','position'=>3,'name'=>get_the_title($obj->ID),'item'=>get_permalink($obj->ID)];
            }
        } else {
            $crumbs[] = ['@type'=>'ListItem','position'=>2,'name'=>get_the_title($obj->ID),'item'=>get_permalink($obj->ID)];
        }
    }
    if (count($crumbs) > 1) {
        $bc = ['@context'=>'https://schema.org','@type'=>'BreadcrumbList','itemListElement'=>$crumbs];
        echo '<script type="application/ld+json">' . wp_json_encode($bc, $flag) . '</script>' . "\n";
    }

    // ── 2b. FAQPage — lecture depuis post meta sauvegardée ────────────
    if (is_page()) {
        $saved_faq = get_post_meta(get_the_ID(), '_nsad_schema_faqpage', true);
        if ($saved_faq) {
            echo '<script type="application/ld+json">' . $saved_faq . '</script>' . "\n";
        }
    }

    // ── 3. Article — lecture depuis post meta sauvegardée ─────────────
    if (is_single() && get_post_type() === 'post') {
        $saved_article = get_post_meta(get_the_ID(), '_nsad_schema_article', true);
        if ($saved_article) {
            // Meta complète générée par nsad-inject-schema.php (word count, tags, thumbnail…)
            echo '<script type="application/ld+json">' . $saved_article . '</script>' . "\n";
        } else {
            // Fallback dynamique pour les posts pas encore traités
            $p   = get_post();
            $exc = $p->post_excerpt ?: mb_substr(wp_strip_all_tags($p->post_content), 0, 220);
            $art = [
                '@context'         => 'https://schema.org',
                '@type'            => 'Article',
                '@id'              => get_permalink($p) . '#article',
                'headline'         => get_the_title($p),
                'description'      => $exc,
                'datePublished'    => get_the_date('c', $p),
                'dateModified'     => get_the_modified_date('c', $p),
                'author'           => ['@type'=>'Organization','name'=>'Nantes Aides et Soins à Domicile','@id'=>$base.'/#organisation'],
                'publisher'        => ['@type'=>'Organization','name'=>'Nantes Aides et Soins à Domicile','@id'=>$base.'/#organisation'],
                'mainEntityOfPage' => ['@type'=>'WebPage','@id'=>get_permalink($p)],
                'inLanguage'       => 'fr-FR',
                'isPartOf'         => ['@id' => $base . '/#website'],
            ];
            echo '<script type="application/ld+json">' . wp_json_encode($art, $flag) . '</script>' . "\n";
        }
    }
}, 5);
