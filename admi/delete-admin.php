<?php
  include('../config/connection.php');
  //get id of admin
  $id = $_GET['id'];

  //sql query to delete admin
  $sql = "DELETE FROM tbl_admin WHERE id=$id";

  //execute query
  $res = mysqli_query($con, $sql);

  //check for successful deletion or not
  if($res==TRUE){
    $_SESSION['delete'] = "<div class='success'>Admin deleted successfully</div>";
    header("location:".HOMEPAGE_URL.'admi/admins.php');
  }else{
    
    $_SESSION['delete'] = "<div class='error'>Admin deletion failed</div>";
    header("location:".HOMEPAGE_URL.'admi/admins.php');
  }
?>