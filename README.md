# Welcome to One Day One Beer !

Hello and welcome to this modest project that is "One Day One Beer" !
This application allows you to display a photo of beer every passing days, and that's pretty all (but it's already good, ^_- nay ?)
This project is made with (love and) Symfony 4.

### Table of Contents
1. [How to Install](#1- How to Install)
2. [How to Use](#2- How to Use)
3. [License](#3- License)

# How to Install

Let's see how to get this project started properly. Follow my lead !

## Clone the project

First of all, let's clone this project on your own machine. In order to do that let's hit this line in your terminal :
```console
git clone https://github.com/Lutie/One-Day-One-Beer.git
```

## Configurations

Well there is not a lot of things to configure for the moment, but:

* You can change the configurations in the `.ex.env` file, especially that line :
```
ADMIN_PASSWORD=
```
* Then you have to rename it into `.env`.

## Start the server

Their is a lot of ways to start the server but i will guide you on the method i recommend, which use the symfony binary.
Since installation depends on your OS i will give you all the links needed to proceed.

First you need to install composer : [https://getcomposer.org/download/](https://getcomposer.org/download/)

Then you need to install symfony cli : [https://symfony.com/download/](https://symfony.com/download)

Once this is done let's enter those instruction in your terminal (from where you clone the project) :
```console
cd One-Day-One-Beer
composer install
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
symfony server:start
```
And "Voilà" ! You can now access to the website here : [http://127.0.0.1:8000/](http://127.0.0.1:8000/)

# How to Use

Well it's pretty simple actually, here's how it all works:
* Every day a picture selected for this day is displayed.
* Every one can submit a picture, but it won't be activated by default : An administrator need to access the administration section and pick a day for it (and validate it at the same time).
* If a day has no picture selected for it then a random picture is randomly chosen from all the previous validated ones.
* To access the administration page you need to go to : [http://127.0.0.1:8000/admin](http://127.0.0.1:8000/admin), the login is 'admin' and the password is the one set previously in your '.env' file.
* From the admin section you can see/sort/update/delete/choose a day for all the pictures uploaded on the website.
* Only one picture can be set to the same date, if a date already taken is set for a picture then the previous one will be automatically unset.

Enjoy !
