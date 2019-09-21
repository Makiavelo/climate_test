# Climate test

## How to use

#### Prerequisites
- Having docker-compose installed: https://docs.docker.com/compose/

#### Installation

1) Open your favourite terminal and go to this directory.

2) run:
```
docker-compose up --build
```

#### Connect to the container

1) Open your favourite terminal.

2) run:
```
docker exec -it serverc /bin/bash
cd /var/www/html/climate_test/
```

#### Running the growers search command

```
php bin/console app:search-growers corn
php bin/console app:search-growers soybeans

php bin/console app:search-growers corn 2018
php bin/console app:search-growers soybeans 2018
```

#### Running the tests
```
php bin/phpunit
```
