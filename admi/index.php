<?php include( 'parts/navbar.php'); ?>
   
    <!--main content-->
    <div class="main-content">
      <div class="wrapper">
        <h1>Dashboard</h1>
        <br>
        <?php

          if(isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset($_SESSION['login']);
          }
        ?>
        <div class="col item-center">
          <?php
          
          $sql = "SELECT * FROM tbl_categ";

          $res = mysqli_query($con, $sql);

          $count = mysqli_num_rows($res);
          ?>
          <h1><?php echo $count; ?></h1>
          <br>
          Categories
        </div>
        <div class="col item-center">
          <?php
          
          $sql1 = "SELECT * FROM tbl_food";

          $res1 = mysqli_query($con, $sql1);

          $count1 = mysqli_num_rows($res1);
          ?>
          <h1><?php echo $count1; ?></h1>
          <br>
          Food
        </div>
        <div class="col item-center">
        <?php
          
          $sql2 = "SELECT * FROM tbl_order";

          $res2 = mysqli_query($con, $sql2);

          $count2 = mysqli_num_rows($res2);
          ?>
          <h1><?php echo $count2; ?></h1>
          <br>
          Total Order
        </div>
        <div class="col item-center">
        <?php
          //for calculating total income or revenue
          $sql4 = "SELECT SUM(total) AS Total FROM tbl_order";

          $res4 = mysqli_query($con, $sql4);

          $res4 = mysqli_fetch_assoc($res4);

          $total_income = $res4['Total'];
          ?>
          <h1>Ghc <?php echo $total_income; ?> .00</h1>
          <br>
          Total Income
        </div>
        <div class="gap-out"></div>
      </div>
    </div>
<?php include( 'parts/footer.php'); ?>