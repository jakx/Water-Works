<?php
class PageView
{
    private $pageModel;
    private $pageName;
    private $dispatcher;
    public $router;
    private $pageController;

    public function __construct($model,$controller, $dispatcher, $router) {
        $this->pageController = $controller;
        $this->pageModel = $model;
        $this->dispatcher= $dispatcher;
        $this->router = $router;
    }
    
    public function changeModel($model) {
        $this->pageModel = $model;
    }

    public function controller(){
        return $this->pageController;
    }

    public function model(){
        return $this->pageModel;
    }

    public function hasCollection(){
        return false;
    }

    public function html($BASEDIR){
         $BASEDIR = $this->pageModel->BASEDIR;
         $this->pageName = $this->pageModel->pageName;
         include($BASEDIR . $this->pageModel->pageName . ".php");
    }

    public function html_edit($BASEDIR){
            $Model = $this->model();
            $Model->template = '/templates/model.php';
            $Model->writePageContents($BASEDIR);
    }

    public function html_create($BASEDIR){
            $Model = $this->model();
            $Model->template = '/templates/model.php';
            $Model->writePageContents($BASEDIR);
    }
}
