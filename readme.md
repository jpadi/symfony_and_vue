## Prerequisites

1. docker
2. docker-compose


## Setup Environment

Clone repo

```
git clone git@github.com:jpadi/symfony_and_vue.git
```


Install symfony dependencies
```
cd path/to/code-challenge-symfony/devops/dev
docker-compose run api composer install
``` 

Install vue dependencies
```
cd path/to/code-challenge-symfony/devops/dev
docker-compose run vue npm install
``` 

Start services

```
cd path/to/code-challenge-symfony/devops/dev
docker-compose up -d
```

Wait about 20 seconds for vue front end start. You can see if it is ready with

```
docker-compose logs -f vue
```

When vue is ready you can access at http://localhost:8080/

### About the project

Is an CRUD example for a Person


### Testing

This project do unit, integration and feature testing.

On unit test we test the use case in insulated way. So we test only the services from application folder of every module.
The unit test only test the services mocking all other class their need as for example the repositories.

On integration we test third parties software or database. So here we test all repositories

On Feature we test the controllers and it test all correct functionality of a feature.

For unit test execute
```
# enter on docker-compose folder 
cd path/to/code-challenge-symfony/devops/dev

# bash into api container
docker-compose exec api /bin/bash

# execute test
vendor/bin/phpunit --filter="Unit"
```

For integration test execute 
```
# enter on docker-compose folder 
cd path/to/code-challenge-symfony/devops/dev

# bash into api container
docker-compose exec api /bin/bash

vendor/bin/phpunit --filter="Integration"
```

For feature test execute
```
# enter on docker-compose folder 
cd path/to/code-challenge-symfony/devops/dev

# bash into api container
docker-compose exec api /bin/bash

vendor/bin/phpunit --filter="Feature"
```