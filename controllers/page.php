<?php
$BASEDIR = $_SERVER['DOCUMENT_ROOT'];

class PageController {

    private $pageModel;
    private $db;
    private $pageName;
    private $BASEDIR = NULL;
    private $template= NULL;
    private $router;
 

    private function template() {
       if($this->template===NULL){ $this->template = '/templates/default.php'; }
       return $this->template;
    }

    public function __construct($dispatcher, $router) {
        $this->dispatcher= $dispatcher;
        $this->router= $router;
        $this->BASEDIR = $_SERVER['DOCUMENT_ROOT'];
   }
   public function BASEDIR(){
      return $this->BASEDIR;
   }

    public function __construct_3($db, $pageModel) { //__construct(db, model)
        $this->db = $db;
        $this->pageModel = $pageModel;
        $this->pageName = $pageModel->pageName;
    }


    private function __construct_2($db, $pageModel, $template) {
        $this->template = $template;
    }


    private function phpTemplate() {
       return $this->BASEDIR . $this->template()  ;
    }

    public function home() {
         include($this->phpTemplate());
    }

    public function error404() {
         include($this->phpTemplate());
    }



    public function signin() {
         include($this->phpTemplate());
    }

    public function about() {
         include($this->BASEDIR . '/templates/blank-template.php');
    }

    public function contact() {
         include($this->phpTemplate());
    }
    public function examples() {

        if(!(isset($_SESSION['loggedin']))){
           header('Location: /signin'); 
           exit;
        }

        $db = $this->db;
        $BASEDIR = $this->BASEDIR;
        $pageName = $this->pageName;
        $sql = "SELECT * FROM examples ORDER BY date_created DESC;";
        $statement = $db->prepare($sql);
        $pdoResult= $statement->execute();
        require_once($BASEDIR . '/models/example.php' );
        require_once($BASEDIR . '/controllers/example.php' );
        require_once($BASEDIR . '/views/example.php' );
        $dataRowViews = Array();
        while($result = $pdoResult->fetchArray()){
             $example = new DataRowModel();
             $example->__construct_3($result['id'], $result['data1'], $result['userid']);
             $dataRowView = new DataRowView($example, $this, $this->dispatcher, $this->router);             
             $dataRowViews []= $dataRowView;
        }
         include($this->phpTemplate());


    }
}

