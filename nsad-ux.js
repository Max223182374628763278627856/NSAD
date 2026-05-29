/**
 * NSAD — UX Commons  v1.1  (performance edition)
 * ─────────────────────────────────────────────────────────
 * 1. Page transitions — fade-out 150 ms au clic interne
 *    Le fade-in (0.2 s) est géré en CSS pur — aucun JS requis
 *    pour l'affichage initial. Body toujours visible (opacity:1).
 *
 * 2. Skeleton loaders — détection img chargées (async, idle)
 *
 * 3. Focus-visible polyfill minimal (Safari < 15.4)
 *
 * ⚡ Chargé en bas de <body> — ne bloque pas le rendu.
 *    Fallback de sécurité : si JS est lent, body reste visible.
 * ─────────────────────────────────────────────────────────
 */
(function () {
  'use strict';

  /* ═══════════════════════════════════════════════
     FILET DE SÉCURITÉ — garantit opacity:1
     Si une classe nsad-out est coincée pour une raison
     quelconque, elle est retirée après 600 ms.
  ═══════════════════════════════════════════════ */
  setTimeout(function () {
    if (document.body.classList.contains('nsad-out')) {
      document.body.classList.remove('nsad-out');
    }
  }, 600);


  /* ═══════════════════════════════════════════════
     1. PAGE TRANSITION — fade-out sur liens internes
        150 ms (doit correspondre à la transition CSS)
        Le fade-IN est entièrement en CSS — aucun JS.
  ═══════════════════════════════════════════════ */
  var NAV_DURATION = 150;

  document.addEventListener('click', function (e) {
    var el = e.target;
    var link = null;

    /* Remonter jusqu'au <a> ancêtre */
    while (el && el !== document) {
      if (el.tagName && el.tagName.toLowerCase() === 'a' && el.getAttribute('href')) {
        link = el;
        break;
      }
      el = el.parentNode;
    }
    if (!link) return;

    var href = link.getAttribute('href');

    /* Ignorer : ancres, protocoles spéciaux, externes, download, _blank */
    if (!href ||
        href.charAt(0) === '#' ||
        href.indexOf('tel:')         === 0 ||
        href.indexOf('mailto:')      === 0 ||
        href.indexOf('javascript:')  === 0 ||
        href.indexOf('http://')      === 0 ||
        href.indexOf('https://')     === 0 ||
        href.indexOf('//')           === 0 ||
        link.hasAttribute('download') ||
        link.getAttribute('target') === '_blank') {
      return;
    }

    e.preventDefault();
    var dest = href;

    document.body.classList.add('nsad-out');

    /* Fallback : naviguer même si la transition CSS échoue */
    setTimeout(function () {
      window.location.href = dest;
    }, NAV_DURATION);
  }, false);

  /* Réinitialiser si l'utilisateur revient (bfcache) */
  window.addEventListener('pageshow', function (ev) {
    if (ev.persisted) {
      document.body.classList.remove('nsad-out');
    }
  });


  /* ═══════════════════════════════════════════════
     2. SKELETON LOADERS — images
        Exécuté en idle (non-bloquant) — le contenu
        textuel est déjà affiché avant cette étape.
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

  /* Différer en tâche de fond — ne pas bloquer le thread principal */
  if (typeof requestIdleCallback === 'function') {
    requestIdleCallback(setupImgSkeletons, { timeout: 2000 });
  } else {
    setTimeout(setupImgSkeletons, 200);
  }


  /* ═══════════════════════════════════════════════
     3. FOCUS-VISIBLE polyfill minimal
        Pour Safari < 15.4 sans support natif.
  ═══════════════════════════════════════════════ */
  (function () {
    var usingMouse = false;
    document.addEventListener('mousedown', function () { usingMouse = true;  }, true);
    document.addEventListener('keydown',   function () { usingMouse = false; }, true);

    try {
      document.querySelector(':focus-visible');
    } catch (err) {
      /* Navigateur sans support natif */
      document.addEventListener('focusin', function () {
        if (!usingMouse) { document.body.classList.add('focus-kb'); }
      }, true);
      document.addEventListener('focusout', function () {
        document.body.classList.remove('focus-kb');
      }, true);
    }
  }());

}());
