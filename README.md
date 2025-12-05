# PROJET WEB
## Contributeurs Corentin GIRARD, Olivier OLSON dans le cadre du module développement Web et Mobile de l'université Polytech Paris-Saclay
### On va créer 4 pages:
-Acceuil
-Login
-Salon de jeux privé
-(Extention: Page de résultas)

On utilisera le framework bootstrap: https://getbootstrap.com/
## Compatibilité Mobile et petit écrans.

### On implémentera SQL pour:
-Système de connexion
-Système de points/classements

## Fonctionalitées essentiels:
-Pouvoir se login et se connecter a une salle (extention: salle privé)
-Pouvoir voir la question est voir les reponses des autres membres de la salle (style flux de messages)
-Pouvoir repondre à la question

Contenu:
-Welcome.html
-Login.html
-Room.html
-Style.css


## Detail Welcome.html
style:
-arrière plan : couleur crème
-header : couleur vert 


Contenu :
-Box vide code de salle
-Menu deroulant si non connecté 
    -Box vide nom d'invité
-Bouton accès salle : si non connecté déroule menu deroulant et affiche en rouge nom d'invité

Sur la page d'acceuil, possibilité de rejoindre une salle via code :
-Si connecté via un compte personnel : connexion directe a la room avec nom du compte
-Sinon mode invité : demande d'un pseudo temporaire (le temps de la room)