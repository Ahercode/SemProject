<?php include('parts/navbar.php') ?>

  <?php
    if(isset($_GET['id'])){
      
      $id = $_GET['id'];
      $sql = "SELECT * FROM tbl_order WHERE id=$id";
      $res = mysqli_query($con, $sql);

      //check if data is available in the database
      $count = mysqli_num_rows($res);

      //check if selected data is available
      if($count==1){

        $row=mysqli_fetch_assoc($res);

        
        $food=$row['food'];
        $price=$row['price'];
        $quantity=$row['quantity'];
        $status=$row['status'];
        $cus_name=$row['cus_name'];
        $cus_email=$row['cus_email'];
        $cus_address=$row['cus_address'];
        $cus_contact=$row['cus_contact'];
        

      }else{
      
        $_SESSION['categ-not-found'] = "<div class='error'>Food not found</div>";
        header("location:".HOMEPAGE_URL.'admi/order.php');
      }
        
    }else{

      header("location:".HOMEPAGE_URL.'admi/order.php');
    }
  ?>
  <div class="main-content">
    <div class="wrapper">
    <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-addCateg">
          <tr>
            <td>Food:</td>
            <td>
              <b><?php echo $food;?></b>
            </td>
          </tr>
          <tr>
            <td>Price:</td>
            <td>
            <b>Ghc <?php echo $price;?>.00</b>
            </td>
          </tr>

          
          <tr>
            <td>Quantity: </td>
            <td>
              <input type="number" name="quantity" value="<?php echo $quantity ?>"/>
            </td>
          </tr>

          <tr>
            <td>Status: </td>
            <td>
              <select name="status">
                
                    <option <?php if($status=="Ordered"){ echo "selected";}?> value="Ordered">Ordered</option>
                    <option <?php if($status=="OnDelivery"){ echo "selected";}?>  value="OnDelivery">OnDelivery</option>
                    <option <?php if($status=="Delivered"){ echo "selected";}?>  value="Delivered">Delivered</option>
                    <option <?php if($status=="Cancelled"){ echo "selected";}?>  value="Cancelled">Cancelled</option>
                   
              </select>
            </td>
          </tr>

          <tr>
            <td>Customer name: </td>
            <td>
              <input type="text" name="cus_name" value="<?php echo $cus_name ?>"/>
            </td>
          </tr>

          <tr>
            <td>Customer Email: </td>
            <td>
              <input type="text" name="cus_email" value="<?php echo $cus_email ?>"/>
            </td>
          </tr>

          <tr>
            <td>Customer Address: </td>
            <td>
              <textarea name="cus_address" col="30" row="5" value=""><?php if($cus_address==""){echo "Enter a brief description of food here ";}else{echo $cus_address;}?></textarea>
            </td>
          </tr>

          <tr>
              <td>Customr Contact: </td>
              <td>
                  <input type="text" name="cus_contact" value="<?php echo $cus_contact ?>"/>
              </td>
          </tr>

         

          <tr>
            <td colspan="2">
             
              <input type="hidden" name="id" value="<?php echo $id ?>" >
              <input type="hidden" name="price" value="<?php echo $price ?>" >
              <input type="submit" name="submit" value="Update Order" class="btn-update">
            </td>
          </tr>
        </table>
      </form>

      <?php

        if(isset($_POST['submit'])){

        $id=$_POST['id'];
        $price=$_POST['price'];
        $quantity=$_POST['quantity'];

        $total = $price * $quantity;

        $status=$_POST['status'];
        $cus_name=$_POST['cus_name'];
        $cus_email=$_POST['cus_email'];
        $cus_address=$_POST['cus_address'];
        $cus_contact=$_POST['cus_contact'];
     
          $sql2 = "UPDATE tbl_order SET
            quantity=$quantity,
            total=$total,
            status='$status',
            cus_name='$cus_name',
            cus_email='$cus_email',
            cus_address='$cus_address',
            cus_contact='$cus_contact'
            WHERE id=$id
          
          ";

          $res2= mysqli_query($con, $sql2);

          if($res2==TRUE){
            $_SESSION['update'] = "<div class='success'>Order updated successfully</div>";

            header("location:".HOMEPAGE_URL.'admi/order.php');
          }else{
            $_SESSION['update'] = "<div class='error'>Order update fail</div>";

            header("location:".HOMEPAGE_URL.'admi/order.php');
          }
        }
      ?>

    </div>
  </div>
<?php include('parts/footer.php') ?>