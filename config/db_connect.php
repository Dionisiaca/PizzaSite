<?php
      //Connect database with MySQLi or PDO
      $conection = mysqli_connect('localhost', 'grupop', '', 'php_pizza');

      //check conection
      if(!$conection){
          echo 'Connection error: ' . mysqli_connect_error();
      }

?>