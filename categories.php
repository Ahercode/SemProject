<?php include('parts-frontEnd/nav.php') ?>


    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php

            $sql = "SELECT * FROM tbl_categ WHERE active='Yes'";
            $res = mysqli_query($con, $sql);

            $count = mysqli_num_rows($res);

            if($count>0){
                while($row=mysqli_fetch_assoc($res)){

                    $id=$row['id'];
                    $title=$row['title'];
                    $image=$row['image'];
                    

                    ?>
                    <div class="box-3 float-container">
                    <?php

                        if($image==""){
                            echo "<div class='error'>Image not available for this food </div>";
                        }else{
                            ?>
                            <a href="<?php echo HOMEPAGE_URL; ?>category-foods.php?categ_id=<?php echo $id;?>"><img src="<?php echo HOMEPAGE_URL;?>images/category/<?php echo $image;?>" alt="Pizza" class="img-responsive Categ-curve"></a>
                            <?php
                        }
                    ?>
                    
                        <div class="product-info"> 
                            <h3 class="P-title"><?php echo $title; ?></h3>
                        </div>
                
                    </div>
                    <?php

                }
            }else{
                echo "<div class='error'>The are no categories added yet !!!!</div>";
            }
            ?>
            

            
            
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


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