<?php

class Dispatcher{
  private $rules;
  public $path; 
  public $pages;


    public function __construct($path, $pages) {
       $this->path = $path;
       $this->pages = $pages;
   }

    public function __construct_2($rules) {
      $this->rules = $rules;
    }
  
   public function isPage(){
    $path = $this->path;
    $pages = $this->pages;

     $firstArgument = $path[1];

      if($firstArgument  == '' || $firstArgument  == '/'){
           $firstArgument = 'home';
        }

      if(in_array($firstArgument,$pages)){
          $pageDestination = $firstArgument;
          $firstArgument = 'page';
          return true;
        }

   }
   public function makeCheckbox($bool, $disabled=false){
      $checkbox = '';
      if($bool == 1) {
         if(!$disabled)
         $checkbox = '<input type="checkbox" name="paid" checked value="true" />';
         else
         $checkbox = '<input type="checkbox" disabled name="paid" checked value="true" />';
      } 
      else
         if(!$disabled)
         $checkbox = '<input type="checkbox" name="paid" value="true" />';
         else
         $checkbox = '<input type="checkbox" disabled name="paid" value="true" />';
      return $checkbox;
   }

/*
   public function isPathAuthorized(){
     if($this->isPage()){
        return $this->isPageAuthorized();
     }
     else{
        return $this->isModelPageAuthorized();
     }
   }

  public function isPageAuthorized(){
     include('/routes.php');
     $page = $this->getPage();
     if(in_array($userPaths, $page)){
       return true;
     }
     else
       return false;
   }

  public function isModelPageAuthorized(){
     include('/routes.php');
     $page = $this->getPage();
     if(in_array($userPaths, $page)){
       return true;
     }
     else
       return false;
   }


   public function getPage(){
    $path = $this->path;
    $pages = $this->pages;

     $firstArgument = $path[1];

      if($firstArgument  == '' || $firstArgument  == '/'){
           $firstArgument = 'home';
        }

      if(in_array($firstArgument,$pages)){
          $pageDestination = $firstArgument;
          $firstArgument = 'page';
          return $pageDestination;
        }

   }

   public function getModelController(){
    $path = $this->path;
     $model = $path[3] ;
     $modelName = ucfirst($model . 'Model');
     $controllerName = ucfirst($model . 'Controller');
     $viewName = ucfirst($model . 'View');

     require_once($BASEDIR . '/controllers/' . $model. '.php' );
     require_once($BASEDIR . '/models/'. $model. '.php' );
     require_once($BASEDIR . '/views/' . $model. '.php' );

     $action = $path[2];
     $modelId = $path[4];
     $Controller = new $controllerName();
     return $Controller;
  }

*/
}

