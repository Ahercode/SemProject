<?php include('parts/navbar.php') ?>

  <?php
    if(isset($_GET['id'])){
      
      $id = $_GET['id'];
      $sql = "SELECT * FROM tbl_food WHERE id=$id";
      $res = mysqli_query($con, $sql);

      //check if data is available in the database
      $count = mysqli_num_rows($res);

      //check if selected data is available
      if($count==1){

        $row=mysqli_fetch_assoc($res);

        
        $title=$row['title'];
        $descrip=$row['descrip'];
        $price=$row['price'];
        $current_image=$row['image'];
        $current_category_id=$row['categ_id'];
        $featured=$row['featured'];
        $active=$row['active'];

      }else{
      
        $_SESSION['categ-not-found'] = "<div class='error'>Food not found</div>";
        header("location:".HOMEPAGE_URL.'admi/food.php');
      }
        
    }else{

      header("location:".HOMEPAGE_URL.'admi/category.php');
    }
  ?>
  <div class="main-content">
    <div class="wrapper">
    <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-addCateg">
          <tr>
            <td>Title:</td>
            <td>
              <input type="text" name="title"  value="<?php echo $title;?>"/>
            </td>
          </tr>

          
          <tr>
            <td>Description:</td>
            <td>
              <textarea name="descrip" rows="5" cols="30"><?php if($descrip==""){echo "Enter a brief description of food here ";}else{echo $descrip;}?></textarea>
            </td>
          </tr>

          <tr>
            <td>Price:</td>
            <td>
              <input type="number" name="price" value="<?php echo $price?>"/>
            </td>
          </tr>


          <tr>
            <td>Current Image:</td>
            <td>
              <?php
                if($current_image!=""){
                  ?>
                  <img src="<?php echo HOMEPAGE_URL;?>images/food/<?php echo $current_image?>" width="100px">
                  <?php
                }else{
                  echo "<div class='error'>Image not added</div>";
                }
                  
              ?>
            </td>
          </tr>

          <tr>
            <td>Select Image:</td>
            <td>
              <input type="file" name="image"/>
            </td>
          </tr>

          <tr>
            <td>Category: </td>
            <td>
              <select name="categ_id">
                <?php

                  $sql1="SELECT * FROM tbl_categ WHERE active='Yes'";

                  $res1=mysqli_query($con,$sql1);

                  $count=mysqli_num_rows($res);

                  if($count>0){
                      //when we have categories
                    while ($rows=mysqli_fetch_assoc($res1)) {

                      //fetch category info

                      $categ_id=$rows['id'];
                      $title=$rows['title'];

                      ?>
                        <!--display all categories with active Yes-->
                        <option <?php if($current_category_id==$categ_id){echo "selected";} ?> value="<?php echo $categ_id;?>"><?php echo $title;?></option>
                      <?php

                    }
                  }else{
                    //when we don't have categories
                    ?>
                    <option value="<?php echo $categ_id?>">No category found</option>
                    <?php
                  }
                ?>
              </select>
            </td>
          </tr>

          <tr>
            <td>Featured:</td>
            <td>
              <input <?php if($featured=="Yes") echo "checked"?> type="radio" name="featured"  value="Yes"/>Yes
              <input <?php if($featured=="No") echo "checked"?> type="radio" name="featured"  value="No"/>No
            </td>
          </tr>


          <tr>
            <td>Active:</td>
            <td>
              <input <?php if($active=="Yes") echo "checked"?>  type="radio" name="active"  value="Yes"/>Yes
              <input <?php if($active=="No") echo "checked"?>  type="radio" name="active"  value="No"/>No
            </td>
          </tr> 

          <tr>
            <td colspan="2">
              <input type="hidden" name="current_image" value="<?php echo $current_image ?>" >
              <input type="hidden" name="id" value="<?php echo $id ?>" >
              <input type="submit" name="submit" value="Update Food" class="btn-update">
            </td>
          </tr>
        </table>
      </form>

      <?php

        if(isset($_POST['submit'])){

          $id=$_POST['id'];
          $title=$_POST['title'];
          $descrip=$_POST['descrip'];
          $price=$_POST['price'];
          $current_image=$_POST['current_image'];
          $categ_id=$_POST['categ_id'];
          $featured=$_POST['featured'];
          $active=$_POST['active'];

          //updating the new image
          if(isset($_FILES['image']['name'])){

            $image = $_FILES['image']['name'];

            if($image!=""){
              //get extention of image
              $rename = end(explode('.',$image));
              //auto change image name to a prefered name
              $image="food_".rand(000,999).'.'.$rename;

              $source=$_FILES['image']['tmp_name'];

              $destination="../images/food/".$image;

              

              //upload image
              $upload=move_uploaded_file($source,$destination);

              //check if image is uploaded or not
              if($upload==FALSE){

              $_SESSION['upload'] = "<div class='error'>Failed to upload image</div> ";

              //go back to manage admins page
              header("location:".HOMEPAGE_URL.'admi/food.php');
              die();
                
              }

              //remove current image from path/location
              //but first we have to check if current image is not empty
              if($current_image!=""){

                $remove_path="../images/food/".$current_image;

                $remove=unlink($remove_path);

                //check if image is removed successfully or not
                if($remove==FALSE){
    
                $_SESSION['remove2'] = "<div class='error'>Could not remove current image</div>";
                header("location:".HOMEPAGE_URL.'admi/food.php');
      
                die();
                }
              }
              
            }else{
              //also if the select new image is been clicked but no image uploaded then we keep current image
              $image=$current_image;
            }

          }else{
            //if no new image is been selected then we keep the current image
            $image = $current_image;
          }

          $sql2 = "UPDATE tbl_food SET
            title='$title',
            descrip='$descrip',
            price='$price',
            image='$image',
            categ_id ='$categ_id',
            featured='$featured',
            active='$active'
            WHERE id='$id'
          
          ";

          $res2= mysqli_query($con, $sql2);

          if($res2==TRUE){
            $_SESSION['update'] = "<div class='success'>Food updated successfully</div>";

            header("location:".HOMEPAGE_URL.'admi/food.php');
          }else{
            $_SESSION['update'] = "<div class='error'>Food update fail</div>";

            header("location:".HOMEPAGE_URL.'admi/food.php');
          }
        }
      ?>

    </div>
  </div>
<?php include('parts/footer.php') ?>