<?php
//Jack "jakx" Daines 04/20/16
//example class
class ExampleModel extends DataRowModel {

}

class DataRowModel{

    public $id = 0;
    private $pageContents= NULL;
    public $template = NULL;
    public $BASEDIR = NULL;

    public $data1= "";
    public $userid = 0;


    public function __construct() {
          $this->data1= "";

          $this->userid = 0;
    }
//this is for displaying this model as a page
    public function __construct_4($pageContents, $BASEDIR) {
     $this->pageContents = $pageContents;
     $this->BASEDIR= $BASEDIR;
    }


    public function __construct_2($db,$id) {
       $sql = "SELECT * from Examples where id=$id";
       $statement = $db->prepare($sql);
       $pdoResult = $statement->execute();
       while($result = $pdoResult->fetchArray()){
             $this->id = $result['id'];
             $this->data1= $result['data1'];
       }
   }

    public function __construct_3($id, $data1,$userid){
         $this->id = $id;
         $this->data1= $data1;
         $this->userid= $userid;
    }
  
    public function userid() {
          return $this->userid;
    }

    public function pageContents() {
     return $this->pageContents;
    }

    public function template() {
     return $this->template;
    }

    public function writePageContents($BASEDIR) {
      $pageContents = $this->pageContents();
      include($BASEDIR . $this->template());
    }

    public function __toString() {
         return $this->caseNo . " " . $this->clientFileNo . " " . $this->client1 . " " . $this->client2;
    }
   
    public function deleteModel($db){
       $sql = "Delete from Examples where id=".$this->id;
       $statement = $db->prepare($sql);
       $pdoResult = $statement->execute();
       header('Location: /examples');
       exit;
}

     public function get() {
        return $this->id;        
    }
     public function paid() {
        if($this->paid =='true')
           return 1;
         else
           return 0;
    }

    public function saveModel($db) { 
 
     $sql = "insert or replace into Examples(id, date_updated, data1, userid) VALUES(:id, DATETIME('now'),:data1, :userid);"; 
     $statement = $db->prepare($sql); 
 
 
     $statement->bindValue(':id', $this->id, SQLITE3_INTEGER);  
     $statement->bindValue(':data1', $this->data1, SQLITE3_TEXT);  

     $statement->bindValue(':userid', $this->userid, SQLITE3_INTEGER); 
 
     $pdoResult = $statement->execute();  
 
    } 



}
