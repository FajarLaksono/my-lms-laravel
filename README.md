# my-lms-laravel
Project Learning Management System untuk tugas akhir 

# How To Install :

before you can able to run this project you need to understand about laravel.

Install and How to use Laravel : https://laravel.com/docs/4.2/quick#installation

Install and How to use Laravel Project in local : https://gist.github.com/hootlex/da59b91c628a6688ceb1

Instal LMS : 
1. Extract the file
2. create new .env from .env.example, and fill it with you information
3. run this command for install vendors : composer install
4. run this command for generate key : php artisan key:generate
5. run this command for build the database : php artisan migrate
6. Important thing is you need to add a record to the database, in table options. here is the data 

id  option_name     option_value    meta_other  autoload    created_at              updated_at
1   web_title       LMS                         y           2019-02-04 12:34:39     0000-00-00 00:00:00

7. then finally run : php artisan serve
dont forget to turn on server for database

Thanks
Regards
Fajar Laksono
