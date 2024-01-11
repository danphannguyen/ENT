# ENT

Fontionnalités Dan Phan Nguyen :
==== login.php ====
- Connexion
- Affichage de message d'erreur en cas de problème
- Possibilité d'afficher ou de cacher le mdp

==== accueil.php ====
- accès au crous via le widget a droite
- accès à l'ADE avec le widget a droite
- accès et affichage des heures d'absences a droite
- affichage des notes sur le "voir plus" lors du scroll
- affichage des différents cours

==== dashboard.php ====
- ajout de widget
- suppression de widget
- redirection vers les pages en questions

==== cours.php ====
- affichage des matieres selon la promotion
- affichage des cours selon les matieres
- boutons archives des cours pour visualiser tout les cours

==== profile.php ====
- Affichage des informations liées au compte
- Navbar : Affichage de la photo de profile
- Ajout d'une photo de profile
- Modification des informations personnelles
- Affichage du champs confirmation de mdp si besoin
- Consultations des absences
- Récap des heures d'absences selon des catégories
- justification des absences directements en ligne

==== notes.php ====
- Visualisation des notes
- de la date d'ajout des notes
- de la moyenne générale
- !! Lors du formulaires d'ajout des notes ne récupérer que les matieres concernés par la promotion de l'utilisateurs 
- !!! les champs suivants ne sont pas fonctionnels
    "Moy. classe : 14,50", 
    "Moyenne générale classe : 14,50", 
    "Moyenne la plus élevée : 19,33", 
    "Moyenne la plus basse : 2,47"

==== backoffice.php ====
- Affichage de tout les utilisateurs de la BDD
- Création / Modification / Suppression d'utilisateurs

==== Logs ==== 
- Lors de certaines actions, des réponses a titre indicatif peuvent apparaître en haut du site

==== Sécurité ====
- Toute les requêtes sont faite avec bindValue empéchant les injections SQL
- Pour toutes les commandes Admin, on revérifie les permissions ce qui empèche que quelqu'un connaissant l'url puisse executer des commandes sans permissions
- Mise en place d'une sécurité sur la longueur / les caractères contenus dans le mdp
- Confirmation de mdp pour éviter les erreurs

