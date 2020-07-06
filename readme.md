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

     In a php application that is not powered by a framework..all urls have a .php extenstion. And the scripts are ran by passing the the script name to the url bar. Often you could see urls that look like: domain.co.za/users.php?action=edit&id=1, or domain.co.za/users.php?action=list. The script would look like this:
if($_GET['action'] = edit){ 
       //do something 

}else{ 
   //do something else

 }
The first that's wrong with this approach is that this kind of url domain.co.za/users.php?action=list, is not search-engine friendly. Secondly, the the scripts becomes messy with if's and else's. 
Routing solves this problem. the .php extenstion is removed from the urls, and the uri us mapped to a revevant route, and the route is mapped to a relevent class and method.

All routes are defined in the routes.php file. The first example in the above screenshot means domain.co.za/movies/add would be routed to the Movies controller, and the add method of the Movies controller. 

URLS

In a php application that is not powered by a framework..all urls have a .php extenstion. And the scripts are ran by passing the the script name to the url bar. Often you could see urls that look like: domain.co.za/users.php?action=edit&id=1, or domain.co.za/users.php?action=list. The script would look like this:
if($_GET['action'] = edit){ 
       //do something 

}else{ 
   //do something else

 }

The first that's wrong with this approach is that this kind of url:  domain.co.za/users.php?action=list, is not search-engine friendly. Secondly, the the scripts become messy with if's and else's. 

Routing solves this problem.  The .php extenstion is removed from the urls, and the uri us mapped to a revevant route, and the route is mapped to a relevent class and method.


All routes are defined in the routes.php file. The first example in the above screenshot means domain.co.za/movies/add would be routed to the Movies controller, and the add method of the Movies controller. 

Index.php

All requests are forwarded to the index.php file, which gets the request uri and pass it to to bootrap.php. Bootstrap.php kickstarts the framework and get everything running.

Bootstrap.php 

The bootstrap.php file loads configuration file and helper functions. An example of a helper function is dd() in Laravel, and dnd() in my framework. After loading the helper functions, the bootstrap php autoloads all classes..it looks for classes the following directories: \core, \models \ controllers.

Once it's done loading the helper functions, it calls the route method from the router class.




The router class and the route method 

The Router class maps all requests to a relevant class and method. 

When a route is registered on the routes.php file like so: Router::get('movies/add','movies@add'), that route is added to an array of valid routes. The route method of the router class loops through the array of valid routes, and try to match the request uri to the list of valid routes, if a match is found will class a relevant class and method. The relevant class and method are passed as second parameter when the Router::get() method is called.


To be continued....









