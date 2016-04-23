<?php
class ExampleView extends DataRowView {}
class DataRowView
{
    public $dataRowModel;
    public $dataRowController;
    public $dispatcher;
    public $router;

    public function __construct($model,$controller, $dispatcher, $router) {
        $this->dataRowController = $controller;
        $this->dataRowModel = $model;
        $this->dispatcher= $dispatcher;
        $this->router= $router;
    }
    
    public function model(){
        return $this->dataRowModel;
    }

    public function hasCollection(){
        return true;
    }


    public function controller(){
        return $this->dataRowController;
    }

    public function __toString(){
        return "<p>" . $this->dataRowModel . "</p>";
    }

    public function htmlRow($actions = true){
      if($actions) 
        return 
            "<td>" . $this->dataRowModel->data1. "</td>"
           . "<td><a class='action-button' href='/edit/example/"  
           . $this->dataRowModel->get()
           ."'> Edit</a>" 
           . ""
           . "</td>"
           ;
    else
     return
            "<td>" . $this->dataRowModel->data1. "</td>"
          ;

    }

    public function edit(){
      return 
 "<form id='post-data' action='/saveModel/example' method='POST'> <table id='create-dataRow'>"
.            "<td><input type='text' name='data1' value='" . $this->dataRowModel->data1. "' /></input></td><td>Data 1</td></tr>"
.            "<td><input type='submit' value='Save'> </input> </td>"
.            "</table> </form>";

;
    }

    public function create(){
      return 
            "<form id='post-data' action='/saveModel/example' method='POST'> <table id='create-dataRow'>"
.            "<td><input type='text' name='data1' value='" . $this->dataRowModel->data1. "' /></input></td><td>Data 1</td></tr>"
.            "<td><input type='submit' value='Save'> </input> </td>"
.            "</table> </form>";

;
    }
}
