<?php
  session_start();
require_once($BASEDIR . '/includes/connect.php');
//require_once($BASEDIR . '/includes/functions.php');
header('Cache-Control: max-age=600');
error_reporting(E_ALL & ~E_NOTICE);
//error_reporting(E_ALL);

global $BASEDIR;
$BASEDIR = $_SERVER['DOCUMENT_ROOT'];


//ini_set("magic_quotes_gpc", "0");
ini_set('display_errors', 'on');

$path = explode('/', $_SERVER['REQUEST_URI']);
$requestURI = $_SERVER['REQUEST_URI'];

require_once($BASEDIR . '/includes/session.php');


require_once($BASEDIR . '/includes/dispatcher.php');
require_once($BASEDIR . '/includes/router.php');
require_once($BASEDIR . '/controllers/page.php' );
require_once($BASEDIR . '/controllers/action.php' );
require_once($BASEDIR . '/models/page.php' );
require_once($BASEDIR . '/models/user.php' );
require_once($BASEDIR . '/views/page.php' );

$pages = get_class_methods(PageController);
$controllerActions = get_class_methods(ActionController);
$Dispatcher = new Dispatcher($path, $pages);
$Router = new Router($path, $pages, $actions);
if(($Router->isPathAuthorized($path, $pages))){
} else {
   header('Location: /error404');
   exit;
 }
if($Router->isAction()){
     $controllerAction = $path[1];
     $ActionController = new ActionController($db, $Router, $Dispatcher);
     $ActionController->$controllerAction();
     //no view is created
     exit();
}

else if($Router->isPage()){
     $page = $Router->getPage();

     $PageController = new PageController($Dispatcher, $Router);
     $PageModel = new PageModel($BASEDIR);
     $PageModel->__construct_2($page, $BASEDIR);
     $PageController->__construct_3($db,$PageModel);
     $PageView = new PageView($PageModel, $PageController, $Dispatcher, $Router);
     $PageController->$page();
    
}


