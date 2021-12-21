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

# Langugae - dont forget Lizenz!
* https://github.com/syncfusion/ej2-locale

# Imagick::writeImage not implemented 
* `chmod 777 -R ./public/images`

# SQLSTATE[HY000] [2002] Connection refused
* in .env: DB_HOST=mysql

### remove docker stuff (except images)
    docker stop $(docker ps -aq)
    docker rm $(docker ps -aq)
    docker network prune -f
    docker volume rm $(docker volume ls --filter dangling=true -q)
    
