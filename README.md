![hng_logo](https://res.cloudinary.com/benchuks-inc/image/upload/v1569336547/hng.png)

# Gate App - API

## This the Documentation for the backend api (Please Read Me)

#### https://documenter.getpostman.com/view/6843654/SVtSXAQP?version=latest

### Contains associative routes

#### /api/register/admin
#### /api/register/gateman
#### /api/register/resident
#### /api/login
#### /api/verify
#### /password/verify
#### /password/reset
#### /api/v1/user
#### /api/v1/user/{id}
#### /api/v1//user/edit
#### /api/v1//user/password
#### /api/v1//user/delete

## Features

* to be added

## Installation

* clone this repo
* cd into the project folder
* Run composer install to install depedencies
* Run `php artisan serve`
* visit localhost:8000 in your web browser

## Rules for sending PR

* attach a brief and concise description of what you have done
* outline the steps to be taken in order to test the feature you added
* attach a screenshot or gif of what you did, if possible
* do not send PR to the master branch



## Note 
* if you want to manually delete form the database this is the link
* https://remotemysql.com/phpmyadmin/
* use the info database username and password from .env file to login

* the .env has been included in this commit so discard you own this time we all going to use one database which is online an a mailing of my own sendgrid 

* make sure you have internet to work 

## Setting up for testing
You will need PHP >= 7.2, [Composer](https://getcomposer.org/) and an SQL Database to get started.
MySql or PostgressSQL preferred.

* Clone this repository
* Run `composer install` to install dependencies
* Copy `.env.example` to `.env` and edit the contents to match your environment
configurations. **For testing purposes, you may keep the .env file provided in the repo for uniformity**
* Run ```php artisan migrate``` to set up the DB
* Run ```php artisan key:generate``` to  generate the application key
* For testing and development purposes, run ```php artisan serve```. You can then access the app at http://localhost:8000 on your browser
