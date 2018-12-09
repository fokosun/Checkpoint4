## TECHADEMIA

[![Build Status](https://travis-ci.org/fokosun/Checkpoint4.svg?branch=master)](https://travis-ci.org/fokosun/Checkpoint4)
[![Coverage Status](https://coveralls.io/repos/andela-fokosun/Checkpoint4/badge.svg?branch=master&service=github)](https://coveralls.io/github/andela-fokosun/Checkpoint4?branch=master)

Techademia is a learning management system. It's an app built to help people learn various technologies from categories such as DevOps, Programming, Games Development and Design patterns. 

A user can access the app either as a guest or as a registered user. Alternatively, a user can sign in via social media (facebook, twitter or github).


##Project Features:

- User registration
- Login via OAuth (facebok, twitter and github)
- User profile Management (user settings)
- User area (This is the user's space. Here, the user can manage his/her videos)
    - upload a youtube video using the video link
    - edit an uploaded video
    - delete a video
    - see all videos in a particular category
- Guest users can only watch videos posted by other users


Techademia is an open-source project. Feel free to fork or clone it and make it better! If you intend to be a contributor, the following guide lines will be useful to you:

- Install [Composer](https://getcomposer.org/doc/00-intro.md)
- Download and install [Laravel homestead](https://laravel.com/docs/5.1/homestead)


##Installation

    git clone git@github.com:andela-fokosun/Checkpoint4.git

##Usage
Make sure your .env file looks like this:

```
    APP_ENV=
    APP_DEBUG=
    APP_KEY=

    DB_HOST=
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=

    CACHE_DRIVER=
    SESSION_DRIVER=
    QUEUE_DRIVER=

    FACEBOOK_ID=
    FACEBOOK_SECRET=
    FACEBOOK_REDIRECT=

    TWITTER_API_KEY=
    TWITTER_APP_SECRET=
    TWITTER_CALLBACK_URL=

    GITHUB_CLIENT_ID=
    GITHUB_CLIENT_SECRET=
    GUTHUB_CALLBACK_URL=

```

Run:

    php artisan migrate

In this app, by design we have only four categories. You can run the seeder to populate the categories. You can use any approach that suits you. To run the seeder, run:

    php artisan db:seed

or

    php artisan db:seed --class=CategoriesTableSeeder


After that run:

    composer install

To pull all the dependencies


Feel free to change the namespace to your desired namespace. Just run:

     php artisan app:name "Your namespace"


Ensure to run `composer dumpautoload` after running this command.


##Testing
Run

    phpunit

##Classes

    - AuthenticateUser
    - User
    - Video
    - UserRepository
    - Videorepository
    - HomeController
    - UserController
    - VideoController


##Final notes

PHP/Laravel + bootstrap is all you need!

see [live demo](http://techademia.herokuapp.com/)

**Happy coding!**


TODOs:
- library Organizer
-- user should be able to create new categories
-- user should be able to move videos into categories
-- user is able to male a copy of a video link shared by another user into their own library (content sharing)

- Remove youtube title links from videos.

- views counter

- likes and comments

