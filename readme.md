# laravel-pioneer-cms
Pioneer CMS for Laravel: To provide a platform for commencing your journey in CMS for Laravel.



Installation Process :-
...
-> Open php.ini (from your 'xampp/php/' directory) & remove semicolon 
	i.e. ';' from the line 'extension=php_fileinfo.dll'.
-> Install composer.
-> Create your .env file using .env.example file.
-> create a new database & update your database name & password in .env file.
-> Run "composer update" command in cmd in root directory.
-> Run "php artisan migrate --seed" command in cmd in root directory. 
-> Create a Re-captcha key & put it in ContactsController & contact-us view.
...



First Usage Instructions :-
...
-> After installing open login using the given creadentials:
		Admin panel url 	: /admin/login
		email  				: admin@mailinator.com
		password			: admin
...