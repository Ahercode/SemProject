<?php include('parts-frontEnd/nav.php') ?>


    <?php
    //get id of food selected by user
    if(isset($_GET['food_id'])){
        $food_id=$_GET['food_id'];

        $sql="SELECT * FROM tbl_food WHERE id=$food_id ";
        $res=mysqli_query($con,$sql);

        $count=mysqli_num_rows($res);

        //check for data in database
        if($count==1){
            
            $row=mysqli_fetch_assoc($res);
            $title=$row['title'];
            $price=$row['price'];
            $image=$row['image'];
        }else{
            //when the is no food available in the database
            header('location:'.HOMEPAGE_URL);
        }
    }else{
        header('location:'.HOMEPAGE_URL);
    }
    
    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="order-container">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend class="order-label">Selected Food</legend>
                    <?php
                    if($image==""){

                    }else{
                        ?>
                        <div class="food-menu-img">
                        <img src="<?php echo HOMEPAGE_URL;?>images/food/<?php echo $image;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                    </div>
                        <?php
                    }
                    ?>
                    
    
                    <div class="food-menu-desc">
                        <h3 class="order-label"><?php echo $title?></h3>
                        <input type="hidden" name="food"  value="<?php echo $title?>" >
                        <p class="food-price">Ghc<?php echo $price?>.00</p>
                        <input type="hidden" name="price"  value="<?php echo $price?>" >

                        <div class="order-label">Quantity</div>
                        <input type="number" name="quantity" class="input-responsive" value="1" required>
                        
                    </div>
                    
                </fieldset>
                <div class="clearfix"></div>
                <fieldset>
                    <legend class="order-label">Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Philip Aherto" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. ahercode.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Modex, Accra - Ghana
House no. SV401" class="input-responsive" required></textarea>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 0249182388" class="input-responsive" required>



                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>
                
            </form>

            <?php
            //post inputs from user
            if(isset($_POST['submit'])){

                $food=$_POST['food'];
                $price=$_POST['price'];
                $quantity=$_POST['quantity'];
                $total=$price*$quantity;//cal for total
                $date=date("Y-m-d h:i:sa");//order date
                $status="ordered";//status of order (ordered, on delivery, delivered or cancelled)
                $cus_name=$_POST['full-name'];
                $cus_email=$_POST['email'];
                $cus_address=$_POST['address'];
                $cus_contact=$_POST['contact'];

                $sql1 ="INSERT INTO tbl_order SET
                food='$food',
                price=$price,
                quantity=$quantity,
                total=$total,
                date='$date',
                status='$status',
                cus_name='$cus_name',
                cus_email='$cus_email',
                cus_address='$cus_address',
                cus_contact='$cus_contact'
                ";
                
                $res1=mysqli_query($con,$sql1);

                if($res1==true){

                    $_SESSION['order'] = "<div class='success1'><h3>Your Order Was Successfull.
                    You will receive a call from our customer representative to confirm our order</h3></div>";
                    header("location:".HOMEPAGE_URL);
                }else{
                    $_SESSION['order'] = "<div class='error text-center'>Your Order Failed
                    Please try again</div>";
                    header("location:".HOMEPAGE_URL);
                }


            }else{

            }
            ?>
        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    <div class="clearfix"></div>
    <!-- social Section Starts Here -->
    <section class="social">
        <div class="container text-center">
            <ul>
                <li>
                    <a href="https://www.facebook.com/profile.php?id=100006071111815"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png"/></a>
                </li>
                <li>
                    <a href="https://www.instagram.com/philipaherto/"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png"/></a>
                </li>
            </ul>
        </div>
    </section>
    <!-- social Section Ends Here -->

    <?php include('parts-frontEnd/footer.php') ?>