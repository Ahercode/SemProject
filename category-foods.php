<?php include('parts-frontEnd/nav.php') ?>

    <?php

    if(isset($_GET['categ_id'])){

        $categ_id=$_GET['categ_id'];

        //get category base on category clicked by user
        $sql="SELECT title FROM tbl_categ WHERE id=$categ_id";

        $res=mysqli_query($con,$sql);

        $row=mysqli_fetch_assoc($res);

        $categ_title=$row['title'];

    }else{

        header('location:'.HOMEPAGE_URL);
    }

    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="">"<?php echo $categ_title;?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
            $sql="SELECT * FROM tbl_food WHERE categ_id=$categ_id";
            $res = mysqli_query($con, $sql);

            $count=mysqli_num_rows($res);
            if($count>0){
                while($row=mysqli_fetch_assoc($res)){
                    $id=$row['id'];
                    $title=$row['title'];
                    $price=$row['price'];
                    $descrip=$row['descrip'];
                    $image=$row['image'];

                    ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                        <?php
                            if($image==""){
                                echo "<div class='error'>No Image Found For This Food</div>";
                            }else{
                                ?>
                                <img src="<?php echo HOMEPAGE_URL;?>images/food/<?php echo $image;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                        ?>
                        
                        </div>
                            <div class="food-menu-desc">
                            <h4><?php echo $title;?></h4>
                            <p class="food-price">Ghc<?php echo $price;?>.00</p>
                            <p class="food-detail">
                                <?php echo $descrip;?>
                            </p>
                            <br>

                            <a href="<?php echo HOMEPAGE_URL;?>order.php?food_id=<?php echo $id?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
                    <?php
                }

            }else{
                echo "<div class='error'>No Food Available For This Category</div>";
            }
            ?>
            


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <!-- social Section Starts Here -->
    <section class="social">
        <div class="container text-center">
            <ul>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png"/></a>
                </li>
            </ul>
        </div>
    </section>
    <!-- social Section Ends Here -->

    <?php include('parts-frontEnd/footer.php') ?>