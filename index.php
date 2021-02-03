<?php
/*
 * Name Patrick Dang
 * Date: 1/28/2021
 * Filename: index.php
 * Description: Controller page for practicing food program in class
 */

//This is my CONTROLLER page

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);


//Require the auto autoload file
require_once('vendor/autoload.php');

//Create an instance of the Base class
$f3 = Base::instance();
$f3->set('Debug',3);

//Define a default route (home page)
$f3->route('GET /', function(){
//    echo 'hello practice pat!';
    $view = new Template();
    echo $view->render('views/home.html');
});

//Define an order route
$f3->route('GET /order', function(){
    //echo 'order 1 - practice!';
    $view = new Template();
    echo $view->render('views/form1.html');
});

//Define an order2 route
$f3->route('POST /order2', function(){
    //echo 'order 2 - practice!';
    $view = new Template();
    echo $view->render('views/form2.html');

});

//Define a summary route
$f3->route('POST /summary', function(){
    //echo 'summary - practice!';
    $view = new Template();
    echo $view->render('views/summary.html');

});


//Run fat free
$f3->run();