# Market Management Program
> Based on [Laravel v9](https://laravel.com)

## Table of contents

- [Prerequisites](#prerequisites)
- [Setup](#setup)
- [Database setup](#database-setup)
- [Running the app](#running-the-app)

## Prerequisites

- PHP ≥ 8

Please install these extensions on your code editor :

- [laravel intellisense](https://marketplace.visualstudio.com/items?itemName=mohamedbenhida.laravel-intellisense)

## Setup
1. Fork This Repository
2. Clone Your Fork Repository:
```sh
$ git clone https://github.com/(your username)/market-management-program.git
```
3. Add Upstream to the Clone Result
```sh
$ git remote add upstream https://github.com/hihi-production/market-management-program.git
```
4. Copy file `.env.example` to `.env`:
```sh
$ cp env-example .env
```
5. Install all package
```sh
$ composer install
```

## Database setup

```sh
...
DB_DATABASE=db_market
DB_USERNAME=root
DB_PASSWORD=
...
```

- Run this command:
```sh
$ php artisan key:generate
$ composer dump-autoload
$ php artisan migrate:fresh --seed
$ php artisan storage:link
```

## Running the app

```sh
$ php artisan serve
```


### Following are the steps that must be taken in the contribution process
1. Always pull upstream whenever you want to start developing
```sh
$ git pull upstream main
```
2. Create a new branch for each developed feature. Example:
```sh
$ git branch feature/add-login // Contoh saat membuat branch untuk fitur baru
$ git branch bug/fix-menu // Contoh saat membuat branch untuk fix bug
```
3. If your work already done, push to the repo of your fork
```sh
$ git push origin {nama-branch}
```
4. Ganbatte!!!

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
