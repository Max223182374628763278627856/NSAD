# Stratégie SEO — Maillage Interne, Silos & Cocons Sémantiques
## Nantes Soins à Domicile (NSAD)
**Document de référence — Mai 2026**

---

## Table des matières

1. [Vue d'ensemble de la stratégie](#1-vue-densemble)
2. [Architecture générale du site](#2-architecture-générale)
3. [Silo 1 — Nos Quartiers](#3-silo-1--nos-quartiers)
4. [Silo 2 — Nos Services (avec cocons)](#4-silo-2--nos-services)
5. [Silo 3 — Le Mag Expert](#5-silo-3--le-mag-expert)
6. [Silo 4 — L'Association](#6-silo-4--lassociation)
7. [Pages de navigation directe](#7-pages-de-navigation-directe)
8. [Maillage interne — Matrice complète](#8-maillage-interne--matrice-complète)
9. [Implémentation technique](#9-implémentation-technique)
10. [Redirections et URLs canoniques](#10-redirections-et-urls-canoniques)
11. [Signaux E-E-A-T](#11-signaux-e-e-a-t)
12. [Récapitulatif des fichiers HTML](#12-récapitulatif-des-fichiers-html)

---

## 1. Vue d'ensemble

### Objectif stratégique

Le site **nantes-soins-a-domicile.fr** est positionné sur des requêtes locales à forte intention de conversion dans le secteur médico-social nantais. La stratégie SEO repose sur trois piliers complémentaires :

1. **Silos sémantiques** : regrouper les pages par thématique pour concentrer l'autorité thématique sur chaque sujet clé
2. **Cocons sémantiques** : à l'intérieur du silo Nos Services, créer des sous-groupes thématiques (cocons) avec un maillage interne dense et cohérent
3. **Maillage interne éditorial** : tisser des liens contextuels dans la rédaction des pages (pas seulement dans le footer ou la navigation) pour transférer le PageRank et guider le crawl de Google

### Philosophie du maillage

> Un silo isole les thématiques pour qu'elles ne se « contaminent » pas mutuellement aux yeux de Google.  
> Un cocon concentre l'autorité en faisant remonter le jus SEO des pages feuilles vers le hub.  
> Le maillage éditorial simule le comportement d'un vrai site d'expert : les pages se citent naturellement, comme dans un article médical bien rédigé.

### Mot mystère par silo

Chaque silo est construit autour d'un **mot-clé pivot (mot mystère)** qui concentre le champ lexical de toutes ses pages :

| Silo | Mot mystère |
|---|---|
| Nos Quartiers | **Proximité** |
| Nos Services | **Soins à domicile** |
| Le Mag Expert | **Expertise** |
| L'Association | **Éthique** |

---

## 2. Architecture générale

```
index.html  (Homepage — pivot central)
│
├── SILO 1 : NOS QUARTIERS
│   └── nos-quartiers.html  [HUB]
│       ├── quartier-centre-ville.html
│       ├── quartier-ile-de-nantes.html
│       ├── quartier-bellevue-chantenay.html
│       ├── quartier-dervallières-zola.html
│       ├── quartier-hauts-paves-saint-felix.html
│       ├── quartier-breil-barbiere.html
│       ├── quartier-malakoff-saint-donatien.html
│       ├── quartier-nantes-nord.html
│       └── quartier-nantes-sud.html
│
├── SILO 2 : NOS SERVICES
│   └── nos-services.html  [HUB]
│       ├── COCON 1 — Soins médicaux
│       │   ├── soins-infirmiers-nantes.html
│       │   ├── nursing-aide-soignant-nantes.html
│       │   ├── soin-hygiene-domicile-nantes.html
│       │   └── accompagnement-fin-de-vie-nantes.html
│       ├── COCON 2 — Vie quotidienne
│       │   ├── aide-a-domicile-nantes.html
│       │   ├── nutrition-repas-domicile-nantes.html
│       │   └── mobilite-vie-sociale-nantes.html
│       └── COCON 3 — Coordination & Démarches
│           ├── dossiers-apa-pch-nantes.html
│           └── lien-famille-corps-medical-nantes.html
│
├── SILO 3 : LE MAG EXPERT
│   └── mag-expert.html  [HUB]
│       ├── comprendre-alzheimer-parkinson-nantes.html
│       └── guide-aidant-nantais.html
│
├── SILO 4 : L'ASSOCIATION
│   └── qui-sommes-nous.html  [HUB]
│       ├── nos-valeurs-engagements.html
│       └── nos-partenaires.html
│
└── NAVIGATION DIRECTE (hors silos)
    ├── faq.html
    ├── recrutement.html
    └── nous-contacter.html
```

**Total : 33 pages HTML** (incluant 2 redirections legacy)

---

## 3. Silo 1 — Nos Quartiers

### Concept et objectif

**Mot mystère : Proximité**

Ce silo cible les requêtes géolocalisées du type `soins à domicile [quartier] Nantes`. Chaque page quartier est une **landing page locale** optimisée pour un secteur géographique précis, renforçant la présence locale de NSAD dans chaque zone d'intervention.

### Hub

**`nos-quartiers.html`** — Page d'entrée du silo  
- Présente les 9 quartiers couverts sous forme de grille
- Lien sortant vers chaque page quartier
- Reçoit des liens entrants depuis : homepage, footer (toutes pages), nav principale

### Pages feuilles (9 quartiers)

| Fichier | Quartier ciblé | Zones couvertes |
|---|---|---|
| `quartier-centre-ville.html` | Centre-ville | Bouffay, Commerce, Graslin, Cathédrale |
| `quartier-ile-de-nantes.html` | Île de Nantes | Beaulieu, Prairie-au-Duc, Chantiers navals |
| `quartier-bellevue-chantenay.html` | Bellevue-Chantenay | Bellevue, Chantenay, Sainte-Anne |
| `quartier-dervallières-zola.html` | Dervallières-Zola | Dervallières, Zola, Bourgeonnière |
| `quartier-hauts-paves-saint-felix.html` | Hauts-Pavés–Saint-Félix | Hauts-Pavés, Saint-Félix, Procé |
| `quartier-breil-barbiere.html` | Breil-Barbière | Breil, Barbière, Bout-des-Landes |
| `quartier-malakoff-saint-donatien.html` | Malakoff–Saint-Donatien | Malakoff, Doulon, Saint-Donatien |
| `quartier-nantes-nord.html` | Nantes Nord–Erdre | Nantes Nord, Erdre, Saulaie |
| `quartier-nantes-sud.html` | Nantes Sud | Rezé, Bouguenais, Saint-Sébastien |

### Structure type d'une page quartier

Chaque page quartier contient :
1. **Hero** avec titre H1 géolocalisé + CTA
2. **Services-cta-grid** : 3 cartes services principaux (soins-infirmiers, aide-a-domicile, nursing)
3. **Section "Tous nos services"** : 9 pills de liens vers les 9 pages service *(maillage BATCH 4)*
4. **Local-grid** : partenaires locaux + logistique transport
5. **Infirmiers partenaires** : cartes Schema.org `Physician`
6. **Témoignages** localisés (5 étoiles, Google Reviews)
7. **FAQ locale** : questions spécifiques au quartier
8. **Nav quartiers** : liens vers les 8 autres quartiers + hub
9. **CTA Band** → nous-contacter + téléphone

### Maillage interne Silo 1

```
nos-quartiers.html
    ↓ liens sortants vers 9 pages quartier
    
Chaque quartier.html
    ↓ liens vers nos-quartiers.html (nav)
    ↓ 9 liens vers pages service (section pills)
    ↓ 8 liens vers autres quartiers (nav-quartiers)
    ↓ liens vers nous-contacter.html
    ↓ 3 liens service dans services-cta-grid
```

**Isolation silo** : les pages quartier ne lient PAS vers le Mag Expert ni vers les pages L'Association dans le corps de page — uniquement via le footer et la nav principale.

---

## 4. Silo 2 — Nos Services

### Concept et objectif

**Mot mystère : Soins à domicile**

C'est le silo le plus stratégique du site. Il est structuré en **3 cocons sémantiques** correspondant aux 3 grandes familles de prestations. Chaque cocon renforce l'autorité thématique de sa famille de services.

### Hub du silo

**`nos-services.html`** — Page d'entrée Silo 2  
- Présente les 3 cocons sous forme de grille colorée
- Lien vers les 9 pages feuilles
- Reçoit des liens entrants depuis : homepage, nav principale, footer, pages quartier, articles mag

---

### Cocon 1 — Soins médicaux

**Couleur identitaire : #7DA2FA (bleu)**  
**Champ lexical pivot** : soin · infirmier · médical · ordonnance · remboursement · SSIAD

#### Pages du cocon

| Fichier | Sujet | Mot-clé principal |
|---|---|---|
| `soins-infirmiers-nantes.html` | Soins infirmiers à domicile | `soins infirmiers domicile Nantes` |
| `nursing-aide-soignant-nantes.html` | Nursing et aide-soignant | `nursing aide soignant domicile Nantes` |
| `soin-hygiene-domicile-nantes.html` | Soins d'hygiène et toilette | `aide toilette domicile Nantes` |
| `accompagnement-fin-de-vie-nantes.html` | Accompagnement fin de vie | `soins palliatifs domicile Nantes` |

#### Maillage interne Cocon 1

```
nos-services.html
    ↓ vers soins-infirmiers · nursing · soin-hygiene · fin-de-vie

soins-infirmiers-nantes.html
    ↓ "En complément" → soin-hygiene · nursing · accompagnement-fin-de-vie

nursing-aide-soignant-nantes.html
    ↓ "En complément" → soins-infirmiers · soin-hygiene · lien-famille

soin-hygiene-domicile-nantes.html
    ↓ "En complément" → nursing · soins-infirmiers · accompagnement-fin-de-vie

accompagnement-fin-de-vie-nantes.html
    ↓ "En complément" → soins-infirmiers · soin-hygiene · lien-famille
```

**Liens inter-cocons** : `accompagnement-fin-de-vie` et `nursing` pointent vers `lien-famille-corps-medical` (Cocon 3) car la coordination est indissociable des soins lourds.

---

### Cocon 2 — Vie quotidienne

**Couleur identitaire : #8FF0D2 (menthe)**  
**Champ lexical pivot** : aide · domicile · quotidien · autonomie · vie sociale · repas · mobilité

#### Pages du cocon

| Fichier | Sujet | Mot-clé principal |
|---|---|---|
| `aide-a-domicile-nantes.html` | Aide à domicile | `aide à domicile Nantes` |
| `nutrition-repas-domicile-nantes.html` | Nutrition et repas | `portage repas domicile Nantes` |
| `mobilite-vie-sociale-nantes.html` | Mobilité et vie sociale | `accompagnement sorties personnes âgées Nantes` |

#### Maillage interne Cocon 2

```
nos-services.html
    ↓ vers aide-a-domicile · nutrition-repas · mobilite-vie-sociale

aide-a-domicile-nantes.html
    ↓ "En complément" → nutrition-repas · mobilite-vie-sociale · dossiers-apa

nutrition-repas-domicile-nantes.html
    ↓ "En complément" → mobilite-vie-sociale · aide-a-domicile · dossiers-apa

mobilite-vie-sociale-nantes.html
    ↓ "En complément" → nutrition-repas · aide-a-domicile · dossiers-apa
```

**Liens inter-cocons** : les 3 pages Cocon 2 pointent vers `dossiers-apa-pch` (Cocon 3), car le financement (APA/PCH) est la première question des familles cherchant une aide à domicile.

---

### Cocon 3 — Coordination & Démarches

**Couleur identitaire : #FF9E8E (corail)**  
**Champ lexical pivot** : coordination · APA · PCH · dossier · administratif · famille · médecin

#### Pages du cocon

| Fichier | Sujet | Mot-clé principal |
|---|---|---|
| `dossiers-apa-pch-nantes.html` | Dossiers APA / PCH | `dossier APA PCH Nantes aide domicile` |
| `lien-famille-corps-medical-nantes.html` | Lien famille & corps médical | `coordination soins domicile famille médecin Nantes` |

#### Maillage interne Cocon 3

```
nos-services.html
    ↓ vers dossiers-apa-pch · lien-famille-corps-medical

dossiers-apa-pch-nantes.html
    ↓ "En complément" → lien-famille · soins-infirmiers · nos-services

lien-famille-corps-medical-nantes.html
    ↓ "En complément" → soins-infirmiers · accompagnement-fin-de-vie · dossiers-apa
```

**Rôle stratégique du Cocon 3** : ces deux pages sont des **pages transversales** — elles reçoivent des liens depuis les Cocons 1 et 2 (car chaque service renvoie vers le financement et la coordination). Elles concentrent donc du jus SEO depuis tout le silo, ce qui renforce leur positionnement sur des requêtes informationnelles à forte valeur.

---

### Vision synthétique Silo 2

```
                    nos-services.html (HUB)
                   /         |         \
           COCON 1        COCON 2        COCON 3
        [Médicaux]      [Quotidien]   [Coordination]
         4 pages          3 pages        2 pages
            │                │               ↑
            └────────────────┴───── liens → dossiers-apa
                                          lien-famille
```

Les Cocons 1 et 2 **alimentent** le Cocon 3 en jus SEO via des liens contextuels. Le Cocon 3 renvoie vers le hub `nos-services.html` pour boucler la circulation de l'autorité.

---

## 5. Silo 3 — Le Mag Expert

### Concept et objectif

**Mot mystère : Expertise**

Ce silo sert deux fonctions SEO complémentaires :
1. **Signaux E-E-A-T** : démontrer l'expertise médicale et l'autorité éditoriale de NSAD
2. **Capture de trafic informationnel** : positionner sur des requêtes longue traîne (Alzheimer, aidants, APA) dont les lecteurs sont des prospects qualifiés

### Hub

**`mag-expert.html`** — Page d'entrée du Mag  
- Présente les 2 articles avec extraits et miniatures
- Lien entrant depuis : nav principale, footer (toutes pages)

### Articles

#### `comprendre-alzheimer-parkinson-nantes.html`
- **Angle** : guide médical + prise en charge domicile à Nantes
- **Requêtes cibles** : `Alzheimer domicile Nantes`, `soins Parkinson à domicile`
- **Liens éditoriaux injectés** :
  - `soins-infirmiers-nantes.html` — ancre : *"infirmières à domicile"*
  - `soin-hygiene-domicile-nantes.html` — ancre : *"soins d'hygiène"*
  - `accompagnement-fin-de-vie-nantes.html` — ancre : *"accompagnement de fin de vie"*
  - `mobilite-vie-sociale-nantes.html` — ancre : *"prévention des chutes"*
  - `nutrition-repas-domicile-nantes.html` — ancre : *"la nutrition"*
  - `lien-famille-corps-medical-nantes.html` — ancre : *"Coordination régulière avec le neurologue..."*
- **Bloc "Nos services pour votre proche"** : 5 liens service en fin d'article
- **Renvoi croisé** : lien vers `guide-aidant-nantais.html`

#### `guide-aidant-nantais.html`
- **Angle** : guide pratique aidant familial — aides financières, burn-out, ressources locales
- **Requêtes cibles** : `guide aidant familial Nantes`, `APA Loire-Atlantique demande`
- **Liens éditoriaux injectés** :
  - `dossiers-apa-pch-nantes.html` — ancre : *"accompagner dans la constitution du dossier APA"*
  - `dossiers-apa-pch-nantes.html` — ancre : *"la PCH est accordée par la MDPH"*
  - `nos-services.html` — ancre : *"l'ensemble de nos services à domicile"*
  - `aide-a-domicile-nantes.html` — ancre dans bloc récapitulatif
- **Bloc "Pour vous aider concrètement"** : 4 liens service en fin d'article
- **Renvoi croisé** : lien vers `comprendre-alzheimer-parkinson-nantes.html`

### Maillage Silo 3 → Silo 2

```
mag-expert.html
    ↓ vers comprendre-alzheimer · guide-aidant

comprendre-alzheimer.html
    ↓ 6 liens inline → soins-infirmiers · soin-hygiene · fin-de-vie
                        mobilite · nutrition · lien-famille
    ↓ bloc services → fin-de-vie · soins-infirmiers · soin-hygiene
                       lien-famille · dossiers-apa

guide-aidant.html
    ↓ 3 liens inline → dossiers-apa (x2) · nos-services
    ↓ bloc services → dossiers-apa · lien-famille · nos-services · aide-a-domicile
```

**Logique** : les articles du Mag Expert **transfèrent leur autorité éditoriale** (PageRank + signaux thématiques) vers les pages service, renforçant leur positionnement sans diluer l'autorité du silo médical.

---

## 6. Silo 4 — L'Association

### Concept et objectif

**Mot mystère : Éthique**

Ce silo construit la **confiance institutionnelle** (Trust dans E-E-A-T). Il répond aux questions que se posent les familles avant de choisir une structure : qui êtes-vous ? quelles sont vos valeurs ? avec qui travaillez-vous ?

### Hub

**`qui-sommes-nous.html`** — Page institutionnelle principale  
- Histoire de l'association, équipe, chiffres clés
- Lien entrant depuis : nav principale ("L'Association"), footer

### Pages feuilles

| Fichier | Sujet | Rôle SEO |
|---|---|---|
| `nos-valeurs-engagements.html` | 6 valeurs + 8 engagements + charte bientraitance | Trust, E-E-A-T, mots-clés institutionnels |
| `nos-partenaires.html` | CHU, MAIA, CLIC, associations partenaires | Autorité, réseaux locaux, backlinks potentiels |

### Maillage Silo 4

```
qui-sommes-nous.html
    ↓ vers nos-valeurs-engagements · nos-partenaires

nos-valeurs-engagements.html
    ↓ vers qui-sommes-nous · nous-contacter

nos-partenaires.html
    ↓ vers qui-sommes-nous · nous-contacter
```

**Note** : Le Silo 4 est **intentionnellement peu lié vers les silos services**. Les pages institutionnelles ne doivent pas diluer leur autorité sur des requêtes transactionnelles — leur rôle est de construire la confiance, pas de convertir directement.

---

## 7. Pages de navigation directe

Ces 3 pages sont accessibles depuis la navigation principale mais n'appartiennent à aucun silo :

| Fichier | Rôle |
|---|---|
| `faq.html` | FAQ générale — capture de longue traîne, réponses aux doutes des prospects |
| `recrutement.html` | Offres d'emploi — 3 postes (infirmier, aide-soignant, auxiliaire) |
| `nous-contacter.html` | Page de conversion principale — formulaire + téléphone |

**Maillage vers ces pages** :
- `faq.html` : badge spécial dans le footer sur toutes les pages + lien nav
- `recrutement.html` : lien nav + footer (section L'Association)
- `nous-contacter.html` : CTA Band sur toutes les pages + footer + nav

---

## 8. Maillage interne — Matrice complète

### Légende
- **N** = Navigation principale (présente sur toutes les pages)
- **F** = Footer (présent sur toutes les pages)
- **C** = Corps de page (rédactionnel — le plus précieux SEO)
- **CTA** = Call-to-action band

### Tableau source → destination

| Page source | Liens vers (dans le corps) |
|---|---|
| `index.html` | nos-quartiers · nos-services · mag-expert · qui-sommes-nous · nous-contacter · soins-infirmiers · aide-a-domicile · nursing |
| `nos-quartiers.html` | 9 pages quartier + nous-contacter |
| `nos-services.html` | 9 pages service (3 cocons) + nous-contacter |
| `mag-expert.html` | comprendre-alzheimer · guide-aidant |
| `qui-sommes-nous.html` | nos-valeurs · nos-partenaires · nous-contacter |
| **Quartier (×9)** | soins-infirmiers · aide-a-domicile · nursing · soin-hygiene · fin-de-vie · nutrition · mobilite · dossiers-apa · lien-famille · 8 autres quartiers · nos-quartiers |
| `soins-infirmiers-nantes.html` | soin-hygiene · nursing · accompagnement-fin-de-vie |
| `nursing-aide-soignant-nantes.html` | soins-infirmiers · soin-hygiene · lien-famille |
| `soin-hygiene-domicile-nantes.html` | nursing · soins-infirmiers · accompagnement-fin-de-vie |
| `accompagnement-fin-de-vie-nantes.html` | soins-infirmiers · soin-hygiene · lien-famille |
| `aide-a-domicile-nantes.html` | nutrition-repas · mobilite · dossiers-apa |
| `nutrition-repas-domicile-nantes.html` | mobilite · aide-a-domicile · dossiers-apa |
| `mobilite-vie-sociale-nantes.html` | nutrition-repas · aide-a-domicile · dossiers-apa |
| `dossiers-apa-pch-nantes.html` | lien-famille · soins-infirmiers · nos-services |
| `lien-famille-corps-medical-nantes.html` | soins-infirmiers · accompagnement-fin-de-vie · dossiers-apa |
| `comprendre-alzheimer-parkinson-nantes.html` | soins-infirmiers · soin-hygiene · fin-de-vie · mobilite · nutrition · lien-famille · dossiers-apa · guide-aidant |
| `guide-aidant-nantais.html` | dossiers-apa · nos-services · aide-a-domicile · lien-famille · comprendre-alzheimer |

### Flux de PageRank attendu

```
index.html  (autorité maximale)
    │
    ├──→ nos-quartiers (hub géo)
    │        └──→ 9 quartiers → 9 services × 9 pages = 81 liens vers services
    │
    ├──→ nos-services (hub services)
    │        ├──→ cocon1 (4 pages) ←→ liens croisés internes
    │        ├──→ cocon2 (3 pages) ←→ liens croisés internes
    │        └──→ cocon3 (2 pages) ← reçoit de cocon1 + cocon2
    │
    └──→ mag-expert → 2 articles → liens vers services (transfert autorité éditoriale)
```

---

## 9. Implémentation technique

### Navigation principale (8 items)

Présente sur les 33 pages du site :

```html
<ul class="nav-links">
  <li><a href="index.html">Accueil</a></li>
  <li><a href="nos-quartiers.html">Nos Quartiers</a></li>
  <li><a href="nos-services.html">Nos Services</a></li>
  <li><a href="mag-expert.html">Le Mag</a></li>
  <li><a href="qui-sommes-nous.html">L'Association</a></li>
  <li><a href="faq.html">FAQ</a></li>
  <li><a href="recrutement.html">Recrutement</a></li>
  <li><a href="nous-contacter.html">Contact</a></li>
</ul>
```

### Footer structuré par silos

Le footer est organisé en **4 colonnes respectant l'architecture des silos** :

- **Colonne 1** : Identité NSAD (logo, adresse, réseaux sociaux)
- **Colonne 2** : Silo 1 — Nos Quartiers (8 liens quartiers + hub)
- **Colonne 3** : Silo 2 — Nos Services (8 liens services + hub)
- **Colonne 4** : Silo 3 + Silo 4 — Le Mag + L'Association (articles + pages instit + FAQ + recrutement + contact)

**Présence sur toutes les pages** : le footer assure un maillage universel de base — chaque page du site peut atteindre n'importe quelle autre page en 2 clics maximum.

### Blocs "En complément" (Silo 2)

Injectés avant le CTA Band sur chacune des 9 pages service :

```html
<section class="nsad-related" aria-label="Services complémentaires">
  <!-- 3 cartes avec liens vers services cousins -->
  <!-- Respecte la logique cocon : priorité liens intra-cocon -->
  <!-- Liens inter-cocon pour les ponts thématiques naturels -->
</section>
```

### Blocs "Tous nos services" (Silo 1)

Injectés sur les 9 pages quartier avant la navigation inter-quartiers :

```html
<div class="nsad-qs-services">
  <!-- 9 pills cliquables vers les 9 pages service -->
  <!-- Design : chips arrondis, fond blanc, bordure #C8D5FC -->
  <!-- Hover : bordure #8FF0D2 -->
</div>
```

### Blocs articles (Silo 3)

Injectés en fin d'article avant le CTA Band :

```html
<div class="nsad-article-services">
  <!-- Grille auto-fit de liens service -->
  <!-- Fond #EEF6FB, bordure gauche #8FF0D2 -->
</div>
```

### Liens inline éditoriaux

Les liens contextuels dans le corps de texte respectent les règles suivantes :
- **Ancre descriptive** : jamais "cliquez ici", toujours une expression qui décrit la page cible
- **1 à 3 liens par section de texte** : pas de sur-optimisation
- **Pertinence sémantique** : le lien doit enrichir la compréhension du lecteur
- **Dofollow par défaut** : tous les liens internes transmettent l'autorité

---

## 10. Redirections et URLs canoniques

### Redirections HTML (pages legacy)

Deux anciennes URLs redirigent vers les nouvelles pages canoniques :

| URL legacy | Redirige vers | Canonical |
|---|---|---|
| `hub-local.html` | `nos-quartiers.html` | `https://nantes-soins-a-domicile.fr/nos-quartiers/` |
| `quartier-bellevue.html` | `quartier-bellevue-chantenay.html` | `https://nantes-soins-a-domicile.fr/quartier-bellevue-chantenay/` |
| `quartier-chantenay.html` | `quartier-bellevue-chantenay.html` | `https://nantes-soins-a-domicile.fr/quartier-bellevue-chantenay/` |

Implémentation :
```html
<meta http-equiv="refresh" content="0; url=nos-quartiers.html" />
<link rel="canonical" href="https://nantes-soins-a-domicile.fr/nos-quartiers/" />
```

### Format des URLs canoniques

Toutes les pages utilisent le format :
```
https://nantes-soins-a-domicile.fr/[slug-de-page]/
```

Exemples :
- `https://nantes-soins-a-domicile.fr/soins-infirmiers-nantes/`
- `https://nantes-soins-a-domicile.fr/quartier-centre-ville/`
- `https://nantes-soins-a-domicile.fr/comprendre-alzheimer-parkinson-nantes/`

---

## 11. Signaux E-E-A-T

La stratégie de contenu renforce les 4 composantes de l'E-E-A-T (Experience, Expertise, Authority, Trust) de Google :

### Experience (Expérience vécue)
- Témoignages géolocalisés sur chaque page quartier
- Cas concrets dans les articles Mag Expert
- Descriptions détaillées des processus d'intervention

### Expertise (Expertise médicale)
- Vocabulaire médical précis (SSIAD, GIR, EMSP, CMRR...)
- Articles Mag Expert documentés avec références locales (CHU Nantes, CLIC 44...)
- Numéros de licences / agréments (ARS Pays de la Loire)
- Schema.org `MedicalTherapy`, `Physician`, `LocalBusiness` sur les pages clés

### Authority (Autorité)
- Partenariats cités : CHU de Nantes, France Alzheimer 44, MAIA Loire-Atlantique
- Infirmiers libéraux partenaires nommés et géolocalisés (Schema.org `Physician`)
- Agrément préfectoral mentionné en footer
- Loi 1901 (association non-lucrative = signal de confiance institutionnel)

### Trust (Confiance)
- HTTPS natif
- Adresse physique cohérente sur toutes les pages
- Numéro de téléphone cliquable universel
- Page `nos-valeurs-engagements.html` dédiée à la charte de bientraitance
- Page `nos-partenaires.html` avec logos et liens externes `rel="noopener noreferrer"`
- Mentions légales et copyright en footer

---

## 12. Récapitulatif des fichiers HTML

### 33 pages au total

| # | Fichier | Type | Silo |
|---|---|---|---|
| 1 | `index.html` | Homepage | — |
| 2 | `nos-quartiers.html` | Hub silo | Silo 1 |
| 3 | `quartier-centre-ville.html` | Page feuille | Silo 1 |
| 4 | `quartier-ile-de-nantes.html` | Page feuille | Silo 1 |
| 5 | `quartier-bellevue-chantenay.html` | Page feuille | Silo 1 |
| 6 | `quartier-dervallières-zola.html` | Page feuille | Silo 1 |
| 7 | `quartier-hauts-paves-saint-felix.html` | Page feuille | Silo 1 |
| 8 | `quartier-breil-barbiere.html` | Page feuille | Silo 1 |
| 9 | `quartier-malakoff-saint-donatien.html` | Page feuille | Silo 1 |
| 10 | `quartier-nantes-nord.html` | Page feuille | Silo 1 |
| 11 | `quartier-nantes-sud.html` | Page feuille | Silo 1 |
| 12 | `nos-services.html` | Hub silo | Silo 2 |
| 13 | `soins-infirmiers-nantes.html` | Feuille cocon 1 | Silo 2 |
| 14 | `nursing-aide-soignant-nantes.html` | Feuille cocon 1 | Silo 2 |
| 15 | `soin-hygiene-domicile-nantes.html` | Feuille cocon 1 | Silo 2 |
| 16 | `accompagnement-fin-de-vie-nantes.html` | Feuille cocon 1 | Silo 2 |
| 17 | `aide-a-domicile-nantes.html` | Feuille cocon 2 | Silo 2 |
| 18 | `nutrition-repas-domicile-nantes.html` | Feuille cocon 2 | Silo 2 |
| 19 | `mobilite-vie-sociale-nantes.html` | Feuille cocon 2 | Silo 2 |
| 20 | `dossiers-apa-pch-nantes.html` | Feuille cocon 3 | Silo 2 |
| 21 | `lien-famille-corps-medical-nantes.html` | Feuille cocon 3 | Silo 2 |
| 22 | `mag-expert.html` | Hub silo | Silo 3 |
| 23 | `comprendre-alzheimer-parkinson-nantes.html` | Article | Silo 3 |
| 24 | `guide-aidant-nantais.html` | Article | Silo 3 |
| 25 | `qui-sommes-nous.html` | Hub silo | Silo 4 |
| 26 | `nos-valeurs-engagements.html` | Page feuille | Silo 4 |
| 27 | `nos-partenaires.html` | Page feuille | Silo 4 |
| 28 | `faq.html` | Navigation directe | — |
| 29 | `recrutement.html` | Navigation directe | — |
| 30 | `nous-contacter.html` | Navigation directe | — |
| 31 | `hub-local.html` | Redirect legacy | → Silo 1 |
| 32 | `quartier-bellevue.html` | Redirect legacy | → Silo 1 |
| 33 | `quartier-chantenay.html` | Redirect legacy | → Silo 1 |

---

## Annexe — Principes de maintenance

### Ajouter une nouvelle page service

1. Créer la page dans le cocon approprié
2. Ajouter le lien depuis `nos-services.html` dans le cocon correspondant
3. Ajouter le lien dans le footer (colonne Nos Services)
4. Ajouter le lien dans les blocs "En complément" des pages sœurs du cocon
5. Ajouter le lien dans les blocs "Tous nos services" de chaque page quartier
6. Vérifier si un article Mag Expert peut l'intégrer

### Ajouter un nouveau quartier

1. Créer la page avec la structure type (services-cta-grid + section pills + nav-quartiers)
2. Ajouter le lien depuis `nos-quartiers.html`
3. Ajouter le lien dans le footer (colonne Nos Quartiers)
4. Ajouter le lien dans les blocs `nav-quartiers` des 8 autres pages quartier
5. Mettre à jour le titre "9 quartiers couverts" → "10 quartiers couverts" sur `nos-quartiers.html`

### Règle d'or du maillage interne

> Ne jamais créer de **page orpheline** (page sans lien entrant depuis une autre page du site).  
> Ne jamais créer de **cul-de-sac** (page sans lien sortant vers d'autres pages du site).  
> Toujours maintenir la **cohérence sémantique** : un lien doit avoir du sens pour le lecteur humain.

---

*Document généré le 21 mai 2026 — Prototype SEO/GEO/AEO 2027*  
*Nantes Soins à Domicile — Association loi 1901 — 6 rue Bel Air, 44000 Nantes*
