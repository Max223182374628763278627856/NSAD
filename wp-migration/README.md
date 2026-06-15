# wp-migration/ — Dossier de migration WordPress/Elementor

Contient tous les fichiers nécessaires pour migrer le prototype HTML statique NSAD vers WordPress + Elementor Pro.

---

## Contenu du dossier

| Fichier | Rôle |
|---|---|
| `page-map.json` | Mapping complet des 36 pages HTML → slugs WordPress + templates + notes SEO |
| `elementor-global-colors.json` | Toutes les couleurs, polices et boutons globaux à configurer dans Elementor |
| `redirects.htaccess` | Règles Apache 301 : anciennes URLs `.html` → nouvelles URLs propres WordPress |
| `child-theme/style.css` | Thème enfant Hello Elementor — CSS complet du Design System NSAD |
| `child-theme/functions.php` | PHP du thème enfant : scripts, Schema.org, Custom Post Types, sécurité |

---

## Ordre d'installation recommandé

### Étape 1 — WordPress de base
1. Installer WordPress (hébergeur : OVH, Infomaniak, WP Engine, etc.)
2. Installer le thème **Hello Elementor** (gratuit, officiel Elementor)
3. Copier le dossier `child-theme/` dans `wp-content/themes/nsad-child/`
4. Activer le thème enfant **NSAD Child Theme** dans Apparence → Thèmes

### Étape 2 — Plugins requis
```
Elementor Pro         → Builder de pages
RankMath Pro          → SEO + Schema.org
WP Rocket             → Cache et performance
OMGF                  → Héberger Google Fonts localement (RGPD)
Redirection           → Gérer les 301 .html → URLs propres
```

### Étape 3 — Design System Elementor
Ouvrir Elementor → hamburger → **Paramètres du site** :
- **Couleurs Globales** : saisir les 11 couleurs de `elementor-global-colors.json`
- **Polices Globales** : Poppins (titres 700/800) + Hind (corps 400, 18px min)
- **Mise en page** : Largeur contenu = **1140px**, padding section = **80px desktop / 48px mobile**
- **Boutons** : border-radius pill (9999px), hauteur min 52px

### Étape 4 — CSS Global
Apparence → **Personnaliser → CSS Additionnel** :
- Coller le contenu de `child-theme/style.css`  
  OU activer le thème enfant qui le charge automatiquement

### Étape 5 — Création des pages
Suivre `page-map.json` dans l'ordre de priorité (1 → 4) :
1. Accueil, Contact, Services, Quartiers
2. Pages services spécialisées (10 pages)
3. Pages quartiers (11 pages — créer 1 template réutilisable)
4. Pages légales et techniques

### Étape 6 — Redirections
Copier le contenu de `redirects.htaccess` dans le `.htaccess` WordPress à la racine  
OU importer les règles via le plugin **Redirection** (CSV ou saisie manuelle)

### Étape 7 — SEO
Configurer **RankMath Pro** :
- Copier les meta descriptions depuis chaque page HTML (balise `<meta name="description">`)
- Migrer les Schema.org JSON-LD depuis chaque `<script type="application/ld+json">`
- Activer le module **FAQ Schema** pour les pages avec accordion FAQ

---

## Notes importantes

- **Slugs** : Les slugs WordPress doivent être identiques aux noms de fichiers HTML (sans l'extension) pour que les redirections 301 fonctionnent correctement
- **Page d'accueil** : Réglages → Lecture → "Une page statique" → sélectionner la page Accueil
- **Permaliens** : Réglages → Permaliens → "Nom de l'article" (`/%postname%/`)
- **Styleguide** : Mettre en noindex et protéger par mot de passe en production
- **Formulaire contact** : Exclure la page `/nous-contacter/` du cache WP Rocket

---

## Template quartier réutilisable

Les 11 pages quartiers ont une structure identique. Dans Elementor :
1. Créer la première page (ex: Centre-ville) avec Elementor
2. Enregistrer comme **Template Elementor** (Modèle de page)
3. Pour chaque autre quartier : créer une page → appliquer le template → modifier uniquement le texte et les couleurs d'accent

---

*Voir aussi : `MIGRATION_GUIDE.md` à la racine pour la documentation technique complète.*
