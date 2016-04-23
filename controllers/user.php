<?php
 $BASEDIR = $_SERVER['DOCUMENT_ROOT'];

class UserController {

    private $userModel;
    private $db;
    private $router;



    public function __construct($router) {
    $this->router = $router;
   }

    public function __construct_2($db,$userModel) {
        $this->db = $db;
        $this->userModel = $userModel;
    }

    //this constructor e.g. create new user
    public function __construct_4($db,$postVariable){
       $this->db = $db;
       $thisModel =  new userModel();
       $this->userModel =$thisModel;
       $thisModel->__construct_2($postVariable['username'],$postVariable['password'],$db);
    }


    public function model(){
       return $this->userModel;
    }

    public function edit($db, $currentView, $View) {
      $Model = $View ->model();
      $BASEDIR = $BASEDIR;
      $Controller = $View ->controller();
      $Model->__construct_4( $View->edit());
      $currentView->changeModel($Model);
      $currentView->html_edit($BASEDIR);
    }

    public function create($db, $currentView, $View) {

     //allow new users?
     if($this->router->isNotLoggedIn()) {
       if($this->router->numberOfUsers($db) != 0 ) {
         header('location: /404');
       }
     }


      $Model = $View ->model();
      $Controller = $View ->controller();
      $Model->__construct_4( $View->create());
      $currentView->changeModel($Model);

      $currentView->html_create($BASEDIR);
    }

    public function saveModel(){
      $thisModel = $this->model();
      $thisModel->saveModel($this->db);
    }

}

