# Guide d'utilisation du site NSAD
## Pour les personnes qui gèrent le site sans être développeurs

---

> **Ce dont vous avez besoin :**
> - Un navigateur web (Chrome, Firefox, Edge…)
> - Votre identifiant et mot de passe WordPress
> - C'est tout. Pas besoin d'installer quoi que ce soit.

---

## Se connecter au site

1. Ouvrez votre navigateur
2. Tapez l'adresse du site suivie de `/wp-admin`  
   *Exemple : `www.nsad-nantes.fr/wp-admin`*
3. Entrez votre identifiant et votre mot de passe
4. Cliquez sur **Se connecter**

Vous arrivez sur le tableau de bord WordPress. C'est votre point de départ.

---

## Modifier le texte d'une page

*Exemple : changer le texte de la page d'accueil*

1. Dans le menu à gauche, cliquez sur **Pages**
2. Repérez la page que vous voulez modifier (ex: "Accueil")
3. Cliquez sur **Modifier avec Elementor** (bouton bleu)
4. La page s'ouvre avec l'éditeur visuel

**Dans l'éditeur :**
- Cliquez sur le texte que vous voulez changer
- Un encadré bleu apparaît autour de lui
- À gauche, une zone de saisie apparaît avec le texte actuel
- Modifiez le texte
- Cliquez sur **Publier** (bouton vert en bas à gauche) pour sauvegarder

> ✅ Vous voyez le résultat en temps réel avant de publier.

---

## Changer une image

1. Cliquez sur l'image dans l'éditeur Elementor
2. À gauche, cliquez sur la vignette de l'image actuelle
3. La médiathèque s'ouvre (toutes vos images)
4. Cliquez sur **Téléverser des fichiers** pour ajouter une nouvelle image
5. Sélectionnez votre fichier depuis votre ordinateur
6. Cliquez sur **Sélectionner** pour l'appliquer
7. Cliquez sur **Publier**

> ⚠️ Privilégiez des images en format JPG ou WebP, largeur maximale 1200 pixels.

---

## Modifier le numéro de téléphone ou l'email

Le numéro et l'email apparaissent à plusieurs endroits du site (header, footer, pages de contact…). Ils sont centralisés : **vous n'avez à changer qu'à un seul endroit**.

1. Dans le menu gauche : **Elementor → Paramètres du site**
2. Cherchez la section **Informations de contact**
3. Modifiez le numéro de téléphone ou l'email
4. Cliquez sur **Enregistrer les modifications**

Le changement s'applique automatiquement sur toutes les pages du site.

---

## Ajouter une actualité

1. Dans le menu gauche, cliquez sur **Actualités**
2. Cliquez sur **Ajouter une actualité**
3. Remplissez :
   - **Titre** : le titre de l'article
   - **Contenu** : le texte de l'article (éditeur simple, comme Word)
   - **Image à la une** : l'image principale (colonne de droite)
   - **Extrait** : le résumé qui s'affiche sur la liste des actualités
4. Cliquez sur **Publier**

L'actualité apparaît automatiquement sur la page "Nos Actualités" du site.

---

## Ajouter ou modifier un témoignage

1. Dans le menu gauche, cliquez sur **Témoignages**
2. Cliquez sur **Ajouter un témoignage**
3. Remplissez :
   - **Titre** : le nom de la personne (ex: "Marie, 74 ans")
   - **Contenu** : le témoignage complet
4. Cliquez sur **Publier**

---

## Modifier la FAQ

La FAQ utilise le module Schéma de RankMath. Pour modifier les questions/réponses :

1. Allez sur la page FAQ : **Pages → FAQ → Modifier avec Elementor**
2. Cliquez sur le bloc d'accordion (les questions/réponses)
3. Dans le panneau gauche, vous voyez la liste des questions
4. Cliquez sur une question pour la modifier
5. Modifiez le titre (la question) et le contenu (la réponse)
6. Pour **ajouter une question** : cliquez sur **+ Ajouter un élément**
7. Pour **supprimer une question** : cliquez sur la corbeille à droite de l'élément
8. Cliquez sur **Publier**

---

## Modifier les pages quartiers

Toutes les pages quartiers utilisent le même modèle. Pour en modifier une :

1. **Pages → [nom du quartier] → Modifier avec Elementor**
2. Cliquez sur le texte ou l'image à modifier
3. Éditez dans le panneau gauche
4. Cliquez sur **Publier**

> ℹ️ Si vous voulez **ajouter un nouveau quartier**, contactez votre développeur — cela nécessite la création d'une nouvelle page à partir du modèle.

---

## Modifier les informations de contact

La page "Nous contacter" contient un formulaire. Pour modifier les champs ou le texte :

1. **Pages → Nous contacter → Modifier avec Elementor**
2. Cliquez sur le texte à modifier
3. Pour le formulaire (champs, bouton) : cliquez sur le formulaire → panneau gauche → modifiez les étiquettes
4. Cliquez sur **Publier**

> ⚠️ Ne supprimez pas les champs du formulaire sans vérifier avec un développeur — cela pourrait empêcher la réception des messages.

---

## Changer le menu de navigation

1. **Apparence → Menus**
2. Sélectionnez le menu "Menu Principal"
3. Pour **renommer un lien** : cliquez sur la flèche à droite de l'élément → modifiez "Étiquette de navigation"
4. Pour **réorganiser** : glissez-déposez les éléments
5. Pour **ajouter une page** : cherchez la page dans la colonne gauche → cochez-la → cliquez "Ajouter au menu"
6. Cliquez sur **Enregistrer le menu**

---

## Changer le logo

1. **Elementor → Paramètres du site → Style du site → Logo du site**
2. Cliquez sur le logo actuel → Médiathèque
3. Uploadez ou sélectionnez le nouveau logo
4. Cliquez sur **Enregistrer les modifications**

Le logo s'applique automatiquement dans tout le header et le footer.

---

## Ce qu'il NE faut pas modifier sans développeur

| Action | Pourquoi |
|---|---|
| Modifier les "Permaliens" | Casse toutes les URLs du site et le référencement |
| Supprimer ou désactiver Elementor Pro | Le site ne s'affichera plus correctement |
| Supprimer le thème NSAD Child | Casse le design |
| Modifier le CSS personnalisé | Peut casser l'affichage sur tous les appareils |
| Supprimer des pages de menu | Casse le maillage interne et le référencement |
| Changer les slugs de pages existantes | Crée des erreurs 404, pénalise le SEO |

---

## En cas de problème

**Le site s'affiche mal :**
→ Allez dans **Elementor → Outils → Vider le cache** et rechargez la page

**Une modification n'apparaît pas :**
→ Videz le cache de votre navigateur (Ctrl+Maj+Suppr sur Windows) et rechargez

**Vous avez fait une erreur et voulez revenir en arrière :**
→ Dans l'éditeur Elementor, cliquez sur l'icône d'historique (flèche en haut à gauche) → cliquez sur une version précédente

**Vous ne savez pas si votre modification est bien enregistrée :**
→ Le bouton "Publier" passe au vert avec une coche ✓ quand c'est sauvegardé

---

*Guide rédigé pour le site NSAD — Nantes Soins à Domicile*  
*Pour toute question technique, contacter le développeur du site.*
