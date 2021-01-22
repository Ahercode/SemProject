<?php include('parts/navbar.php') ?>
  <?php
    $id = $_GET['id'];
    $sql = "SELECT * FROM tbl_admin WHERE id=$id";
    $res = mysqli_query($con, $sql);

    if($res==TRUE){

      //check if data is available in the database
      $count = mysqli_num_rows($res);

      //check if selected data is available
      if($count==1){

        $row=mysqli_fetch_assoc($res);

        
        $full_name=$row['full_name'];
        $username=$row['username'];
      }else{
      
        //$_SESSION['delete'] = "<div class='error'>Admin update failed</div>";
        header("location:".HOMEPAGE_URL.'admi/admins.php');
      }
      
    }
  ?>
  <div class="main-content">
    <div class="wrapper">
    <h1>Update Admin</h1>
      <form action="" method="POST">
        <table class="tbl-updateAdmin">

          <tr>
            <td>Full Name:</td>
            <td>
              <input type="text" name="full_name" value="<?php echo $full_name;?>">
            </td>
          </tr>

          <tr>
            <td>Username:</td>
            <td>
              <input type="text" name="username" value="<?php echo $username; ?>">
            </td>
          </tr>

          <tr>
            <td colspan="2">
              <!--- hide id -->
              <input type="hidden" name="id" value="<?php echo $id?>">
              <input type="submit" name="submit" value="Update Admin" class="btn-update">
            </td>
          </tr>

        </table>
      </form>
    </div>
  </div>

<?php
  //Listen to click and update the admin
  if(isset($_POST['submit'])){

    $id=$row['id'];
    $full_name=$_POST['full_name'];
    $username=$_POST['username'];

    $sql = "UPDATE tbl_admin SET
    full_name='$full_name',
    username='$username'
    WHERE id=$id
    ";

    $res = mysqli_query($con, $sql);

    if($res==TRUE){
      $_SESSION['update'] = "<div class='success'>Admin updated successfully</div>";
  
      //go back to manage admins page
      header("location:".HOMEPAGE_URL.'admi/admins.php');
    }else {
      $_SESSION['update'] = "<div class='error'>Failed to update admin</div> ";
  
      //go back to manage admins page
      header("location:".HOMEPAGE_URL.'admi/update-admin.php');
    }
  }
?>
  
<?php include('parts/footer.php') ?>