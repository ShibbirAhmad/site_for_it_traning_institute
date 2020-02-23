<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>


   

   
<div class="grid_10">
    <div class="box round first grid">
        <h2>Create Admin</h2>
       
        <div class="block">  
             
         <form action="" method="post">
            <table class="form">
            <?php   
   
   if (!isset($_GET['editAdminId']) && isset($_GET['editAdminId'])==NULL   ) {
       
    echo" <scrtipt>window.location='adminProfile.php'</scrtipt>";

   }else{ 


   
    $adminId=$_GET['editAdminId'];
        
    if ($_SERVER['REQUEST_METHOD']=="POST" &&  isset($_POST['update'])  ) {
           
           $adminDataSending=$admin->adminInforamtionUPdate($_POST,$adminId);
    
           if ($adminDataSending) {
              
                return $adminDataSending;
           }
    
    }
    
        

        $get_admin=$admin->getDefinateAdmin($adminId);

                if($get_admin){ 

                while ($result=$get_admin->fetch_assoc()) {
   
   ?>
					
                <tr> 
                    <td>
                        <label>username</label>
                    </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $result['username']; ?>" class="medium" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result['adminEmail']; ?>"  name="email" class="medium" />
                    </td>
                </tr>
                 
        <?php   $power=session::get('adminStatus');
                if($power == '1' ){
                
    
                ?>                
              
                  <tr>
                    <td>
                        <label>Designation</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result['designation']; ?>"  name="designation" class="medium" />
                    </td>
                </tr> 

                 <tr>
                    <td>
                        <label>Status</label>
                    </td>
                    <td>'
                        <input type=text" value="<?php echo $result['adminStatus']; ?>"  name="status" class="medium" />
                    </td>
                </tr> 

                <?php } ?>
                
				 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="update" Value="update" />
                    </td>
                </tr>
            </table>

            <?php  }  }  } ?>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>