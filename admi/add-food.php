<?php include('parts/navbar.php'); ?>
  <div class="main-content">
    <div class="wrapper">
      <h1>Add Food</h1>
      <br>
      <?php

        if(isset($_SESSION['upload'])){

          echo $_SESSION['upload'];
          unset($_SESSION['upload']);

        }      
        if(isset($_SESSION['add'])){

          echo $_SESSION['add'];
          unset($_SESSION['add']);

        }      
      ?>

      <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-addCateg">
          <tr>
            <td>Title:</td>
            <td>
              <input type="text" name="title"  placeholder="Title"/>
            </td>
          </tr>

          
          <tr>
            <td>Description:</td>
            <td>
              <textarea name="descrip" rows="5" cols="30" placeholder="Enter a brief description of food here "></textarea>
            </td>
          </tr>

          <tr>
            <td>Price:</td>
            <td>
              <input type="number" name="price" />
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

                  $sql="SELECT * FROM tbl_categ WHERE active='Yes'";

                  $res=mysqli_query($con,$sql);

                  $count=mysqli_num_rows($res);

                  if($count>0){
                      //when we have categories
                    while ($rows=mysqli_fetch_assoc($res)) {

                      //fetch category info

                      $id=$rows['id'];
                      $title=$rows['title'];

                      ?>
                        <!--display all categories with active Yes-->
                        <option value="<?php echo $id;?>"><?php echo $title;?></option>
                      <?php

                    }
                  }else{
                    //when we don't have categories
                    ?>
                    <option value="<?php echo $id?>">No category found</option>
                    <?php
                  }
                ?>
              </select>
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
              <input type="submit" name="submit" value="Add Food" class="btn-update">
            </td>
          </tr>
        </table>
      </form>

      <?php

        if(isset($_POST['submit'])){

          //$id=$_POST['id'];
          $title=$_POST['title'];
          $descrip=$_POST['descrip'];
          $price=$_POST['price'];
          $category=$_POST['categ_id'];

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
              $image="food_".rand(0000,9999).'.'.$rename;

              $source=$_FILES['image']['tmp_name'];

              $destination="../images/food/".$image;

              

              //upload image
              $upload=move_uploaded_file($source,$destination);

              //check if image is selected or not
              if($upload==FALSE){
                $_SESSION['upload'] = "<div class='error'>Failed to upload image</div> ";

              //go back to manage admins page
              header("location:".HOMEPAGE_URL.'admi/add-food.php');
              }
            }
          }
          else{
            $image="";
          }

          $sql2 ="INSERT INTO tbl_food SET
          title='$title',
          descrip='$descrip',
          price='$price',
          image='$image',
          categ_id='$categ_id',
          featured='$featured',
          active='$active'
          ";

          $res2=mysqli_query($con, $sql2);

            //to display success message
          if($res2==TRUE){
            $_SESSION['add'] = "<div class='success'>Food added successfully</div>";

            //go back to manage admins page
            header("location:".HOMEPAGE_URL.'admi/food.php');
          }else {
            $_SESSION['add'] = "<div class='error'>Failed to add food</div> ";

            //go back to manage admins page
            header("location:".HOMEPAGE_URL.'admi/add-food.php');
          }
        }
      ?>
    </div>
  </div>
<?php include('parts/footer.php'); ?>