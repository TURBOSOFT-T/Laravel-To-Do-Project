# Laravel-To-Do-Project


Manuel de déploiement en local 
1-	Cloner le projet
2-	XAMPP for Windows 8.0.28
3-	composer update
4-	npm install
5-	Créer le fichier .env (dans le fichier .env le nom de la bdd)
6-	Dans PHPMYADMIN créer la base de données.
7-	php artisan migrate
8-	Dans dossier seeders, le fichier CreateAdminUserSeeder modifier le mail et le mot de passe
9-	php artisan db:seed --class=PermissionTableSeeder
10-	php artisan db:seed --class=CreateAdminUserSeeder
11-	php artisan db:seed
12-	php artisan serve   pour lancer 
