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

*Document vivant — mettre à jour après chaque sprint de migration.*
