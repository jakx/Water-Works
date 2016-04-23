<?php

class ExampleController extends DataRowController{

 }
class DataRowController {

    private $dataRowModel;
    private $db;

    private $router;


    public function model() {
       return $this->dataRowModel;
    }
    public function __construct($router) {
       $this->router = $router;
    }
//for saving
    public function __construct_4($db, $postVariable) {
      $this->db = $db;
       $this->dataRowModel = new DataRowModel();
       $thisModel = $this->model();
       $thisModel->__construct_3($_POST['id'],$_POST['data1'], $_SESSION['loggedin']); 

    }
 
    public function __construct_2($db,$dataRowModel) {
        $this->db = $db;
        $this->dataRowModel = $dataRowModel;
    }

    public function __construct_3($pageContents, $dataRowModel) { //change model
        $this->dataRowModel = $dataRowModel;
        $dataRowModel->__construct_4($pageContents);
    }

    public function edit($db, $currentView, $View, $BASEDIR) {
      $Model = $View ->model();
      $BASEDIR = $BASEDIR;
      $Controller = $View ->controller();
      $Model->__construct_4( $View->edit(), $BASEDIR);
      $currentView->changeModel($Model);
      $currentView->html_edit($BASEDIR);
    }
    public function create($db, $currentView, $View, $BASEDIR) {
      $Model = $View ->model();
      $BASEDIR = $BASEDIR;
      $Controller = $View ->controller();

      $Model->__construct_4( $View->create(), $BASEDIR);
      $currentView->changeModel($Model);
     
      $currentView->html_create($BASEDIR);
    }

    public function saveModel(){
      $thisModel = $this->model();
      $thisModel->saveModel($this->db);
      header('Location: /examples');
    }

    public function addDB($db){
       $this->db = $db;
    }
}

