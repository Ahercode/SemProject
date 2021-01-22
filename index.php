<?php include('parts-frontEnd/nav.php') ?>

    <!----Homepage---->
    <section class="search">
        <div class="search-container">
            
            <form action="<?php echo HOMEPAGE_URL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required >
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>

            <?php
            if(isset($_SESSION['order'])){
                echo $_SESSION['order'];
                unset($_SESSION['order']);
            }
            ?>
            
        <div class="featured">
            
            <h1 class="header">Food of the Day</h1>
            <p class="welcome">Truffle alfredo sauce topped<br>with 24 carat gold dust.</p>
            <button class="btn-order">Check It Out</button>
        </div>
    

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Featured Of The Week</h2>

            <?php

                $sql = "SELECT * FROM tbl_categ WHERE featured='Yes' AND active='Yes' LIMIT 6";

                $res = mysqli_query($con,$sql);

                $count = mysqli_num_rows($res);

                if($count>0){

                    while($rows=mysqli_fetch_assoc($res)){

                        $id = $rows['id'];
                        $title = $rows['title'];
                        $image = $rows['image'];

                        ?>
                        <!--pass id of category selected-->
                           <a href="<?php echo HOMEPAGE_URL; ?>category-foods.php?categ_id=<?php echo $id;?>">
                           <div class="box-3 float-container">
                               <?php

                                    if($image==""){

                                        echo "<div>Image not available for this category</div>";

                                    }else{

                                        ?>
                                            <img src="<?php echo HOMEPAGE_URL; ?>images/category/<?php echo $image ?>" alt="Pizza" class="img-responsive Categ-curve">
                                        <?php
                                    }
                                ?>
                                
                                <div class="product-info"> 
                                    <h3 class="P-title"><?php echo $title?></h3>
                                </div>
                
                            </div>
                           </a>
                        <?php
                    }

                }else{
                    echo "<div class='error'>No category available in database</div>";
                }
                
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
                <?php
                    $sql1= "SELECT * FROM tbl_food WHERE featured='Yes' AND active='Yes' LIMIT 5";

                    $res1 = mysqli_query($con,$sql1);

                    $count1 = mysqli_num_rows($res1);

                    if($count1>0){

                        while($row=mysqli_fetch_assoc($res1)){
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
                                        echo "<div class='error'>Image not available for this food </div>";
                                    }else{
                                        
                                        ?>
                                        <img src="<?php echo HOMEPAGE_URL; ?>images/food/<?php echo $image; ?>" alt="" class="img-responsive img-curve">
                                        <?php
                                    }

                                    ?>
                                </div>
                                

                                <div class="food-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <p class="food-price">Ghc <?php echo $price; ?>.00</p>
                                    <p class="food-detail">
                                        <?php echo $descrip; ?>
                                    </p>
                                    <br>
                                    <!--pass id of food selected by user-->
                                    <a href="<?php echo HOMEPAGE_URL;?>order.php?food_id=<?php echo $id?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
                            <?php
                        }

                    }else{
                        echo "<div class='error'>No Food Available</div>";
                    }
                ?>


            <div class="clearfix"></div>

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
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