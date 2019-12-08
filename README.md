# FLIP PHP-NATIVE (NO FRAMEWORK & NO EXTERNAL LIBRARY)

Integration Slightly-big Flip

1. Send the disbursement data to the 3rd party API
2. Save the detailed data about the disbursement from the 3rd party, in your local database
3. Check the disbursement status, and update the information on your database according to the response you get

## Installation
Use the docker to running application, [here](https://docs.docker.com/install/) for documentation.


```bash
// clone project
git clone https://github.com/anwar-github/flip.git

// change directory
cd flip

// copy env-example to .env
cp env-example .env

// running application
docker-compose up -d nginx mysql php-fpm
 
//check container is running
docker-compose ps

// container workspace
docker-compose exec php-fpm sh
cd ../flip/database/Migration/

// migration (/var/www/flip/database/Migration # php Migration.php)
php Migration.php

```

open browser [http://localhost:3000](http://localhost:3000)

## Specification
1. database mysql:5.7
2. server nginx:1.11.10-alpine
3. php:7.1-fpm-alpine
4. Docker version 19.03.5, build 633a0ea (develop)
5. docker-compose version 1.25.0-rc4, build 8f3c9c58 (develop)

you can running manually with nginx config:

```
server {
  listen  80;
  error_log  /var/log/nginx/error.log;
  access_log /var/log/nginx/access.log;
  root /var/www/flip/;

  location / {
      try_files $uri /index.php$is_args$args;
  }

  location ~ ^/.+\.php(/|$) {
      # change here for other pass
      fastcgi_pass php-fpm:9000;
      include fastcgi_params;
      fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
  }
}
```




## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)
