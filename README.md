# City-R-US Web 
Part of the [Radical project](http://www.radical-project.eu/) CityRUs brings an innovative way to connect a Municipality with its citizens and motivate citizens to get involved in city issues. With CityRUs, a City council asks its citizens to contribute to missions of common interest that can improve life in the city (points accessible by people with disabilities, something nice to see or do, points of interest, nice walks or bike rides…). The citizen's contributions are publicly displayed on a public map for all to use. What is more, citizens can suggest new missions, report troubles and even get awarded for the involvement.

This github project contains the code for the [Athens Municipatily](http://go.scify.gr/cityrus-web) website, that enables city administrators to define missions and citizens to view their contributions.<br/><br/>
You can find the related service [here](http://go.scify.gr/cityrus-service)<br/>
and the mobile application [here](https://play.google.com/store/apps/details?id=gr.scify.cityrus)<br/>
### Starting the project

For installing Laravel, please refer to [Official Laravel installation
guide](http://laravel.com/docs/5.0).

### Installing dependencies (assuming apache as web server and mysql as db):

In a nutchell (assuming debian-based OS), first install the dependencies needed:

Note: php5 package installs apache2 as a dependency so we have no need to add
it manually.

`% sudo aptitude install php5 php5-cli mcrypt php5-mcrypt mysql-server php5-mysql`

Install composer according to official instructions (link above) and move binary to ~/bin:

`% curl -sS https://getcomposer.org/installer | php5 && mv composer.phar ~/bin`

Download Laravel installer via composer:

`% composer global require "laravel/installer=~1.1"`

And add ~/.composer/vendor/bin to your $PATH. Example:

```
% cat ~/.profile
[..snip..]
LARAVEL=/home/username/.composer/vendor
PATH=$PATH:$LARAVEL/bin
```

And source your .profile with `% source ~/.profile`

After cloning the project with a simple `git clone https://github.com/scify/city-r-us-web.git`, type `composer install` to install all dependencies.

### Apache configuration:

```
% cat /etc/apache2/sites-available/city-r-us-web.conf
<VirtualHost *:80>
	ServerName myapp.localhost.com
	DocumentRoot "/path/to/city-r-us-web/public"
	<Directory "/path/to/city-r-us-web/public">
		AllowOverride all
	</Directory>
</VirtualHost>
```

Make the symbolic link:

`% cd /etc/apache2/sites-enabled && sudo ln -s ../sites-available/city-r-us-web.conf`

Enable mod_rewrite and restart apache:

`% sudo a2enmod rewrite && sudo service apache2 restart`

Fix permissions for storage directory:

`% chmod -R 775 path/to/city-r-us-web/storage && chown -R www-data:www-data /path/to/city-r-us-web/storage`

Test your setup with:

`% php artisan serve`

and navigate to localhost:8000.


### Nginx configuration:

Add additional the additional dependencies needed:

`% sudo aptitude install nginx php5-fpm`

Disable cgi.fix_pathinfo at /etc/php5/fpm/php.ini: `cgi.fix_pathinfo=0`

`% sudo php5enmod mcrypt && sudo service php5-fpm restart`

Nginx server block:

```
server {
    listen 80 default_server;
    listen [::]:80 default_server ipv6only=on;

    root /var/www/laravel/public;
    index index.php index.html index.htm;

    server_name server_domain_or_IP;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        try_files $uri /index.php =404;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass unix:/var/run/php5-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

`% sudo service nginx restart && sudo chmod -R 775 path/to/project/storage`

And finally, set the group appropriately:

`% sudo chown -R www-data:www-data storage`

*database instructions placeholder*

Initialize the database with `php artisan migrate` and test the installation with `php artisan serve` and hit `localhost:8000/auth/register` at your browser of choice to create the first user.
