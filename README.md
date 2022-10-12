# Contact Manager

*(work in progress)*

A proof-of-concept to implement Clean Architecture in PHP (with Symfony)

## Requirements

* PHP >= 8.1
* docker
* docker-compose

## Run

* `docker-compose up -d`
* `symfony serve -d`
* `symfony console doctrine:migration:migrate`

## Scripts

* `composer cs-fix` PHP Coding Standards Fixer
* `deptrac-cli` Enforces dependency rules between software layers (output results in console)
* `deptrac-svg` Enforces dependency rules between software layers (output results in `deptrac.svg` file)
* `phpstan` Static Analysis Tool
* `tests` Run tests suite
* `qa` Run all previous tasks
