# Twogether birthday cake calculator

Composer based project, no framework
Language: PHP (min v7.3)
Libraries:
```
"require": {
  "php": "^7.3",
  "ext-json": "*",
  "league/climate": "^3.7"
},
"require-dev": {
  "phpunit/phpunit": "^9.3"
  "phpunit/php-code-coverage": "^9.1"
},
```

Code owner: Zoltan Nagy <nzolthu@gmail.com> 

### Acceptance Criteria:
- See in provided pdf documents.

- Can be run in demo container, docker-compose.yml provided. 

### Start: (Using container. Not required, can be run on any *nix filesystem with PHP, Composer installed.)

- user@host$ docker-compose -up [-d]
- user@host$ docker exec -ti app-spp bash
- root@app-spp$ cd /var/www/app/
- root@app-spp$ composer install (composer 2.*)
- root@app-spp$ php app.php (demo)
- root@app-spp$ php vendor/bin/phpunit --group [unit|ready]
__________________________________________________________________________________________
root@app-twg:/var/www/app# php ./vendor/bin/phpunit --group unit
PHPUnit 9.5.10 by Sebastian Bergmann and contributors.

Runtime:       PHP 7.4.3 with PCOV 1.0.6
Configuration: /home/nzolt/Desktop/Code/sportsp/phpunit.xml
Random Seed:   1634303750
Warning:       Incorrect filter configuration, code coverage will not be processed

....                                                                4 / 4 (100%)

Time: 00:00.026, Memory: 8.00 MB

OK (4 tests, 4 assertions)
__________________________________________________________________________________________

### TODO:
- Configure code coverage reporting.
##---------------------------------------------

