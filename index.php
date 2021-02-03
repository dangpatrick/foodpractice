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

/*
 * Start a session: Each time I submit a form, where going to grab the data
 * from the form, put the data into my session array and go to the next page.
 * order route displays form1 - form 1 POSTS to order2, so order2 get the 1st form data
 * being sent to them. Start at the home, no data. click place an order, brings up the order form.
 * Enter data, hit Next >> sends you to order2 route along with POST data. Order 2 route is the first place
 * where I need to capture the information and put in session array before you go to next page
 *
 */
session_start();

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

    /*
    Adding data from form1 to Session array, the data from form1 is being sent to order2 route(form2.html)
    If they enter something for the food, going to add it to the session variable. If they order something for the meal
    (radio buttons), going to add it to the session variable. Grabbing the data from form1 when we get to the next page
    order2 is take the data from form1,
    */
    //see data being passed
    var_dump($_POST);
    /*
     * Order 2 looks into the POST array to see if theres anything in the food text box, if there is, it puts it in the
     * session - $_SESSION['food'] = $_POST['food'];
     */
    if(isset($_POST['food'])){
        $_SESSION['food'] = $_POST['food'];
    }
    /*
     * If theres anything in the meal selection, it puts it into the session, all data is stored in the session variable
     */
    if(isset($_POST['meal'])){
        $_SESSION['meal'] = $_POST['meal'];
    }

    //echo 'order 2 - practice!';
    $view = new Template();
    echo $view->render('views/form2.html');

});

//Define a summary route
$f3->route('POST /summary', function(){

    echo "<p>POST:</p>";
    var_dump($_POST);

    echo "<p>SESSION:</p>";
    var_dump($_SESSION);

    //add data from form2 to session array - now everything should be in my session array on summary page
    if(isset($_POST['condiments'])){
        $_SESSION['condiments'] = implode(", ", $_POST['condiments']);
    }

    //echo 'summary - practice!';
    $view = new Template();
    echo $view->render('views/summary.html');

});


//Run fat free
$f3->run();