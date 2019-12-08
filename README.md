# FLIP PHP-NATIVE (NO FRAMEWORK)

Integration Slightly-big Flip

1. Send the disbursement data to the 3rd party API
2. Save the detailed data about the disbursement from the 3rd party, in your local database
3. Check the disbursement status, and update the information on your database according to the response you get

## Installation
Use the docker to running application, [here](https://docs.docker.com/install/) for documentation.


```bash
// running application
docker-compose up -d nginx mysql php_fpm

// container workspace
docker-compose exec php-fpm sh

// migration (at container workspace)
/var/www/flip/database/Migration php Migration.php

```


## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)
