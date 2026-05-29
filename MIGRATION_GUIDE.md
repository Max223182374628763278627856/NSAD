# MIGRATION_GUIDE.md — NSAD → WordPress / Elementor
*Design System v2.0 — Mise à jour : 2026-05*

---

## Vue d'ensemble

Ce document assure la continuité entre le prototype HTML statique (GitHub Pages)
et la future migration WordPress + Elementor Pro.

---

## 1. Design Tokens → Elementor Global Colors

| Token CSS (`variables.css`)   | Nom Elementor Global       | Valeur hex    |
|-------------------------------|----------------------------|---------------|
| `--primary`                   | `Primaire`                 | `#2E6A8A`     |
| `--primary-dark`              | `Primaire Foncé`           | `#1E4F68`     |
| `--primary-deeper`            | `Primaire Profond`         | `#0F2F3E`     |
| `--primary-50`                | `Primaire Clair`           | `#EAF3F8`     |
| `--mint`                      | `Menthe`                   | `#70E8C6`     |
| `--mint-dark`                 | `Menthe Foncée`            | `#3DC9A0`     |
| `--coral`                     | `Corail`                   | `#FF8A75`     |
| `--lavender`                  | `Lavande`                  | `#7DA2FA`     |
| `--bg`                        | `Fond Page`                | `#F5F8FA`     |
| `--surface-card`              | `Fond Carte`               | `#FFFFFF`     |
| `--surface-dark`              | `Fond Sombre`              | `#0F2F3E`     |
| `--text`                      | `Texte Corps`              | `#344852`     |
| `--text-heading`              | `Texte Titre`              | `#122432`     |
| `--text-muted`                | `Texte Secondaire`         | `#637D88`     |

---

## 2. Classes CSS → Widgets Elementor

### Navigation

| Classe HTML              | Widget Elementor               | Notes                                                 |
|--------------------------|-------------------------------|-------------------------------------------------------|
| `nav` (glassmorphism)    | **Nav Menu** widget            | Coller dans CSS Perso : `backdrop-filter:blur(20px)` |
| `.nav-cta`               | Bouton dans la nav             | Couleur : `--primary`, border-radius pill            |
| `.nav-hamburger`         | Natif Elementor mobile         | Hamburger intégré au widget Nav Menu                 |

### Hero Section

| Classe HTML              | Widget Elementor               | Notes                                                 |
|--------------------------|-------------------------------|-------------------------------------------------------|
| `.hero` (gradient bg)    | Section Elementor              | BG : dégradé `#2E6A8A → #1E4F68 → #0F2F3E`          |
| `.hero-content`          | Conteneur Flexbox              | Colonne gauche, justify-content: flex-start          |
| `.hero-visual`           | Conteneur Flexbox              | Colonne droite, avec Lottie ou Image                 |
| `.hero-badge`            | Widget Texte + CSS Perso       | Fond glassmorphism mint                              |
| `.hero-float-chip`       | Widget Image Box               | Position absolute, animer via Motion Effects         |
| Animation Lottie hero    | **Lottie** widget (Elementor Pro) | `lf20_in4cufsz.json` ou remplacer par photo équipe  |

### Cards Soins (`.soin-card`)

| Propriété                | Valeur Elementor               |
|--------------------------|-------------------------------|
| Background               | Blanc `#FFFFFF`                |
| Border radius            | `28px` (`--radius-lg`)         |
| Box shadow               | `--shadow-sm` → custom shadow  |
| Border                   | `1px solid rgba(14,40,60,0.06)`|
| Hover : transform        | Motion Effects → `translateY(-6px)` |
| Hover : shadow           | `--shadow-xl`                  |
| Accent top border `::before` | CSS Perso sur l'élément   | `height:3px; background: gradient primary→mint` |

**Template Elementor suggéré :** Grille de 3 colonnes avec Widget Image Box stylisé.

### Cards Quartiers (`.quartier-card`)

| Propriété                | Valeur Elementor               |
|--------------------------|-------------------------------|
| Dot coloré               | Widget Forme → Cercle `12px`, couleur `--primary` |
| Hover dot                | Motion Effects → `scale(1.4)`, couleur mint       |
| Accent top `::before`    | CSS Perso sur la carte         |
| Background hover         | `--primary-50` (`#EAF3F8`)     |

### Boutons

| Classe HTML              | Widget Elementor               | Style                                                |
|--------------------------|-------------------------------|------------------------------------------------------|
| `.btn-primary`           | Widget Bouton                  | BG `--primary`, radius pill, padding `16px 36px`    |
| `.btn-coral`             | Widget Bouton                  | BG `--coral`, radius pill, hover shadow coral        |
| `.btn-outline`           | Widget Bouton — contour        | Border `2px solid --primary`, transparent bg        |
| `.btn-white` (sur dark)  | Widget Bouton                  | BG blanc, couleur `--primary`                       |

### Info Card (`.info-card`)

| Propriété                | Valeur Elementor               |
|--------------------------|-------------------------------|
| Background               | `--white`                      |
| Border radius            | `--radius-lg` (28px)           |
| Hover border             | `--mint`                       |
| Section label `::before` | CSS Perso → ligne mint 20px    |

---

## 3. Typographie → Elementor Global Fonts

| Rôle                     | Police              | Poids           | Elementor                      |
|--------------------------|---------------------|-----------------|-------------------------------|
| Titres (`h1`–`h4`)       | Poppins             | 700 / 800       | Global Font "Titre"           |
| Corps de texte (`p`)     | Hind                | 400 / 500       | Global Font "Corps"           |
| Taille minimale body     | 18px                | —               | Taille de base Elementor       |
| Line-height corps        | 1.8                 | —               | Option typographie Elementor   |

---

## 4. Animations → Elementor Motion Effects

| Animation HTML/CSS        | Équivalent Elementor                          |
|---------------------------|----------------------------------------------|
| `data-reveal="up"`        | Motion Effects → Entrée : Fade Up (delay par carte) |
| `data-reveal="fade"`      | Motion Effects → Entrée : Fade In            |
| `.hero-visual` opacity 0  | Motion Effects → Entrance → delay 300ms      |
| Chip flottant `@keyframes chip-float` | Motion Effects → Float + Entrance |
| Lottie player `<lottie-player>` | Widget Lottie (Elementor Pro) natif    |

---

## 5. Maillage Interne — Liens Sacrés

> **⚠️ Ces liens ne doivent JAMAIS être modifiés sans accord explicite.**

### Pages pilotes → leur maillage sortant

**index.html**
- → `nos-services.html` (soin-card 1 "Soins infirmiers")
- → `aide-a-domicile-nantes.html` (soin-card 2)
- → `nos-quartiers.html` (nav + section quartiers)
- → `nous-contacter.html` (CTA)

**nos-services.html**
- → `soins-infirmiers-nantes.html` (#soins)
- → `soin-hygiene-domicile-nantes.html` (#aide-domicile)
- → `nursing-aide-soignant-nantes.html` (#accompagnement)
- → `nous-contacter.html` (CTA)

**nos-quartiers.html**
- → `quartier-centre-ville.html`, `quartier-ile-de-nantes.html`, etc. (9 quartiers)
- → `nous-contacter.html` (CTA)

---

## 6. Fichiers CSS → Elementor

| Fichier                  | Rôle                            | Migration                                             |
|--------------------------|--------------------------------|------------------------------------------------------|
| `variables.css`          | Design tokens v2.0             | Copier dans **CSS Personnalisé Global** Elementor     |
| `nsad-common.css`        | Nav, hamburger, floating call  | → Widgets Elementor Header Builder (Elementor Pro)   |
| CSS inline `<style>`     | Styles page-specific            | → CSS Perso de chaque section/widget Elementor       |

---

## 7. Structure de Page → Conteneurs Elementor

```
Page
└── Header (Elementor Pro Header Builder)
    ├── Logo (Image Widget)
    ├── Nav Menu (Nav Menu Widget)
    └── Bouton CTA (Button Widget)

└── Section Hero (Section Elementor)
    ├── Conteneur Flex (2 colonnes)
    │   ├── Colonne Gauche : Texte + Badge + Boutons + Stats
    │   └── Colonne Droite : Lottie Widget / Image Widget

└── Trust Band (Section)
    └── Conteneur Flex : Stats numériques

└── Section Soins (Section)
    └── Grille 3 colonnes
        └── × 3 : Image Box Widget (soin-card)

└── Section Quartiers (Section) [nos-quartiers.html]
    └── Grille 3 colonnes
        └── × 9 : Image Box Widget (quartier-card avec dot)

└── CTA Band (Section)
    └── Conteneur centré + 2 boutons

└── Footer (Elementor Pro Footer Builder)
    ├── Barre contact (ft-bar)
    └── Footer grid 4 colonnes
```

---

## 8. SEO — Points de Vigilance

- **URLs** : Les URLs des 34 pages sont définitives — ne pas les modifier dans WordPress (utiliser `%postname%` = slug exact).
- **Meta descriptions** : Déjà optimisées — copier telles quelles dans Yoast/RankMath.
- **Schema.org JSON-LD** : Présent dans chaque page — à migrer via plugin RankMath ou directement dans le `<head>` WP.
- **Balises canonical** : `<link rel="canonical">` présentes — configurer dans Yoast par page.
- **`STRATEGIE-SEO-NSAD.md`** : Fichier local uniquement — NE PAS uploader sur GitHub ni dans le media WP.
- **`styleguide.html`** : Déjà noindex — garder en privé sur WP ou supprimer en prod.

---

## 9. Performances — Recommandations WP

- **Images** : Convertir en `.webp`, dimensions max 1200px, lazy-load natif.
- **Lottie** : Charger uniquement sur les pages qui l'utilisent (Elementor Pro Conditions).
- **Fonts** : Google Fonts déjà préconnectées — utiliser plugin OMGF pour les héberger localement.
- **Cache** : WP Rocket ou LiteSpeed Cache. Exclure les pages de contact du cache.
- **CDN** : Cloudflare Free suffit pour ce volume.

---

## 10. UX — Navigation Active & Scroll Reveal

### 10.1 État actif du menu

| HTML statique                           | Elementor / WordPress                                    |
|-----------------------------------------|----------------------------------------------------------|
| `class="active"` auto-détecté par JS   | Nav Menu widget → **Highlight current page** (natif)    |
| `::after` underline mint animé          | CSS Perso sur `.e-nav-menu a.elementor-item-active`      |
| `color: var(--primary)` sur lien actif  | Elementor Global Style → Nav Menu Active Color           |

**CSS Perso Elementor pour reproduire le soulignement mint :**
```css
.e-nav-menu .elementor-item {
  position: relative;
  padding-bottom: 4px;
}
.e-nav-menu .elementor-item::after {
  content: '';
  position: absolute;
  bottom: 0; left: 0; right: 0;
  height: 2px;
  background: var(--mint, #70E8C6);
  border-radius: 2px;
  transform: scaleX(0);
  transform-origin: left center;
  transition: transform 260ms cubic-bezier(0.4, 0.0, 0.2, 1);
}
.e-nav-menu .elementor-item:hover::after,
.e-nav-menu .elementor-item-active::after {
  transform: scaleX(1);
}
```

### 10.2 Scroll Reveal — Animations d'entrée

**Implémentation HTML/CSS/JS actuelle :**
- Attribut `data-reveal="up"` sur les éléments cibles
- CSS : début à `opacity:0; translateY(24px)`, arrivée à `opacity:1; translateY(0)`
- Durée : **0.6s** avec timing `cubic-bezier(0.0, 0.0, 0.2, 1)` (ease-out Material Design)
- Déclenché par `IntersectionObserver` (threshold 0.12, rootMargin -32px)
- Stagger automatique dans les grilles via CSS nth-child

**Reproduire dans Elementor :**
1. Sélectionner l'élément (section, widget, colonne)
2. Onglet **Avancé → Effets de mouvement**
3. **Animation d'entrée** → choisir **Fade In Up**
4. **Durée** : `600ms` / **Retard** : `0ms` (ou `100ms`, `200ms` pour le stagger)
5. Pour les cartes en grille : appliquer sur chaque widget avec retards croissants de `100ms`

**Éléments cibles par page :**

| Page             | Éléments avec `data-reveal`                                      |
|------------------|------------------------------------------------------------------|
| `index.html`     | trust-band, soins-grid (×3), steps, testimonials, FAQ sections  |
| `nos-services.html` | soins-header, soin-cards (×3), service-detail (left/right)  |
| `nos-quartiers.html` | hero-stats, intro-inner, section-label, section-title, section-sub, quartier-cards (×9 avec stagger nth-child), cta h2 |

**Note Elementor :** Les `transition-delay` CSS ne fonctionnent pas avec les Motion Effects d'Elementor. Utiliser à la place le champ "Retard" dans l'onglet Motion Effects de **chaque widget individuel**.

---

---

## 11. Timeline Historique — `qui-sommes-nous.html`

### 11.1 Description du composant

Timeline verticale interactive à 7 jalons (1993 → 2024), pilotée par le scroll.

| Élément               | Comportement                                                       |
|-----------------------|--------------------------------------------------------------------|
| Ligne de fond         | `2px`, gradient `#3C697F → #8FF0D2`, opacité 10 %                |
| Ligne de progression  | Même couleur, `scaleY(0 → 1)` piloté par `scrollY`               |
| Dots milestones       | Blanc au repos → fond `--mint`, `scale(1.35)`, pulse infini       |
| Cartes (gauche)       | `opacity:0; translateX(-28px)` → révèle quand dot s'illumine     |
| Cartes (droite)       | `opacity:0; translateX(+28px)` → idem                            |
| Mobile (< 768 px)     | Ligne à gauche, tout empilé, animation `translateY`               |

### 11.2 Option A — Widget Timeline Elementor Pro (recommandé)

> Disponible dans **Elementor Pro ≥ 3.9** via le widget **Timeline**.

1. Insérer le widget **Timeline** (catégorie Pro)
2. **Layout** → Vertical, **Align** → Center (alternating)
3. Pour chaque item : Year, Title, Description (7 items)
4. **Style → Line** : couleur `--primary` (#3C697F), largeur 2px
5. **Style → Icon/Point** : cercle, couleur active `--mint` (#8FF0D2)
6. **Motion Effects** sur chaque item : Fade In Left / Fade In Right selon position

**Limite :** Le widget Elementor ne supporte pas la progression scroll-driven native.  
Pour la garder fidèlement, utiliser l'**Option B**.

### 11.3 Option B — Code HTML/CSS/JS personnalisé (fidélité maximale)

Insérer via **Elementor → HTML Widget** ou **Code Block** le code complet du composant.

**Variables CSS à déclarer dans le CSS Global Elementor :**
```css
/* Coller dans Elementor → Personnaliser → CSS Additionnel */
.tl-line-fill {
  background: linear-gradient(180deg, var(--e-global-color-primary, #3C697F) 0%, var(--e-global-color-accent, #8FF0D2) 100%);
}
.tl-year { color: var(--e-global-color-primary, #3C697F); background: rgba(60,105,127,.08); }
.tl-item.tl-active .tl-dot { background: var(--e-global-color-accent, #8FF0D2); border-color: var(--e-global-color-primary, #3C697F); }
```

**JS (coller en bas de page via Elementor → Personnaliser → CSS/JS Perso) :**
```js
// Pilotage scroll-driven de la timeline
(function(){
  var track=document.getElementById('tlTrack'),fill=document.getElementById('tlLineFill');
  if(!track||!fill)return;
  function update(){
    var r=track.getBoundingClientRect(),vH=window.innerHeight;
    var p=Math.max(0,Math.min(1,(vH*.85-r.top)/r.height));
    var mob=window.innerWidth<768;
    fill.style.transform=mob?'scaleY('+p+')':'translateX(-50%) scaleY('+p+')';
    track.querySelectorAll('[data-tl-item]').forEach(function(i){
      var ir=i.getBoundingClientRect();
      if(ir.top+ir.height*.5<vH*.76)i.classList.add('tl-active');
    });
  }
  window.addEventListener('scroll',update,{passive:true});
  window.addEventListener('resize',update,{passive:true});
  update();setTimeout(update,180);
}());
```

### 11.4 Accessibilité & fallbacks

| Cas                          | Comportement                                             |
|------------------------------|----------------------------------------------------------|
| JavaScript désactivé         | `<noscript>` force `opacity:1; transform:none` sur tout |
| `prefers-reduced-motion`     | Transitions désactivées, éléments visibles d'emblée     |
| Navigateurs sans `IntersectionObserver` | Activation par `getBoundingClientRect` (scroll event) — compatible IE 11+ |

---

*Document vivant — mettre à jour après chaque sprint de migration.*
