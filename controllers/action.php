<?php


class ActionController{

  private $modelcontroller;
  private $db;
  private $router;
  private $dispatcher;
  private $BASEDIR = NULL;


    public function __construct($db, $router, $dispatcher) {
     $this->db = $db;
     $this->router = $router;
     $this->dispatcher = $dispatcher;
     $this->BASEDIR = $_SERVER['DOCUMENT_ROOT'];

   }

   public function __construct_2($modelcontroller){
       $this->modelcontroller = $modelcontroller;
   }




   public function create() {
     $db = $this->db;
     $Router = $this->router;
     $Dispatcher = $this->dispatcher;
     $BASEDIR= $this->BASEDIR;
     $model = $Router->getModel();
     $modelName = $Router->getModelName();

     require_once($BASEDIR . '/controllers/' . $model. '.php' );
     require_once($BASEDIR . '/models/'. $model. '.php' );
     require_once($BASEDIR . '/views/' . $model. '.php' );

     $Model = new $modelName();

     $controllerName = ucfirst($model . 'Controller');
     $Controller = new $controllerName($Router);
     $viewName = ucfirst($model . 'View');


     $PageController = new PageController($Dispatcher,$Router);
     $PageModel = new PageModel($BASEDIR);


     $modelId = $Router->getArgument();
     $action= $Router->getAction();

     $Controller->__construct_2($db,$modelId);
     $View = new $viewName($Model, $Controller, $Dispatcher, $Router);
     $PageModel->__construct_3($View->create(), $BASEDIR);

     $PageController->__construct_3($db,$PageModel);
     $PageView = new PageView($PageModel, $PageController, $Dispatcher, $Router);
    echo $Controller->$action($db,$PageView, $View, $BASEDIR);

   }
   public function saveModel() {
     $db = $this->db;
     $Router = $this->router;
     $Dispatcher = $this->dispatcher;
     $BASEDIR= $this->BASEDIR;
     $model = $Router->getModel();
     $modelName = $Router->getModelName();

     require_once($BASEDIR . '/controllers/' . $model. '.php' );
     require_once($BASEDIR . '/models/'. $model. '.php' );
     require_once($BASEDIR . '/views/' . $model. '.php' );

     $Model = new $modelName();

     $controllerName = ucfirst($model . 'Controller');
     $Controller = new $controllerName($Router);
     $viewName = ucfirst($model . 'View');


     $PageController = new PageController($Dispatcher,$Router);
     $PageModel = new PageModel($BASEDIR);


     $modelId = $Router->getArgument();
     $action= $Router->getAction();

     $Controller->__construct_4($db,$_POST);
     $Controller->saveModel();
   }
   public function deleteModel() {
     $db = $this->db;
     $Router = $this->router;
     $Dispatcher = $this->dispatcher;
     $BASEDIR= $this->BASEDIR;
     $model = $Router->getModel();
     $modelName = $Router->getModelName();

     require_once($BASEDIR . '/controllers/' . $model. '.php' );
     require_once($BASEDIR . '/models/'. $model. '.php' );
     require_once($BASEDIR . '/views/' . $model. '.php' );

     $Model = new $modelName();

     $controllerName = ucfirst($model . 'Controller');
     $Controller = new $controllerName($Router);
     $viewName = ucfirst($model . 'View');


     $PageController = new PageController($Dispatcher,$Router);
     $PageModel = new PageModel($BASEDIR);


     $modelId = $Router->getArgument();
     $action= $Router->getAction();

     $Model->__construct_2($db, $modelId);
     $Model->deleteModel($db);

   }
   public function edit() {
     $db = $this->db;
     $Router = $this->router;
     $Dispatcher = $this->dispatcher;
     $BASEDIR= $this->BASEDIR;
     $model = $Router->getModel();
     $modelName = $Router->getModelName();

     require_once($BASEDIR . '/controllers/' . $model. '.php' );
     require_once($BASEDIR . '/models/'. $model. '.php' );
     require_once($BASEDIR . '/views/' . $model. '.php' );

     $Model = new $modelName();

     $controllerName = ucfirst($model . 'Controller');
     $Controller = new $controllerName($Router);
     $viewName = ucfirst($model . 'View');


     $PageController = new PageController($Dispatcher,$Router);
     $PageModel = new PageModel($BASEDIR);


     $modelId = $Router->getArgument();
     $action= $Router->getAction();

     $Model->__construct_2($db, $modelId);
     $Controller->__construct_2($db,$modelId);
     $View = new $viewName($Model, $Controller, $Dispatcher, $Router);
     $PageModel->__construct_3($View->edit(), $BASEDIR);

     $PageController->__construct_3($db,$PageModel);
     $PageView = new PageView($PageModel, $PageController, $Dispatcher, $Router);
    echo $Controller->$action($db,$PageView, $View, $BASEDIR);

   }


   public function login(){
     $post = $_POST;
     $userModel = new UserModel();
     $loginresult = $userModel->__construct_3(strtolower($post['username']), $post['password'],$this->db);
     if($loginresult >= 0 ){
       $_SESSION['loggedin'] = $loginresult;
       header('Location: /examples');
     }
     else 
       header('Location: /signin');
   }

   public function logout(){
     $post = $_POST;
      unset($_SESSION['loggedin']) ;
      header('Location: /signin');
   }

}

