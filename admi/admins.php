<?php include('parts/navbar.php') ?>
    
    <!--main content-->
    <div class="main-content">
      <div class="wrapper">
        <h1>Manage Admins</h1>
        <br>
        <?php
        //show success message for adding admin 
          if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
          }
        //show success message for deleting admin
          if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
          }
        //show success message for updating admin
          if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
          }
        //show success message for changing password
          if(isset($_SESSION['userNot'])){
            echo $_SESSION['userNot'];
            unset($_SESSION['userNot']);
          }
          if(isset($_SESSION['changePass'])){
            echo $_SESSION['changePass'];
            unset($_SESSION['changePass']);
          }
          
        ?>
        <br><br> 
        <a href="add-admin.php" class="btn-add"> Add Admin</a>
        <br><br><br>
        <table class="tbl">
          <tr>
            <th>Index</th>
            <th>Full Name</th>
            <th>Username</th>
            <th>Actions</th>
          </tr>

          <?php
          //get all admin
            $sql ="SELECT * FROM tbl_admin";

            $res = mysqli_query($con, $sql);

            
            if($res==TRUE){
              //count rows
              $count = mysqli_num_rows($res);// get all rows in database

              $sn = 1; 
              //how many rows are there in the database
              if($count>0){
                //we have data in the database
                while($rows=mysqli_fetch_assoc($res)){

                  //display values in table

                  $id =$rows['id'];
                  $full_name=$rows['full_name'];
                  $username=$rows['username'];

                  ?>
                    <tr>
                      <td><?php echo $sn++; ?></td>
                      <td><?php echo $full_name; ?></td>
                      <td><?php echo $username; ?></td>
                      <td>
                          <!--getting id of admin to be deleted-->
                        <a href="<?php echo HOMEPAGE_URL;?>admi/update-admin.php?id=<?php echo $id?>" class="btn-update">Update</a>
                          <!--getting id of admin to be deleted-->
                        <a href="<?php echo HOMEPAGE_URL;?>admi/change-password.php?id=<?php echo $id?>" class="btn-change">Change Password</a>
                          <!--getting id of admin to be deleted-->
                        <a href="<?php echo HOMEPAGE_URL;?>admi/delete-admin.php?id=<?php echo $id;?>" class="btn-delete">Delete</a>
                      </td>
                    </tr>

                  <?php

                }
              }else{
                //when data is not in the database yet
                echo "<tr><td colspan='7' class='error'>No Admin Added Yet.!!! </td></tr>";
              }
            }
          
          ?>
          
          
        </table>
      </div>
    </div>

<?php include('parts/footer.php');?>