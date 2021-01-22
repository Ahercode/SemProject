<?php include('parts/navbar.php'); ?>
  <div class="main-content">
    <div class="wrapper">
      <h1>Add Category</h1>
      <br><br>
      <?php
        if(isset($_SESSION['add'])){
          echo $_SESSION['add'];
          unset($_SESSION['add']);
        }

        if(isset($_SESSION['upload'])){
          echo $_SESSION['upload'];
          unset($_SESSION['upload']);
        }
      ?>
      <br><br>
      
      <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-addCateg">
          <tr>
            <td>Title:</td>
            <td>
              <input type="text" name="title"  placeholder="Title"/>
            </td>
          </tr>

          
          <tr>
            <td>Select Image:</td>
            <td>
              <input type="file" name="image"/>
            </td>
          </tr>

          <tr>
            <td>Featured:</td>
            <td>
              <input type="radio" name="featured"  value="Yes"/>Yes
              <input type="radio" name="featured"  value="No"/>No
            </td>
          </tr>


          <tr>
            <td>Active:</td>
            <td>
              <input type="radio" name="active"  value="Yes"/>Yes
              <input type="radio" name="active"  value="No"/>No
            </td>
          </tr>

          <tr>
            <td colspan="2">
              <input type="submit" name="submit" value="Add Category" class="btn-update">
            </td>
          </tr>
        </table>
      </form>

      <?php

        if(isset($_POST['submit'])){

          $title = $_POST['title'];

          if(isset($_POST['featured'])){

            $featured=$_POST['featured'];

          }else{

            $featured="No";
            
          }

          //check to see if the radio button is clicked
          if(isset($_POST['active'])){

            //if it's clicked then we set it to the clicked button
            $active=$_POST['active'];

          }else{
            //default if should be no
            $active="No";

          }

          //for the image upload
          if(isset($_FILES['image']['name'])){

            $image=$_FILES['image']['name'];
            
            if($image!=""){
              
              //get extention of image
              $rename = end(explode('.',$image));
              //auto change image name to a prefered name
              $image="category_".rand(000,999).'.'.$rename;

              $source=$_FILES['image']['tmp_name'];

              $destination="../images/category/".$image;

              

              //upload image
              $upload=move_uploaded_file($source,$destination);

              //check if image is selected or not
              if($upload==FALSE){
                $_SESSION['upload'] = "<div class='error'>Failed to upload image</div> ";

              //go back to manage admins page
              header("location:".HOMEPAGE_URL.'admi/add-category.php');
              }
            }
          }
          else{
            $image="";
          }

          $sql ="INSERT INTO tbl_categ SET
          title='$title',
          image='$image',
          featured='$featured',
          active='$active'
          ";

          $res=mysqli_query($con, $sql);

            //to display success message
          if($res==TRUE){
            $_SESSION['add'] = "<div class='success'>Category added successfully</div>";

            //go back to manage admins page
            header("location:".HOMEPAGE_URL.'admi/category.php');
          }else {
            $_SESSION['add'] = "<div clas='error'>Failed to add category</div> ";

            //go back to manage admins page
            header("location:".HOMEPAGE_URL.'admi/add-category.php');
          }
        }
      
      ?>

    </div>
  </div>
<?php include('parts/footer.php'); ?>