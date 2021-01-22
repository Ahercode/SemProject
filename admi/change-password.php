<?php include('parts/navbar.php') ?>

<div class="main-content">
    <div class="wrapper">
    <h1>Update Admin</h1>
    <br>
    <?php 
      if(isset($_GET['id'])){
        $id=$_GET['id'];
      }
    ?>

    <?php
      if(isset($_SESSION['PassNot'])){
        echo $_SESSION['PassNot'];
        unset($_SESSION['PassNot']);
      }
    ?>

    <br>
    <br>
      <form action="" method="POST">
        <table class="tbl-changePass">

          <tr>
            <td>Current Password:</td>
            <td>
            <input type="password" name="current_password" placeholder="enter current password">
            </td>
          </tr>

          <tr>
            <td>New Password:</td>
            <td>
              <input type="password" name="new_password" placeholder="enter new password">
            </td>
          </tr>
          <tr>
            <td>New Password:</td>
            <td>
              <input type="password" name="confirm_password" placeholder="confirm password">
            </td>
          </tr>

          <tr>
            <td colspan="2">
              <!--- hide id -->
              <input type="hidden" name="id" value="<?php echo $id?>">
              <input type="submit" name="submit" value="Update Admin" class="btn-change">
            </td>
          </tr>

        </table>
      </form>
    </div>
  </div>

<?php
  //Listen to click and update the admin
  if(isset($_POST['submit'])){

    $id=$_POST['id'];
    $current_password=md5($_POST['current_password']);
    $new_password=md5($_POST['new_password']);
    $confirm_password=md5($_POST['confirm_password']);

    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

    $res = mysqli_query($con, $sql);
    if($res==TRUE){

      $count = mysqli_num_rows($res);

      if($count==1){

        if($new_password==$confirm_password){

          #update to the new password
          $sql2 = "UPDATE tbl_admin SET
          password = '$new_password'
          WHERE id=$id
          ";

          $res2 = mysqli_query($con, $sql2);

          if($res2==TRUE){
            # when password is been changed successfully
          $_SESSION['changePass'] = "<div class='success'>Password has been changed successfully</div> ";
          header("location:".HOMEPAGE_URL.'admi/admins.php');
          }else{
            # when password could not be change
          $_SESSION['changePass'] = "<div class='error'>Counld not change password</div> ";
          header("location:".HOMEPAGE_URL.'admi/admins.php');
          }

        }else {
          # when password does not march
          $_SESSION['PassNot'] = "<div class='error'>Password does not match</div> ";
          header("location:".HOMEPAGE_URL.'admi/change-password.php');
        }

      }else{
        //when user is not in database
        $_SESSION['userNot'] = "<div class='error'> Admin does not exists </div> ";
        header("location:".HOMEPAGE_URL.'admi/admins.php');
      }
    }

    
  }
?>
<?php include('parts/footer.php') ?>