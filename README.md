# Sebastian's Super-Duper Shoe Store Manager

##### Shoe Store Management using MySQL join table, 08/25/15

#### By Ashlin Aronin

## Description
SS-DSSM allows a user to enter shoe stores into a database and associate carried
brands with them. The user may [C]reate, [R]ead, [U]pdate and [D]elete shoe
stores and the brands they carry. The project utilizes some nifty div-hiding
to keep the number of template files to just three- one for all stores, one for
an individual store, and one for an individual brand.

## Setup
* Clone this repository from GitHub

* Run the following command in the project directory
```console
$ composer install
```
* Start MySQL and Apache servers with MAMP.
* Check in MAMP preferences that MySQL server port is set to 3306.
* Open phpMyAdmin in the browser at localhost:8888/phpMyAdmin
* Import both the shoes.sql.zip and shoes_test.sql.zip databases using the Import tab

* Start a PHP server in the web subdirectory of this project
```console
$ php -S localhost:8000
```

* Navigate to localhost:8000

* Enjoy!

## Technologies Used

PHP, phpMyAdmin, MySQL, PHPUnit, Silex, Twig, HTML, CSS, Bootstrap

### Legal

Copyright (c) Ashlin Aronin

This software is licensed under the MIT license.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
