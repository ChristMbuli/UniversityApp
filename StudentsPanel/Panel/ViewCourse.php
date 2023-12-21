<?php 
  try{
              
      $conn = new PDO('mysql:host=localhost;dbname=university;charset=utf8;','root','');

  }catch(Exception $e){
      die('Erreur de connexion: '.$e->getMessage());
  } 

      //Afficher les programmes
      $AllCourses = $conn->prepare('SELECT * FROM courses WHERE program = ?');
      $AllCourses->execute(array($_SESSION['program']));


?>