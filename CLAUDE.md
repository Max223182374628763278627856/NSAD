# CLAUDE.md — Nantes Soins à Domicile (NSAD)

Instructions de référence pour toute intervention sur ce projet.

---

## IDENTITÉ DU SITE

- Site vitrine professionnel pour une entreprise d'aide et soins à domicile à Nantes
- Public cible : personnes de plus de 60 ans, personnes atteintes de maladies chroniques, et membres de la famille qui cherchent une solution pour leurs proches
- Ton : humain, chaleureux, rassurant et professionnel — jamais médical ou froid
- Toujours mettre en avant le lien humain, la proximité et la bienveillance
- Pour les membres de la famille : rassurer, donner confiance, montrer le sérieux et la fiabilité

---

## DESIGN

- Style : clair, épuré, aéré — beaucoup d'espace blanc
- Accrocheur mais jamais surchargé
- Chaque élément doit être immédiatement compréhensible, sans effort de lecture
- Pas de design générique ou d'apparence IA — chaque page doit sembler designée par un professionnel

---

## COULEURS

- **Primaires** : `#3C697F` et `#8FF0D2`
- **Secondaires** : `#7DA2FA`, `#C8D5FC`, `#FF9E8E`
- Ne jamais utiliser ces couleurs de façon aléatoire :
  - `#3C697F` → éléments forts (titres, boutons principaux)
  - `#8FF0D2` → accents et highlights
  - Secondaires → fonds doux et badges uniquement

---

## TYPOGRAPHIE

- **Titres** : Poppins (Google Fonts) — toujours importé en tête de chaque fichier HTML
- **Corps de texte** : Hind (Google Fonts) — toujours importé en tête de chaque fichier HTML
- Taille minimale du corps de texte : **18px** — jamais en dessous
- Titres principaux : minimum **32px**
- Interlignage généreux : `line-height` minimum **1.8** pour le corps de texte
- Jamais de texte gris trop clair — contraste fort obligatoire pour lisibilité senior

---

## ACCESSIBILITÉ SENIOR

- Boutons grands et bien espacés — minimum **48px** de hauteur
- Zones cliquables larges et évidentes
- Icônes toujours accompagnées d'un texte explicatif
- Navigation simple et linéaire — pas de menus cachés ou d'interactions complexes
- Messages clairs et directs — phrases courtes, vocabulaire simple
- Jamais de texte sur fond coloré sans contraste suffisant

---

## SÉCURITÉ

- Toujours valider et assainir les entrées des formulaires de contact
- Pas de données personnelles stockées côté client
- Liens externes toujours en `rel="noopener noreferrer"`
- Formulaires avec protection anti-spam de base
- Headers de sécurité recommandés dans chaque page HTML

---

## STRUCTURE DES PAGES

- Header fixe avec logo et navigation claire
- Hero section avec message humain fort et call-to-action évident
- Sections bien délimitées avec titres clairs
- Footer complet avec coordonnées et mentions légales
- Toujours un numéro de téléphone visible et cliquable (`tel:`) sur mobile
