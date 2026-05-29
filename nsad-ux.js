/**
 * NSAD — UX Commons  v1.0
 * ─────────────────────────────────────────────────────────
 * 1. Page transitions (fade-out au clic interne)
 * 2. Skeleton loaders (img-skel auto-setup)
 * 3. Focus-visible polyfill (très léger)
 *
 * Ajouter en bas de chaque page :
 *   <script src="nsad-ux.js"></script>
 * ─────────────────────────────────────────────────────────
 */
(function () {
  'use strict';

  /* ═══════════════════════════════════════════════
     1. PAGE TRANSITION — fade-out sur liens internes
     La classe .nsad-out est définie dans nsad-common.css
  ═══════════════════════════════════════════════ */
  var NAV_DURATION = 230; // ms — doit correspondre à la transition CSS

  document.addEventListener('click', function (e) {
    /* Trouver le lien ancêtre le plus proche */
    var el = e.target;
    var link = null;
    while (el && el !== document) {
      if (el.tagName && el.tagName.toLowerCase() === 'a' && el.getAttribute('href')) {
        link = el;
        break;
      }
      el = el.parentNode;
    }
    if (!link) return;

    var href = link.getAttribute('href');

    /* Ignorer : ancres, protocoles spéciaux, external, download, target=_blank */
    if (!href ||
        href.charAt(0) === '#' ||
        href.indexOf('tel:')    === 0 ||
        href.indexOf('mailto:') === 0 ||
        href.indexOf('javascript:') === 0 ||
        href.indexOf('http://') === 0 ||
        href.indexOf('https://') === 0 ||
        href.indexOf('//') === 0 ||
        link.hasAttribute('download') ||
        link.getAttribute('target') === '_blank') {
      return;
    }

    e.preventDefault();
    var dest = href;

    /* Appliquer le fade-out */
    document.body.classList.add('nsad-out');

    setTimeout(function () {
      window.location.href = dest;
    }, NAV_DURATION);
  }, false);

  /* Réinitialiser la classe si l'utilisateur revient (bfcache) */
  window.addEventListener('pageshow', function (ev) {
    if (ev.persisted) {
      document.body.classList.remove('nsad-out');
    }
  });


  /* ═══════════════════════════════════════════════
     2. SKELETON LOADERS — images
     Toute image dans un wrapper .img-skel reçoit
     la classe .img-loaded dès que l'image est prête.
  ═══════════════════════════════════════════════ */
  function setupImgSkeletons() {
    document.querySelectorAll('.img-skel img').forEach(function (img) {
      var wrap = img.closest('.img-skel');
      if (!wrap) return;

      function markLoaded() { wrap.classList.add('img-loaded'); }

      if (img.complete && img.naturalWidth > 0) {
        markLoaded();
      } else {
        img.addEventListener('load',  markLoaded, { once: true });
        img.addEventListener('error', markLoaded, { once: true });
      }
    });
  }

  /* Logo nav — wrap automatique si pas déjà wrappé */
  function wrapNavLogo() {
    var logoImg = document.querySelector('.nav-logo img');
    if (!logoImg || logoImg.closest('.img-skel')) return;
    var wrap = document.createElement('span');
    wrap.className = 'img-skel';
    wrap.style.cssText = 'display:inline-block;height:46px;width:auto;min-width:120px;border-radius:4px;';
    logoImg.parentNode.insertBefore(wrap, logoImg);
    wrap.appendChild(logoImg);
    function markLoaded() { wrap.classList.add('img-loaded'); }
    if (logoImg.complete && logoImg.naturalWidth > 0) {
      markLoaded();
    } else {
      logoImg.addEventListener('load',  markLoaded, { once: true });
      logoImg.addEventListener('error', markLoaded, { once: true });
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function () {
      setupImgSkeletons();
      wrapNavLogo();
    });
  } else {
    setupImgSkeletons();
    wrapNavLogo();
  }


  /* ═══════════════════════════════════════════════
     3. FOCUS-VISIBLE polyfill minimal
     Pour Safari < 15.4 qui ne supporte pas :focus-visible
  ═══════════════════════════════════════════════ */
  (function () {
    var usingMouse = false;
    document.addEventListener('mousedown', function () { usingMouse = true; },  true);
    document.addEventListener('keydown',   function () { usingMouse = false; }, true);

    /* Sur navigateurs qui ne supportent pas :focus-visible nativement,
       on ajoute/retire la classe .focus-kb sur le body */
    try {
      document.querySelector(':focus-visible');
    } catch (err) {
      /* Navigateur sans support natif — activer la classe fallback */
      document.addEventListener('focusin', function (e) {
        if (!usingMouse) { document.body.classList.add('focus-kb'); }
      }, true);
      document.addEventListener('focusout', function () {
        document.body.classList.remove('focus-kb');
      }, true);
    }
  }());

}());
