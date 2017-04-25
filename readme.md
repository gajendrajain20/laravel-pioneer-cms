# Laravel Pioneer CMS

Pioneer CMS for Laravel : To provide a platform for commencing your journey in CMS for Laravel.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purpose.

### Prerequisites

What things you need to install the software

```
composer
```

### Installing

A step by step series of examples that tell you how to get a development env running


Open your php.ini (from your 'xampp/php/' directory) & remove semicolon i.e. ';' from the line 
```
'extension=php_fileinfo.dll'.
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
 
### First Usage Instructions 
1) After installing open login using the given creadentials:
    *	Admin panel url 	: /admin/login
	*	email  				: admin@mailinator.com
	*	password			: admin


## Built With

* [Laravel](https://laravel.com/docs/5.1/) - The web framework used
* [Composer](https://getcomposer.org/) - Dependency Management

## Authors

* **Gajendra Jain**


## License

This project is licensed under the MIT License - see the LICENSE  file for details

## Acknowledgments

* Hat tip to anyone who's code was used

