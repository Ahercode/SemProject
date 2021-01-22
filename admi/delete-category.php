<?php
  include('../config/connection.php');

  //get both id and image
  if(isset($_GET['id']) AND isset($_GET['image'])){

    $id = $_GET['id'];
    $image = $_GET['image'];

    //check for image and delete it
    if($image!=""){
      //location of image
      $path="../images/category/".$image;

      //remove image from path/location
      $remove=unlink($path);
      //if fail to remove image from path/location
      if($remove==FALSE){
    
          $_SESSION['remove'] = "<div class='error'>Could not remove image</div>";
          header("location:".HOMEPAGE_URL.'admi/category.php');

          //die();
      }
    }

    //sql query to delete admin
    $sql = "DELETE FROM tbl_categ WHERE id=$id";

    //execute query
    $res = mysqli_query($con, $sql);

    //check for successful deletion or not
    if($res==TRUE){
      $_SESSION['delete'] = "<div class='success'>category deleted successfully</div>";
      header("location:".HOMEPAGE_URL.'admi/category.php');
    }else{
      
      $_SESSION['delete'] = "<div class='error'>Category deletion failed</div>";
      header("location:".HOMEPAGE_URL.'admi/category.php');
    }

  }else{
    
    $_SESSION['delete'] = "<div class='error'>Category deletion failed</div>";
    header("location:".HOMEPAGE_URL.'admi/category.php');
  }
?>