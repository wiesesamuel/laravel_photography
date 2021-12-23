# Setup

# php and nginx

sudo add-apt-repository ppa:ondrej/php   
sudo apt update   
sudo apt install php8.0-fpm nginx git zip unzip

# composer

cd ~ && curl -sS https://getcomposer.org/installer -o composer-setup.php   
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer   
alias composer='/usr/local/bin/composer'  
rm composer-setup.php

nano /etc/nginx/sites-available/default  
https://laravel.com/docs/8.x/deployment#nginx  
service nginx reload

git clone https://samuelwiese@bitbucket.org/samuelwiese/laravel-webseite.git /var/www/html/wiesesamuel/

cd /var/www/html/wiesesamuel/   
cp .env.example .env  
nano .env

sudo apt install php8.0-cli php8.0-common php8.0-imap php8.0-redis php8.0-snmp php8.0-xml php8.0-mbstring php8.0-zip
php8.0-curl   
composer install --optimize-autoloader --no-dev

# docker vs non docker

## non docker

sudo apt install mysql-server php8.0-mysql   
sudo mysql

CREATE DATABASE wiesesamuel_de;   
CREATE USER 'wiesesamuel'@'localhost' IDENTIFIED BY 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';   
GRANT ALL PRIVILEGES ON wiesesamuel_de.* TO 'wiesesamuel'@'localhost';   
FLUSH PRIVILEGES;

sudo apt-get install certbot python3-certbot-nginx   
nginx -t && nginx -s reload   
sudo certbot --nginx -d wiesesamuel.de -d www.wiesesamuel.de

## docker

install docker, docker-compose, run docker-compose.yml

php artisan config:cache php artisan view:cache

php artisan up php artisan key:generate php artisan migrate

php artisan tinker App\Models\User::create([
'name' => 'Admin',
'email' => 'admin@admin.de',
'role' => 5,
'email_verified_at' => now(),
'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
'remember_token' => Str::random(10),
]);

* blank page [source](https://stackoverflow.com/questions/30639174/how-to-set-up-file-permissions-for-laravel)
  sudo chown -R $USER:www-data /var/www/html/wiesesamuel sudo find /var/www/html/wiesesamuel/ -type f -exec chmod 664 {}
  \;   
  sudo find /var/www/html/wiesesamuel/ -type d -exec chmod 775 {} \; cd /var/www/html/wiesesamuel/ sudo chgrp -R
  www-data storage bootstrap/cache sudo chmod -R ug+rwx storage bootstrap/cache

----------------------------------------------
----------------------------------------------
----------------------------------------------
----------------------------------------------
----------------------------------------------
----------------------------------------------
----------------------------------------------
----------------------------------------------
----------------------------------------------
----------------------------------------------
----------------------------------------------

# Setup

* git clone
* `composer install`
* `./vendor/bin/sail up -d`
* `./vendor/bin/sail php artisan migrate -seed`

# Composer 1 to Composer 2

* `sudo apt remove composer`
* `cd ~ && curl -sS https://getcomposer.org/installer -o composer-setup.php`
* `sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer`
* `alias composer='/usr/local/bin/composer'`

# php8

* `sudo apt install php8.0-cli php8.0-common php8.0-imap php8.0-redis php8.0-snmp php8.0-xml`

# docker

* `https://docs.docker.com/engine/install/ubuntu/`
* `https://docs.docker.com/compose/install/`
  !O80e$@9tK

# Langugae - dont forget Lizenz!

* https://github.com/syncfusion/ej2-locale

# Imagick::writeImage not implemented

* `chmod 777 -R ./public/images`

# SQLSTATE[HY000] [2002] Connection refused

* in .env: DB_HOST=mysql

### add db user
# SQLSTATE[HY000] [2002] Connection refused
* `
  docker exec -it laravel-webseite_mysql_1 mysql -e CREATE USER 'username'@'localhost' IDENTIFIED BY '894357092837654987263548ad'; GRANT ALL PRIVILEGES ON asdf.* TO 'username'@'localhost'; FLUSH PRIVILEGES;`

### remove docker stuff (except images)
    docker stop $(docker ps -aq)
    docker rm $(docker ps -aq)
    docker network prune -f
    docker volume rm $(docker volume ls --filter dangling=true -q)
    
