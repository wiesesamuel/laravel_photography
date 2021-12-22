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
 docker exec -it laravel-webseite_mysql_1 mysql -e
 CREATE USER 'username'@'localhost' IDENTIFIED BY '894357092837654987263548ad';
 GRANT ALL PRIVILEGES ON asdf.* TO 'username'@'localhost';
 FLUSH PRIVILEGES;`

### remove docker stuff (except images)
    docker stop $(docker ps -aq)
    docker rm $(docker ps -aq)
    docker network prune -f
    docker volume rm $(docker volume ls --filter dangling=true -q)
    
