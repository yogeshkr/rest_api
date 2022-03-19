# Rest API with API Platform
Demo rest Api's Project

### Installation Step's :-

Used MySql 5.7, PHP >= 7.3 and framework Symfony v5.4 with  
API Platform package for rest API's.

- Clone Project from https://github.com/yogeshkr/rest_api.git
- Change directory to project directory `cd rest_api`
- Checkout `master` branch
- Run `composer install` command in project directory
- Copy .env file to .env.local `cp .env .env.local`
- Update Mysql database name, username and password in `.env.local` file
- Run `mkdir -p api/config/jwt`
- Run `openssl genrsa -out api/config/jwt/private.pem -aes256 4096` # this will ask you for the JWT_PASSPHRASE
- Run `openssl rsa -pubout -in api/config/jwt/private.pem -out api/config/jwt/public.pem` # will confirm the JWT_PASSPHRASE again
- Add/repalce `JWT_PASSPHRASE`parameter value in `.env.local` file.
- RUN `php ./bin/console doctrine:database:create`
- RUN `php bin/console doctrine:migrations:migrate`
- RUN `php bin/console doctrine:fixtures:load` # To seed dummy data
- RUN command `symfony server:start`in project directory  # To start local webserver
- Import `postman_collection.json` into postman
- Add/Update variable `baseUrl` into postman
- Get the token from `login` Api (`/api/login`) by passing following parameter's in body.
  - username : dummy
  - password : dummy
- Get the token and Add/Update variable `API_KEY` into postman

No test cases has been written except `login` api as implementation of all the API's has been done with API Platform and handled in entity with annotations.


Thanks!
