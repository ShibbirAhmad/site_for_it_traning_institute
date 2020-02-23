<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Create Admin</h2>
        <div class="block">  
<?php
        
if ($_SERVER['REQUEST_METHOD']=="POST" &&  isset($_POST['submit'])  ) {
	   
	   $adminDataSending=$admin->adminCreate($_POST);

	   if ($adminDataSending) {
		  
		    return $adminDataSending;
	   }

}


?>             
         <form action="" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <label>username</label>
                    </td>
                    <td>
                        <input type="text" placeholder="username"  name="username" class="medium" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input type="text" placeholder="admin email"  name="email" class="medium" />
                    </td>
                </tr>

                	 <tr>
                    <td>
                        <label>Password</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Enter strong Password..." name="password" class="medium" />
                    </td>
                </tr>
				 

                  <tr>
                    <td>
                        <label>Designation</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Designation"  name="designation" class="medium" />
                    </td>
                </tr> 

                  <tr>
                    <td>
                        <label>Status</label>
                    </td>
                    <td>
                        <input type="text" placeholder="status number"  name="status" class="medium" />
                    </td>
                </tr>

				
				 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="submit" Value="Create" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>