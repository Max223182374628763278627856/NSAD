# Guide de migration NSAD — Étape par étape
## WordPress + Elementor (version gratuite) + Elementor Header & Footer Builder

---

> **Avant de commencer**
> Durée estimée : **3 à 5 heures** pour les pages principales.
> Aucune connaissance technique requise.

---

## Les 3 plugins indispensables

Installez ces 3 plugins **dans cet ordre** avant toute autre action.

### 1. Hello Elementor (thème de base)
> Apparence → Thèmes → Ajouter → chercher "Hello Elementor" → Installer → Activer

C'est le thème officiel d'Elementor. Il est vide, léger, et laisse Elementor contrôler 100% du design. Sans lui, des styles du thème précédent peuvent interférer avec votre design NSAD.

### 2. Elementor
> Extensions → Ajouter → chercher "Elementor" → Installer → Activer

L'éditeur visuel principal. La version gratuite suffit pour tout le contenu des pages.

### 3. Elementor Header & Footer Builder
> Extensions → Ajouter → chercher "Elementor Header Footer Builder" → Installer → Activer

Ce plugin gratuit permet de créer un header et un footer visuellement dans Elementor, sans Elementor Pro. Indispensable pour reproduire la navigation et le pied de page NSAD.

---

## PHASE 1 — Configurer les couleurs globales Elementor (5 min)

C'est la configuration la plus importante. Faire ça en premier garantit que tout le design est cohérent.

1. Allez dans **Elementor → Paramètres du site** (icône hamburger en haut à gauche dans Elementor)
2. Cliquez sur **Style du site → Couleurs globales**
3. Configurez les 4 couleurs :

| Nom dans Elementor | Couleur à entrer |
|---|---|
| **Primaire** | `#2E6A8A` |
| **Secondaire** | `#70E8C6` |
| **Texte** | `#344852` |
| **Accent** | `#FF8A75` |

4. Cliquez sur **Enregistrer les modifications**

> **Pourquoi c'est magique :** Après ça, si vous changez la couleur Primaire (ex: passer de bleu à vert), TOUT le site se met à jour en 1 clic — boutons, titres, liens, sections. Le CSS du fichier `config/custom-css.css` pointe vers ces couleurs automatiquement.

---

## PHASE 2 — Installer le CSS global (3 min)

Ce fichier CSS fait le lien entre les couleurs Elementor et le design NSAD.

1. Allez dans **Apparence → Personnaliser**
2. Cliquez sur **CSS Additionnel** (tout en bas du menu gauche)
3. Ouvrez le fichier `wordpress/config/custom-css.css` dans le Bloc-notes (Windows) ou TextEdit (Mac)
4. Sélectionnez tout le contenu (`Ctrl+A`) → Copiez (`Ctrl+C`)
5. Collez dans la zone CSS Additionnel de WordPress (`Ctrl+V`)
6. Cliquez sur **Publier**

✅ Résultat immédiat : les polices Poppins et Hind s'appliquent, les boutons ont le bon style arrondi, le fond de page est légèrement grisé.

---

## PHASE 3 — Configurer les polices globales (3 min)

1. Retournez dans **Elementor → Paramètres du site → Style du site → Typographies globales**
2. Configurez :

| Nom | Police | Poids | Taille mini |
|---|---|---|---|
| **Titre principal** | Poppins | Bold (700) | — |
| **Titre secondaire** | Poppins | SemiBold (600) | — |
| **Corps de texte** | Hind | Regular (400) | 18px |
| **Accent** | Poppins | Medium (500) | — |

3. **Enregistrer les modifications**

---

## PHASE 4 — Importer le Header (10 min)

### 4.1 Importer le fichier JSON du header

1. Dans Elementor, allez dans **Modèles → Mes modèles**
2. Cliquez sur **Importer des modèles**
3. Sélectionnez le fichier `wordpress/templates/header-template.json`
4. Le modèle "NSAD — Header" apparaît dans la liste

### 4.2 Créer le header dans Elementor Header & Footer Builder

1. Dans le menu WordPress : **Elementor → Header Footer Builder** (ou via le menu du plugin)
2. Cliquez sur **Ajouter un nouveau**
3. Titre : `Header NSAD`
4. Type : **Header**
5. Afficher sur : **Tout le site**
6. Cliquez sur **Modifier avec Elementor**
7. Dans l'éditeur, cliquez sur **Ajouter modèle** (icône dossier)
8. Cherchez "NSAD Header" → cliquez sur **Insérer**
9. **Remplacez l'image** : cliquez sur le logo → dans le panneau gauche, cliquez sur l'image → uploadez votre logo NSAD depuis `wordpress/assets/logos/`
10. Cliquez sur **Publier**

✅ Le header NSAD apparaît maintenant sur toutes les pages.

---

## PHASE 5 — Importer le Footer (10 min)

Même procédure qu'au Phase 4 :

1. **Modèles → Mes modèles → Importer** → `wordpress/templates/footer-template.json`
2. **Elementor → Header Footer Builder → Ajouter un nouveau**
3. Type : **Footer** / Afficher sur : **Tout le site**
4. **Modifier avec Elementor → Ajouter modèle → "NSAD Footer" → Insérer**
5. Remplacez les images de logo (version blanche pour le footer sombre)
6. **Publier**

---

## PHASE 6 — Créer et configurer les pages (30 min)

### 6.1 Créer toutes les pages

Allez dans **Pages → Ajouter une page** pour chaque ligne ci-dessous.

> ⚠️ Le **Slug** (URL) est crucial pour le SEO. Dans chaque page, vérifiez et corrigez le slug dans "Permalien" à droite de l'éditeur.

| Titre de la page | Slug (URL) | Priorité |
|---|---|---|
| Accueil | *(voir 6.2)* | 🔴 Urgent |
| Nos Services | `nos-services` | 🔴 Urgent |
| Nous Contacter | `nous-contacter` | 🔴 Urgent |
| Nos Quartiers | `nos-quartiers` | 🟠 Important |
| Qui sommes-nous | `qui-sommes-nous` | 🟠 Important |
| Recrutement | `recrutement` | 🟠 Important |
| FAQ | `faq` | 🟡 Normal |
| Nos Actualités | `nos-actualites` | 🟡 Normal |
| Mentions Légales | `mentions-legales` | 🟡 Normal |
| Soins infirmiers à Nantes | `soins-infirmiers-nantes` | 🟡 Normal |
| Aide à domicile Nantes | `aide-a-domicile-nantes` | 🟡 Normal |

**Pages Quartiers — créer 1 par quartier :**

| Titre | Slug |
|---|---|
| Aide à domicile Centre-ville Nantes | `quartier-centre-ville` |
| Aide à domicile Île de Nantes | `quartier-ile-de-nantes` |
| Aide à domicile Bellevue-Chantenay | `quartier-bellevue-chantenay` |
| Aide à domicile Hauts-Pavés Saint-Félix | `quartier-hauts-paves-saint-felix` |
| Aide à domicile Nantes Nord | `quartier-nantes-nord` |
| Aide à domicile Malakoff Saint-Donatien | `quartier-malakoff-saint-donatien` |
| Aide à domicile Breil-Barbière | `quartier-breil-barbiere` |
| Aide à domicile Nantes Sud | `quartier-nantes-sud` |
| Aide à domicile Dervallières-Zola | `quartier-dervallieres-zola` |

### 6.2 Définir la page d'accueil

1. **Réglages → Lecture**
2. Cocher **Une page statique**
3. Page d'accueil : sélectionner "Accueil"
4. **Enregistrer les modifications**

### 6.3 URLs propres

1. **Réglages → Permaliens**
2. Sélectionner **Nom de l'article** (`/%postname%/`)
3. **Enregistrer les modifications**

---

## PHASE 7 — Importer le template Page Quartier (15 min)

Cette phase concerne les 11 pages quartiers. Le template se réutilise pour toutes.

### 7.1 Importer le template

1. **Modèles → Mes modèles → Importer** → `wordpress/templates/page-quartier-type.json`

### 7.2 Appliquer à la première page quartier

1. **Pages → Centre-ville → Modifier avec Elementor**
2. Cliquez sur l'icône dossier **Ajouter modèle**
3. Cherchez "NSAD Page Quartier Type" → **Insérer**
4. Le squelette de la page apparaît avec tous les blocs NSAD

### 7.3 Personnaliser le contenu

Remplacez tous les textes `[Nom du Quartier]` par "Centre-ville" :
- Cliquez sur le texte → modifiez dans le panneau gauche
- Titre H1, sous-titre, FAQ, section histoire, CTA final

5. **Publier**

### 7.4 Dupliquer pour les autres quartiers

Dans la liste des pages :
1. Passez la souris sur "Centre-ville"
2. Cliquez sur **Dupliquer** *(si le plugin Yoast ou un duplicate plugin est installé)*
3. OU : ouvrez la page suivante avec Elementor → Ajouter modèle → Insérer le même template
4. Changez uniquement le nom du quartier et les textes spécifiques

---

## PHASE 8 — Configurer le formulaire de contact (15 min)

Suivre les instructions détaillées dans `wordpress/config/contact-form7.txt` :

1. Installer les plugins Contact Form 7 + Flamingo
2. Créer le formulaire avec le code fourni
3. Configurer les emails de réception et confirmation
4. Copier le shortcode dans la page "Nous contacter" via un widget Shortcode Elementor

---

## PHASE 9 — Menu de navigation (5 min)

1. **Apparence → Menus → Créer un nouveau menu** : "Menu Principal"
2. Ajouter dans cet ordre :
   - Nos Services → Nos Quartiers → Qui sommes-nous → Recrutement → Nous contacter
3. Emplacement : cocher **Menu principal**
4. **Enregistrer le menu**

---

## PHASE 10 — Redirections SEO (10 min)

Si l'ancien site avait des URLs avec `.html`, installez le plugin **Redirection** (gratuit) :

1. **Extensions → Ajouter → "Redirection" → Installer → Activer**
2. **Outils → Redirection**
3. Ajoutez chaque ancienne URL (ex: `/nos-services.html`) → nouvelle URL (ex: `/nos-services/`)
4. La liste complète est dans `wp-migration/redirects.htaccess`

---

## ✅ Checklist finale

Avant de déclarer la migration terminée, vérifiez chaque point :

- [ ] Les 3 plugins sont installés et activés
- [ ] Les 4 couleurs globales sont configurées dans Elementor
- [ ] Le CSS additionnel est collé dans le Personnaliseur
- [ ] Les polices Poppins et Hind s'affichent correctement
- [ ] Le header s'affiche sur toutes les pages
- [ ] Le footer s'affiche sur toutes les pages
- [ ] Le bouton téléphone apparaît sur mobile (tester en réduisant la fenêtre)
- [ ] La page d'accueil est définie dans Réglages → Lecture
- [ ] Les URLs propres sont activées (Permaliens → Nom de l'article)
- [ ] Toutes les pages ont le bon slug (sans accent, sans majuscule)
- [ ] Le formulaire de contact envoie bien un email test
- [ ] Les pages quartiers affichent le bon nom de quartier
- [ ] Le menu de navigation fonctionne et affiche la page active
- [ ] Le site est lisible sur mobile (tester avec Chrome DevTools)

---

## En cas de problème

| Symptôme | Solution |
|---|---|
| Le design ne s'applique pas | Vider le cache Elementor : hamburger → Outils → Vider le cache |
| Les polices ne changent pas | Vérifier que le CSS additionnel est bien enregistré |
| Le formulaire n'envoie pas | Vérifier les réglages SMTP de votre hébergeur |
| L'ancien contenu apparaît encore | Vider le cache du navigateur (Ctrl+Maj+Suppr) |
| Une page affiche une erreur 404 | Aller dans Réglages → Permaliens et cliquer sur "Enregistrer" sans changer |

---

*Guide rédigé pour la migration NSAD — SSIAD Nantes*
