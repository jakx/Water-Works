<?php

class Router{
  private $rules;
  public $path; 
  public $pages;
  public $actions;
  public $myMap;


    public function __construct($path, $pages, $actions) {
       $this->path = $path;
       $this->pages = $pages;
       $this->actions = $actions;
       $this->myMap = array(
                                'page' => array('home' => false, 'signin' => false,'about'=> false, 'contact' =>false),
                                'action' => array('login' => false, 'logout' => false),
                                'example' => array('edit' => true, 'create' => true,'deleteModel'=> true, 'saveModel' =>true),
                                'user' => array('create' =>false, 'saveModel' =>'true', 'edit' => true) 
       );
   }

    public function __construct_2($rules) {
      $this->rules = $rules;
    }

    public function isLoggedIn(){
    if(isset($_SESSION['loggedin']))
      return true; 
    return false;
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


    public function userLoggedIn(){
   return $_SESSION['loggedin'];
   } 
 
   public function isAction(){
    $action = $this->action();

    $controllerActions = get_class_methods(ActionController);
    if(in_array($action,$controllerActions)){
     return true; 
    }
   }

   public function getAction(){
       return $this->action()  ;
   }
   public function action(){
    $path = $this->path;
    $action = (strlen($path[2]) ==0 ? $path[1] : $path[1]);
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
   $myMap = $this->myMap;

     if($this->isPage()){
   $action = $this->action();
       $page = $this->getPage();
 //      $pageAuthAnswer = $this->isPageAuthorized();
       $isLoggedIn = $this->isLoggedIn();
       if($myMap['page'][$page] == true && $isLoggedIn) {
            return true;
       }
       else if($myMap['page'][$page] == false && !$isLoggedIn) {
            return true;
      }
       else {
          return $myMap['action'][$action] ? false : true;
       }

     }
     else if ($this->isAction()){
   $action = $this->action();
//       $actionAuthAnswer = $this->isActionAuthorized();
       $isLoggedIn = $this->isLoggedIn();
       $action = $this->getAction();
       $model = $this->getModel();
       if($myMap[$model][$action] == true && $isLoggedIn) {
            return true;
       }
       else if($myMap[$model][$action] == false ) { //no permissions
               return true;
      }
          $mapResult = $myMap['action'][$action]  ==true ? true: false;
          return $mapResult;
      }
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

/*
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
*/

/*
       if(strpos($action, "__construct") + 1){ //strings start at 0
       }
       else if($action == $this->getAction()) {
         return true;
       }
    }
   return false;

  }

*/

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

