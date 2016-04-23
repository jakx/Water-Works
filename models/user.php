<?php
//Jack "jakx" Daines 04/20/16
//page 


class UserModel{

    public $username = '';
    public $password = '';
    public $id = NULL;
    private $pageContents= NULL;
    public $template = NULL;


    public function username(){
       return strtolower($this->username);
    }
   //this is for displaying this model as a page
    public function __construct_4($pageContents) {
     $this->pageContents = $pageContents;
    }


    public function __construct(){
    }

   //__construct_2 -> create a user aka handle user input
    public function __construct_2($username, $password,$db){
        $this->username = $username;
        $this->password = $password;
   
    }
//this constructor e.g. log in
    public function __construct_3($username, $password,$db){

       $sql = "select * from users where username=:username AND password = :password";

      $statement = $db->prepare($sql);

      $statement->bindValue(':username', $username, SQLITE3_TEXT);  
      $statement->bindValue(':password', $password, SQLITE3_TEXT);
    
       $pdoResult = $statement->execute();
       while($result = $pdoResult->fetchArray()){
             $this->username = $result['username'];
             $this->password = $result['password'];
             $this->userid = $result['id'];
       }
      return $this->userid ;// $this->userid;
    }


    public function __toString() {
          return $this->username;
    }

    public function saveModel($db) { 
      $sql = "insert or replace into Users(id, date_updated, username, password) VALUES(:id, DATETIME('now'), :username, :password);";
     $statement = $db->prepare($sql);
     $statement->bindValue(':username', $this->username(), SQLITE3_TEXT);
     $statement->bindValue(':password', $this->password, SQLITE3_TEXT);
     $pdoResult = $statement->execute();  
    } 

    public function deleteModel($db){
       $sql = "Delete from users where id=".$this->id;
       $statement = $db->prepare($sql);
       $pdoResult = $statement->execute();
     }

    public function pageContents() {
     return $this->pageContents;
    }

    public function template() {
     return $this->template;
    }

    public function writePageContents() {
      global $BASEDIR;
      $pageContents = $this->pageContents();
      include($BASEDIR . $this->template());
    }


}

