# Excel-Import-Laravel-Nuxt
Develop an application with GUI that uploads an excel sheet contains users names and their uuid. Inserts users that their uuid exist in uuid table and neglect those that do not match. List inserted users and number of neglected users with RESTFUL API using laravel as backend framework and vue.js nuxt as frontend platform.

### Clone GitHub repo for this project locally

`git clone https://github.com/baselrabia/Excel-Import-Laravel-Nuxt.git`

- `cd Excel-Import-Laravel-Nuxt`
- `cd server`
- `composer install`
- `cp .env.example .env`
- `php artisan key:generate`

## Linking Mysql Database to the Project

- Open your local `PhpMyAdmin` 
- create new database for the application 
- edit the configration of the database in the `.env` file 
- Run the command line for making the migration of the database -> `php artisan migrate`
- import your uuid table and add your reuired fields ('first_name','second_name','family_name',)

## starting the application 

now everthing is almost done just one step more to start your App
-  Run this command line for serveing the App to your localhost ->  `php artisan serve` 
-  then run this line to listen to any jobs in the queue ->  `php artisan queue:listen` 
### then go to client folder 
- and run `npm install ` then `npm run dev ` 
