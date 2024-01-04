# ENT

Fontionnalités Dan Phan Nguyen :
==== login.php ====
- Connexion
- Affichage de message d'erreur en cas de problème
- Possibilité d'afficher ou de cacher le mdp

==== profile.php ====
- Affichage des informations liées au compte
- Navbar : Affichage de la photo de profile
- Ajout d'une photo de profile
- Modification des informations personnelles
- Affichage du champs confirmation de mdp si besoin
- Confirmation de mdp

==== backoffice.php ====
- Affichage de tout les utilisateurs de la BDD
- Création / Modification / Suppression d'utilisateurs

==== Logs ==== 
- Lors de certaines actions, des réponses a titre indicatif peuvent apparaître en haut du site

==== Sécurité ====
- Toute les requêtes sont faite avec bindValue empéchant les injections SQL
- Pour toutes les commandes Admin, on revérifie les permissions ce qui empèche que quelqu'un connaissant l'url puisse executer des commandes sans permissions

