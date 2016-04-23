<?php
//Jack "jakx" Daines 04/01/16
//page 

class PageModel{

    public $pageName = '';
    public $pageContents= NULL;
    public  $BASEDIR = NUlL; 

    //construct order    
    public function __construct($BASEDIR){
         $this->BASEDIR = $BASEDIR;
    }
    public function __construct_2($pageName){
         $this->pageName = $pageName;
    }

    public function __construct_3($pageContents){
         $this->pageContents = $pageContents;
    }

    public function __toString() {
          return $this->pageName;
    }

    public function returnContents() {
          return $this->pageContents;
    }

    public function save($db) { 
       return false;
    } 



}

