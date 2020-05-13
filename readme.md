# titanium
My MVC Framework

1. Introduction

       My own php MVC framework that I decided to build to level up my OOP skills. 
       Decided to write this documentation to make sure I understand what I'm doing.
       I'm amending when I'm bored or don't have much to do. if you by any chance find this repo..

       Thanks for readin in advance... haha jk.. I know programmers are lazy to read, they watch tutorials..
       I'm gonna make a video version of this documentation..The goal is to convert this basic framwork into 
       something powerful like laravel. Once it gets to that level, I'll create a course on 'How to build a powerful 
        MVC php framework' and sell it on youdemy. Wish me luck if you read up till this point :)


Installation
...coming soon.

URLS

      In a php application that is not powered by a framework..all urls have a .php extenstion.
      And you run your scripts by typing the script name in the url bar, e.g domain.co.za/add_user.php.

      That is not how things work in an mvc application. The .php extenstion is removed from the urls.
      And the urls is broeken into 2 or 3 parts. e.g domain.co.za/user/add or domain.co.za/user/edit/1.

      The first part of the url is a class, and the second part is a method from a class and the 3rd part is optional 
      request parameters.

    All requests are routed to a relevant class and a method. All of that is handled by the index.php & Router class

INDEX.PHP

    The index.php file explodes urls in the url bar on '/'. 

    E.g if the url is user/edit/1, index.php will turn into

    $url = [
       0 => "user",
       1 => "edit",
       2 => 1
    ] 

    this array is passed to the bootstrap.php, which kinda boot the framework and get everything running.


BOOTSTRAP.PHP

    The bootstrap .php application starts the framework and get everything running, it beggins that process by 
    including all framework helper functions...so they are publicly available anywhere in the framework.
    (an example of a helper function is the dd function in laravel)
    Then it autoload all the classes in the framework so can be instanciated without requiring/including them.

    Once all classes and helpers functions are loaded, we pass the url array to the Router class.
    again the url array could be something like: 
    $url = [
       0 => "user",
       1 => "edit",
       2 => 1
    ] 

THE ROUTER CLASS AND THE ROUTE METHOD.

    The router class calls a relevant class and the method, based on what we have on the url.

    it declares the first part of the url array as a class.
    e.g $class = user;
    the second part as a method of that class.
    e.g $method = edit;
    and the 3rd part as request parameters
    e.g
    $params = 1;

    with all this information, a relevant class (Crontroller) and and method is called..
    then the magic happens...

    to be continued.










