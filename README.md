# Pagina CV Symfony 6
![USV](https://suceavalive.ro/wp-content/uploads/2013/07/usv-mare-300x257.gif)

## Installation

To be able to run the project you should have installed [docker environment and docker-compose cli](https://docs.docker.com/compose/install/)

1. Run `docker network create --subnet=172.2.0.0/24 --ip-range=172.2.0.0/24 --gateway=172.2.0.1 web`
2. Copy file and rename `docker-compose.yml.dist` to `docker-compose.yml`
3. Update docker-compose.yml: device path to your `${pwd}/symfony`
5. Run `docker-compose up --build`
6. Run `docker exec -it cv-php bash`
   1. Inside container run `composer install`
7. update hosts file `sudo gedit /etc/hosts` with
   `172.2.0.4 cv-project.loc`


### For each database changes (Entity modification)
1. Run `docker exec -it cv-php bash`
2. Inside container run to update database automatically - `composer migrate` or `bin/console d:s:u -f`

