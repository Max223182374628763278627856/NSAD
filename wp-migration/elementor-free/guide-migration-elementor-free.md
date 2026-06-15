# Guide de migration — NSAD vers WordPress + Elementor (version gratuite)
*Étape par étape, sans code*

---

## Ce dont vous avez besoin avant de commencer

- Accès à l'interface WordPress (`votresite.fr/wp-admin`)
- Elementor installé et activé
- Plugin **Contact Form 7** installé (gratuit — Extensions → Ajouter)
- Le fichier `custom-css-wordpress.css` de ce dossier (ouvert dans un éditeur de texte)
- Les pages HTML du dépôt GitHub (pour copier les textes)

**Durée estimée :** 2 à 4 heures pour les pages principales

---

## ÉTAPE 1 — Installer le CSS global du Design System

C'est la première chose à faire. Ce CSS va appliquer automatiquement les couleurs, polices et styles NSAD sur tout le site.

1. Dans WordPress : **Apparence → Personnaliser**
2. Cliquez sur **CSS Additionnel** (tout en bas du menu gauche)
3. Ouvrez le fichier `elementor-free/custom-css-wordpress.css` dans le Bloc-Notes (Windows) ou TextEdit (Mac)
4. Sélectionnez tout (Ctrl+A) → Copiez (Ctrl+C)
5. Collez dans la zone CSS Additionnel de WordPress
6. Cliquez sur **Publier**

✅ Le site applique maintenant automatiquement les polices Poppins/Hind et les couleurs NSAD.

---

## ÉTAPE 2 — Installer et configurer Contact Form 7

1. **Extensions → Ajouter une extension**
2. Chercher : `Contact Form 7`
3. Cliquer **Installer** puis **Activer**
4. Suivre les instructions du fichier `elementor-free/contact-form7.txt` (copier le code du formulaire, configurer l'email de réception)

---

## ÉTAPE 3 — Préparer les pages dans WordPress

Avant de modifier le contenu dans Elementor, créer toutes les pages avec les bons noms.

### 3.1 Pages à créer (si elles n'existent pas)

Allez dans **Pages → Ajouter une page** pour chaque ligne :

| Titre de la page | Slug (URL) |
|---|---|
| Accueil | *(page d'accueil, voir 3.2)* |
| Nos Services | nos-services |
| Nos Quartiers | nos-quartiers |
| Qui sommes-nous | qui-sommes-nous |
| Nos Valeurs & Engagements | nos-valeurs-engagements |
| Nous Contacter | nous-contacter |
| Recrutement | recrutement |
| FAQ | faq |
| Nos Actualités | nos-actualites |
| Nos Partenaires | nos-partenaires |
| Mentions Légales | mentions-legales |

**Pour les pages quartiers :**

| Titre | Slug |
|---|---|
| Aide à Domicile Centre-ville Nantes | quartier-centre-ville |
| Aide à Domicile Île de Nantes | quartier-ile-de-nantes |
| Aide à Domicile Bellevue-Chantenay | quartier-bellevue-chantenay |
| Aide à Domicile Hauts-Pavés Saint-Félix | quartier-hauts-paves-saint-felix |
| Aide à Domicile Nantes Nord | quartier-nantes-nord |
| Aide à Domicile Malakoff Saint-Donatien | quartier-malakoff-saint-donatien |
| Aide à Domicile Breil-Barbière | quartier-breil-barbiere |
| Aide à Domicile Nantes Sud | quartier-nantes-sud |
| Aide à Domicile Dervallières-Zola | quartier-dervallieres-zola |
| Aide à Domicile Île de Nantes (Erdre) | quartier-nantes-erdre |
| Aide à Domicile Doulon-Bottière | quartier-doulon-bottiere |

> ⚠️ **Important :** Le slug (URL) doit être exactement comme indiqué — sans accents, sans majuscules. C'est essentiel pour le référencement.

### 3.2 Définir la page d'accueil

1. **Réglages → Lecture**
2. Cocher **Une page statique**
3. Sélectionner la page "Accueil" dans le menu déroulant
4. Cliquer **Enregistrer les modifications**

### 3.3 Configurer les URLs propres (permaliens)

1. **Réglages → Permaliens**
2. Sélectionner **Nom de l'article** (`/%postname%/`)
3. Cliquer **Enregistrer les modifications**

---

## ÉTAPE 4 — Modifier chaque page avec Elementor

### Comment ouvrir l'éditeur Elementor

1. **Pages** → repérez la page à modifier
2. Cliquez sur **Modifier avec Elementor** (lien bleu)
3. L'éditeur visuel s'ouvre

### Comment ajouter du contenu

Dans Elementor, chaque page est composée de **sections** contenant des **colonnes** et des **widgets**.

**Pour ajouter une section :**
- Cliquer sur le **+** bleu qui apparaît entre les sections
- Choisir le nombre de colonnes (1, 2 ou 3)

**Pour ajouter un widget :**
- Dans la colonne gauche, chercher le widget (ex: "Titre", "Texte", "Image", "Bouton")
- Faire glisser-déposer dans la section

**Widgets les plus utilisés pour ce site :**

| Widget | Usage |
|---|---|
| Titre | H1, H2, H3 — titres de sections |
| Éditeur de texte | Paragraphes, listes |
| Image | Photos |
| Bouton | CTA, liens |
| Code court | Formulaire Contact Form 7 |
| Accordéon | FAQ |
| Séparateur | Lignes de séparation |
| Colonnes d'icônes | Avantages, étapes |

---

## ÉTAPE 5 — Appliquer le style NSAD dans Elementor

Les widgets Elementor ne connaissent pas automatiquement les couleurs NSAD. Voici comment les appliquer sans code.

### Couleurs des boutons

1. Ajouter un widget **Bouton**
2. Dans le panneau gauche, onglet **Style**
3. **Background Type** → Couleur → entrer : `#2E6A8A`
4. **Couleur du texte** → `#FFFFFF`
5. **Border Radius** → `9999` (pour le look arrondi)
6. OU : dans l'onglet **Avancé → Classes CSS**, taper `nsad-btn-primary`

### Couleurs des sections

1. Cliquez sur la section (pas le widget dedans)
2. Onglet **Style → Fond**
3. Choisir une couleur ou utiliser la classe CSS :
   - `nsad-section-mint` → fond menthe clair
   - `nsad-section-coral` → fond corail clair
   - `nsad-section-dark` → fond sombre (hero, CTA)

### Titres (H1, H2)

Dans le widget Titre, onglet **Style** :
- Police : `Poppins`
- Poids : `Bold` (700) ou `Extra Bold` (800) pour les H1
- Couleur : `#122432`

### Corps de texte

Dans le widget Éditeur de texte, onglet **Style** :
- Police : `Hind`
- Taille : `17px` minimum
- Interligne : `1.85`
- Couleur : `#344852`

---

## ÉTAPE 6 — Construire la page Accueil

Reproduire cette structure dans l'éditeur Elementor :

```
Section 1 : Hero (classe : nsad-hero)
  └── 2 colonnes
      ├── Colonne gauche (60%) : Titre H1 + Texte + 2 Boutons
      └── Colonne droite (40%) : Image ou illustration

Section 2 : Trust Band (classe : nsad-section-primary)
  └── 1 colonne : 3 chiffres clés côte à côte

Section 3 : Nos Services (fond blanc)
  └── Titre H2 + sous-titre
  └── 3 colonnes : 3 cartes (classe : nsad-card nsad-card-mint/coral/lavender)
      Chaque carte : Icône + Titre + Texte + Lien

Section 4 : Nos Quartiers (classe : nsad-section-mint)
  └── Titre H2
  └── Grille de liens vers les pages quartiers

Section 5 : Témoignages
  └── Titre H2
  └── 3 colonnes (classe : nsad-temoignage)

Section 6 : CTA (classe : nsad-cta-band)
  └── Titre H2 + Sous-titre + Bouton principal
```

---

## ÉTAPE 7 — Pages Quartiers (template réutilisable)

Toutes les pages quartiers ont la même structure. Faire la première, puis la dupliquer.

**Structure d'une page quartier :**

```
Section 1 : Hero (classe : nsad-hero)
  └── Titre H1 : "Aide à Domicile [Quartier] Nantes"
  └── Sous-titre + Bouton

Section 2 : Services disponibles
  └── Titre H2 : "Services disponibles à [Quartier]"
  └── 3 cartes de services

Section 3 : Partenaires locaux
  └── Titre H2 : "Infirmiers libéraux partenaires"
  └── Liste des partenaires (Texte)

Section 4 : Histoire du quartier (classe : nsad-section-mint)
  └── Texte historique

Section 5 : FAQ local (Accordion)
  └── 5 à 7 questions/réponses spécifiques au quartier

Section 6 : Navigation quartiers
  └── Liens vers les autres quartiers

Section 7 : CTA (classe : nsad-cta-band)
  └── Bouton de contact
```

**Pour dupliquer :**
1. Sur la page Centre-ville terminée, cliquer sur les **3 points** en haut à droite d'Elementor
2. **Enregistrer comme modèle**
3. Pour chaque nouveau quartier : créer la page → Ouvrir avec Elementor → **Ajouter un modèle** → Sélectionner le modèle quartier → Modifier uniquement le texte

---

## ÉTAPE 8 — Menu de navigation

1. **Apparence → Menus**
2. Créer un menu : **Créer un nouveau menu** → Nommer "Menu Principal" → Créer
3. Ajouter les pages dans cet ordre :
   - Nos Services
   - Nos Quartiers
   - Qui sommes-nous
   - Recrutement
   - Nous Contacter
4. Cocher **Menu principal** dans "Emplacement du menu"
5. **Enregistrer le menu**

---

## ÉTAPE 9 — Bouton flottant téléphone (mobile)

Ajouter ce code HTML dans le footer du site via un widget **HTML** Elementor :

```html
<a href="tel:0240354343" class="nsad-floating-call">
  <span>📞</span>
  <span class="fc-label">02 40 35 43 43</span>
</a>
```

Le CSS dans `custom-css-wordpress.css` le rend visible uniquement sur mobile.

---

## ÉTAPE 10 — Redirections (anciens liens → nouveaux)

Si l'ancien site avait des URLs avec `.html`, installer le plugin **Redirection** (gratuit) :

1. **Extensions → Ajouter → chercher "Redirection"**
2. Installer et activer
3. **Outils → Redirection**
4. Ajouter chaque ancienne URL et sa nouvelle destination
5. Exemple : `/nos-services.html` → `/nos-services/`

La liste complète des redirections est dans `wp-migration/redirects.htaccess`.

---

## RÉCAPITULATIF DES PLUGINS À INSTALLER

| Plugin | Gratuit ? | Rôle |
|---|---|---|
| Elementor | ✅ Gratuit | Éditeur de pages visuel |
| Contact Form 7 | ✅ Gratuit | Formulaire de contact |
| Redirection | ✅ Gratuit | Redirections 301 (SEO) |
| RankMath | ✅ Gratuit | SEO, meta descriptions |
| LiteSpeed Cache ou W3 Total Cache | ✅ Gratuit | Performance |
| OMGF | ✅ Gratuit | Charger Google Fonts localement (RGPD) |

---

## CE QUI FONCTIONNE DIFFÉREMMENT SANS ELEMENTOR PRO

| Fonctionnalité | Elementor Free | Contournement |
|---|---|---|
| Header/footer visuel | ❌ | Géré par le thème actif |
| Couleurs globales | ❌ | CSS Additionnel (déjà fait à l'étape 1) |
| Formulaire de contact | ❌ | Contact Form 7 (étape 2) |
| Animations d'entrée | ❌ | Accepter des pages sans animation |
| Templates quartiers illimités | ❌ | Sauvegarder comme modèle (disponible en free) |

---

*Fichier rédigé pour la migration du site NSAD — juin 2026*
