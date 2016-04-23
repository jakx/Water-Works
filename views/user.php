<?php
class UserView 
{
    public $userModel;
    public $userController;
    public $dispatcher;
    public $router;

    
    public function __construct($model,$controller, $dispatcher, $router) {
        $this->userController = $controller;
        $this->userModel = $model;
        $this->dispatcher= $dispatcher;
        $this->router= $router;
    }

    
    public function model(){
        return $this->userModel;
    }

    public function controller(){
        return $this->userController;
    }

    public function __toString(){
        return "<p>" . $this->userController.  "</p>";
    }

    public function hasCollection(){
        return false;
    }
    public function edit(){
      return 
            "<tr><td><input type='password' name='password' /></input><td>Password</td></td></tr>"
;
    }

    public function create(){
      return 
            "<form id='post-data' action='/saveModel/user' method='POST'>
<table id='create-user'>"
.            "<tr><td><input type='text' name='username' value='" . $this->userModel->username. "' /></input><td>Username</td></td></tr>"
.            "<tr><td><input type='password' name='password'  /></input><td>Password</td></td></tr>" 
.            "<td><input type='submit' value='Save'> </input> </td>"
.            "</table> </form>";

    }
}
