<?php include('parts/navbar.php');?>

  <!--main content-->     
  <div class="main-content">
      <div class="wrapper">
        <h1>Manage Foods</h1>

        <br><br>
        <a href="add-food.php" class="btn-add"> Add Food</a>
        <br><br>
        <?php

          if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
          }
          if(isset($_SESSION['img-upload'])){
            echo $_SESSION['img-upload'];
            unset($_SESSION['img-upload']);
          }
          if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
          }
          if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
          }

        ?>

        <table class="tbl">
          <tr>
            <th>Index</th>
            <th>Title</th>
            <th>Price</th>
            <th>Image</th>
            <th>Featured</th>
            <th>Active</th>
            <th>Actions</th>
          </tr>
          <?php

            $sql="SELECT * FROM tbl_food";
            $res=mysqli_query($con,$sql);

            if($res==TRUE){

              $count=mysqli_num_rows($res);

              $index=1;
              if($count>0){

                while($rows=mysqli_fetch_assoc($res)){

                  $id=$rows['id'];
                  $title=$rows['title'];
                  $price=$rows['price'];
                  $image=$rows['image'];
                  $featured=$rows['featured'];
                  $active=$rows['active'];

                  ?>

                    <tr>
                      <td><?php echo $index++;?></td>

                      <td><?php echo $title;?></td>

                      <td>Ghc<?php echo $price;?>.00</td>

                      <td>
                        <?php
                        if($image!=""){
                          ?>
                          <img src="<?php echo HOMEPAGE_URL;?>images/food/<?php echo $image?>" width="100px">
                          <?php
                        }else{
                          echo "<div class='error'>Image not added</div>";
                        }
                            
                        ?>
                      </td>

                      <td><?php echo $featured;?></td>

                      <td><?php echo $active;?></td>
                      <td>
                        <a href="<?php echo HOMEPAGE_URL;?>admi/update-food.php?id=<?php echo $id; ?>" class="btn-update">Update</a>
                        <a href="<?php echo HOMEPAGE_URL;?>admi/delete-food.php?id=<?php echo $id;?>&image=<?php echo $image ?>" class="btn-delete">Delete</a>
                      </td>
                    </tr>
                  <?php
                }

              }else{
                //when data is not in the database yet
                echo "<tr><td colspan='7' class='error'>No food has been added yet. Click on the Add Food Button above to add a food </td></tr>";
              }
            }
            
          ?>
          
          
        </table>
        
      </div>
</div>

<?php include('parts/footer.php');?>