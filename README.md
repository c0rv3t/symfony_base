# Thomas DUCRET Installation

Projet Symfony universitaire de Thomas DUCRET datant de fin 2024 dans le cadre du cours de Programmation avancées S5 BUT3

Voici les commandes pour lancer le projet (il risque d'en manquer quelques unes):

php bin/console doctrine:database:create
php bin/console make:migration
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
composer install
composer require --dev doctrine/doctrine-fixtures-bundle

J'ai réalisé ce projet en utilisant un serveur Xampp plutôt que symfony serve

Il est possible que vous rencontriez quelques erreurs de dépendances, par exemple une erreur demandant l'activation de l'extension php_fileinfo ou une autre erreur avec la variable d'environnement "MAILER_DSN", il faudra simplement installer ces derniers pour régler les problèmes.


# Symfony 7.1 Boilerplate 

Attention : Il vous faut PHP 8.2 pour faire fonctionner ce projet si vous avez PHP 8.1 utiliser la branche symfony64 du repository.

## Initialisation de votre IDE

### PHPStorm

1. Ouvrir le projet dans PHPStorm
2. Installer les extensions Twig et Symfony
    - Aller dans File > Settings > Plugins
    - Installer les extensions (Twig, EA Inspection, PHP Annotations, .env files support)

### Visual Studio Code

1. Ouvrir le projet dans Visual Studio Code
2. Installer les extensions pour PHP, Twig et Symfony
    - Aller dans l'onglet Extensions
    - Installer les extensions (whatwedo.twig, TheNouillet.symfony-vscode, DEVSENSE.phptools-vscode, 
    bmewburn.vscode-intelephense-client, zobo.php-intellisense)

## Installation

1. Cloner le projet
2. Installer PHP >= 8.2 et Composer (Sur votre machine utiliser XAMPP pour windows, MAMP pour mac ou LAMP pour linux bien prendre la version PHP 8.2)
3. Installer les dépendances du projet avec la commande `composer install`
4. Faire un virtual host sur votre serveur local (XAMPP par exemple pour Windows) 
 - Ouvrir le fichier `httpd-vhosts.conf` dans le répertoire `C:\xampp\apache\conf\extra`
    - Ajouter le code suivant à la fin du fichier
    ```
    <VirtualHost *>
        DocumentRoot "C:\Users\votre_username\Documents\iut\symfony_base\public"
        ServerName symfony_base.local
        
        <Directory "C:\Users\votre_username\Documents\iut\symfony_base\public">
            AllowOverride All
            Require all granted
        </Directory>
    </VirtualHost>
    ```
    - Ajouter l'adresse IP de votre machine dans le fichier `C:\Windows\System32\drivers\etc\hosts`
    ```
    127.0.0.1 symfony_base.local
    ```
    - Redémarrer Apache
    - Accéder à l'adresse `symfony_base.local` dans votre navigateur

4. Créer un fichier `.env.local` à la racine du projet et ajouter la configuration de la base de données
5. Créer la base de données avec la commande `php bin/console doctrine:database:create`

## Utilisation

- N'hésitez pas à consulter la documentation de Symfony pour plus d'informations sur l'utilisation du framework : https://symfony.com/doc/current/index.html

- Notez comment fonctionne votre projet dans le fichier README.md et mettez à jour ce fichier au fur et à mesure de l'avancement de votre projet pour aider les autres développeurs à comprendre comment fonctionne votre projet.