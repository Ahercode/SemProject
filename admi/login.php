<?php include("../config/connection.php"); ?>

<html >
<head>
  <title>Login | Aher Food</title>
  <link rel="stylesheet" type="" href="login.css">
</head>

<body>


<div class="container">
<h2>Login</h2>
        <br>
        <?php
          if(isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset($_SESSION['login']) ;
          }
        ?>
      <form action="" class="form" method="POST">
        
        <div class="form-control">
          <label for="username">Username</label>
          <br>
          <input type="text" name="username" placeholder="Enter username" />
          
        </div>
    
        <div class="form-control">
          <label for="password">Password</label>
          <br>
          <input type="password" name="password" placeholder="Enter password" />
          
        </div>
        
        <input type="submit" name="submit" value="Login" class="log">

        <p class="question">Don't have account ? <a href="#">Craete Account</a></p>
      </form>
    </div>
  
</body>
</html>


<?php

  if(isset($_POST['submit'])){

    $username=$_POST['username'];
    $password=$_POST['password'];

    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    $res=mysqli_query($con, $sql);

    $count=mysqli_num_rows($res);

    if($count==1){

      $_SESSION['login'] = "<div class='success'>Welcome</div>";

    //go back to manage admins page
    header("location:".HOMEPAGE_URL.'admi/');
    }else{

      $_SESSION['login'] = "<div class='error'>Invalid username or password</div>";

      //go back to manage admins page
      
    }  
  }
?>