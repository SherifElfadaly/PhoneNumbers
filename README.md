# Phone Numbers

## Run

Via Docker

Run the following commands:
``` bash
sudo cp ./docker/.env.example ./.env
sudo docker-compose -f ./docker/docker-compose.yml build
sudo docker-compose -f ./docker/docker-compose.yml up -d
sudo docker exec phone_number php -d memory_limit=-1 /usr/local/bin/composer update nothing --prefer-dist --lock
sudo docker exec phone_number php -d memory_limit=-1 /usr/local/bin/composer install --prefer-dist --optimize-autoloader
sudo docker exec phone_number php artisan clear-compiled
sudo docker exec phone_number php artisan view:clear
sudo docker exec phone_number php artisan cache:clear
sudo docker exec phone_number php artisan config:clear
sudo docker exec phone_number php artisan optimize
sudo docker exec phone_number php artisan storage:link
sudo docker exec phone_number php artisan queue:restart
sudo docker exec phone_number php artisan octane:reload --server=swoole
```

Go to

``` bash
http://localhost:8003/
```

## Credits

- [Sherif Elfadaly][link-author]