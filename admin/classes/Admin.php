<?php


   
class Admin {

    public $db;
    public $secure;

    public function __construct(){

        $this->db=new database();
        $this->secure=new helper();
    }

public function adminCreate($data){
       
       $adminUsername = $this->secure->validation( $data['username']);
       $adminEmail    = $this->secure->validation( $data['email']);
       $adminPassword = $this->secure->validation( $data['password']);
    $adminDesignation = $this->secure->validation( $data['designation']);
       $adminStatus   = $this->secure->validation( $data['status']);


       $username  =mysqli_real_escape_string($this->db->link,$adminUsername);
       $email     =mysqli_real_escape_string($this->db->link,$adminEmail);
       $password  =mysqli_real_escape_string($this->db->link,$adminPassword);
       $designation=mysqli_real_escape_string($this->db->link,$adminDesignation);
       $status    =mysqli_real_escape_string($this->db->link,$adminStatus);


       $chkEmail=$this->checkOldEmail($email);

      if (empty($username) || empty($email) || empty($password) || empty($designation) || empty($status)) {
        
              echo "<span class='warning'>field must not be empty...! </spna>";
      
      } elseif(strlen($password ) < 6){
         
               echo "<span class='warning'>password should be more than 8 character...! </spna>";

      }elseif(filter_var($email,FILTER_VALIDATE_EMAIL)==false){
          
               echo "<span class='warning'>email address isn't valid..! </spna>";

      } elseif($chkEmail==false){
         
        echo "<span class='warning'>this email already exists...! </spna>";   
    
       }else  {
              
              $finalPassword=md5($password);

       $query="INSERT INTO admin_table (username,adminEmail,adminPassword,designation,AdminStatus) 
               VALUES('$username','$email','$finalPassword','$designation','$status')";
        $inserting=$this->db->insert($query);
        
        if ($inserting) {
            
            echo "<span class='success'>admin created successfully...! </spna>";
        }else{
            echo "<span class='warning'>admin creating fail...! </spna>";
        }


     
    }
      


       
}




//admin login

public function adminLogin($data){
       
  
    $adminEmail    = $this->secure->validation($data['logInEmail']);
    $adminPassword = $this->secure->validation($data['logInPassword']);
 


    $email     =mysqli_real_escape_string($this->db->link,$adminEmail);
    $password  =mysqli_real_escape_string($this->db->link,$adminPassword);
   
   if ( empty($email) || empty($password) ) {
     
           echo "<span class='warning'>field must not be empty...! </spna>";
   
   }elseif(filter_var($email,FILTER_VALIDATE_EMAIL)==false){
       
            echo "<span class='warning'>email address isn't valid..! </spna>";

   } else  {
           
           $finalPassword=md5($password);

   
        $query="SELECT * FROM admin_table WHERE adminEmail='$email' AND adminPassword='$finalPassword' ";
        $result=$this->db->select($query);
      
      
        if($result == true)
        {
            $value=$result->fetch_assoc();
                        
                        session::init();
                        session::set("login",true);
                        session::set("amdinId",$value['admin_id']);
                        session::set("adminName",$value['username']);
                        session::set("adminStatus",$value['adminStatus']);
                        header("location:dashboard.php");
        }else 
        {
            echo "<span class='warning'><strong>incorrect!</strong> username && password   </sapan>";
        }

  
 }
   


    
}






// password updatning

public function adminPasswordUpdate($data){
   

    $adminOldPass  =mysqli_real_escape_string($this->db->link,$data['oldpassword']);
    $adminNewPass =mysqli_real_escape_string($this->db->link,$data['newpassword'],);


    
    $adminOldPassword = $this->secure->validation($adminOldPass);
    $adminNewPassword = $this->secure->validation($adminNewPass);

   
   
 $chkPassword=$this->checkOldPassword($adminOldPassword);


    if (empty($adminOldPassword) || empty($adminNewPassword) ) {
        
        echo "<span class='warning'>field must not be empty...! </spna>";

   } elseif($chkPassword==false){
         
    echo "<span class='warning'>your old password isn't correct...! </spna>";   

   } else  { 

    $finalPassword =md5($adminNewPassword);

    $query="UPDATE admin_table SET adminPassword='$finalPassword' ";
    $updating=$this->db->update($query);
    
    
    if ($updating) {
            
        echo "<span class='success'>password chancged successfully..! </spna>";
    }else{
        echo "<span class='warning'>password changing fail...! </spna>";
    }


}

      

}



//checking email



private function checkOldEmail($email){
     
       $query="SELECT adminEmail FROM admin_table WHERE adminEmail= '$email'  ";
       $checking=$this->db->select($query);
       if ($checking == false) {
           return true;
       } else {
           return false;
       }
       



}





// checking password 

private function checkOldPassword($adminOldPassword){
    $oldPassword=md5($adminOldPassword);
       $query="SELECT adminPassword FROM admin_table WHERE adminPassword= '$oldPassword'  ";
       $checking=$this->db->select($query);
       if ($checking == false) {
           return true;
       } else {
           return false;
       }
       



}





//admin information update 

public function adminInforamtionUPdate($data,$id)
{

    $adminUsername = $this->secure->validation( $data['username']);
    $adminEmail    = $this->secure->validation( $data['email']);
 $adminDesignation = $this->secure->validation( $data['designation']);
    $adminStatus   = $this->secure->validation( $data['status']);


    $username  =mysqli_real_escape_string($this->db->link,$adminUsername);
    $email     =mysqli_real_escape_string($this->db->link,$adminEmail);
    $designation=mysqli_real_escape_string($this->db->link,$adminDesignation);
    $status    =mysqli_real_escape_string($this->db->link,$adminStatus);

   
    $query="UPDATE admin_table  SET username='$username',
                                    adminEmail   ='$email',
                                    designation='$designation',
                                    adminStatus  ='$status'
                                    
                                                     WHERE admin_id='$id' ";
    $updating=$this->db->update($query);
    if ($updating) {
            
        echo "<span class='success'>your information updated successfully...! </spna>";
    }else{
        echo "<span class='warning'>information updatin fail...! </spna>";
    }

                                                     


}




//get AllAdmin


public function getAllAdmin(){

       $query="SELECT * FROM admin_table ";
       $selecting=$this->db->select($query);
       if ($selecting) {
           return $selecting;
       }
}


//definate admin

public function getDefinateAdmin($adminId){

    $query="SELECT * FROM admin_table WHERE admin_id='$adminId' ";
    $selecting=$this->db->select($query);
    if ($selecting) {
        return $selecting;
    }




}


public function adminDelete($id){


      $query="DELETE FROM admin_table WHERE admin_id='$id' ";
      $deleting=$this->db->delete($query);
      
      if ($deleting) {
            
        echo "<span class='success'>one admin deleted successfully...! </spna>";

    }else{ 

        echo "<span class='warning'> user deleting fail...! </spna>";
    }



}

















    
}





?>