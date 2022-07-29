
# MachineTest

It is an application for the pickup and delivery service system. The code is written in php using Laravel framework(Version 9.22.1).


## Clone Project

Please clone the project from github.

   https://github.com/pradeepkv24/machine_test

Please run the below command to download the required vendor files.

    composer install

## Database Connection

Please create the database name as "machine_test". If any changes in mysql connection credentials is required, please update in env file.

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=machine_test
    DB_USERNAME=root
    DB_PASSWORD=

## Migration for Table

Using bellow command we can run our migration and create database table.

    php artisan migrate
After that you can see created new table in your database


## Run Seeder

Next, run seeder with below command:

    php artisan db:seed --class=UsersTableDataSeeder
## Run Laravel App:

Required steps have been done, now you have to type the given below command and hit enter to run 
the Laravel app:

    php artisan serve

Now, Go to your web browser, type the given URL and view the app output:

    http://localhost:8000/
    
customer login credentials
--------------------------
aneesh@mail.com :     123456,
sarath@mail.com :     123456,
sam@mail.com :        123456,



Deliveryboy login credentials
-----------------------------
 
syam@mail.com :       123456,
nithin@mail.com :     123456,
sinto@mail.com :      123456,
