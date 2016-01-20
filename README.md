## TECHADEMIA

[![Build Status](https://travis-ci.org/andela-fokosun/Checkpoint4.svg)](https://travis-ci.org/andela-fokosun/Checkpoint4)
[![Coverage Status](https://coveralls.io/repos/andela-fokosun/Checkpoint4/badge.svg?branch=master&service=github)](https://coveralls.io/github/andela-fokosun/Checkpoint4?branch=master)

Techademia is a learning management system. It's an app built to help people learn various technologies from categories such as DevOps, Programming, Games Developement and Design patterns. 

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

##Installation

    git clone git@github.com:andela-fokosun/Checkpoint4.git

##Usage
Run

    composer install

To pull all the dependencies

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
