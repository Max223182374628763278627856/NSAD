<?php
/**
 * single.php — NSAD Theme — Template article de blog
 * Reproduit exactement le design du site live nantes-soins-a-domicile.fr
 */
if (!defined('ABSPATH')) exit;

while (have_posts()) : the_post();

$post_id      = get_the_ID();
$title        = get_the_title();
$raw_content  = get_the_content();
$featured_img = get_the_post_thumbnail_url($post_id, 'large');
$permalink    = get_permalink();
$post_date    = get_the_date('d/m/Y');

// ── Parse content : injecter IDs sur H2/H3 et construire le sommaire ──
$toc   = [];
$index = 0;

$content = preg_replace_callback(
    '/<(h[23])([^>]*)>(.*?)<\/h[23]>/si',
    function($m) use (&$toc, &$index) {
        $tag   = $m[1];
        $attrs = $m[2];
        $text  = wp_strip_all_tags($m[3]);
        $id    = 'section-' . (++$index);
        $toc[] = ['tag' => $tag, 'text' => $text, 'id' => $id];
        return "<{$tag}{$attrs} id=\"{$id}\">{$m[3]}</{$tag}>";
    },
    $raw_content
);

// Appliquer les filtres WordPress normaux
$content = apply_filters('the_content', $content);

endwhile;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width,initial-scale=1">
<?php wp_head(); ?>
<style>
/* ═══════════════════════════════════════════════
   ARTICLE — Layout global
═══════════════════════════════════════════════ */
.nsad-article-page {
    font-family: 'Hind', sans-serif;
    color: #344852;
}

/* ── Hero ── */
.art-hero {
    background: linear-gradient(135deg, #dde8f5 0%, #eaf0f9 50%, #e4ecf8 100%);
    padding: 72px 48px 64px;
}
.art-hero-inner {
    max-width: 1100px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 420px 1fr;
    gap: 64px;
    align-items: center;
}
.art-hero-photo-wrap {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}
.art-hero-ring {
    position: absolute;
    width: 380px;
    height: 380px;
    border-radius: 50%;
    border: 2px solid rgba(60,105,127,0.18);
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    pointer-events: none;
}
.art-hero-photo {
    width: 340px;
    height: 340px;
    border-radius: 50%;
    overflow: hidden;
    flex-shrink: 0;
    background: linear-gradient(135deg, #b8ddd6, #8ccfc4);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 64px;
}
.art-hero-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}
.art-hero-meta {}
.art-hero-meta h1 {
    font-family: 'Poppins', sans-serif;
    font-size: 2.25rem;
    font-weight: 700;
    color: #1a2d36;
    line-height: 1.2;
    margin: 0 0 18px;
}
.art-hero-bar {
    width: 72px;
    height: 4px;
    background: #FF8A75;
    border-radius: 2px;
    margin-bottom: 28px;
}
.art-share {
    display: flex;
    align-items: center;
    gap: 14px;
    flex-wrap: wrap;
}
.art-share-label {
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
    font-weight: 500;
    color: #344852;
}
.art-share-icons {
    display: flex;
    gap: 10px;
    align-items: center;
}
.art-share-icon {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: rgba(60,105,127,0.10);
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    color: #344852;
    transition: background 0.2s, color 0.2s;
}
.art-share-icon:hover { background: #3C697F; color: #fff; }
.art-share-icon svg  { width: 16px; height: 16px; fill: currentColor; }

/* ── Corps ── */
.art-body-wrap {
    max-width: 1100px;
    margin: 0 auto;
    padding: 56px 48px 80px;
    display: grid;
    grid-template-columns: 1fr 320px;
    gap: 56px;
    align-items: start;
}

/* Contenu principal */
.art-content {
    min-width: 0;
    font-size: 16px;
    line-height: 1.75;
    color: #344852;
}
.art-content p { margin: 0 0 20px; }
.art-content h2 {
    font-family: 'Poppins', sans-serif;
    font-size: 1.6rem;
    font-weight: 700;
    color: #1a2d36;
    margin: 48px 0 16px;
    line-height: 1.25;
}
.art-content h2:first-child { margin-top: 0; }
.art-content h3 {
    font-family: 'Poppins', sans-serif;
    font-size: 1.15rem;
    font-weight: 600;
    color: #2E6A8A;
    margin: 32px 0 12px;
}
.art-content ul {
    margin: 0 0 20px;
    padding-left: 24px;
    list-style: disc;
}
.art-content ul li { margin-bottom: 6px; }
.art-content ol {
    margin: 0 0 20px;
    padding-left: 24px;
}
.art-content ol li { margin-bottom: 6px; }
.art-content strong { font-weight: 600; color: #1a2d36; }
.art-content em { font-style: italic; }
.art-content a { color: #2E6A8A; text-decoration: underline; }
.art-content a:hover { color: #1a2d36; }
.art-content table {
    width: 100%;
    border-collapse: collapse;
    margin: 24px 0;
    font-size: 15px;
}
.art-content table th {
    background: #1a2d36;
    color: #fff;
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    font-size: 14px;
    padding: 12px 16px;
    text-align: left;
}
.art-content table td {
    padding: 11px 16px;
    border-bottom: 1px solid #e2e8ed;
    color: #344852;
}
.art-content table tr:nth-child(even) td { background: #f5f8fa; }
.art-content blockquote {
    border-left: 4px solid #8FF0D2;
    margin: 24px 0;
    padding: 16px 24px;
    background: #f0faf6;
    border-radius: 0 8px 8px 0;
    font-style: italic;
}

/* Sommaire */
.art-toc {
    position: sticky;
    top: 120px;
    background: #d4f0e8;
    border-radius: 16px;
    padding: 0;
    overflow: hidden;
    max-height: calc(100vh - 140px);
    overflow-y: auto;
    scrollbar-width: thin;
    scrollbar-color: rgba(60,105,127,0.3) transparent;
}
.art-toc-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 18px 22px 14px;
    cursor: pointer;
    user-select: none;
}
.art-toc-header h2 {
    font-family: 'Poppins', sans-serif;
    font-size: 1rem;
    font-weight: 700;
    color: #1a2d36;
    margin: 0;
}
.art-toc-chevron {
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.25s;
    color: #1a2d36;
}
.art-toc.collapsed .art-toc-chevron { transform: rotate(180deg); }
.art-toc-list {
    padding: 0 22px 20px;
    list-style: none;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 2px;
}
.art-toc.collapsed .art-toc-list { display: none; }
.art-toc-item {
    display: block;
}
.art-toc-item a {
    display: block;
    font-family: 'Poppins', sans-serif;
    font-size: 13px;
    color: #2a3a42;
    text-decoration: none;
    padding: 4px 0;
    line-height: 1.4;
    transition: color 0.15s;
    border-bottom: none;
}
.art-toc-item a:hover { color: #2E6A8A; }
.art-toc-item.toc-h2 a {
    font-weight: 600;
    font-size: 13px;
}
.art-toc-item.toc-h3 a {
    font-weight: 400;
    padding-left: 14px;
    font-size: 12.5px;
    color: #3a4a52;
}
.art-toc-item.toc-active a {
    color: #2E6A8A;
    text-decoration: underline;
    font-weight: 600;
}

/* ── Responsive ── */
@media (max-width: 960px) {
    .art-hero { padding: 48px 24px 40px; }
    .art-hero-inner { grid-template-columns: 1fr; gap: 32px; text-align: center; }
    .art-hero-photo { width: 240px; height: 240px; margin: 0 auto; }
    .art-hero-ring { width: 270px; height: 270px; }
    .art-hero-bar { margin: 0 auto 28px; }
    .art-share { justify-content: center; }
    .art-body-wrap { grid-template-columns: 1fr; padding: 32px 24px 56px; gap: 32px; }
    .art-toc { position: static; max-height: none; order: -1; }
    .art-hero-meta h1 { font-size: 1.6rem; }
}
@media (max-width: 580px) {
    .art-hero-meta h1 { font-size: 1.35rem; }
    .art-hero-photo { width: 200px; height: 200px; }
    .art-hero-ring { width: 226px; height: 226px; }
}
</style>
</head>
<body <?php body_class('nsad-single-post'); ?>>
<?php wp_body_open(); ?>

<?php do_action('elementor/page_templates/canvas/before_content'); ?>

<div class="nsad-article-page">

    <!-- ── HERO ── -->
    <section class="art-hero" aria-label="En-tête de l'article">
        <div class="art-hero-inner">

            <!-- Photo circulaire -->
            <div class="art-hero-photo-wrap">
                <div class="art-hero-ring" aria-hidden="true"></div>
                <div class="art-hero-photo">
                    <?php if ($featured_img): ?>
                        <img src="<?php echo esc_url($featured_img); ?>" alt="<?php echo esc_attr($title); ?>">
                    <?php else: ?>
                        🏥
                    <?php endif; ?>
                </div>
            </div>

            <!-- Titre + partage -->
            <div class="art-hero-meta">
                <h1><?php echo wp_kses_post($title); ?></h1>
                <div class="art-hero-bar" aria-hidden="true"></div>
                <div class="art-share">
                    <span class="art-share-label">Partager l'article</span>
                    <div class="art-share-icons">
                        <?php
                        $enc_url   = rawurlencode($permalink);
                        $enc_title = rawurlencode($title);
                        ?>
                        <!-- Facebook -->
                        <a class="art-share-icon"
                           href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $enc_url; ?>"
                           target="_blank" rel="noopener noreferrer" aria-label="Partager sur Facebook">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <!-- LinkedIn -->
                        <a class="art-share-icon"
                           href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $enc_url; ?>&title=<?php echo $enc_title; ?>"
                           target="_blank" rel="noopener noreferrer" aria-label="Partager sur LinkedIn">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        </a>
                        <!-- X / Twitter -->
                        <a class="art-share-icon"
                           href="https://twitter.com/intent/tweet?url=<?php echo $enc_url; ?>&text=<?php echo $enc_title; ?>"
                           target="_blank" rel="noopener noreferrer" aria-label="Partager sur X">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.747l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                        <!-- Email -->
                        <a class="art-share-icon"
                           href="mailto:?subject=<?php echo $enc_title; ?>&body=<?php echo $enc_url; ?>"
                           aria-label="Partager par email">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- /.art-hero -->

    <!-- ── CORPS ── -->
    <div class="art-body-wrap">

        <!-- Contenu principal -->
        <article class="art-content">
            <?php echo $content; ?>
        </article>

        <!-- Sommaire sticky -->
        <?php if (!empty($toc)): ?>
        <aside class="art-toc" id="art-toc" aria-label="Sommaire de l'article">
            <div class="art-toc-header" id="art-toc-toggle" role="button" tabindex="0" aria-expanded="true" aria-controls="art-toc-list">
                <h2>Sommaire</h2>
                <span class="art-toc-chevron" aria-hidden="true">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2 9L7 4L12 9" stroke="#1a2d36" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </span>
            </div>
            <ul class="art-toc-list" id="art-toc-list" role="list">
                <?php foreach ($toc as $item): ?>
                <li class="art-toc-item toc-<?php echo esc_attr($item['tag']); ?>" data-target="<?php echo esc_attr($item['id']); ?>">
                    <a href="#<?php echo esc_attr($item['id']); ?>"><?php echo esc_html($item['text']); ?></a>
                </li>
                <?php endforeach; ?>
            </ul>
        </aside>
        <?php endif; ?>

    </div><!-- /.art-body-wrap -->

</div><!-- /.nsad-article-page -->

<script>
(function(){
    // Toggle sommaire
    var toggle = document.getElementById('art-toc-toggle');
    var toc    = document.getElementById('art-toc');
    if (toggle && toc) {
        toggle.addEventListener('click', function(){
            toc.classList.toggle('collapsed');
            var expanded = !toc.classList.contains('collapsed');
            toggle.setAttribute('aria-expanded', expanded ? 'true' : 'false');
        });
        toggle.addEventListener('keydown', function(e){
            if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); toggle.click(); }
        });
    }

    // Highlight section active dans le sommaire
    var items = document.querySelectorAll('.art-toc-item[data-target]');
    if (items.length) {
        var ids = Array.from(items).map(function(el){ return el.getAttribute('data-target'); });
        var headings = ids.map(function(id){ return document.getElementById(id); }).filter(Boolean);

        function onScroll(){
            var scrollY = window.scrollY + 140;
            var active = headings[0];
            headings.forEach(function(h){ if (h.offsetTop <= scrollY) active = h; });
            items.forEach(function(el){
                el.classList.toggle('toc-active', el.getAttribute('data-target') === (active && active.id));
            });
        }
        window.addEventListener('scroll', onScroll, {passive:true});
        onScroll();
    }

    // Smooth scroll sur les liens du sommaire
    document.querySelectorAll('.art-toc-list a[href^="#"]').forEach(function(a){
        a.addEventListener('click', function(e){
            e.preventDefault();
            var target = document.getElementById(a.getAttribute('href').slice(1));
            if (target) target.scrollIntoView({behavior:'smooth', block:'start'});
        });
    });
})();
</script>

<?php do_action('elementor/page_templates/canvas/after_content'); ?>

<?php wp_footer(); ?>
</body>
</html>
