<?php include('parts/navbar.php');?>

  <!--main content-->
  <div class="main-content">
      <div class="wrapper">
        <h1>Manage Orders</h1>
        <br>
        <?php

          if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
          }

        ?>
        <table class="tbl">
        <tr>
            <th>Index</th>
            <th>Food</th>
            <th>Price</th>
            <th>Qty </th>
            <th>Total </th>
            <th>Date </th>
            <th>Status </th>
            <th>Name </th>
            <th>Email </th>
            <th>Address </th>
            <th>Contact </th>
           
            
            <?php

              $sql="SELECT * FROM tbl_order";
              $res=mysqli_query($con,$sql);

              if($res==TRUE){

                $count=mysqli_num_rows($res);

                $index=1;
                if($count>0){

                  while($rows=mysqli_fetch_assoc($res)){

                    $id=$rows['id'];
                    $food=$rows['food'];
                    $price=$rows['price'];
                    $quantity=$rows['quantity'];
                    $total=$rows['total'];
                    $date=$rows['date'];
                    $status=$rows['status'];
                    $cus_name=$rows['cus_name'];
                    $cus_email=$rows['cus_email'];
                    $cus_address=$rows['cus_address'];
                    $cus_contact=$rows['cus_contact'];

                    ?>

                      <tr>
                        <td><?php echo $index++;?></td>

                        <td><?php echo $food;?></td>

                        <td>Ghc<?php echo $price;?>.00</td>

                        <td><?php echo $quantity; ?></td>

                        <td><?php echo $total;?></td>

                        <td><?php echo $date;?></td>

                        <td>
                            <?php

                            if($status=="Ordered"){
                              echo "<label>$status</label>";
                            }
                            elseif($status=="OnDelivery"){
                              echo "<label style='color:orange;'>$status</label>";
                            }
                            elseif($status=="Delivered"){
                              echo "<label style='color:green;'>$status</label>";
                            }
                            elseif($status=="Cancelled"){
                              echo "<label style='color:red'>$status</label>";
                            }
                            
                            ?>
                        </td>

                        <td><?php echo $cus_name;?></td>

                        <td><?php echo $cus_email;?></td>

                        <td><?php echo $cus_address;?></td>

                        <td><?php echo $cus_contact;?></td>
                        <td>
                          <a href="<?php echo HOMEPAGE_URL;?>admi/update-order.php?id=<?php echo $id; ?>" class="btn-update">Update</a>
                        </td>
                      </tr>
                    <?php
                  }

                }else{
                  //when data is not in the database yet
                  echo "<tr><td colspan='7' class='error'>No orders available yet!! </td></tr>";
                }
              }

              ?>  
     
         
        </table>
      </div>
    </div>

<?php include('parts/footer.php');?>