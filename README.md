## Live Version
[Go To Live Example](http://http://waterstation.net)

## Requirement

- ** apache server (latest) . **
- ** PHP 7.1 . **
- ** Laravel php extensions (see [laravel Documentation](https://laravel.com/docs/5.5#server-requirements)) . **
- ** composer ([install Inc](https://getcomposer.org/doc/00-intro.md)). **
- ** mysql server . **

### meet that requirement then just complete this :

## installation steps
##### first of all get clone fron repo :
- run in console : **  git clone https://bitbucket.org/zaxx44a/phptest.git ** 
##### then go to the website directory :
- run in console : **  cd phptest ** 
##### get the php packages via composer (the vendor folder content) :
- run in console : **  composer install ** 
##### set the permission 744 to the folders:
- storage 
- bootstrap/cache 
##### make your own .env file :
- run in console : **  cp .env.example .env ** 
##### generate new key for security :
- run in console : **  php artisan key:generate ** 
##### edit .env file to your DB credentials :
- ** fix database name,user&pass in .env file ** 
##### create empty DB  By your own DB app (phpmyadmin or likes) :
- ** create empty Database ** 
##### generate DB tables By laravel migration system :
- run in console : **  php artisan migrate ** 
##### make link from storage file to public file :
- run in console : **  php artisan storage:link ** 
##### put demanded courses in DB by laravel seed system :
- run in console : **  php artisan db:seed ** 
##### run laravel internal server :
- run in console : **  php artisan serve ** 
##### That's it !! :
- Go to Page 	 : ** http://127.0.0.1:8000 ** 


## License

This is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
