<?php

  session_start();

  define('LOCALHOST', 'sql213.epizy.com');
  define('DATABASE_USERNAME', 'epiz_27741454');
  define('DATABASE_NAME', 'epiz_27741454_aherfood');
  define('PASSWORD', 'XAEUMQ4IW688oAN');
  define('HOMEPAGE_URL','http://localhost/Sem_Project_00830118/');

  $con = mysqli_connect('LOCALHOST','DATABASE_USERNAME','DATABASE_NAME','PASSWORD');
  $db_select = mysqli_select_db($con, 'aherfood');

?>