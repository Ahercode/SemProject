<?php include('parts/navbar.php');?>

  <!--main content-->
  <div class="main-content">
      <div class="wrapper">
        <h1>Manage Category</h1>
        <br>

        <?php
        //for successfully adding category
        if(isset($_SESSION['add'])){

          echo $_SESSION['add'];
          unset($_SESSION['add']);

        }

        //show success message for deleting category
        if(isset($_SESSION['delete'])){
          echo $_SESSION['delete'];
          unset($_SESSION['delete']);
        }

        //show success message for deleting image
        if(isset($_SESSION['remove'])){
          echo $_SESSION['remove'];
          unset($_SESSION['remove']);
        }
        //show success message for deleting current image
        if(isset($_SESSION['remove2'])){
          echo $_SESSION['remove2'];
          unset($_SESSION['remove2']);
        }
        //show success message for updating category
        if(isset($_SESSION['update'])){
          echo $_SESSION['update'];
          unset($_SESSION['update']);
        }
        //show success message for updating image
        if(isset($_SESSION['upload'])){
          echo $_SESSION['upload'];
          unset($_SESSION['upload']);
        }
        ?>
        <br>
        <a href="<?php echo HOMEPAGE_URL;?>admi/add-category.php" class="btn-add"> Add Category</a>
        <br><br><br>
        <table class="tbl">
          <tr>
            <th>Index</th>
            <th>Title</th>
            <th>Image</th>
            <th>Featured</th>
            <th>Active</th>
            <th>Actions</th>
          </tr>
          <?php
          //get all admin
            $sql ="SELECT * FROM tbl_categ";

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
                  $title=$rows['title'];
                  $image=$rows['image'];
                  $featured=$rows['featured'];
                  $active=$rows['active'];

                  ?>
                    <tr>
                      <td><?php echo $sn++; ?></td>
                      <td><?php echo $title; ?></td>

                      <td>
                        <?php
                        if($image!=""){
                          ?>
                          <img src="<?php echo HOMEPAGE_URL;?>images/category/<?php echo $image?>" width="100px">
                          <?php
                        }else{
                          echo "<div class='error'>Image not added</div>";
                        }
                            
                        ?>
                      </td>

                      <td><?php echo $featured; ?></td>
                      <td><?php echo $active; ?></td>
                      <td>
                          <!--getting id of admin to be deleted-->
                        <a href="<?php echo HOMEPAGE_URL;?>admi/update-category.php?id=<?php echo $id?>" class="btn-update">Update</a>
                          <!--getting id of admin to be deleted-->
                        <a href="<?php echo HOMEPAGE_URL;?>admi/delete-category.php?id=<?php echo $id;?>&image=<?php echo $image ?>" class="btn-delete">Delete</a>
                      </td>
                    </tr>

                  <?php

                }
              }else{
                //when data is not in the database yet
                echo "<tr><td colspan='7' class='error'>Categories not added yet.!!! </td></tr>";
              }
            }
          
          ?>
        </table>
        
      </div>
    
</div>
<?php include('parts/footer.php');?>