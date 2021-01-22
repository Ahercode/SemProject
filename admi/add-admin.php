<?php include('parts/navbar.php'); ?>



  <div class="main-content">
    <div class="wrapper">
      <h1>Add Admin</h1>
      <br>
      <?php
          if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
          }
      ?>
      <br>
      <form action="" method="POST">
        <table class="tbl-addAdmin">

          <tr>
            <td>Full Name:</td>
            <td>
              <input type="text" name="full_name" placeholder="enter full name">
            </td>
          </tr>

          <tr>
            <td>Username:</td>
            <td>
              <input type="text" name="username" placeholder="enter username">
            </td>
          </tr>

          <tr>
            <td>Password:</td>
            <td>
              <input type="password" name="password" placeholder="enter password">
            </td>
          </tr>

          <tr>
            <td colspan="2">
              <input type="submit" name="submit" value="Add Admin" class="btn-update">
            </td>
          </tr>

        </table>
      </form>
    </div>
  </div>
<?php include('parts/footer.php'); ?>



<!---- Back End Part------>
<?php

if(isset($_POST['submit'])){

  //echo "Button clicked";
  //push data from form
  $fullname = $_POST['full_name'];
  $username = $_POST['username'];
  $password = md5($_POST['password']); // encrypt password with md5

  //query to save data in database
  $sql = "INSERT INTO tbl_admin SET
   full_name='$fullname',
   username = '$username',
   password = '$password'
  ";

  //submit inputs to database
  $res = mysqli_query($con,$sql)or die(mysqli_error('could not add admin'));

    //to display success message
  if($res==TRUE){
    $_SESSION['add'] = "<div class='success'>Admin added successfully</div>";

    //go back to manage admins page
    header("location:".HOMEPAGE_URL.'admi/admins.php');
  }else {
    $_SESSION['add'] = "<div class='error'>Failed to add admin</div> ";

    //go back to manage admins page
    header("location:".HOMEPAGE_URL.'admi/add-admin.php');
  }
}
?>