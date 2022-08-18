<p align="center"><a href="https://laravel.com" target="_blank"><img src="public/assets/img/tradefull1.png" width="300"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Tradefull Assessment Application

For setup:
- Pull down and usual Laravel setup (including composer stuff)
- Create your local .env file as usual, but be sure to change your QUEUE_CONNECTION parameter to 'database'
- Set up local LAMP environment - the DB I used is called society_six but you can change it to whatever, just make sure to change the reference to it in your .env file
- In the database/raw_sql_files, import that dump - if you want to see my migration in action, then go ahead  and comment out the table creation statements for **orders**
- Inside database/migrations, delete the users migration (the dump file handled that) OR just comment out the code in the up() function
- Run **php artisan migrate**
- Run **php artisan serve**

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Some cool things to look out for in the Application
- Routing: there are both **web** routes and **API** routes utilized in the /routes folder.
  - /routes/api.php have endpoints set up. Please take a look at the ApiController and the functions therein for some extra stuff I got done: 
    - **127.0.0.1:8000/mfa/getPrints**
    - **127.0.0.1:8000/dj/getShirts**
- **Order Service** in the app/Services folder to abstract away business logic
- **Order Repository** in the app/Repositories folder to do Order Database interaction (I added this, not native to Laravel) stuff
- **Dependency Injection** in the ApiController (awareness of the service container and how it works)
- **Event driven code**: after an order is added, an asynchronous process is queued up in the database in the jobs table to see if an order is outside of the state of OH and if it is, delete that record
  - See the "app/Events" and "app/Listeners" folders 
- Front-end chops: **Blade templating and Bootstrap** used to full effect
- DB Migrations, including: FK constraints and indexing
- **CRUD** operations
  - NB: I made these pretty simple to show that I can pass information to the backend from a webform, I wanted to show off my knowledge of backend processes and Laravel so I focused on these things a little more
