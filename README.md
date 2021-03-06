
## Simple example filtering articles by tags in Laravel Blog.  
* PHP: php 7.2
* DB: mysql
* Server: Nginx
## Installation
~~~
$ git clone https://github.com/
$ cd blog_laravel
$ cp .env.example .env
$ composer install
~~~
## Init and start
* Set your DB settings in .env
~~~
php artisan key:generate
php artisan serve
~~~
## Fill or refresh DB
~~~
 php artisan migrate:fresh --seed
~~~
