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

# website

ssh-keygen -t rsa -b 4096 -f ~/.ssh/bb cat ~/.ssh/bb.pub
https://bitbucket.org/account/settings/ssh-keys/
eval `ssh-agent -s` && ssh-add ~/.ssh/*
git clone git@bitbucket.org:samuelwiese/laravel-webseite.git /var/www/html/wiesesamuel/

cd /var/www/html/wiesesamuel/   
cp .env.example .env  
nano .env

sudo apt install php8.0-cli php8.0-common php8.0-imap php8.0-redis php8.0-snmp php8.0-xml php8.0-mbstring php8.0-zip
php8.0-curl php8.0-gd  
composer install --optimize-autoloader --no-dev

# docker vs non docker

## non docker

### nginx

nano /etc/nginx/sites-available/default  
https://laravel.com/docs/8.x/deployment#nginx  
service nginx reload

### mysql

sudo apt install mysql-server php8.0-mysql   
sudo mysql

CREATE DATABASE wiesesamuel;   
CREATE USER 'wiesesamuel'@'localhost' IDENTIFIED BY 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';   
GRANT ALL PRIVILEGES ON wiesesamuel.* TO 'wiesesamuel'@'localhost';   
FLUSH PRIVILEGES;

### https

sudo apt-get install certbot python3-certbot-nginx   
nginx -t && nginx -s reload   
sudo certbot --nginx -d wiesesamuel.de -d www.wiesesamuel.de

## docker

install docker, docker-compose, run docker-compose.yml

# Start Server

ln -s /var/www/html/wiesesamuel ~/web ln -s /var/www/html/wiesesamuel/resources/webdata/albums ~/albums cd web

php artisan config:cache   
php artisan view:cache

php artisan up   
php artisan key:generate   
php artisan migrate

* blank page [source](https://stackoverflow.com/questions/30639174/how-to-set-up-file-permissions-for-laravel)
  sudo chown -R $USER:www-data /var/www/html/wiesesamuel   
  sudo find /var/www/html/wiesesamuel/ -type f -exec chmod 664 {} \;   
  sudo find /var/www/html/wiesesamuel/ -type d -exec chmod 775 {} \;   
  cd /var/www/html/wiesesamuel/   
  sudo chgrp -R www-data storage bootstrap/cache   
  sudo chmod -R ug+rwx storage bootstrap/cache

* file not found /var/log/nginx
