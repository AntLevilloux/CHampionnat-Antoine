Installation d'un Projet Laravel - Documentation Technique
Étape 1 :

PHP installé Composer installé Un serveur web (ex. Apache, Nginx) configuré Une base de données (ex. MySQL) installée et configurée

Étape 2 :

Ouvrez un terminal. Naviguez vers le répertoire où vous souhaitez installer le projet. Clonez le dépôt Git du projet Laravel à partir de votre référentiel distant avec la commande :

git clone <URL_du_projet>
Étape 3 :

Naviguez dans le répertoire du projet Laravel cloné : cd nom_du_projet Exécutez la commande Composer pour installer les dépendances Laravel :

composer install
Étape 4 :

Dupliquez le fichier .env.example en tant que .env. Configurez les informations de la base de données dans le fichier .env.

Étape 5 : Exécutez les migrations pour créer les tables de base de données :

php artisan migrate-