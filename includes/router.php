<?php

class Router{
  private $rules;
  public $path; 
  public $pages;
  public $actions;


    public function __construct($path, $pages, $actions) {
       $this->path = $path;
       $this->pages = $pages;
       $this->actions = $actions;
   }

    public function __construct_2($rules) {
      $this->rules = $rules;
    }

    public function isLoggedIn(){
    if(isset($_SESSION['loggedin']))
      return true; 
    return false;
   } 

    public function userLoggedIn(){
     return $_SESSION['loggedin'];
     } 

    public function isNotLoggedIn(){
      return $this->isLoggedIn() ? "false" : "true";
    }
   public function numberOfUsers($db) {
         $sql = "SELECT count(*) as numberOfUsers FROM users ;";
        $statement = $db->prepare($sql);
        $pdoResult= $statement->execute();
        while($result = $pdoResult->fetchArray()){
            $countUsers =$result['numberOfUsers'];  
            return $countUsers;
       }
      return 0;
}

   public function isAction(){
    $action = $this->action();
    $controllerActions = get_class_methods(ActionController);
    if(in_array($action,$controllerActions)){
     return true; 
    }
   }

   public function getAction(){
       return $this->action();
   }
   public function action(){
    $path = $this->path;
   // $action = ($path[2] ? $path[2] : $path[1]);
    return $path[1];
    return $action;
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

   public function isPathAuthorized(){
   $path = $this->path;
 
     if($this->isPage()){
        return $this->isPageAuthorized();
     }
     else if ($this->isAction()){
        return $this->isActionAuthorized();
     }
     else
         return false;
   }

  public function isPageAuthorized(){
     $pages = get_class_methods(PageController);
     foreach($pages as $page) { 
       if(strcmp($page, $this->getPage())== 0) {
         return true;
       }
       if(strpos($page, "construct") + 1){ //strings start at 0
         continue;
       }
       else {
          continue;
       };
    }
   return false;

  }

  public function isActionAuthorized(){
     $actions = get_class_methods(ActionController);
     foreach($actions as $action) { 
      if(strcmp($action, $this->getAction())== 0) {
         return true;
       }
       if(strpos($page, "construct") + 1){ //strings start at 0
         continue;
       }
       else {
          continue;
       };
    }
   return false;


/*
       if(strpos($action, "__construct") + 1){ //strings start at 0
       }
       else if($action == $this->getAction()) {
         return true;
       }
    }
   return false;

*/
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
  public function getModel(){
     return $this->path[2];
  }

  public function getArgument(){
     if(is_numeric($this->path[3]))
        return $this->path[3];
  }
   public function getModelName(){

     return ucfirst($this->path[2] . 'Model');
  }
}

