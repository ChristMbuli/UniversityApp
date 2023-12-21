<?php 
    try{
              
        $conn = new PDO('mysql:host=localhost;dbname=university;charset=utf8;','root','');

    }catch(Exception $e){
        die('Erreur de connexion: '.$e->getMessage());
    }

    //Section pour verifier si l'id du student est entre dans le parametre de URL
    if(isset($_GET['id']) AND !empty($_GET['id'])){

        //stocker Id du student dans une variable
        $IdTheStudent = $_GET['id'];
        // $IdOwnerHouse = $_GET['id_owner'];

        //Section pour voir si l'id entrée correspond à un student dans la table
        $ReStudentExiste = $conn->prepare('SELECT * FROM students WHERE id_student = ?');
        $ReStudentExiste->execute(array($IdTheStudent));

        if($ReStudentExiste->rowCount() > 0){

            //Recuper tous les donnée et le stocker dans une variable sous forme d'un tableau avec la methode fetch()
            $StudentInfos = $ReStudentExiste->fetch();

            //Stocker les donnée dans les varibles correspondant
            
            $fname = $StudentInfos['fname'];
            $lname = $StudentInfos['lname'];
            $email = $StudentInfos['email'];
            $sexe = $StudentInfos['sexe'];
            $nation = $StudentInfos['nationality'];
            $birth = $StudentInfos['birth'];
            $profil = $StudentInfos['profil'];
            $prog = $StudentInfos['program'];
            $matricule = $StudentInfos['matricule'];


        }else{
            $errorMsg = 'No student found';
        }
    }else{
        $errorMsg = 'Student selection error';
    }


?>