# CODE GENERATOR AUTOMATION FOR LARAVEL 5

[![License](https://poser.pugx.org/zizaco/entrust/license.svg)](https://packagist.org/packages/zizaco/entrust)

Code Generation Automation is a source code generator for Laravel 5, which will help you to create controller, view, model and route class automatically based on MySQL database scheme you have been designed before.

## Installation

1) In order to install, just run:

```shell
composer global require "indyka/cgat=~1.0"
```

2) Open your cgat folder, setup your env file and run migration to migrate all user authentication table:

```shell
php artisan migrate,
```
## Using Code Generator

1) Import your MySQL script to your database. You can do it from third party application such as MySQL Workbench or phpMyAdmin

2) Serve the application by run:

```shell
php artisan -S localhost:8000
```

3) Login by using email: demo@demo.com and password: demo

4) Follow all steps showed to generate your table source code

## License

CGAT is free software distributed under the terms of the MIT license.

## Contribution guidelines

Support follows PSR-1 and PSR-4 PHP coding standards, and semantic versioning.

Please report any issue you find in the issues page.  
Pull requests are welcome.
