# titanium
My MVC Framework

1. Introduction

My own php MVC framework that I decided to build to level up my OOP skills. 

Installation
...coming soon.

URLS

In a php application that is not powered by a framework..all urls have a .php extenstion.
And you run your scripts by typing the script name in the url bar, e.g domain.co.za/add_user.php.

That is not how things work in an mvc application. The .php extenstion is removed from the urls.
And the urls is broken has two or 3 parts. e.g domain.co.za/user/add or domain.co.za/user/edit/1.

The firrst part of the url is a class, and the second part is a method from a class and the 3rd part is option 
request parameters.

All requests are routed to a relevant class and a method. All of that is handled by the Router class



