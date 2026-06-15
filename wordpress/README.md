# NSAD — Kit de Migration WordPress
## Elementor Free + Elementor Header & Footer Builder

> **Ce dossier contient tout ce qu'il faut pour migrer le site NSAD vers WordPress.**
> Aucune connaissance en développement n'est nécessaire.

---

## Structure du dossier

```
wordpress/
├── assets/
│   └── logos/          → Déposer ici vos fichiers de logo avant de les uploader
│
├── templates/
│   ├── page-quartier-type.json   → Modèle importable pour les 11 pages quartiers
│   ├── header-template.json      → Header NSAD (navigation + logo + CTA)
│   └── footer-template.json      → Footer NSAD (4 colonnes + barre légale)
│
├── config/
│   ├── custom-css.css            → CSS global à coller dans WordPress (dynamique, suit les couleurs Elementor)
│   └── contact-form7.txt         → Configuration complète du formulaire de contact
│
├── guide/
│   └── MIGRATION_STEP_BY_STEP.md → Guide de migration complet, étape par étape
│
└── README.md                     → Ce fichier
```

---

## Par où commencer ?

**→ Lire d'abord :** `guide/MIGRATION_STEP_BY_STEP.md`

Ce guide détaille les 10 phases de la migration dans l'ordre exact à suivre.

---

## Les 3 plugins à installer (et rien d'autre)

| Plugin | Gratuit ? | Rôle |
|---|---|---|
| **Hello Elementor** | ✅ Gratuit | Thème de base vide et léger |
| **Elementor** | ✅ Gratuit | Éditeur visuel des pages |
| **Elementor Header & Footer Builder** | ✅ Gratuit | Header et footer visuels sans Elementor Pro |

> Plugins complémentaires recommandés (tous gratuits) :
> Contact Form 7, Flamingo, Redirection, RankMath, OMGF

---

## Comment changer une couleur en 2 clics — sans toucher au code

**C'est la promesse centrale de ce kit.**

Le CSS (`config/custom-css.css`) est conçu pour **suivre automatiquement** les couleurs globales Elementor. Si vous changez la couleur primaire dans Elementor, tout le site se met à jour instantanément.

### Procédure en 2 clics :

**Clic 1 :** Dans n'importe quelle page ouverte dans Elementor → icône hamburger (☰) en haut à gauche → **Paramètres du site → Style du site → Couleurs globales**

**Clic 2 :** Cliquez sur la pastille colorée de **"Primaire"** → entrez le nouveau code couleur → **Enregistrer**

✅ Tous les boutons, tous les titres, tous les liens et tous les fonds du site se mettent à jour automatiquement.

---

## Comment changer une image en 2 clics

**Clic 1 :** Dans Elementor, cliquez sur l'image à remplacer → dans le panneau gauche, cliquez sur la vignette de l'image

**Clic 2 :** La médiathèque s'ouvre → uploadez votre image ou sélectionnez-en une existante → **Sélectionner** → **Publier**

---

## Comment utiliser les templates pour les pages quartiers

Les 11 pages quartiers partagent le même design. Une seule importation du template suffit.

1. Ouvrir une page quartier avec Elementor
2. Cliquer sur l'icône dossier **"Ajouter modèle"** (milieu de l'écran si la page est vide)
3. Aller dans l'onglet **"Mes modèles"**
4. Chercher **"NSAD Page Quartier Type"**
5. Cliquer sur **"Insérer"**
6. Remplacer les textes `[Nom du Quartier]` par le vrai nom du quartier
7. **Publier**

---

## Fonctionnement du CSS dynamique

Le fichier `config/custom-css.css` utilise des **variables CSS Elementor** :

```css
/* Au lieu d'écrire une couleur fixe comme #2E6A8A : */
background-color: var(--e-global-color-primary, #2E6A8A);
/*                ↑ Couleur Elementor   ↑ Valeur par défaut si non configuré */
```

Résultat : quand vous changez la couleur **Primaire** dans Elementor de `#2E6A8A` vers `#1A5276` (par exemple), **tous les éléments qui utilisent `--e-global-color-primary` changent automatiquement** — sans toucher au CSS.

Le même mécanisme s'applique aux polices :
```css
font-family: var(--e-global-typography-primary-font-family, 'Poppins', sans-serif);
```

---

## Ce que vous pouvez changer librement

| Action | Comment |
|---|---|
| Changer une couleur du site | Elementor → Paramètres du site → Couleurs globales |
| Changer la police | Elementor → Paramètres du site → Typographies globales |
| Changer le logo | Elementor → Paramètres du site → Logo du site |
| Modifier un texte | Cliquer dessus dans Elementor → modifier → Publier |
| Changer une image | Cliquer dessus → médiathèque → sélectionner → Publier |
| Modifier le numéro de téléphone | Chercher "02 40 35 43 43" dans Elementor et remplacer |
| Ajouter une actualité | WP Admin → Actualités → Ajouter |
| Modifier la FAQ | Page FAQ → Elementor → cliquer sur l'accordion → modifier |

## Ce qu'il ne faut pas changer sans développeur

| Action | Risque |
|---|---|
| Changer les slugs de pages existantes | Casse le référencement (erreurs 404) |
| Supprimer ou désactiver Elementor | Le site ne s'affiche plus |
| Changer le thème (Hello Elementor) | Peut casser le design |
| Modifier les Permaliens | Casse toutes les URLs du site |
| Supprimer des pages du menu | Casse le maillage interne SEO |

---

*Kit rédigé pour SSIAD NSAD — Nantes Soins à Domicile*
*Version 1.0 — juin 2026*
