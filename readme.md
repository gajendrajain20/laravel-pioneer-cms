# Laravel Pioneer CMS

Pioneer CMS for Laravel : To provide a platform for commencing your journey in CMS for Laravel.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purpose.

### Prerequisites

What things you need to install the application

```
composer
```

### Installing

A step by step series of examples that tell you how to get a development environment running

Run the command in terminal
```
$ composer create-project gajendrajain20/laravel-pioneer-cms
```

Open your `php.ini` (from your 'xampp/php/' directory) & remove semicolon i.e. ';' from the line 
```
;extension=php_fileinfo.dll
```

Update your `.env` file
```
DB_HOST=127.0.0.1
DB_DATABASE=homestead
DB_USERNAME=root
DB_PASSWORD=secret
```

Create an empty database & update the database name & password in .env file.

Create a Re-captcha key & put it in your .env file under following key 
```
'G-RECAPTCHA-SECRET'
```

Run the command in root directory.
```
$ composer update
```

Run the command in root directory.
```
$ php artisan migrate --seed
```

Create a new virtual host entry for this application in your `httpd-vhosts.conf` file.
```
<VirtualHost *:80>
    ##ServerAdmin webmaster@dummy-host.example.com
    ServerName www.pioneercms.com
    ServerAlias pioneercms.com
    DocumentRoot "D:\xampp\htdocs\projects\laravel-pioneer-cms"
    <Directory "D:\xampp\htdocs\projects\laravel-pioneer-cms">
        Options -Indexes +FollowSymLinks +MultiViews
        AllowOverride All
        Require all granted
    </Directory>
    ##ErrorLog "logs/dummy-host.example.com-error.log"
    ##CustomLog "logs/dummy-host.example.com-access.log" common
</VirtualHost>
```

Note: **set the `DocumentRoot` & `Directory` path to only `laravel-pioneer-cms` folder only... don't set it to the public folder**

Create a new entry in your `hosts` file like this:
```
127.0.0.1   pioneer.com
```

### For Adding Comments functionality in website
Signup on [IntenseDebate](https://intensedebate.com/) & add a new blog/site from sites dropdown in header. Provide your site url in the given box & click on next step, then click on generic install. Then copy the code provded in sidebar & paste it in the following file:
```
..\resources\views\templates\default\intense-debate-script.blade.php
```
 
### First Usage Instructions 
1) After installing open login using the given creadentials:
    *	Admin panel url 	: /admin/login
	*	email  				: admin@mailinator.com
	*	password			: admin

## Screenshots

### Posts
![Alt text](https://github.com/gajendrajain20/laravel-pioneer-cms/blob/screenshots/images/Posts.jpg?raw=true "Posts Index Page")

### Settings
![Alt text](https://github.com/gajendrajain20/laravel-pioneer-cms/blob/screenshots/images/Settings.jpg?raw=true "Settings Page")

### Front-end
![Alt text](https://github.com/gajendrajain20/laravel-pioneer-cms/blob/screenshots/images/Site%20Public.jpg?raw=true "Site Front-end with default template")

## Built With

* [Laravel](https://laravel.com/docs/5.1/) - The web framework used
* [Composer](https://getcomposer.org/) - Dependency Management

## Authors

* [**Gajendra Jain**](https://github.com/gajendrajain20)
* [**Manish Yadav**](https://github.com/manishyadav-daffodil)
* [**Rudraksh Pathak**](https://github.com/rudraksh-daffodil)


## License

This project is licensed under the MIT License - see the LICENSE  file for details

## Acknowledgments

* Hat tip to anyone who's code was used

