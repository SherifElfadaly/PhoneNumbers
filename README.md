# Phone Numbers

## Run

Via Docker

Run the following commands:
``` bash
sudo cp ./docker/.env.example ./.env
sudo docker-compose -f ./docker/docker-compose.yml build
sudo docker-compose -f ./docker/docker-compose.yml up -d
```

Go to
[http://localhost:8003/][link]

[link]: http://localhost:8003/

## Unit Testing

Run the following command:
``` bash
docker exec phone_number php artisan test
```