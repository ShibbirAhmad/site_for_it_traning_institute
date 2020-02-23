
<?php 


class  Database {

    public $dbHost= DB_HOST;
    public $dbUser= DB_USER;
    public $dbPass= DB_PASS;
    public $dbName= DB_NAME;
    

    public $link;
    public $error;

     public function  __construct() {

       $this->connectionDB();

     }


  private  function connectionDB(){

           $this->link =  new mysqli($this->dbHost,$this->dbUser,$this->dbPass,$this->dbName);
           
           if (!$this->link) {
                 
                 $this->error="connection fail".$this->link->connect_error;
                 return $this->error;
           }

    }    
    
    

    //insert operation


    public function insert($sql){

      $insertRow=$this->link->query($sql) or die ($this->link->error.__LINE__);

      if ($insertRow) {

        return $insertRow;

      }else {

        return false;
      }
    }


    //select operation 



     public function select($sql){

      $selectRow=$this->link->query($sql)  or die ($this->link->error.__LINE__) ;
      
      if ($selectRow->num_rows > 0) {

        return $selectRow;

      }else {

        return false;
      }
    }




    //update row

    public function update($sql){

      $updateRow=$this->link->query($sql)  or die ($this->link->error.__LINE__) ;
      
      if ($updateRow) {

        return $updateRow;

      }else {

        return false;
      }
    }


// delete operation


public function delete($sql){

  $deleteRow=$this->link->query($sql)  or die ($this->link->error.__LINE__) ;
  
  if ($deleteRow) {

    return $deleteRow;

  }else {

    return false;
  }
}













}















?>

