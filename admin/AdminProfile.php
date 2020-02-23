<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>admin profile</h2>

     <?php   
   
   if (isset($_GET['delete_AdminId']) && isset($_GET['delete_AdminId'])!=NULL   ) 
       
{ 

    $adminId=$_GET['delete_AdminId'];

       $delete=$admin->adminDelete($adminId);

       if($delete){
           
           return $delete;
       }
        

   }


    ?>

        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
                    <th width="10%" >Serial</th>
                    <th width="10%" >Admin_id</th>
					<th width="20%" >userName</th>
					<th width="30%" >Email</th>
					<th width="10%" >Designation</th>
					<th width="20%" >Action</th>
				</tr>
			</thead>
			<tbody>
	<?php
                
				$get_admin=$admin->getAllAdmin();

                if($get_admin){ 

                      $i=0;

                while ($result=$get_admin->fetch_assoc()) {

                	$i++;

                 
    ?>
				<tr class="odd gradeX">

					<td><?php echo $i; ?></td>
					<td><?php echo $result['admin_id'] ; ?></td>
					<td><?php echo $result['username'] ; ?></td>
					<td><?php echo  $result['adminEmail'] ?></td>
                  
                    <td><?php echo $result['designation'] ; ?></td>
					
                    <td><a href="editAdminProfile.php?editAdminId=<?php echo $result['admin_id']; ?> " >Edit</a> || 
                    <a onclick="return confirm('Are you sure to Delete');" href="?delete_AdminId=<?php echo $result['admin_id']; ?>">Delete</a></td>
				</tr>

			<?php 
             
               }
            }
			 ?>
							</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
