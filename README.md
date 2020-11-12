# Laravel common Admin panel for inheritex solution

Please follow following steps to start project:

=> Step-1 :
-----------
- Run this command to install dependencies
composer install


=> Step-2 :
-----------
- Create empty database named 'common_app' or anything else
- Set database name and phpmyadmin credentials in config/database.php file under mysql object
- Set your application own gmail address in config/mail.php file


=> Step-3 :
-----------
- Run this command to create database tables
php artisan migrate


=> Step-4 :
-----------
- Run this command to add basic data for login and cms page
php artisan db:seed


This command will create one super admin with following credentials:
email - admin@admin.com
password - 123456

=> Step-5 :
----------- 
- Done start your devlopment work now.
- Happy coding...