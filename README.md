Une fois le projet ouvert : 
1. composer install
2. ouvrir docker sur votre machine (si pas intallé, installer docker)
3. effectuer la commande docker-compose up -d --build
4. accéder au site via l'url localhost:8888

En cas de problème d'ouverture du site via docker, voici les étapes à suivre pour démarrer le site sans docker : 

1. php -S localhost:3000 -t public   

En cas de problème avec la base de données : 
1. php binary/doctrine.php :schema:drop --full-database --force  
2. php binary/doctrine.php orm:schema-tool:update --force --dump-sql
3. php -S localhost:3000 -t public 

Pour executer les tests PHPUnit, créés dans le fichier TestExample.php, executez la commande : ./vendor/bin/phpunit --configuration phpunit.xml

Si vous rencontrez un problème persistant, n'hésitez pas à nous contacter

Le rapport en pdf se trouve a la racine du projet : Description Projet TechnoWEB ROUILLARD_VAULEY.pdf

Voici les informations de connexions d'un utilisateur, avec un mail lié a gravatar : 

Identifiant : thomas1
Mot de passe : thomas1
