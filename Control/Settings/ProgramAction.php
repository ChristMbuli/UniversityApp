<?php 
  try{
              
      $conn = new PDO('mysql:host=localhost;dbname=university;charset=utf8;','root','');

  }catch(Exception $e){
      die('Erreur de connexion: '.$e->getMessage());
  } 

      //Afficher les programmes
      $AllProgram = $conn->prepare('SELECT * FROM programs');
      $AllProgram->execute();

      //Afficher les programmes
      $AllPrograms = $conn->prepare('SELECT * FROM programs');
      $AllPrograms->execute();

      //Afficher les teachers
      $AllTeacher = $conn->prepare('SELECT * FROM teachers');
      $AllTeacher->execute();

       //Afficher les courses
       $AllCourses = $conn->prepare('SELECT * FROM courses');
       $AllCourses->execute();

?>